font@extends('admin.layout')

@section('content')
    <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold">Manajemen Katalog Produk</h1>
            <p class="mt-1 text-gray-500">Kelola produk, harga, stok, kategori, dan gambar produk.</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="inline-flex rounded-xl bg-yellow-400 px-5 py-3 font-bold text-gray-900 hover:bg-yellow-300">
            + Tambah Produk
        </a>
    </div>

    <div class="mb-6 rounded-2xl bg-white p-5 shadow-sm">
        <form action="{{ route('admin.products.index') }}" method="GET" class="grid gap-4 md:grid-cols-[1fr_240px_auto]">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama/deskripsi produk..."
                class="rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-yellow-400"
            >

            <select
                name="category_id"
                class="rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-yellow-400"
            >
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="rounded-xl bg-green-700 px-5 py-3 font-bold text-white hover:bg-green-800">
                Filter
            </button>
        </form>
    </div>

    <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
        <table class="w-full border-collapse">
            <thead class="bg-gray-50">
                <tr class="text-left text-sm text-gray-600">
                    <th class="px-5 py-4">Produk</th>
                    <th class="px-5 py-4">Kategori</th>
                    <th class="px-5 py-4">Harga</th>
                    <th class="px-5 py-4">Stok</th>
                    <th class="px-5 py-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    @php
                        $image = $product->image_url
                            ? asset('storage/' . $product->image_url)
                            : 'https://placehold.co/100x100/FACC15/1F2933?text=Produk';
                    @endphp

                    <tr>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-4">
                                <img src="{{ $image }}" alt="{{ $product->name }}" class="h-16 w-16 rounded-xl object-cover">

                                <div>
                                    <p class="font-bold">{{ $product->name }}</p>
                                    <p class="line-clamp-1 text-sm text-gray-500">
                                        {{ $product->description ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            {{ $product->category->name ?? '-' }}
                        </td>

                        <td class="px-5 py-4 font-semibold">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td class="px-5 py-4">
                            <span class="rounded-full {{ $product->stock > 0 ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }} px-3 py-1 text-sm font-bold">
                                {{ $product->stock }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.products.show', $product) }}" class="rounded-lg bg-gray-100 px-3 py-2 text-sm font-bold text-gray-700 hover:bg-gray-200">
                                    Detail
                                </a>

                                <a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg bg-yellow-100 px-3 py-2 text-sm font-bold text-yellow-800 hover:bg-yellow-200">
                                    Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="rounded-lg bg-red-100 px-3 py-2 text-sm font-bold text-red-700 hover:bg-red-200">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-500">
                            Produk belum tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection