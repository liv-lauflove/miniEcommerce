<x-layouts.web title="Home">

    {{-- ================================================
         HERO SECTION
         ================================================ --}}
    <section class="relative bg-gradient-to-br from-chocolate-700 via-chocolate-600 to-chocolate-800 overflow-hidden">
        {{-- Decorative background shapes --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-20 -right-20 w-80 h-80 rounded-full bg-white/[0.04]"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-white/[0.03]"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full bg-white/[0.02]"></div>
            {{-- Diagonal accent stripe --}}
            <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-cream-400/10 to-transparent hidden lg:block"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28 lg:py-32">
            <div class="max-w-2xl">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-1.5 mb-6">
                    <span class="w-2 h-2 rounded-full bg-cream-400 animate-pulse"></span>
                    <span class="text-cream-200 text-sm font-medium">Toko Bahan Baku Roti Terpercaya</span>
                </div>

                {{-- Headline --}}
                <h1 class="text-4xl md:text-5xl xl:text-6xl font-bold text-white leading-tight mb-6">
                    Wujudkan Roti
                    <span class="text-cream-300"> Sempurna</span><br>
                    dengan Bahan Premium
                </h1>

                {{-- Subheadline --}}
                <p class="text-white/70 text-lg md:text-xl mb-8 leading-relaxed max-w-lg">
                    UD Trisna Putra menyediakan berbagai bahan baku roti berkualitas tinggi. Dari tepung hingga cokelat premium — semua dalam satu tempat.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap items-center gap-4 mb-10">
                    <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 bg-cream-400 hover:bg-cream-300 text-chocolate-800 font-semibold px-7 py-3.5 rounded-xl transition-all duration-150 hover:shadow-lg hover:-translate-y-0.5">
                        Jelajahi Produk
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('shop') }}?sort=price_asc" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/25 text-white font-medium px-7 py-3.5 rounded-xl transition-all duration-150">
                        Lihat Penawaran
                    </a>
                </div>

                {{-- Trust indicators --}}
                <div class="flex flex-wrap items-center gap-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-cream-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span class="text-white/80 text-sm">Bahan Premium</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-cream-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span class="text-white/80 text-sm">Gratis Ongkir</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-cream-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span class="text-white/80 text-sm">Quality Guaranteed</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================
         STATS BAR
         ================================================ --}}
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-0 md:divide-x divide-gray-100">
                <div class="flex flex-col items-center text-center px-4">
                    <div class="w-10 h-10 bg-chocolate-100 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-chocolate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <span class="text-xl md:text-2xl font-bold text-chocolate-700">100+</span>
                    <span class="text-xs text-gray-500 mt-0.5">Jenis Bahan Baku</span>
                </div>
                <div class="flex flex-col items-center text-center px-4">
                    <div class="w-10 h-10 bg-chocolate-100 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-chocolate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <span class="text-xl md:text-2xl font-bold text-chocolate-700">1.200+</span>
                    <span class="text-xs text-gray-500 mt-0.5">Pelanggan Puas</span>
                </div>
                <div class="flex flex-col items-center text-center px-4">
                    <div class="w-10 h-10 bg-chocolate-100 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-chocolate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <span class="text-xl md:text-2xl font-bold text-chocolate-700">100%</span>
                    <span class="text-xs text-gray-500 mt-0.5">Kualitas Terjamin</span>
                </div>
                <div class="flex flex-col items-center text-center px-4">
                    <div class="w-10 h-10 bg-chocolate-100 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-chocolate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span class="text-xl md:text-2xl font-bold text-chocolate-700">Cepat</span>
                    <span class="text-xs text-gray-500 mt-0.5">Proses & Pengiriman</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================
         FEATURED PRODUCTS
         ================================================ --}}
    @if($featuredProducts->isNotEmpty())
    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="flex items-center justify-between mb-10">
                <div>
                    <span class="text-xs font-semibold text-chocolate-500 uppercase tracking-widest">Koleksi Kami</span>
                    <h2 class="text-2xl md:text-3xl font-bold text-chocolate-700 mt-1">Produk Unggulan</h2>
                </div>
                <a href="{{ route('shop') }}" class="hidden sm:flex items-center gap-1 text-sm font-medium text-chocolate-600 hover:text-chocolate-700 transition-colors group">
                    Lihat Semua
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Products Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-6">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            {{-- Mobile "View All" --}}
            <div class="sm:hidden mt-6 text-center">
                <a href="{{ route('shop') }}" class="btn-secondary btn-sm">Lihat Semua Produk</a>
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================
         WHY CHOOSE US
         ================================================ --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs font-semibold text-chocolate-500 uppercase tracking-widest">Mengapa Memilih Kami</span>
                <h2 class="text-2xl md:text-3xl font-bold text-chocolate-700 mt-1">Keunggulan UD Trisna Putra</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                {{-- Benefit 1 --}}
                <div class="bg-cream-50 rounded-2xl p-6 text-center border border-cream-100 hover:shadow-lift transition-shadow duration-300">
                    <div class="w-14 h-14 bg-chocolate-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-chocolate-700 text-base mb-2">Bahan Premium</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Menggunakan bahan baku import & lokal berkualitas tinggi untuk hasil roti terbaik.</p>
                </div>
                {{-- Benefit 2 --}}
                <div class="bg-cream-50 rounded-2xl p-6 text-center border border-cream-100 hover:shadow-lift transition-shadow duration-300">
                    <div class="w-14 h-14 bg-chocolate-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-chocolate-700 text-base mb-2">Harga Bersaing</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Dapatkan harga terbaik langsung dari distributor resmi. Tanpa perantara.</p>
                </div>
                {{-- Benefit 3 --}}
                <div class="bg-cream-50 rounded-2xl p-6 text-center border border-cream-100 hover:shadow-lift transition-shadow duration-300">
                    <div class="w-14 h-14 bg-chocolate-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-chocolate-700 text-base mb-2">Pengiriman Cepat</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Pesanan diproses same-day & dikirim besok hari.</p>
                </div>
                {{-- Benefit 4 --}}
                <div class="bg-cream-50 rounded-2xl p-6 text-center border border-cream-100 hover:shadow-lift transition-shadow duration-300">
                    <div class="w-14 h-14 bg-chocolate-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-md">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-chocolate-700 text-base mb-2">Quality Assured</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Setiap produk melewati quality control ketat. Garansi replace jika tidak sesuai standar.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================
         CATEGORIES
         ================================================ --}}
    @if($categories->isNotEmpty())
    <section class="section bg-cream-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="text-xs font-semibold text-chocolate-500 uppercase tracking-widest">Telusuri</span>
                <h2 class="text-2xl md:text-3xl font-bold text-chocolate-700 mt-1">Kategori Produk</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('shop', ['category' => $category->id]) }}"
                       class="bg-white rounded-2xl p-5 text-center border border-cream-100 hover:border-chocolate-200 hover:shadow-lift transition-all duration-200 group">
                        <div class="w-14 h-14 bg-cream-100 group-hover:bg-chocolate-100 rounded-2xl flex items-center justify-center mx-auto mb-3 transition-colors duration-200">
                            <svg class="w-6 h-6 text-chocolate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-chocolate-700 group-hover:text-chocolate-600 transition-colors text-sm mb-1">{{ $category->name }}</h3>
                        <p class="text-xs text-gray-400">{{ $category->active_products_count }} produk</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================
         CTA BANNER
         ================================================ --}}
    <section class="relative bg-gradient-to-r from-chocolate-600 via-chocolate-700 to-chocolate-800 overflow-hidden">
        {{-- Decorative --}}
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-16 -right-16 w-72 h-72 rounded-full bg-white/[0.04]"></div>
            <div class="absolute -bottom-16 -left-16 w-80 h-80 rounded-full bg-white/[0.03]"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center">
            <h2 class="text-2xl md:text-4xl font-bold text-white mb-4 leading-tight">
                Siap Wujudkan Roti Impian Anda?
            </h2>
            <p class="text-white/70 text-base md:text-lg mb-8 max-w-xl mx-auto">
                Mulai pesan bahan baku pilihan Anda hari ini. Gratis ongkir ke seluruh Bali (S&K berlaku).
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('shop') }}" class="inline-flex items-center gap-2 bg-cream-400 hover:bg-cream-300 text-chocolate-800 font-bold px-8 py-3.5 rounded-xl transition-all duration-150 hover:shadow-lg hover:-translate-y-0.5">
                    <span>Belanja Sekarang</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                </a>
                <a href="https://wa.me/623619004486" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/25 text-white font-medium px-8 py-3.5 rounded-xl transition-all duration-150">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Hubungi via WhatsApp</span>
                </a>
            </div>
        </div>
    </section>

</x-layouts.web>
