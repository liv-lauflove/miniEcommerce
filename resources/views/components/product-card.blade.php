<article class="card-hover overflow-hidden group">
    <a href="{{ route('product.show', $product->slug) }}">
        {{-- Image --}}
        <div class="aspect-square bg-gray-100 overflow-hidden relative">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            @endif
            @if($product->stock <= 0)
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                    <span class="badge-red">Out of Stock</span>
                </div>
            @elseif($product->stock < 5)
                <div class="absolute top-2 left-2">
                    <span class="badge-yellow">Low Stock</span>
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="p-4">
            @if($product->category)
                <p class="text-xs text-chocolate-600 font-medium uppercase tracking-wider mb-1">{{ $product->category->name }}</p>
            @endif
            <h3 class="font-medium text-chocolate-600 group-hover:text-chocolate-500 transition-colors line-clamp-2 text-sm mb-2">{{ $product->name }}</h3>
            <div class="flex items-center justify-between">
                <span class="text-chocolate-600 font-bold">{{ $product->formatted_price }}</span>
                @if($product->stock > 0)
                    <span class="text-xs text-green-600 font-medium">In Stock</span>
                @endif
            </div>
        </div>
    </a>
</article>
