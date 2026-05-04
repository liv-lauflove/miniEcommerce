<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'UD Trisna Putra' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#FFFDF6] text-slate-900 antialiased">
    @php
        $cartCount = collect(session('cart', []))->sum();
    @endphp

    <header class="sticky top-0 z-50 border-b border-yellow-100 bg-white/95 backdrop-blur-xl">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex min-h-20 items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="grid h-11 w-11 place-items-center rounded-2xl bg-yellow-400 font-black text-red-700 shadow-sm">
                        TP
                    </div>

                    <div class="hidden sm:block">
                        <p class="text-lg font-black leading-5 text-slate-950">
                            UD Trisna Putra
                        </p>
                        <p class="text-xs font-semibold text-slate-500">
                            Bahan kue & kemasan
                        </p>
                    </div>
                </a>

                <nav class="hidden items-center gap-7 md:flex">
                    <a
                        href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-red-600' : 'text-slate-500' }} text-sm font-bold transition hover:text-red-600"
                    >
                        Home
                    </a>

                    <a
                        href="{{ route('categories.index') }}"
                        class="{{ request()->routeIs('categories.index') ? 'text-red-600' : 'text-slate-500' }} text-sm font-bold transition hover:text-red-600"
                    >
                        Categories
                    </a>
                </nav>

                <form action="{{ route('categories.index') }}" method="GET" class="hidden w-full max-w-md items-center rounded-full border border-yellow-100 bg-slate-50 px-4 py-2.5 shadow-inner lg:flex">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari produk..."
                        class="w-full bg-transparent text-sm font-medium text-slate-700 outline-none placeholder:text-slate-400"
                    >

                    <button type="submit" class="ml-3 rounded-full px-3 py-1 text-sm font-black text-green-700 transition hover:bg-green-50">
                        Cari
                    </button>
                </form>

                <div class="flex items-center gap-2 sm:gap-3">
                    @auth
                        <a
                            href="{{ route('cart.index') }}"
                            aria-label="Buka keranjang"
                            class="relative grid h-11 w-11 place-items-center rounded-full bg-green-700 text-white shadow-sm transition hover:bg-green-800"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h2.386c.51 0 .955.343 1.087.835l.383 1.437m0 0L7.5 14.25A2.25 2.25 0 0 0 9.694 16h6.862a2.25 2.25 0 0 0 2.183-1.704l1.111-4.444A1.125 1.125 0 0 0 18.76 8.45H7.02m-.914-3.178L5.25 2.25M9 20.25h.008v.008H9v-.008Zm8.25 0h.008v.008h-.008v-.008Z" />
                            </svg>

                            @if ($cartCount > 0)
                                <span class="absolute -right-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-red-600 px-1.5 text-[11px] font-black leading-none text-white ring-2 ring-white">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                            @csrf
                            <button type="submit" class="rounded-full border border-red-100 px-4 py-2.5 text-sm font-black text-red-600 transition hover:bg-red-50">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full bg-yellow-400 px-5 py-2.5 text-sm font-black text-slate-950 shadow-sm transition hover:bg-yellow-300">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            <div class="grid gap-3 border-t border-yellow-50 py-3 md:grid-cols-[auto_1fr] lg:hidden">
                <nav class="flex items-center gap-3 overflow-x-auto">
                    <a
                        href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-600' }} whitespace-nowrap rounded-full px-4 py-2 text-sm font-bold"
                    >
                        Home
                    </a>

                    <a
                        href="{{ route('categories.index') }}"
                        class="{{ request()->routeIs('categories.index') ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-600' }} whitespace-nowrap rounded-full px-4 py-2 text-sm font-bold"
                    >
                        Categories
                    </a>
                </nav>

                <form action="{{ route('categories.index') }}" method="GET" class="flex items-center rounded-full border border-yellow-100 bg-slate-50 px-4 py-2.5">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari produk..."
                        class="w-full bg-transparent text-sm font-medium outline-none placeholder:text-slate-400"
                    >

                    <button type="submit" class="ml-3 text-sm font-black text-green-700">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-semibold text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

        {{-- Login Required Toast --}}
    <div
        id="login-toast"
        class="pointer-events-none fixed inset-x-4 bottom-4 z-[999] translate-y-6 opacity-0 transition-all duration-300 sm:left-auto sm:right-6 sm:bottom-6 sm:w-full sm:max-w-md"
        aria-live="polite"
    >
        <div class="pointer-events-auto overflow-hidden rounded-[1.5rem] bg-white shadow-2xl ring-1 ring-slate-200">
            <div class="flex gap-4 p-4 sm:p-5">
                <div class="grid h-11 w-11 shrink-0 place-items-center rounded-2xl bg-yellow-100 text-yellow-700">
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
                            class="inline-flex justify-center rounded-full bg-yellow-400 px-5 py-2.5 text-sm font-black text-slate-950 transition hover:bg-yellow-300"
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

            <div id="login-toast-progress" class="h-1 w-0 bg-yellow-400 transition-all duration-[4500ms]"></div>
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
</body>
</html>