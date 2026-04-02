<x-layouts.web title="{{ $product->name }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm body-text mb-8">
            <a href="{{ route('home') }}" class="hover:text-oxford-600">Home</a>
            <span>/</span>
            <a href="{{ route('shop') }}" class="hover:text-oxford-600">Shop</a>
            <span>/</span>
            @if($product->category)
                <a href="{{ route('shop', ['category' => $product->category->id]) }}" class="hover:text-oxford-600">{{ $product->category->name }}</a>
                <span>/</span>
            @endif
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Image --}}
            <div>
                <div class="aspect-square bg-gray-100 rounded-2xl overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Info --}}
            <div>
                @if($product->category)
                    <span class="badge-tan mb-4 inline-block">{{ $product->category->name }}</span>
                @endif
                <h1 class="text-2xl md:text-3xl font-bold text-oxford-900 mb-4">{{ $product->name }}</h1>

                <div class="text-3xl font-bold text-oxford-900 mb-6">{{ $product->formatted_price }}</div>

                {{-- Stock --}}
                @if($product->stock > 0)
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-green-700 font-medium">In Stock ({{ $product->stock }} available)</span>
                    </div>
                @else
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <span class="text-sm text-red-700 font-medium">Out of Stock</span>
                    </div>
                @endif

                @if($product->description)
                    <div class="body-text mb-8 leading-relaxed">{{ $product->description }}</div>
                @endif

                {{-- Add to Cart --}}
                @if($product->stock > 0)
                    <form action="{{ route('cart.store') }}" method="POST" class="flex gap-4 mb-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                            <button type="button" class="px-4 py-2.5 hover:bg-gray-100 transition-colors text-gray-600" onclick="const input = this.nextElementSibling; input.value = Math.max(1, parseInt(input.value) - 1)">−</button>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-16 text-center border-x border-gray-200 py-2.5 focus:outline-none text-gray-900">
                            <button type="button" class="px-4 py-2.5 hover:bg-gray-100 transition-colors text-gray-600" onclick="const input = this.previousElementSibling; input.value = Math.min({{ $product->stock }}, parseInt(input.value) + 1)">+</button>
                        </div>
                        <button type="submit" class="btn-primary flex-1">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <div class="alert-error mb-8">This product is currently out of stock.</div>
                @endif

                <div class="card p-4 text-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-oxford-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                        <span class="body-text">Free shipping on orders over Rp 500.000</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->isNotEmpty())
        <div class="mt-16">
            <h2 class="section-title">Related Products</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-layouts.web>
