@extends('admin.layout')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Produk</h1>
        <p class="mt-1 text-gray-500">Ubah data produk, harga, stok, kategori, atau gambar.</p>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="rounded-2xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label class="mb-2 block font-semibold">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-yellow-400" required>
            </div>

            <div>
                <label class="mb-2 block font-semibold">Kategori</label>
                <select name="category_id" class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-yellow-400" required>
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block font-semibold">Harga</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0" class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-yellow-400" required>
            </div>

            <div>
                <label class="mb-2 block font-semibold">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-yellow-400" required>
            </div>

            <div class="md:col-span-2">
                <label class="mb-2 block font-semibold">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-yellow-400">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="md:col-span-2">
                <label class="mb-2 block font-semibold">Gambar Produk</label>

                @if ($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="mb-3 h-32 w-32 rounded-xl object-cover">
                @endif

                <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-gray-300 px-4 py-3">
                <p class="mt-2 text-sm text-gray-500">Kosongkan jika tidak ingin mengganti gambar.</p>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="rounded-xl bg-green-700 px-5 py-3 font-bold text-white hover:bg-green-800">
                Simpan Perubahan
            </button>

            <a href="{{ route('admin.products.index') }}" class="rounded-xl bg-gray-100 px-5 py-3 font-bold text-gray-700 hover:bg-gray-200">
                Batal
            </a>
        </div>
    </form>
@endsection