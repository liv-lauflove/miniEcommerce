<x-layouts.web title="Shop">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-oxford-900 mb-2">Shop</h1>
            <p class="body-text">Browse our full collection of products.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Filters Sidebar --}}
            <aside class="lg:w-64 flex-shrink-0">
                <form method="GET" action="{{ route('shop') }}" class="card p-6 space-y-6 sticky top-24">
                    <div>
                        <h3 class="font-semibold text-oxford-900 mb-3 text-sm">Search</h3>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="form-input text-sm">
                    </div>

                    <div>
                        <h3 class="font-semibold text-oxford-900 mb-3 text-sm">Category</h3>
                        <select name="category" class="form-select text-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <h3 class="font-semibold text-oxford-900 mb-3 text-sm">Price Range</h3>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="form-input text-sm w-1/2">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="form-input text-sm w-1/2">
                        </div>
                    </div>

                    <div>
                        <h3 class="font-semibold text-oxford-900 mb-3 text-sm">Sort By</h3>
                        <select name="sort" class="form-select text-sm">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name A-Z</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-primary w-full btn-sm">Apply Filters</button>
                    <a href="{{ route('shop') }}" class="btn-ghost w-full text-center btn-sm text-xs">Clear Filters</a>
                </form>
            </aside>

            {{-- Products Grid --}}
            <div class="flex-1">
                <div class="flex items-center justify-between mb-6">
                    <p class="text-sm body-text">{{ $products->total() }} products</p>
                </div>

                @if($products->isEmpty())
                    <div class="card p-12 text-center">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        <h3 class="font-semibold text-oxford-900 mb-1">No products found</h3>
                        <p class="body-text text-sm">Try adjusting your filters or search terms.</p>
                    </div>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($products as $product)
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.web>
