<?php

namespace App\Http\Services\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\DistanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private DistanceService $distanceService;

    public function __construct()
    {
        $this->distanceService = new DistanceService;
    }

    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong');
        }

        $cartItems = $this->getCartItemsWithProducts($cart);
        $subtotal = $this->calculateSubtotal($cartItems);
        $storeConfig = [
            'lat' => config('store.latitude'),
            'lng' => config('store.longitude'),
            'radius' => config('store.delivery_radius_km'),
            'name' => config('store.name'),
        ];

        return view('customer.checkout.index', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'storeConfig' => $storeConfig,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:20',
            'address_note' => 'nullable|string|max:500',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'payment_method' => 'required|in:transfer,cod',
        ]);

        // Validate delivery radius
        if (! $this->distanceService->isWithinRadius(
            $validated['latitude'],
            $validated['longitude']
        )) {
            $distance = $this->distanceService->calculate(
                $validated['latitude'],
                $validated['longitude']
            );

            return back()->with('error', "Maaf, alamat di luar jangkauan pengantaran ({$distance} km dari toko). Maksimal 5 km.")->withInput();
        }

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja kosong');
        }

        $cartItems = $this->getCartItemsWithProducts($cart);
        $subtotal = $this->calculateSubtotal($cartItems);
        $distance = $this->distanceService->calculate(
            $validated['latitude'],
            $validated['longitude']
        );
        $shippingFee = $this->calculateShippingFee($subtotal);
        $grandTotal = $subtotal + $shippingFee;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'recipient_name' => $validated['recipient_name'],
                'recipient_phone' => $validated['recipient_phone'],
                'address_note' => $validated['address_note'] ?? null,
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'distance_km' => $distance,
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'grand_total' => $grandTotal,
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {

                // VALIDASI STOK
                if ($item['quantity'] > $item['product']->stock) {

                    DB::rollBack();

                    return back()->with(
                        'error',
                        'Stok produk '.$item['product']->name.' tidak mencukupi.'
                    );
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['product']->price,
                    'subtotal' => $item['product']->price * $item['quantity'],
                ]);

                // Kurangi stok otomatis
                $item['product']->decrement('stock', $item['quantity']);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function validateLocation(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $distance = $this->distanceService->calculate(
            $validated['latitude'],
            $validated['longitude']
        );

        $isWithinRadius = $this->distanceService->isWithinRadius(
            $validated['latitude'],
            $validated['longitude']
        );

        return response()->json([
            'distance' => $distance,
            'is_within_radius' => $isWithinRadius,
            'max_radius' => config('store.delivery_radius_km'),
            'message' => $isWithinRadius
                ? "Lokasi dalam jangkauan ({$distance} km)"
                : "Maaf, alamat di luar jangkauan ({$distance} km). Maksimal ".config('store.delivery_radius_km').' km.',
        ]);
    }

    private function getCartItemsWithProducts(array $cart): array
    {
        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $cartItems = [];
        foreach ($cart as $productId => $quantity) {
            if ($product = $products->get($productId)) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
        }

        return $cartItems;
    }

    private function calculateSubtotal(array $cartItems): float
    {
        return array_reduce($cartItems, function ($sum, $item) {
            return $sum + ($item['product']->price * $item['quantity']);
        }, 0);
    }

    private function calculateShippingFee(float $subtotal): float
    {
        // Free shipping for orders >= 500k as shown on homepage
        return $subtotal >= 500000 ? 0 : config('store.shipping_fee', 15000);
    }
}
