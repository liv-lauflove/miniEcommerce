<article class="card-hover overflow-hidden group relative">
    <a href="{{ route('product.show', $product->slug) }}" class="block">

        {{-- Image --}}
        <div class="aspect-square bg-gray-100 overflow-hidden relative">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <div class="w-full h-full flex items-center justify-center bg-cream-50">
                    <svg class="w-12 h-12 text-chocolate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif

            {{-- Stock overlay --}}
            @if($product->stock <= 0)
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                    <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">Stok Habis</span>
                </div>
            @elseif($product->stock < 5)
                <div class="absolute top-2 left-2">
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Stok Terbatas</span>
                </div>
            @endif

            {{-- Hover: Quick Add to Cart overlay --}}
            @if($product->stock > 0)
                <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                    <div class="translate-y-2 group-hover:translate-y-0 transition-transform duration-200">
                        <form method="POST" action="{{ route('cart.store') }}" onsubmit="event.stopPropagation()">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit"
                                    class="bg-white text-chocolate-700 font-semibold text-sm px-5 py-2 rounded-xl shadow-lg hover:bg-cream-50 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="p-4">
            @if($product->category)
                <p class="text-xs text-chocolate-500 font-medium uppercase tracking-wider mb-1">{{ $product->category->name }}</p>
            @endif
            <h3 class="font-semibold text-gray-800 group-hover:text-chocolate-600 transition-colors line-clamp-2 text-sm mb-2 leading-snug">{{ $product->name }}</h3>
            <div class="flex items-center justify-between">
                <span class="text-chocolate-700 font-bold text-base">{{ $product->formatted_price }}</span>
                @if($product->stock > 0)
                    <span class="text-xs text-green-600 font-medium flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                        Tersedia
                    </span>
                @endif
            </div>
        </div>
    </a>
</article>
