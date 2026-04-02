<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
    public function __construct(private InvoiceService $invoiceService) {}

    public function index(): View
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('web.orders.index', compact('orders'));
    }

    public function show(int $id): View
    {
        $order = Order::with(['items.product', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('web.orders.show', compact('order'));
    }

    public function invoice(Order $order): View|StreamedResponse
    {
        abort_unless($order->user_id === Auth::id(), 403);

        $order->load(['items.product', 'user']);

        if (request('format') === 'pdf') {
            return $this->invoiceService->streamPdf($order);
        }

        return view('web.orders.invoice', compact('order'));
    }

    public function downloadInvoice(Order $order): StreamedResponse
    {
        abort_unless($order->user_id === Auth::id(), 403);

        return $this->invoiceService->downloadPdf($order);
    }
}
