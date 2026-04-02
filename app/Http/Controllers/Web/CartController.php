<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function index(): View
    {
        $cartItems = $this->cartService->getItems();
        $cartTotal = $this->cartService->total();
        $cartCount = $this->cartService->count();

        return view('web.cart.index', compact('cartItems', 'cartTotal', 'cartCount'));
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = max(1, (int) $request->quantity ?? 1);

        if ($product->stock < $quantity) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Insufficient stock.'], 422);
            }
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        $this->cartService->add($product, $quantity);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Product added to cart.',
                'cart_count' => $this->cartService->count(),
                'cart_total' => $this->cartService->getFormattedTotal(),
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($validated['quantity'] > 0 && $product->stock < $validated['quantity']) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Insufficient stock.'], 422);
            }
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        $this->cartService->update($validated['product_id'], $validated['quantity']);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Cart updated.',
                'cart_count' => $this->cartService->count(),
                'cart_total' => $this->cartService->getFormattedTotal(),
            ]);
        }

        return redirect()->back();
    }

    public function destroy(Request $request, int $productId): JsonResponse|RedirectResponse
    {
        $this->cartService->remove($productId);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Item removed from cart.',
                'cart_count' => $this->cartService->count(),
                'cart_total' => $this->cartService->getFormattedTotal(),
            ]);
        }

        return redirect()->back();
    }
}
