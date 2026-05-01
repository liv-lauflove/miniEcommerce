@extends('admin.layout')

@section('content')
    <div class="rounded-2xl bg-white p-8 shadow-sm">
        <h1 class="text-3xl font-bold">Dashboard Admin</h1>
        <p class="mt-2 text-gray-500">Selamat datang di halaman admin.</p>

        <div class="mt-6">
            <a href="{{ route('admin.products.index') }}" class="inline-flex rounded-xl bg-yellow-400 px-5 py-3 font-bold text-gray-900 hover:bg-yellow-300">
                Kelola Katalog Produk
            </a>
        </div>
    </div>
@endsection