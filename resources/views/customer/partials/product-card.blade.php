@php
    $image = $product->image_url
        ? (\Illuminate\Support\Str::startsWith($product->image_url, ['http://', 'https://'])
            ? $product->image_url
            : asset('storage/' . $product->image_url))
        : 'https://placehold.co/600x600/FACC15/1F2933?text=Produk';
@endphp

<article class="group flex h-full flex-col overflow-hidden rounded-[1.7rem] bg-white shadow-sm ring-1 ring-slate-200/60 transition duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:ring-[#006B3F]/20">
    <a href="{{ route('products.show', $product) }}" class="block">
        <div class="relative aspect-square overflow-hidden bg-[#FFFDF6]">
            <img
                src="{{ $image }}"
                alt="{{ $product->name }}"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-110"
            >

            {{-- Subtle gradient overlay --}}
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>

            @if ($product->stock <= 0)
                <span class="absolute left-3 top-3 rounded-full bg-[#D42027]/90 px-4 py-1.5 text-xs font-black text-white shadow-sm backdrop-blur-sm">
                    Habis
                </span>
            @endif
        </div>
    </a>

    <div class="flex flex-1 flex-col p-4 sm:p-5">
        <p class="text-[11px] font-bold uppercase tracking-wider text-[#006B3F]">
            {{ $product->category->name ?? 'Tanpa Kategori' }}
        </p>

        <a href="{{ route('products.show', $product) }}" class="mt-1 block">
            <h3 class="line-clamp-2 text-base font-black leading-snug text-slate-950 transition hover:text-[#006B3F] sm:text-lg">
                {{ $product->name }}
            </h3>
        </a>

        <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">
            {{ \Illuminate\Support\Str::limit($product->description ?? 'Produk berkualitas untuk kebutuhan toko.', 78) }}
        </p>

        <div class="mt-auto flex items-end justify-between gap-3 pt-5">
            <div>
                <p class="text-lg font-black text-slate-950 sm:text-xl">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Stok {{ $product->stock }}
                </p>
            </div>

            @auth
                <form action="{{ route('cart.store', $product) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" value="1">

                    <button
                        type="submit"
                        aria-label="Tambah ke keranjang"
                        title="Tambah ke keranjang"
                        @disabled($product->stock <= 0)
                        class="grid h-11 w-11 place-items-center rounded-xl bg-[#006B3F] text-white shadow-sm transition hover:bg-[#005432] hover:scale-105 disabled:cursor-not-allowed disabled:opacity-40"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h2.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L7.5 14.25A2.25 2.25 0 0 0 9.694 16h6.862a2.25 2.25 0 0 0 2.183-1.704l1.111-4.444A1.125 1.125 0 0 0 18.76 8.45H7.02m-.914-3.178L5.25 2.25M9 20.25h.008v.008H9v-.008Zm8.25 0h.008v.008h-.008v-.008Z" />
                        </svg>
                    </button>
                </form>
            @else
                    <button
                        type="button"
                        aria-label="Login untuk tambah ke keranjang"
                        title="Login untuk tambah ke keranjang"
                        onclick="showLoginToast()"
                        class="grid h-11 w-11 place-items-center rounded-xl bg-[#006B3F] text-white shadow-sm transition hover:bg-[#005432] hover:scale-105"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h2.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L7.5 14.25A2.25 2.25 0 0 0 9.694 16h6.862a2.25 2.25 0 0 0 2.183-1.704l1.111-4.444A1.125 1.125 0 0 0 18.76 8.45H7.02m-.914-3.178L5.25 2.25M9 20.25h.008v.008H9v-.008Zm8.25 0h.008v.008h-.008v-.008Z" />
                        </svg>
                    </button>
            @endauth
        </div>
    </div>
</article>