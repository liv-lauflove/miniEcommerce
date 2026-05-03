@extends('admin.layout')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold">Edit Kategori</h1>
        <p class="mt-1 text-gray-500">
            Ubah nama kategori produk.
        </p>
    </div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="max-w-xl rounded-2xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div>
            <label class="mb-2 block font-semibold">Nama Kategori</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $category->name) }}"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-yellow-400"
                required
            >

            @error('name')
                <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="rounded-xl bg-green-700 px-5 py-3 font-bold text-white hover:bg-green-800">
                Simpan Perubahan
            </button>

            <a href="{{ route('admin.categories.index') }}" class="rounded-xl bg-gray-100 px-5 py-3 font-bold text-gray-700 hover:bg-gray-200">
                Batal
            </a>
        </div>
    </form>
@endsection