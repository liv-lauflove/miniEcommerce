<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        private CartService $cartService
    ) {}

    public function createFromCart(User $user, array $data): Order
    {
        return DB::transaction(function () use ($user, $data) {
            $cartItems = $this->cartService->getItems();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty.');
            }

            $productIds = $cartItems->pluck('product_id')->toArray();

            // Lock product rows to prevent race-condition overselling
            $products = Product::whereIn('id', $productIds)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            // Re-validate stock within the lock
            foreach ($cartItems as $item) {
                $product = $products->get($item['product_id']);
                if (!$product || $product->stock < $item['quantity']) {
                    throw new \Exception(
                        $product
                            ? "Insufficient stock for '{$product->name}'."
                            : 'One or more products are no longer available.'
                    );
                }
            }

            $totalAmount = $cartItems->sum('subtotal');

            $order = Order::create([
                'user_id' => $user->id,
                'invoice_number' => Order::generateInvoiceNumber(),
                'status' => OrderStatus::Pending,
                'total_amount' => $totalAmount,
                'shipping_address' => $data['shipping_address'],
                'phone' => $data['phone'],
                'payment_method' => $data['payment_method'],
                'notes' => $data['notes'] ?? null,
                'invoice_date' => now(),
                'due_date' => now()->addDays(7),
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);

                $products->get($item['product_id'])->decrement('stock', $item['quantity']);
            }

            $this->cartService->clear();

            return $order->load('items.product');
        });
    }

    public function updateStatus(Order $order, OrderStatus $status): Order
    {
        $order->update(['status' => $status]);
        return $order->fresh();
    }

    public function getStats(): array
    {
        return [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', OrderStatus::Pending)->count(),
            'total_revenue' => Order::where('status', '!=', OrderStatus::Cancelled)->sum('total_amount'),
            'recent_orders' => Order::with('user')->latest()->take(5)->get(),
        ];
    }
}
