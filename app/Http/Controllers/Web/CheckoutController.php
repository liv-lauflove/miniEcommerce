<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\InvoiceService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function __construct(
        private CartService $cartService,
        private OrderService $orderService,
        private InvoiceService $invoiceService
    ) {}

    public function index(): View
    {
        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartItems = $this->cartService->getItems();
        $cartTotal = $this->cartService->total();

        return view('web.checkout.index', compact('cartItems', 'cartTotal'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|string|in:bank_transfer,cod,ewallet',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            $order = $this->orderService->createFromCart(Auth::user(), $validated);

            $this->invoiceService->sendInvoiceEmail($order);

            return redirect()
                ->route('orders.show', $order->id)
                ->with('success', 'Order placed successfully! Your invoice has been sent to your email.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }
}
