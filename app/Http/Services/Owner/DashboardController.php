<?php

namespace App\Http\Services\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display owner dashboard
     */
    public function index(Request $request)
    {
        // Default filter: current month
        $period = $request->get('period', 'month');

        if ($period === 'month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            $label = 'Bulan '.Carbon::now()->translatedFormat('F Y');
        } else {
            $startDate = Carbon::now()->startOfDay();
            $endDate = Carbon::now()->endOfDay();
            $label = 'Hari Ini - '.Carbon::now()->translatedFormat('d F Y');
        }

        // Total Revenue
        $totalRevenue = Order::where('status', 'selesai')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('grand_total');

        // Total Orders (incoming)
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Processed Orders (successful)
        $processedOrders = Order::where('status', 'selesai')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Pending Orders
        $pendingOrders = Order::where('status', 'pending')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // In Progress Orders
        $inProgressOrders = Order::whereIn('status', ['diproses', 'dikirim'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // Get daily sales data for chart
        $dailySalesData = $this->getDailySalesData($period, $startDate, $endDate);

        // Get top products by sales
        $topProducts = $this->getTopProducts($startDate, $endDate);

        // All available periods
        $periods = ['day' => 'Hari Ini', 'month' => 'Bulan Ini'];

        return view('owner.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'processedOrders',
            'pendingOrders',
            'inProgressOrders',
            'dailySalesData',
            'topProducts',
            'period',
            'periods',
            'label'
        ));
    }

    /**
     * Get daily sales data for chart
     */
    private function getDailySalesData($period, $startDate, $endDate)
    {
        $query = Order::where('status', 'selesai')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(grand_total) as total, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];

        if ($period === 'day') {
            // Hourly data
            for ($i = 0; $i < 24; $i++) {
                $labels[] = sprintf('%02d:00', $i);
                $data[] = 0;
            }

            foreach ($query as $item) {
                $hour = intval(Carbon::parse($item->date)->format('H'));
                $data[$hour] = $item->total;
            }
        } else {
            // Daily data for the month
            $current = $startDate->clone();
            while ($current <= $endDate) {
                $labels[] = $current->format('d');
                $current->addDay();
            }

            foreach ($query as $item) {
                $day = intval(Carbon::parse($item->date)->format('d')) - 1;
                $data[$day] = $item->total;
            }
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Get top products by sales
     */
    private function getTopProducts($startDate, $endDate)
    {
        return \DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'selesai')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->select(
                'products.name',
                \DB::raw('SUM(order_items.quantity) as total_quantity'),
                \DB::raw('SUM(order_items.subtotal) as total_sales')
            )
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();
    }
}
