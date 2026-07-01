@extends('admin.layout')

@section('content')
    @php
        $image = $product->image_url
            ? asset('storage/' . $product->image_url)
            : 'https://placehold.co/600x600/FACC15/1F2933?text=Produk';
    @endphp

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold">Detail Produk</h1>
            <p class="mt-1 text-gray-500">Informasi lengkap produk katalog.</p>
        </div>

        <a href="{{ route('admin.products.index') }}" class="rounded-xl bg-gray-100 px-5 py-3 font-bold text-gray-700 hover:bg-gray-200">
            Kembali
        </a>
    </div>

    <div class="grid gap-6 rounded-2xl bg-white p-6 shadow-sm md:grid-cols-[320px_1fr]">
        <img src="{{ $image }}" alt="{{ $product->name }}" class="h-80 w-full rounded-2xl object-cover">

        <div>
            <p class="text-sm font-bold uppercase text-green-700">
                {{ $product->category->name ?? 'Tanpa Kategori' }}
            </p>

            <h2 class="mt-2 text-4xl font-bold">
                {{ $product->name }}
            </h2>

            <p class="mt-4 text-2xl font-bold text-red-600">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </p>

            <p class="mt-4 rounded-xl bg-green-50 px-4 py-3 font-bold text-green-700">
                Stok: {{ $product->stock }}
            </p>

            <div class="mt-6">
                <h3 class="mb-2 font-bold">Deskripsi</h3>
                <p class="leading-7 text-gray-600">
                    {{ $product->description ?? '-' }}
                </p>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('admin.products.edit', $product) }}" class="rounded-xl bg-yellow-400 px-5 py-3 font-bold text-gray-900 hover:bg-yellow-300">
                    Edit Produk
                </a>

                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="rounded-xl bg-red-600 px-5 py-3 font-bold text-white hover:bg-red-700">
                        Hapus Produk
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection