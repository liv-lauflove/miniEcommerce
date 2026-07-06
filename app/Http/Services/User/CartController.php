<?php

namespace App\Http\Services\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        $products = Product::with('category')
            ->whereIn('id', array_keys($cart))
            ->get();

        $items = $products->map(function ($product) use ($cart) {
            $quantity = $cart[$product->id] ?? 0;

            return (object) [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity,
            ];
        });

        $subtotal = $items->sum('subtotal');

        return view('customer.cart.index', compact('items', 'subtotal'));
    }

    public function store(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return back()->with('error', 'Maaf, stok produk sedang kosong.');
        }

        $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $quantity = (int) $request->input('quantity', 1);

        $cart = session('cart', []);

        $currentQuantity = $cart[$product->id] ?? 0;
        $newQuantity = $currentQuantity + $quantity;

        if ($newQuantity > $product->stock) {
            return back()->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        }

        $cart[$product->id] = $newQuantity;

        session()->put('cart', $cart);

        return back()->with('success', $product->name.' berhasil ditambahkan ke cart.');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        }

        $cart = session('cart', []);
        $cart[$product->id] = (int) $request->quantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $cart = session('cart', []);

        unset($cart[$product->id]);

        session()->put('cart', $cart);

        return back()->with('success', 'Produk berhasil dihapus dari cart.');
    }
}
