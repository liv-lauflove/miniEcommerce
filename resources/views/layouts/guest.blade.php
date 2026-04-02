<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Autentikasi' }} — UD Trisna Putra</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        <!-- =============================================
             SPLIT-SCREEN LAYOUT
             Left panel  : Brand identity (hidden on mobile)
             Right panel : Auth form
             ============================================= -->
        <div class="min-h-screen flex">

            <!-- ── LEFT PANEL : Brand Identity ───────────── -->
            <div class="hidden lg:flex lg:w-1/2 xl:w-[45%]
                        bg-gradient-to-br from-chocolate-600 via-chocolate-700 to-chocolate-800
                        relative overflow-hidden flex-col justify-between p-12 xl:p-16">

                <!-- Decorative circles (background) -->
                <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full bg-white/[0.04]"></div>
                <div class="absolute -bottom-16 -right-16 w-96 h-96 rounded-full bg-white/[0.03]"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full bg-white/[0.02]"></div>

                <!-- Top: Brand mark -->
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center gap-3 group">
                        <div class="w-11 h-11 bg-white/15 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20 group-hover:bg-white/25 transition-all duration-200">
                            <span class="text-white font-bold text-sm tracking-wide">TP</span>
                        </div>
                        <span class="text-white font-bold text-lg tracking-tight">UD Trisna Putra</span>
                    </a>
                </div>

                <!-- Center: Value proposition -->
                <div class="relative z-10 space-y-6">
                    <!-- Hero icon / visual mark -->
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/15">
                            <svg class="w-8 h-8 text-cream-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                <path d="M2 17l10 5 10-5"/>
                                <path d="M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-3xl xl:text-4xl font-bold text-white leading-tight">
                        Supplier Terpercaya<br>
                        <span class="text-cream-300">Bahan Baku Roti</span><br>
                        Berkualitas Tinggi
                    </h2>

                    <p class="text-white/60 text-base leading-relaxed max-w-sm">
                        Temukan berbagai bahan baku roti premium dengan harga terbaik. Pesan mudah, kirim cepat, kualitas terjamin.
                    </p>

                    <!-- Trust indicators -->
                    <div class="flex items-center gap-6 pt-2">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-cream-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-white/70 text-sm">Bahan Premium</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-cream-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-white/70 text-sm">Harga Bersaing</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-cream-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-white/70 text-sm">Pengiriman Cepat</span>
                        </div>
                    </div>
                </div>

                <!-- Bottom: Tagline & contact -->
                <div class="relative z-10 pt-8 border-t border-white/10">
                    <p class="text-white/40 text-xs">© {{ now()->year }} UD Trisna Putra. All rights reserved.</p>
                    <p class="text-white/40 text-xs mt-1">hello@udtrisnaputra.com · (0361) 9004486</p>
                </div>
            </div>

            <!-- ── RIGHT PANEL : Auth Form ────────────────── -->
            <div class="flex-1 flex flex-col justify-center px-6 sm:px-8 lg:px-12 xl:px-20 py-12 bg-white relative">

                <!-- Mobile brand mark (only visible on small screens) -->
                <div class="lg:hidden absolute top-6 left-6 flex items-center gap-2">
                    <div class="w-9 h-9 bg-chocolate-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xs tracking-wide">TP</span>
                    </div>
                    <span class="text-chocolate-600 font-bold text-sm">UD Trisna Putra</span>
                </div>

                <!-- The form slot -->
                <div class="w-full max-w-[400px] mx-auto lg:mx-0 lg:ml-4">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>
