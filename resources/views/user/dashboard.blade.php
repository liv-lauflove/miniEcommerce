@extends('customer.layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-black text-slate-900 mb-2">Dashboard</h1>
    <p class="text-slate-500 mb-8">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Lanjut Belanja Card -->
        <a href="{{ route('home') }}" class="group">
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-sm hover:shadow-lg transition p-8 text-white h-full flex flex-col justify-between">
                <div>
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/20 mb-4 group-hover:bg-white/30 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black mb-2">Lanjut Belanja</h3>
                    <p class="text-emerald-50 text-sm">Jelajahi katalog produk kami yang lengkap</p>
                </div>
                <div class="flex items-center gap-2 text-sm font-bold mt-4">
                    Mulai Belanja
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </a>

        <!-- Keranjang Card -->
        <a href="{{ route('cart.index') }}" class="group">
            <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl shadow-sm hover:shadow-lg transition p-8 text-slate-900 h-full flex flex-col justify-between">
                <div>
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-black/10 mb-4 group-hover:bg-black/20 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black mb-2">Lihat Keranjang</h3>
                    <p class="text-slate-700 text-sm">Periksa dan kelola item di keranjang Anda</p>
                </div>
                <div class="flex items-center gap-2 text-sm font-bold mt-4">
                    Buka Keranjang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </a>

        <!-- Riwayat Pesanan Card -->
        <a href="{{ route('user.orders.index') }}" class="group">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-sm hover:shadow-lg transition p-8 text-white h-full flex flex-col justify-between">
                <div>
                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-white/20 mb-4 group-hover:bg-white/30 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.66V6.75a2.25 2.25 0 00-2.25 2.25v12.75c0 1.24 1.01 2.25 2.25 2.25h13.5c1.24 0 2.25-1.01 2.25-2.25V8.75c0-.227-.035-.45-.1-.66m-5.8 0A2.251 2.251 0 0013.5 2.25H12a2.25 2.25 0 00-1.5.75m0 0A2.251 2.251 0 0012 2.25h1.5m0 0A2.25 2.25 0 0115.75 3.75M15 6.75a.75.75 0 00-1.5 0m0 0a.75.75 0 01-1.5 0m1.5 0a.75.75 0 001.5 0m-3-2.25a.75.75 0 00-1.5 0m0 0a.75.75 0 01-1.5 0m1.5 0a.75.75 0 001.5 0M6.75 6.75a.75.75 0 00-1.5 0m0 0a.75.75 0 01-1.5 0m1.5 0a.75.75 0 001.5 0M6.75 9m0 0a.75.75 0 00-1.5 0m0 0a.75.75 0 01-1.5 0m1.5 0a.75.75 0 001.5 0" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black mb-2">Riwayat Pesanan</h3>
                    <p class="text-blue-50 text-sm">Lihat semua pesanan dan status pengirimannya</p>
                </div>
                <div class="flex items-center gap-2 text-sm font-bold mt-4">
                    Lihat Riwayat
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </a>

        <!-- Profil Pengguna Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 h-full flex flex-col justify-between">
            <div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">Profil Anda</h3>
                <div class="space-y-2 text-sm text-slate-600">
                    <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                    <p><strong>No. HP:</strong> {{ auth()->user()->no_hp }}</p>
                </div>
            </div>
            <p class="text-xs text-slate-500 mt-4">Akun digunakan untuk mengelola pesanan dan pengiriman</p>
        </div>
    </div>
</div>
@endsection
