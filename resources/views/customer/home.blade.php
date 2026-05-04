@extends('customer.layout')

@section('content')
    <section class="grid gap-5 lg:grid-cols-[1.45fr_0.75fr]">
        <div class="relative overflow-hidden rounded-[2rem] bg-slate-950 p-6 shadow-sm sm:p-8 lg:p-12">
            <div class="absolute inset-0 opacity-30">
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-yellow-400 blur-3xl"></div>
                <div class="absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-green-500 blur-3xl"></div>
                <div class="absolute bottom-10 right-20 h-40 w-40 rounded-full bg-red-500 blur-3xl"></div>
            </div>

            <div class="relative">
                <span class="inline-flex rounded-full bg-yellow-400 px-4 py-2 text-xs font-black uppercase tracking-wide text-slate-950">
                    Toko bahan kue & kemasan
                </span>

                <h1 class="mt-6 max-w-3xl text-4xl font-black leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Belanja kebutuhan baking dan kemasan jadi lebih gampang.
                </h1>

                <p class="mt-5 max-w-2xl text-sm leading-7 text-slate-200 sm:text-base sm:leading-8">
                    Temukan bahan kue, alat baking, plastik kemasan, bahan memasak, minuman, dan frozen food dalam satu katalog yang mudah dijelajahi.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('categories.index') }}" class="rounded-full bg-yellow-400 px-6 py-3 text-sm font-black text-slate-950 shadow-sm transition hover:bg-yellow-300">
                        Mulai Belanja
                    </a>

                    @auth
                        <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 rounded-full bg-white/10 px-6 py-3 text-sm font-black text-white ring-1 ring-white/20 transition hover:bg-white/15">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h2.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L7.5 14.25A2.25 2.25 0 0 0 9.694 16h6.862a2.25 2.25 0 0 0 2.183-1.704l1.111-4.444A1.125 1.125 0 0 0 18.76 8.45H7.02m-.914-3.178L5.25 2.25M9 20.25h.008v.008H9v-.008Zm8.25 0h.008v.008h-.008v-.008Z" />
                            </svg>
                            Keranjang
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full bg-white/10 px-6 py-3 text-sm font-black text-white ring-1 ring-white/20 transition hover:bg-white/15">
                            Login untuk Belanja
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <aside class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200/70 sm:p-8">
            <p class="text-sm font-black uppercase tracking-wide text-green-700">
                Info Toko
            </p>

            <h2 class="mt-3 text-2xl font-black text-slate-950">
                Shopping first, validate later.
            </h2>

            <p class="mt-3 text-sm leading-7 text-slate-500">
                Kamu bisa lihat produk dan isi keranjang dulu. Validasi minimum belanja dan jarak pengiriman dilakukan saat checkout.
            </p>

            <div class="mt-6 space-y-3">
                <div class="rounded-2xl bg-yellow-50 p-4 ring-1 ring-yellow-100">
                    <p class="text-xs font-bold text-slate-500">Minimum Order</p>
                    <p class="mt-1 text-lg font-black text-slate-950">Rp500.000</p>
                </div>

                <div class="rounded-2xl bg-green-50 p-4 ring-1 ring-green-100">
                    <p class="text-xs font-bold text-slate-500">Radius Pengiriman</p>
                    <p class="mt-1 text-lg font-black text-green-800">Maks. 5 KM</p>
                </div>

                <div class="rounded-2xl bg-red-50 p-4 ring-1 ring-red-100">
                    <p class="text-xs font-bold text-slate-500">Kategori</p>
                    <p class="mt-1 text-lg font-black text-red-700">{{ $categories->count() }} kategori tersedia</p>
                </div>
            </div>
        </aside>
    </section>

    <section class="mt-10 sm:mt-12">
        <div class="mb-5 flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-black uppercase tracking-wide text-red-600">
                    Produk Pilihan
                </p>

                <h2 class="mt-1 text-2xl font-black text-slate-950 sm:text-3xl">
                    Preview Produk
                </h2>
            </div>

            <a href="{{ route('categories.index') }}" class="hidden rounded-full bg-slate-100 px-4 py-2 text-sm font-black text-slate-700 transition hover:bg-yellow-400 hover:text-slate-950 sm:inline-flex">
                Lihat semua
            </a>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($products as $product)
                @include('customer.partials.product-card', ['product' => $product])
            @empty
                <div class="col-span-full rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center">
                    <h3 class="text-xl font-black text-slate-950">
                        Produk belum tersedia
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Tambahkan produk dari admin panel.
                    </p>
                </div>
            @endforelse
        </div>

        <a href="{{ route('categories.index') }}" class="mt-5 inline-flex w-full justify-center rounded-full bg-slate-100 px-4 py-3 text-sm font-black text-slate-700 transition hover:bg-yellow-400 hover:text-slate-950 sm:hidden">
            Lihat semua produk
        </a>
    </section>

    @auth
        @if ($recentlyPurchased->isNotEmpty())
            <section class="mt-10 sm:mt-12">
                <div class="mb-5">
                    <p class="text-sm font-black uppercase tracking-wide text-green-700">
                        Belanja Lagi
                    </p>

                    <h2 class="mt-1 text-2xl font-black text-slate-950 sm:text-3xl">
                        Recently Purchased
                    </h2>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($recentlyPurchased as $product)
                        @include('customer.partials.product-card', ['product' => $product])
                    @endforeach
                </div>
            </section>
        @endif
    @endauth
@endsection