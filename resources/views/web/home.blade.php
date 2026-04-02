<x-layouts.web title="Home">
    {{-- Hero --}}
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="max-w-2xl">
                <span class="badge-cream mb-4 inline-block">Selamat Datang di UD Trisna Putra</span>
                <h1 class="text-4xl md:text-5xl font-bold text-chocolate-600 leading-tight mb-4">
                    Bahan Roti Premium,<br>Harga Terbaik.
                </h1>
                <p class="body-text text-lg mb-8">
                    Temukan koleksi bahan baku roti berkualitas tinggi. Belanja dengan percaya diri, kualitas terjamin.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('shop') }}" class="btn-primary">
                        Jelajahi Produk
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('shop') }}?sort=price_asc" class="btn-secondary">Lihat Penawaran</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    @if($featuredProducts->isNotEmpty())
    <section class="section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="section-title mb-0">Featured Products</h2>
                <a href="{{ route('shop') }}" class="text-chocolate-500 hover:text-chocolate-700 font-medium text-sm flex items-center gap-1">
                    View All
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Categories --}}
    @if($categories->isNotEmpty())
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="section-title">Shop by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('shop', ['category' => $category->id]) }}" class="card-hover p-6 text-center group">
                        <div class="w-12 h-12 bg-cream-100 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-cream-200 transition-colors">
                            <svg class="w-5 h-5 text-chocolate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/></svg>
                        </div>
                        <h3 class="font-medium text-chocolate-600 group-hover:text-chocolate-500 transition-colors">{{ $category->name }}</h3>
                        <p class="text-xs muted-text mt-1">{{ $category->active_products_count }} products</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section class="section bg-chocolate-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Mulai Belanja Hari Ini</h2>
            <p class="text-chocolate-300 mb-8 max-w-lg mx-auto">Jelajahi katalog lengkap kami dan temukan bahan baku yang Anda butuhkan. Gratis ongkir untuk pesanan di atas Rp 500.000.</p>
            <a href="{{ route('shop') }}" class="btn-accent">Lihat Semua Produk</a>
        </div>
    </section>
</x-layouts.web>
