@extends('customer.layout')

@section('content')
    <section class="mb-8">
        <h1 class="text-4xl font-black text-gray-950">
            Cart
        </h1>

        <p class="mt-2 text-gray-500">
            Item yang sudah kamu masukkan ke keranjang.
        </p>
    </section>

    @if ($items->isEmpty())
        <div class="rounded-[2rem] border border-dashed border-gray-300 bg-white p-12 text-center">
            <h2 class="text-2xl font-black text-gray-900">
                Cart masih kosong
            </h2>

            <p class="mt-2 text-gray-500">
                Tambahkan produk dari halaman Home atau Categories.
            </p>

            <a href="{{ route('categories.index') }}" class="mt-6 inline-flex rounded-2xl bg-yellow-400 px-6 py-3 font-black text-gray-900 hover:bg-yellow-300">
                Belanja Sekarang
            </a>
        </div>
    @else
        <div class="grid gap-6 lg:grid-cols-[1.6fr_0.8fr]">
            <div class="space-y-4">
                @foreach ($items as $item)
                    @php
                        $product = $item->product;

                        $image = $product->image_url
                            ? (\Illuminate\Support\Str::startsWith($product->image_url, ['http://', 'https://'])
                                ? $product->image_url
                                : asset('storage/' . $product->image_url))
                            : 'https://placehold.co/600x600/FACC15/1F2933?text=Produk';
                    @endphp

                    <div class="grid gap-4 rounded-3xl bg-white p-4 shadow-sm ring-1 ring-black/5 sm:grid-cols-[110px_1fr] lg:grid-cols-[110px_1fr_auto]">
                        <img src="{{ $image }}" alt="{{ $product->name }}" class="h-28 w-28 rounded-2xl object-cover">

                        <div>
                            <p class="text-xs font-black uppercase tracking-wide text-green-700">
                                {{ $product->category->name ?? 'Tanpa Kategori' }}
                            </p>

                            <h2 class="mt-1 text-xl font-black text-gray-950">
                                {{ $product->name }}
                            </h2>

                            <p class="mt-1 text-sm font-semibold text-gray-500">
                                Rp{{ number_format($product->price, 0, ',', '.') }} / item
                            </p>

                            <p class="mt-2 text-sm font-bold text-gray-700">
                                Subtotal: Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex flex-col gap-3 lg:items-end">
                            <form action="{{ route('cart.update', $product) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')

                                <input
                                    type="number"
                                    name="quantity"
                                    value="{{ $item->quantity }}"
                                    min="1"
                                    max="{{ $product->stock }}"
                                    class="w-20 rounded-xl border border-gray-200 px-3 py-2 text-center outline-none focus:border-yellow-400 focus:ring-4 focus:ring-yellow-100"
                                >

                                <button type="submit" class="rounded-xl bg-green-700 px-4 py-2 text-sm font-black text-white hover:bg-green-800">
                                    Update
                                </button>
                            </form>

                            <form action="{{ route('cart.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="rounded-xl bg-red-50 px-4 py-2 text-sm font-black text-red-600 hover:bg-red-100">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <aside class="h-fit rounded-3xl bg-white p-6 shadow-sm ring-1 ring-black/5">
                <h2 class="text-2xl font-black text-gray-950">
                    Ringkasan Belanja
                </h2>

                <div class="mt-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold text-gray-500">Subtotal</span>

                        <span class="text-xl font-black text-gray-950">
                            Rp{{ number_format($subtotal, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="mt-6">
                    <a
                        href="{{ route('checkout.index') }}"
                        style="
                            display:block;
                            width:100%;
                            background:#059669;
                            color:white;
                            padding:16px;
                            text-align:center;
                            border-radius:16px;
                            font-weight:700;
                            text-decoration:none;
                            position:relative;
                            z-index:9999;
                        "
                    >
                        Checkout
                    </a>
                </div>
            </aside>
        </div>
    @endif
@endsection