@extends('admin.layout')

@section('content')
    <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold">Manajemen Kategori</h1>
            <p class="mt-1 text-gray-500">
                Tambahkan kategori produk sesuai kebutuhan toko.
            </p>
        </div>

        <a href="{{ route('admin.products.index') }}" class="rounded-xl bg-gray-100 px-5 py-3 font-bold text-gray-700 hover:bg-gray-200">
            Kembali ke Produk
        </a>
    </div>

    @if (session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-[0.8fr_1.4fr]">
        <div class="rounded-2xl bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold">Tambah Kategori</h2>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf

                <div>
                    <label class="mb-2 block font-semibold">Nama Kategori</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Bahan Kue"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none focus:border-yellow-400"
                        required
                    >

                    @error('name')
                        <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full rounded-xl bg-yellow-400 px-5 py-3 font-bold text-gray-900 hover:bg-yellow-300">
                    Tambah Kategori
                </button>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm">
            <table class="w-full border-collapse">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm text-gray-600">
                        <th class="px-5 py-4">Nama Kategori</th>
                        <th class="px-5 py-4">Jumlah Produk</th>
                        <th class="px-5 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="px-5 py-4">
                                <p class="font-bold">{{ $category->name }}</p>
                            </td>

                            <td class="px-5 py-4">
                                <span class="rounded-full bg-green-50 px-3 py-1 text-sm font-bold text-green-700">
                                    {{ $category->products_count }} produk
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    <a
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="rounded-lg bg-yellow-100 px-3 py-2 text-sm font-bold text-yellow-800 hover:bg-yellow-200"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg bg-red-100 px-3 py-2 text-sm font-bold text-red-700 hover:bg-red-200"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-10 text-center text-gray-500">
                                Belum ada kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-5">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection