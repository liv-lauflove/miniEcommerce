@extends('customer.layout')

@section('content')
    @php
        $image = $product->image_url
            ? (\Illuminate\Support\Str::startsWith($product->image_url, ['http://', 'https://'])
                ? $product->image_url
                : asset('storage/' . $product->image_url))
            : 'https://placehold.co/900x900/FACC15/1F2933?text=Produk';
    @endphp

    <section class="grid gap-8 rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-black/5 lg:grid-cols-2 lg:p-8">
        <div class="overflow-hidden rounded-[1.5rem] bg-yellow-50">
            <img src="{{ $image }}" alt="{{ $product->name }}" class="aspect-square w-full object-cover">
        </div>

        <div class="flex flex-col justify-center">
            <p class="text-sm font-black uppercase tracking-wide text-green-700">
                {{ $product->category->name ?? 'Tanpa Kategori' }}
            </p>

            <h1 class="mt-3 text-4xl font-black leading-tight text-gray-950">
                {{ $product->name }}
            </h1>

            <p class="mt-5 text-3xl font-black text-red-600">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </p>

            <p class="mt-4 leading-8 text-gray-600">
                {{ $product->description ?? 'Produk berkualitas untuk kebutuhan toko.' }}
            </p>

            <div class="mt-5 rounded-2xl bg-green-50 px-5 py-4 text-sm font-bold text-green-700">
                Stok tersedia: {{ $product->stock }}
            </div>

            <div class="mt-6">
            @auth
                <form action="{{ route('cart.store', $product) }}" method="POST" class="flex flex-col gap-3 sm:flex-row">
                    @csrf

                    <input
                        type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        max="{{ $product->stock }}"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-3 outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100 sm:w-32"
                    >

                    <button
                        type="submit"
                        @disabled($product->stock <= 0)
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-yellow-400 px-6 py-3 font-black text-slate-950 transition hover:bg-yellow-300 disabled:cursor-not-allowed disabled:opacity-50"
                    >
                
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h2.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L7.5 14.25A2.25 2.25 0 0 0 9.694 16h6.862a2.25 2.25 0 0 0 2.183-1.704l1.111-4.444A1.125 1.125 0 0 0 18.76 8.45H7.02m-.914-3.178L5.25 2.25M9 20.25h.008v.008H9v-.008Zm8.25 0h.008v.008h-.008v-.008Z" />
                </svg>
                    Tambah ke Keranjang
                </button>
                </form>
                
                @else
                <button
                    type="button"
                    onclick="showLoginToast()"
                    class="inline-flex items-center justify-center gap-2 rounded-2xl bg-yellow-400 px-6 py-3 font-black text-slate-950 transition hover:bg-yellow-300"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h2.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L7.5 14.25A2.25 2.25 0 0 0 9.694 16h6.862a2.25 2.25 0 0 0 2.183-1.704l1.111-4.444A1.125 1.125 0 0 0 18.76 8.45H7.02m-.914-3.178L5.25 2.25M9 20.25h.008v.008H9v-.008Zm8.25 0h.008v.008h-.008v-.008Z" />
                </svg>
                Login untuk Belanja
                </button>
            @endauth
            </div>
        </div>
    </section>

    @if ($relatedProducts->isNotEmpty())
        <section class="mt-12">
            <h2 class="mb-6 text-3xl font-black text-gray-950">
                Produk Serupa
            </h2>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($relatedProducts as $product)
                    @include('customer.partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </section>
    @endif
@endsection