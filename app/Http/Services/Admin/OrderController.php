<?php

namespace App\Http\Services\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Order;
use App\Patterns\Observer\ActivityLogObserver;
use App\Patterns\Observer\OrderStatusSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'orderItems.product'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('recipient_name', 'like', '%'.$search.'%')
                        ->orWhere('recipient_phone', 'like', '%'.$search.'%')
                        ->orWhere('address_note', 'like', '%'.$search.'%');
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $statuses = ['pending', 'diproses', 'dikirim', 'selesai', 'tertunda'];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product']);

        $activityLogs = ActivityLog::where('order_id', $order->id)
            ->with('admin')
            ->latest()
            ->get();

        return view('admin.orders.show', compact('order', 'activityLogs'));
    }

    /**
     * Accept/Receive an order
     */
    public function accept(Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Hanya pesanan dengan status "Menunggu" yang dapat diterima.');
        }

        $oldStatus = $order->status;
        $order->update(['status' => 'diproses']);

        // --- OBSERVER PATTERN ---
        $subject = new OrderStatusSubject($order);
        $subject->attach(new ActivityLogObserver);
        $subject->notify('accept', $oldStatus, 'diproses', Auth::id());
        // ------------------------

        return back()->with('success', 'Pesanan berhasil diterima dan status diubah menjadi "Diproses".');
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,diproses,dikirim,selesai,tertunda'],
        ]);

        $oldStatus = $order->status;

        // Validasi transisi status yang diizinkan
        $validTransitions = [
            'pending' => ['diproses', 'tertunda'],
            'diproses' => ['dikirim', 'tertunda'],
            'dikirim' => ['selesai'],
            'selesai' => [],
            'tertunda' => ['diproses', 'dikirim'],
        ];

        if (! in_array($validated['status'], $validTransitions[$oldStatus])) {
            return back()->with('error', 'Transisi status tidak diizinkan. Dari '.ucfirst($oldStatus).' hanya bisa ke: '.implode(', ', $validTransitions[$oldStatus]));
        }

        $order->update(['status' => $validated['status']]);

        // --- OBSERVER PATTERN ---
        $subject = new OrderStatusSubject($order);
        $subject->attach(new ActivityLogObserver);
        $subject->notify('update_status', $oldStatus, $validated['status'], Auth::id());
        // ------------------------

        return back()->with('success', 'Status pesanan berhasil diperbarui menjadi '.ucfirst($validated['status']).'.');
    }
}
