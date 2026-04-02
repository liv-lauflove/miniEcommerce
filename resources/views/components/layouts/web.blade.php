<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }} — UD Trisna Putra</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-chocolate-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-[10px]">TP</span>
                    </div>
                    <span class="text-chocolate-600 font-bold text-lg tracking-tight">UD Trisna Putra</span>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">Home</a>
                    <a href="{{ route('shop') }}" class="nav-link {{ request()->routeIs('shop') ? 'nav-link-active' : '' }}">Shop</a>
                </div>

                {{-- Right Nav --}}
                <div class="flex items-center gap-4">
                    {{-- Cart --}}
                    <a href="{{ route('cart.index') }}" class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors group" title="Cart">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-chocolate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        @if($cartCount = \App\Services\CartService::new()->count())
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-cream-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">{{ $cartCount > 9 ? '9+' : $cartCount }}</span>
                        @endif
                    </a>

                    @auth
                        <a href="{{ route('orders.index') }}" class="hidden md:block nav-link {{ request()->routeIs('orders.*') ? 'nav-link-active' : '' }}">Orders</a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-8 h-8 bg-chocolate-100 rounded-full flex items-center justify-center">
                                    <span class="text-chocolate-500 font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span class="hidden md:block text-sm text-gray-700">{{ Auth::user()->name }}</span>
                            </button>
                            <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lift border border-gray-100 py-2 z-50"
                                x-on:click.away="open = false">
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">My Orders</a>
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.index') }}" class="block px-4 py-2 text-sm text-chocolate-500 font-medium hover:bg-gray-50">Admin Panel</a>
                                @endif
                                <hr class="my-1 border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Sign Out</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary btn-sm">Sign In</a>
                        <a href="{{ route('register') }}" class="btn-primary btn-sm hidden md:inline-flex">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="alert-success flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
            <div class="alert-error flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-chocolate-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-[10px]">TP</span>
                        </div>
                        <span class="text-chocolate-600 font-bold text-lg">UD Trisna Putra</span>
                    </div>
                    <p class="body-text text-sm">Supplier terpercaya bahan baku roti berkualitas tinggi.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-chocolate-600 mb-4">Shop</h4>
                    <ul class="space-y-2 text-sm body-text">
                        <li><a href="{{ route('shop') }}" class="hover:text-chocolate-500 transition-colors">All Products</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-chocolate-600 mb-4">Account</h4>
                    <ul class="space-y-2 text-sm body-text">
                        @auth
                            <li><a href="{{ route('orders.index') }}" class="hover:text-chocolate-500 transition-colors">My Orders</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-chocolate-500 transition-colors">Sign In</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-chocolate-600 mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm body-text">
                        <li>hello@udtrisnaputra.com</li>
                        <li>(0361) 9004486</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-100 mt-8 pt-8 text-center text-sm muted-text">
                &copy; {{ date('Y') }} UD Trisna Putra. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
