<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'UD Trisna Putra' }}</title>

    {{-- Google Font Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#FFFDF6] text-slate-900 antialiased">
    @php
        $cartCount = collect(session('cart', []))->sum();
    @endphp

    {{-- Announcement Bar --}}
    <div class="hidden bg-[#006B3F] sm:block">
        <div class="mx-auto flex max-w-7xl items-center justify-center gap-2 px-4 py-2 text-xs font-semibold text-white/90">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-[#FECB00]" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
            </svg>
            <span>Plastik & Bahan² Kue-Roti &bull; Grosir & Eceran &bull; Melayani dengan Sepenuh Hati</span>
        </div>
    </div>

    {{-- Header --}}
    <header class="sticky top-0 z-50 border-b border-[#006B3F]/10 bg-white/95 backdrop-blur-xl">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex min-h-20 items-center justify-between gap-4">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3">
                    <img
                        src="{{ asset('images/logo-trisna-putra.jpeg') }}"
                        alt="UD Trisna Putra - Plastik & Bahan Kue-Roti, Grosir & Eceran"
                        class="h-12 w-auto rounded-xl shadow-sm transition-transform duration-200 hover:scale-105 sm:h-14"
                    >
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden items-center gap-7 md:flex">
                    <a
                        href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-[#006B3F]' : 'text-slate-500' }} text-sm font-bold transition hover:text-[#006B3F]"
                    >
                        Home
                    </a>

                    <a
                        href="{{ route('categories.index') }}"
                        class="{{ request()->routeIs('categories.index') ? 'text-[#006B3F]' : 'text-slate-500' }} text-sm font-bold transition hover:text-[#006B3F]"
                    >
                        Categories
                    </a>

                    @auth
                        <a
                            href="{{ route('user.orders.index') }}"
                            class="{{ request()->routeIs('user.orders.index', 'user.orders.show') ? 'text-[#006B3F]' : 'text-slate-500' }} text-sm font-bold transition hover:text-[#006B3F]"
                        >
                            Pesanan Saya
                        </a>
                    @endauth
                </nav>

                {{-- Search Bar --}}
                <form action="{{ route('categories.index') }}" method="GET" class="hidden w-full max-w-md items-center rounded-full border border-[#006B3F]/20 bg-slate-50 px-4 py-2.5 shadow-inner transition-all focus-within:border-[#006B3F]/40 focus-within:ring-2 focus-within:ring-[#006B3F]/10 lg:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari produk..."
                        class="w-full bg-transparent text-sm font-medium text-slate-700 outline-none placeholder:text-slate-400"
                    >

                    <button type="submit" class="ml-3 rounded-full bg-[#006B3F] px-4 py-1.5 text-xs font-bold text-white transition hover:bg-[#005432]">
                        Cari
                    </button>
                </form>

                {{-- Right Actions --}}
                <div class="flex items-center gap-2 sm:gap-3">
                    @auth
                        <a
                            href="{{ route('cart.index') }}"
                            aria-label="Buka keranjang"
                            class="relative grid h-11 w-11 place-items-center rounded-full bg-[#006B3F] text-white shadow-sm transition hover:bg-[#005432]"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h2.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L7.5 14.25A2.25 2.25 0 0 0 9.694 16h6.862a2.25 2.25 0 0 0 2.183-1.704l1.111-4.444A1.125 1.125 0 0 0 18.76 8.45H7.02m-.914-3.178L5.25 2.25M9 20.25h.008v.008H9v-.008Zm8.25 0h.008v.008h-.008v-.008Z" />
                            </svg>

                            @if ($cartCount > 0)
                                <span class="absolute -right-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-[#D42027] px-1.5 text-[11px] font-black leading-none text-white ring-2 ring-white">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                            @csrf
                            <button type="submit" class="rounded-full border border-[#D42027]/20 px-4 py-2.5 text-sm font-bold text-[#D42027] transition hover:bg-red-50">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full bg-[#FECB00] px-5 py-2.5 text-sm font-black text-slate-950 shadow-sm transition hover:bg-[#e6b800] hover:shadow-md">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Mobile Nav + Search --}}
            <div class="grid gap-3 border-t border-[#006B3F]/5 py-3 md:grid-cols-[auto_1fr] lg:hidden">
                <nav class="flex items-center gap-3 overflow-x-auto">
                    <a
                        href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'bg-[#006B3F] text-white' : 'bg-slate-100 text-slate-600' }} whitespace-nowrap rounded-full px-4 py-2 text-sm font-bold transition"
                    >
                        Home
                    </a>

                    <a
                        href="{{ route('categories.index') }}"
                        class="{{ request()->routeIs('categories.index') ? 'bg-[#006B3F] text-white' : 'bg-slate-100 text-slate-600' }} whitespace-nowrap rounded-full px-4 py-2 text-sm font-bold transition"
                    >
                        Categories
                    </a>

                    @auth
                        <a
                            href="{{ route('user.orders.index') }}"
                            class="{{ request()->routeIs('user.orders.index', 'user.orders.show') ? 'bg-[#006B3F] text-white' : 'bg-slate-100 text-slate-600' }} whitespace-nowrap rounded-full px-4 py-2 text-sm font-bold transition"
                        >
                            Pesanan
                        </a>
                    @endauth
                </nav>

                <form action="{{ route('categories.index') }}" method="GET" class="flex items-center rounded-full border border-[#006B3F]/15 bg-slate-50 px-4 py-2.5">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari produk..."
                        class="w-full bg-transparent text-sm font-medium outline-none placeholder:text-slate-400"
                    >

                    <button type="submit" class="ml-3 text-sm font-bold text-[#006B3F]">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-[#006B3F]/20 bg-[#006B3F]/5 px-5 py-4 text-sm font-semibold text-[#006B3F]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 flex items-center gap-3 rounded-2xl border border-[#D42027]/20 bg-[#D42027]/5 px-5 py-4 text-sm font-semibold text-[#D42027]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-16">
        {{-- Yellow accent line --}}
        <div class="h-1 bg-[#FECB00]"></div>

        <div class="bg-[#006B3F]">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    {{-- Store Info --}}
                    <div>
                        <img
                            src="{{ asset('images/logo-trisna-putra.jpeg') }}"
                            alt="UD Trisna Putra"
                            class="h-14 w-auto rounded-xl shadow-md"
                        >
                        <p class="mt-4 max-w-xs text-sm leading-relaxed text-white/70">
                            Menyediakan plastik, bahan kue & roti, dan aneka kebutuhan toko Anda dengan harga grosir & eceran.
                        </p>
                    </div>

                    {{-- Quick Links --}}
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-wider text-[#FECB00]">
                            Menu
                        </h3>
                        <ul class="mt-4 space-y-3">
                            <li>
                                <a href="{{ route('home') }}" class="text-sm text-white/70 transition hover:text-white">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('categories.index') }}" class="text-sm text-white/70 transition hover:text-white">
                                    Katalog Produk
                                </a>
                            </li>
                            @auth
                                <li>
                                    <a href="{{ route('user.orders.index') }}" class="text-sm text-white/70 transition hover:text-white">
                                        Pesanan Saya
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cart.index') }}" class="text-sm text-white/70 transition hover:text-white">
                                        Keranjang
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>

                    {{-- Info --}}
                    <div>
                        <h3 class="text-sm font-black uppercase tracking-wider text-[#FECB00]">
                            Informasi
                        </h3>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-[#FECB00]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 1 1 9.9 9.9L10 18.9l-4.95-4.95a7 7 0 0 1 0-9.9ZM10 11a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-white/70">Pengiriman maks. 5 KM dari toko</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-[#FECB00]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M1 4a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4Zm12 4a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM4 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm13-1a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM2 15.25h16v.75a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-.75Z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-white/70">Minimum order Rp500.000</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-[#FECB00]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm text-white/70">Buka setiap hari</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Bottom bar --}}
                <div class="mt-10 border-t border-white/10 pt-6">
                    <p class="text-center text-xs text-white/50">
                        &copy; {{ date('Y') }} UD Trisna Putra. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    {{-- Login Required Toast --}}
    <div
        id="login-toast"
        class="pointer-events-none fixed inset-x-4 bottom-4 z-[999] translate-y-6 opacity-0 transition-all duration-300 sm:left-auto sm:right-6 sm:bottom-6 sm:w-full sm:max-w-md"
        aria-live="polite"
    >
        <div class="pointer-events-auto overflow-hidden rounded-[1.5rem] bg-white shadow-2xl ring-1 ring-slate-200">
            <div class="flex gap-4 p-4 sm:p-5">
                <div class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-[#FECB00]/20 text-[#D42027]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A3.75 3.75 0 0 0 12 1.5 3.75 3.75 0 0 0 8.25 5.25V9m-1.5 0h10.5A1.5 1.5 0 0 1 18.75 10.5v9A1.5 1.5 0 0 1 17.25 21H6.75a1.5 1.5 0 0 1-1.5-1.5v-9A1.5 1.5 0 0 1 6.75 9Z" />
                    </svg>
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h3 class="text-base font-black text-slate-950">
                                Login diperlukan
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-slate-500">
                                Silakan login terlebih dahulu sebelum menambahkan produk ke keranjang.
                            </p>
                        </div>

                        <button
                            type="button"
                            onclick="hideLoginToast()"
                            class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-slate-200 hover:text-slate-700"
                            aria-label="Tutup notifikasi"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-4 flex flex-col gap-2 sm:flex-row">
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex justify-center rounded-full bg-[#FECB00] px-5 py-2.5 text-sm font-black text-slate-950 transition hover:bg-[#e6b800]"
                        >
                            Login Sekarang
                        </a>

                        <button
                            type="button"
                            onclick="hideLoginToast()"
                            class="inline-flex justify-center rounded-full bg-slate-100 px-5 py-2.5 text-sm font-black text-slate-600 transition hover:bg-slate-200"
                        >
                            Nanti Dulu
                        </button>
                    </div>
                </div>
            </div>

            <div id="login-toast-progress" class="h-1 w-0 bg-[#006B3F] transition-all duration-[4500ms]"></div>
        </div>
    </div>

    <script>
        let loginToastTimer = null;

        function showLoginToast() {
            const toast = document.getElementById('login-toast');
            const progress = document.getElementById('login-toast-progress');

            if (!toast || !progress) return;

            clearTimeout(loginToastTimer);

            toast.classList.remove('translate-y-6', 'opacity-0', 'pointer-events-none');
            toast.classList.add('translate-y-0', 'opacity-100');

            progress.classList.remove('w-full');
            progress.classList.add('w-0');

            setTimeout(() => {
                progress.classList.remove('w-0');
                progress.classList.add('w-full');
            }, 50);

            loginToastTimer = setTimeout(() => {
                hideLoginToast();
            }, 4800);
        }

        function hideLoginToast() {
            const toast = document.getElementById('login-toast');
            const progress = document.getElementById('login-toast-progress');

            if (!toast || !progress) return;

            toast.classList.add('translate-y-6', 'opacity-0', 'pointer-events-none');
            toast.classList.remove('translate-y-0', 'opacity-100');

            progress.classList.remove('w-full');
            progress.classList.add('w-0');

            clearTimeout(loginToastTimer);
        }
    </script>

    @stack('scripts')
</body>
</html>