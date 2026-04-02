<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::active()
            ->inStock()
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount(['activeProducts'])
            ->having('active_products_count', '>', 0)
            ->get();

        return view('web.home', compact('featuredProducts', 'categories'));
    }
}
