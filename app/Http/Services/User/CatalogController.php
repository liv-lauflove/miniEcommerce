<?php

namespace App\Http\Services\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CatalogController extends Controller
{
    public function home()
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $products = Product::with('category')
            ->latest()
            ->take(8)
            ->get();

        $recentlyPurchased = collect();

        if (
            Auth::check()
            && Schema::hasTable('orders')
            && Schema::hasTable('order_items')
        ) {
            $productIds = OrderItem::query()
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.user_id', Auth::id())
                ->select('order_items.product_id')
                ->distinct()
                ->pluck('order_items.product_id');

            $recentlyPurchased = Product::with('category')
                ->whereIn('id', $productIds)
                ->latest()
                ->take(4)
                ->get();
        }

        return view('customer.home', compact(
            'categories',
            'products',
            'recentlyPurchased'
        ));
    }

    public function categories(Request $request)
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $selectedCategory = null;

        $products = Product::with('category')
            ->when($request->filled('category_id'), function ($query) use ($request, &$selectedCategory) {
                $selectedCategory = Category::find($request->category_id);

                $query->where('category_id', $request->category_id);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('name', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%');
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('customer.categories', compact(
            'categories',
            'products',
            'selectedCategory'
        ));
    }

    public function show(Product $product)
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('customer.products.show', compact(
            'product',
            'relatedProducts'
        ));
    }
}
