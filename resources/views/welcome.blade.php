<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mini eCommerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Syne', 'sans-serif'],
                        body: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        ink: '#0F0F0F',
                        cream: '#F7F4EF',
                        sand: '#E8E2D9',
                        ember: '#E8400C',
                        'ember-light': '#FF6B3D',
                        mist: '#F0EDE8',
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.6s ease forwards',
                        'slide-in': 'slideIn 0.5s ease forwards',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': { opacity: '0', transform: 'translateY(24px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideIn: {
                            '0%': { opacity: '0', transform: 'translateX(-16px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #F7F4EF;
            color: #0F0F0F;
        }
        h1, h2, h3, h4, .font-display {
            font-family: 'Syne', sans-serif;
        }

        /* Navbar scroll shadow */
        .navbar-sticky {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(247, 244, 239, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid #E8E2D9;
            transition: box-shadow 0.3s ease;
        }

        /* Product Card Hover */
        .product-card {
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1),
                        box-shadow 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(15, 15, 15, 0.12);
        }
        .product-card:hover .product-image-wrap img {
            transform: scale(1.05);
        }
        .product-image-wrap {
            overflow: hidden;
        }
        .product-image-wrap img {
            transition: transform 0.4s ease;
        }

        /* Add to cart button reveal */
        .product-card .btn-cart {
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.25s ease, transform 0.25s ease;
        }
        .product-card:hover .btn-cart {
            opacity: 1;
            transform: translateY(0);
        }

        /* Category card */
        .category-card {
            transition: transform 0.25s ease, background 0.25s ease;
        }
        .category-card:hover {
            transform: translateY(-4px);
            background: #0F0F0F;
            color: #F7F4EF;
        }
        .category-card:hover .cat-icon {
            background: rgba(255,255,255,0.1);
            color: #FF6B3D;
        }
        .category-card:hover .cat-label {
            color: #F7F4EF;
        }
        .category-card:hover .cat-count {
            color: #E8E2D9;
        }

        /* Search focus */
        .search-input:focus {
            outline: none;
            border-color: #E8400C;
            box-shadow: 0 0 0 3px rgba(232, 64, 12, 0.12);
        }

        /* Staggered animation */
        .stagger-1 { animation-delay: 0.05s; }
        .stagger-2 { animation-delay: 0.1s; }
        .stagger-3 { animation-delay: 0.15s; }
        .stagger-4 { animation-delay: 0.2s; }
        .stagger-5 { animation-delay: 0.25s; }
        .stagger-6 { animation-delay: 0.3s; }
        .stagger-7 { animation-delay: 0.35s; }
        .stagger-8 { animation-delay: 0.4s; }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hero grain overlay */
        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            border-radius: inherit;
        }

        /* Newsletter input */
        .nl-input:focus {
            outline: none;
            border-color: #E8400C;
        }

        /* Mobile menu */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
        }
        #mobile-menu.open {
            max-height: 400px;
        }

        /* Cart badge */
        .cart-badge {
            min-width: 18px;
            height: 18px;
            font-size: 10px;
        }

        /* Star rating */
        .star-filled { color: #F59E0B; }
        .star-empty { color: #D1D5DB; }

        /* Promo banner gradient */
        .promo-gradient {
            background: linear-gradient(135deg, #0F0F0F 0%, #1a1a1a 50%, #0F0F0F 100%);
        }
    </style>
</head>

<body class="min-h-screen">

<!-- ============================================================
     NAVBAR
============================================================ -->
<header class="navbar-sticky">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <!-- Top bar: Logo + Search + Icons -->
        <div class="flex items-center gap-4 py-3.5">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 flex-shrink-0 mr-2">
                <div class="w-8 h-8 bg-ink rounded-md flex items-center justify-center">
                    <span class="text-cream text-sm font-display font-800">M</span>
                </div>
                <span class="font-display font-700 text-xl text-ink tracking-tight hidden sm:block">Mini</span>
            </a>

            <!-- Search Bar -->
            <div class="flex-1 relative max-w-xl">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"></i>
                <input
                    type="text"
                    placeholder="Cari produk, merek, kategori..."
                    class="search-input w-full pl-9 pr-4 py-2 text-sm bg-sand border border-transparent rounded-lg font-body transition-all duration-200 placeholder:text-gray-400"
                >
            </div>

            <!-- Nav Icons -->
            <div class="flex items-center gap-1 flex-shrink-0">
                <!-- Cart -->
                <a href="#" class="relative p-2 rounded-lg hover:bg-sand transition-colors group">
                    <i data-lucide="shopping-cart" class="w-5 h-5 text-ink group-hover:text-ember transition-colors"></i>
                    <span class="cart-badge absolute -top-0.5 -right-0.5 bg-ember text-white rounded-full flex items-center justify-center font-body font-600 leading-none px-1">3</span>
                </a>
                <!-- Wishlist -->
                <a href="#" class="p-2 rounded-lg hover:bg-sand transition-colors group hidden sm:flex">
                    <i data-lucide="heart" class="w-5 h-5 text-ink group-hover:text-ember transition-colors"></i>
                </a>
                <!-- Profile -->
                <a href="#" class="p-2 rounded-lg hover:bg-sand transition-colors group">
                    <i data-lucide="user" class="w-5 h-5 text-ink group-hover:text-ember transition-colors"></i>
                </a>
                <!-- Mobile Hamburger -->
                <button id="menu-toggle" class="p-2 rounded-lg hover:bg-sand transition-colors md:hidden" aria-label="Menu">
                    <i data-lucide="menu" class="w-5 h-5 text-ink" id="menu-icon-open"></i>
                    <i data-lucide="x" class="w-5 h-5 text-ink hidden" id="menu-icon-close"></i>
                </button>
            </div>
        </div>

        <!-- Category Nav (Desktop) -->
        <nav class="hidden md:flex items-center gap-1 pb-2.5 border-t border-sand pt-2.5">
            <span class="text-xs font-body font-500 text-gray-400 mr-2 uppercase tracking-widest">Kategori:</span>
            <a href="#" class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-sm font-body font-500 text-ink hover:bg-sand hover:text-ember transition-all">
                <i data-lucide="zap" class="w-3.5 h-3.5"></i> Elektronik
            </a>
            <a href="#" class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-sm font-body font-500 text-ink hover:bg-sand hover:text-ember transition-all">
                <i data-lucide="shirt" class="w-3.5 h-3.5"></i> Fashion
            </a>
            <a href="#" class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-sm font-body font-500 text-ink hover:bg-sand hover:text-ember transition-all">
                <i data-lucide="home" class="w-3.5 h-3.5"></i> Home
            </a>
            <a href="#" class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-sm font-body font-500 text-ink hover:bg-sand hover:text-ember transition-all">
                <i data-lucide="dumbbell" class="w-3.5 h-3.5"></i> Olahraga
            </a>
            <a href="#" class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-sm font-body font-500 text-ink hover:bg-sand hover:text-ember transition-all">
                <i data-lucide="book-open" class="w-3.5 h-3.5"></i> Buku
            </a>
            <a href="#" class="flex items-center gap-1.5 px-3 py-1.5 rounded-md text-sm font-body font-500 text-ink hover:bg-sand hover:text-ember transition-all">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i> Kecantikan
            </a>
            <div class="ml-auto">
                <a href="#" class="text-sm font-body text-ember hover:underline font-500">Lihat Semua →</a>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden">
            <nav class="py-3 border-t border-sand flex flex-col gap-1">
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-body font-500 text-ink hover:bg-sand">
                    <i data-lucide="zap" class="w-4 h-4"></i> Elektronik
                </a>
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-body font-500 text-ink hover:bg-sand">
                    <i data-lucide="shirt" class="w-4 h-4"></i> Fashion
                </a>
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-body font-500 text-ink hover:bg-sand">
                    <i data-lucide="home" class="w-4 h-4"></i> Home
                </a>
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-body font-500 text-ink hover:bg-sand">
                    <i data-lucide="dumbbell" class="w-4 h-4"></i> Olahraga
                </a>
                <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-body font-500 text-ink hover:bg-sand">
                    <i data-lucide="sparkles" class="w-4 h-4"></i> Kecantikan
                </a>
            </nav>
        </div>

    </div>
</header>


<!-- ============================================================
     HERO SECTION
============================================================ -->
<section class="hero-section relative bg-ink overflow-hidden" style="min-height: 520px;">

    <!-- Background decorative shapes -->
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-96 h-96 bg-ember opacity-10 rounded-full blur-3xl translate-x-1/3 -translate-y-1/4"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-ember-light opacity-5 rounded-full blur-2xl -translate-x-1/4 translate-y-1/4"></div>
        <!-- Grid pattern -->
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: repeating-linear-gradient(0deg, transparent, transparent 39px, #fff 39px, #fff 40px), repeating-linear-gradient(90deg, transparent, transparent 39px, #fff 39px, #fff 40px);"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-16 md:py-24 flex flex-col md:flex-row items-center gap-10 md:gap-6">

        <!-- Hero Text -->
        <div class="flex-1 text-center md:text-left animate-on-scroll">
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/10 rounded-full px-4 py-1.5 mb-6">
                <span class="w-2 h-2 rounded-full bg-ember-light animate-pulse"></span>
                <span class="text-white/80 text-xs font-body font-500 uppercase tracking-widest">Flash Sale Hari Ini</span>
            </div>
            <h1 class="font-display font-800 text-4xl sm:text-5xl lg:text-6xl text-white leading-tight mb-4">
                Temukan yang<br>
                <span>Kamu Inginkan!</span><br>
                di Sini.
            </h1>
            <p class="font-body text-white/60 text-base sm:text-lg mb-8 max-w-md mx-auto md:mx-0">
                Ribuan produk pilihan dari brand terpercaya, pengiriman cepat, dan harga yang nggak bohong.
            </p>
            <div class="flex flex-col sm:flex-row items-center gap-3 justify-center md:justify-start">
                <a href="#products" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-ember hover:bg-ember-light text-white font-body font-600 px-7 py-3.5 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-ember/30 hover:-translate-y-0.5">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                    Belanja Sekarang
                </a>
                <a href="#categories" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white font-body font-500 px-7 py-3.5 rounded-xl border border-white/20 transition-all duration-200">
                    Jelajahi Kategori
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            <!-- Trust badges -->
            <div class="flex items-center gap-5 mt-8 justify-center md:justify-start">
                <div class="flex items-center gap-1.5 text-white/50 text-xs font-body">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5 text-green-400"></i>
                    Pembayaran Aman
                </div>
                <div class="flex items-center gap-1.5 text-white/50 text-xs font-body">
                    <i data-lucide="refresh-ccw" class="w-3.5 h-3.5 text-blue-400"></i>
                    Retur Mudah
                </div>
                <div class="flex items-center gap-1.5 text-white/50 text-xs font-body">
                    <i data-lucide="truck" class="w-3.5 h-3.5 text-yellow-400"></i>
                    Gratis Ongkir
                </div>
            </div>
        </div>

        <!-- Hero Image / Visual -->
        <div class="flex-1 flex items-center justify-center md:justify-end">
            <div class="relative w-72 h-72 sm:w-80 sm:h-80 md:w-96 md:h-96">
                <!-- Main product showcase -->
                <div class="absolute inset-0 rounded-3xl overflow-hidden bg-white/5 border border-white/10 backdrop-blur-sm">
                    <img
                        src="https://placehold.co/400x400/1a1a1a/ff6b3d?text=🎧+PRODUK+UNGGULAN&font=outfit"
                        alt="Produk Unggulan"
                        class="w-full h-full object-cover opacity-80"
                    >
                </div>
                <!-- Floating badge: discount -->
                <div class="absolute -top-3 -right-3 bg-ember text-white rounded-2xl px-3 py-2 shadow-lg shadow-ember/40 text-center">
                    <div class="font-display font-800 text-xl leading-none">50%</div>
                    <div class="font-body text-xs text-white/80">OFF</div>
                </div>
                <!-- Floating badge: rating -->
                <div class="absolute -bottom-3 -left-3 bg-white rounded-xl px-3 py-2 shadow-xl flex items-center gap-2">
                    <div class="flex text-yellow-400 text-xs">
                        ★★★★★
                    </div>
                    <div>
                        <div class="font-display font-700 text-ink text-sm leading-none">4.9</div>
                        <div class="font-body text-gray-400 text-xs">2.4k ulasan</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 opacity-40">
        <span class="text-white text-xs font-body">Scroll</span>
        <i data-lucide="chevron-down" class="w-4 h-4 text-white animate-bounce"></i>
    </div>
</section>


<!-- ============================================================
     PROMO BANNER (Free Shipping Strip)
============================================================ -->
<section class="bg-ember py-3">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap items-center justify-center gap-6 text-white text-sm font-body font-500">
            <div class="flex items-center gap-2">
                <i data-lucide="truck" class="w-4 h-4"></i>
                <span>Gratis Ongkir min. belanja Rp150.000</span>
            </div>
            <span class="hidden sm:block text-white/40">|</span>
            <div class="flex items-center gap-2">
                <i data-lucide="tag" class="w-4 h-4"></i>
                <span>Diskon s.d 70% produk pilihan</span>
            </div>
            <span class="hidden sm:block text-white/40">|</span>
            <div class="flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4"></i>
                <span>Flash Sale setiap hari pukul 12.00 & 20.00</span>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     CATEGORIES SECTION
============================================================ -->
<section id="categories" class="py-16 max-w-7xl mx-auto px-4 sm:px-6">

    <div class="flex items-end justify-between mb-8 animate-on-scroll">
        <div>
            <p class="text-ember text-sm font-body font-600 uppercase tracking-widest mb-1">Jelajahi</p>
            <h2 class="font-display font-700 text-3xl sm:text-4xl text-ink">Kategori Populer</h2>
        </div>
        <a href="#" class="hidden sm:flex items-center gap-1 text-sm font-body font-500 text-ink hover:text-ember transition-colors">
            Semua Kategori <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">

        <!-- Category: Elektronik -->
        <a href="#" class="category-card group bg-white border border-sand rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
            <div class="cat-icon w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center transition-all">
                <i data-lucide="zap" class="w-6 h-6 text-blue-500"></i>
            </div>
            <div class="text-center">
                <p class="cat-label font-body font-600 text-sm text-ink transition-colors">Elektronik</p>
                <p class="cat-count font-body text-xs text-gray-400 transition-colors">1.2k produk</p>
            </div>
        </a>

        <!-- Category: Fashion -->
        <a href="#" class="category-card group bg-white border border-sand rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
            <div class="cat-icon w-12 h-12 rounded-xl bg-pink-50 flex items-center justify-center transition-all">
                <i data-lucide="shirt" class="w-6 h-6 text-pink-500"></i>
            </div>
            <div class="text-center">
                <p class="cat-label font-body font-600 text-sm text-ink transition-colors">Fashion</p>
                <p class="cat-count font-body text-xs text-gray-400 transition-colors">3.5k produk</p>
            </div>
        </a>

        <!-- Category: Home -->
        <a href="#" class="category-card group bg-white border border-sand rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
            <div class="cat-icon w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center transition-all">
                <i data-lucide="home" class="w-6 h-6 text-amber-500"></i>
            </div>
            <div class="text-center">
                <p class="cat-label font-body font-600 text-sm text-ink transition-colors">Home</p>
                <p class="cat-count font-body text-xs text-gray-400 transition-colors">890 produk</p>
            </div>
        </a>

        <!-- Category: Olahraga -->
        <a href="#" class="category-card group bg-white border border-sand rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
            <div class="cat-icon w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center transition-all">
                <i data-lucide="dumbbell" class="w-6 h-6 text-green-500"></i>
            </div>
            <div class="text-center">
                <p class="cat-label font-body font-600 text-sm text-ink transition-colors">Olahraga</p>
                <p class="cat-count font-body text-xs text-gray-400 transition-colors">640 produk</p>
            </div>
        </a>

        <!-- Category: Kecantikan -->
        <a href="#" class="category-card group bg-white border border-sand rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
            <div class="cat-icon w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center transition-all">
                <i data-lucide="sparkles" class="w-6 h-6 text-purple-500"></i>
            </div>
            <div class="text-center">
                <p class="cat-label font-body font-600 text-sm text-ink transition-colors">Kecantikan</p>
                <p class="cat-count font-body text-xs text-gray-400 transition-colors">2.1k produk</p>
            </div>
        </a>

        <!-- Category: Buku -->
        <a href="#" class="category-card group bg-white border border-sand rounded-2xl p-5 flex flex-col items-center gap-3 cursor-pointer">
            <div class="cat-icon w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center transition-all">
                <i data-lucide="book-open" class="w-6 h-6 text-orange-500"></i>
            </div>
            <div class="text-center">
                <p class="cat-label font-body font-600 text-sm text-ink transition-colors">Buku</p>
                <p class="cat-count font-body text-xs text-gray-400 transition-colors">450 produk</p>
            </div>
        </a>

    </div>
</section>


<!-- ============================================================
     FEATURED PRODUCTS
============================================================ -->
<section id="products" class="py-4 pb-16 max-w-7xl mx-auto px-4 sm:px-6">

    <div class="flex items-end justify-between mb-8 animate-on-scroll">
        <div>
            <p class="text-ember text-sm font-body font-600 uppercase tracking-widest mb-1">Terlaris</p>
            <h2 class="font-display font-700 text-3xl sm:text-4xl text-ink">Produk Unggulan</h2>
        </div>
        <div class="hidden sm:flex items-center gap-2">
            <button class="px-3 py-1.5 text-sm font-body font-500 bg-ink text-cream rounded-lg">Semua</button>
            <button class="px-3 py-1.5 text-sm font-body font-500 text-gray-500 hover:bg-sand rounded-lg transition-colors">Baru</button>
            <button class="px-3 py-1.5 text-sm font-body font-500 text-gray-500 hover:bg-sand rounded-lg transition-colors">Sale</button>
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">

        <!-- Product 1 -->
        <article class="product-card animate-on-scroll stagger-1 bg-white border border-sand rounded-2xl overflow-hidden group cursor-pointer">
            <div class="product-image-wrap relative bg-mist aspect-square">
                <img src="https://placehold.co/300x300/F0EDE8/E8400C?text=🎧&font=outfit" alt="Wireless Headphone" class="w-full h-full object-cover">
                <span class="absolute top-3 left-3 bg-ember text-white text-xs font-body font-600 px-2 py-0.5 rounded-md">-30%</span>
                <button class="absolute top-3 right-3 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow hover:text-ember transition-colors">
                    <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                </button>
            </div>
            <div class="p-4">
                <p class="text-xs font-body text-gray-400 mb-1">Elektronik</p>
                <h3 class="font-display font-600 text-ink text-sm leading-snug mb-2 line-clamp-2">Wireless Headphone Pro Max ANC</h3>
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400 text-xs">★★★★★</div>
                    <span class="text-gray-400 text-xs font-body">(4.8) · 2.3k</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-display font-700 text-ink text-base">Rp 349.000</p>
                        <p class="text-xs font-body text-gray-400 line-through">Rp 499.000</p>
                    </div>
                </div>
                <button class="btn-cart mt-3 w-full flex items-center justify-center gap-2 bg-ink text-cream text-sm font-body font-500 py-2 rounded-lg hover:bg-ember transition-colors">
                    <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                    Tambah ke Keranjang
                </button>
            </div>
        </article>

        <!-- Product 2 -->
        <article class="product-card animate-on-scroll stagger-2 bg-white border border-sand rounded-2xl overflow-hidden group cursor-pointer">
            <div class="product-image-wrap relative bg-mist aspect-square">
                <img src="https://placehold.co/300x300/F0EDE8/0F0F0F?text=👟&font=outfit" alt="Sneakers" class="w-full h-full object-cover">
                <span class="absolute top-3 left-3 bg-ink text-cream text-xs font-body font-600 px-2 py-0.5 rounded-md">NEW</span>
                <button class="absolute top-3 right-3 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow hover:text-ember transition-colors">
                    <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                </button>
            </div>
            <div class="p-4">
                <p class="text-xs font-body text-gray-400 mb-1">Fashion</p>
                <h3 class="font-display font-600 text-ink text-sm leading-snug mb-2 line-clamp-2">Sneakers Urban Runner Series 5</h3>
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400 text-xs">★★★★<span class="text-gray-300">★</span></div>
                    <span class="text-gray-400 text-xs font-body">(4.4) · 987</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-display font-700 text-ink text-base">Rp 520.000</p>
                        <p class="text-xs font-body text-transparent">-</p>
                    </div>
                </div>
                <button class="btn-cart mt-3 w-full flex items-center justify-center gap-2 bg-ink text-cream text-sm font-body font-500 py-2 rounded-lg hover:bg-ember transition-colors">
                    <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                    Tambah ke Keranjang
                </button>
            </div>
        </article>

        <!-- Product 3 -->
        <article class="product-card animate-on-scroll stagger-3 bg-white border border-sand rounded-2xl overflow-hidden group cursor-pointer">
            <div class="product-image-wrap relative bg-mist aspect-square">
                <img src="https://placehold.co/300x300/F0EDE8/E8400C?text=🪴&font=outfit" alt="Pot Tanaman" class="w-full h-full object-cover">
                <span class="absolute top-3 left-3 bg-green-500 text-white text-xs font-body font-600 px-2 py-0.5 rounded-md">ECO</span>
                <button class="absolute top-3 right-3 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow hover:text-ember transition-colors">
                    <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                </button>
            </div>
            <div class="p-4">
                <p class="text-xs font-body text-gray-400 mb-1">Home</p>
                <h3 class="font-display font-600 text-ink text-sm leading-snug mb-2 line-clamp-2">Pot Keramik Minimalis Nordic Style</h3>
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400 text-xs">★★★★★</div>
                    <span class="text-gray-400 text-xs font-body">(4.9) · 1.5k</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-display font-700 text-ink text-base">Rp 89.000</p>
                        <p class="text-xs font-body text-gray-400 line-through">Rp 129.000</p>
                    </div>
                </div>
                <button class="btn-cart mt-3 w-full flex items-center justify-center gap-2 bg-ink text-cream text-sm font-body font-500 py-2 rounded-lg hover:bg-ember transition-colors">
                    <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                    Tambah ke Keranjang
                </button>
            </div>
        </article>

        <!-- Product 4 -->
        <article class="product-card animate-on-scroll stagger-4 bg-white border border-sand rounded-2xl overflow-hidden group cursor-pointer">
            <div class="product-image-wrap relative bg-mist aspect-square">
                <img src="https://placehold.co/300x300/F0EDE8/0F0F0F?text=⌚&font=outfit" alt="Smartwatch" class="w-full h-full object-cover">
                <span class="absolute top-3 left-3 bg-ember text-white text-xs font-body font-600 px-2 py-0.5 rounded-md">-45%</span>
                <button class="absolute top-3 right-3 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow hover:text-ember transition-colors">
                    <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                </button>
            </div>
            <div class="p-4">
                <p class="text-xs font-body text-gray-400 mb-1">Elektronik</p>
                <h3 class="font-display font-600 text-ink text-sm leading-snug mb-2 line-clamp-2">Smartwatch Gen 3 AMOLED GPS</h3>
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400 text-xs">★★★★<span class="text-gray-300">★</span></div>
                    <span class="text-gray-400 text-xs font-body">(4.5) · 3.1k</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-display font-700 text-ink text-base">Rp 799.000</p>
                        <p class="text-xs font-body text-gray-400 line-through">Rp 1.449.000</p>
                    </div>
                </div>
                <button class="btn-cart mt-3 w-full flex items-center justify-center gap-2 bg-ink text-cream text-sm font-body font-500 py-2 rounded-lg hover:bg-ember transition-colors">
                    <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                    Tambah ke Keranjang
                </button>
            </div>
        </article>

        <!-- Product 5 -->
        <article class="product-card animate-on-scroll stagger-5 bg-white border border-sand rounded-2xl overflow-hidden group cursor-pointer">
            <div class="product-image-wrap relative bg-mist aspect-square">
                <img src="https://placehold.co/300x300/F0EDE8/E8400C?text=💄&font=outfit" alt="Lip Cream" class="w-full h-full object-cover">
                <span class="absolute top-3 left-3 bg-pink-500 text-white text-xs font-body font-600 px-2 py-0.5 rounded-md">LOCAL</span>
                <button class="absolute top-3 right-3 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow hover:text-ember transition-colors">
                    <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                </button>
            </div>
            <div class="p-4">
                <p class="text-xs font-body text-gray-400 mb-1">Kecantikan</p>
                <h3 class="font-display font-600 text-ink text-sm leading-snug mb-2 line-clamp-2">Lip Cream Matte Tahan Lama 24 Jam</h3>
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400 text-xs">★★★★★</div>
                    <span class="text-gray-400 text-xs font-body">(4.9) · 8.7k</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-display font-700 text-ink text-base">Rp 45.000</p>
                        <p class="text-xs font-body text-transparent">-</p>
                    </div>
                </div>
                <button class="btn-cart mt-3 w-full flex items-center justify-center gap-2 bg-ink text-cream text-sm font-body font-500 py-2 rounded-lg hover:bg-ember transition-colors">
                    <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                    Tambah ke Keranjang
                </button>
            </div>
        </article>

        <!-- Product 6 -->
        <article class="product-card animate-on-scroll stagger-6 bg-white border border-sand rounded-2xl overflow-hidden group cursor-pointer">
            <div class="product-image-wrap relative bg-mist aspect-square">
                <img src="https://placehold.co/300x300/F0EDE8/0F0F0F?text=🎒&font=outfit" alt="Backpack" class="w-full h-full object-cover">
                <span class="absolute top-3 left-3 bg-ink text-cream text-xs font-body font-600 px-2 py-0.5 rounded-md">BEST</span>
                <button class="absolute top-3 right-3 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow hover:text-ember transition-colors">
                    <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                </button>
            </div>
            <div class="p-4">
                <p class="text-xs font-body text-gray-400 mb-1">Fashion</p>
                <h3 class="font-display font-600 text-ink text-sm leading-snug mb-2 line-clamp-2">Ransel Laptop Waterproof 30L USB</h3>
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400 text-xs">★★★★<span class="text-gray-300">★</span></div>
                    <span class="text-gray-400 text-xs font-body">(4.6) · 4.2k</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-display font-700 text-ink text-base">Rp 210.000</p>
                        <p class="text-xs font-body text-gray-400 line-through">Rp 280.000</p>
                    </div>
                </div>
                <button class="btn-cart mt-3 w-full flex items-center justify-center gap-2 bg-ink text-cream text-sm font-body font-500 py-2 rounded-lg hover:bg-ember transition-colors">
                    <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                    Tambah ke Keranjang
                </button>
            </div>
        </article>

        <!-- Product 7 -->
        <article class="product-card animate-on-scroll stagger-7 bg-white border border-sand rounded-2xl overflow-hidden group cursor-pointer">
            <div class="product-image-wrap relative bg-mist aspect-square">
                <img src="https://placehold.co/300x300/F0EDE8/E8400C?text=📚&font=outfit" alt="Buku" class="w-full h-full object-cover">
                <button class="absolute top-3 right-3 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow hover:text-ember transition-colors">
                    <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                </button>
            </div>
            <div class="p-4">
                <p class="text-xs font-body text-gray-400 mb-1">Buku</p>
                <h3 class="font-display font-600 text-ink text-sm leading-snug mb-2 line-clamp-2">Atomic Habits — James Clear (Edisi BM)</h3>
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400 text-xs">★★★★★</div>
                    <span class="text-gray-400 text-xs font-body">(5.0) · 12k</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-display font-700 text-ink text-base">Rp 89.000</p>
                        <p class="text-xs font-body text-transparent">-</p>
                    </div>
                </div>
                <button class="btn-cart mt-3 w-full flex items-center justify-center gap-2 bg-ink text-cream text-sm font-body font-500 py-2 rounded-lg hover:bg-ember transition-colors">
                    <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                    Tambah ke Keranjang
                </button>
            </div>
        </article>

        <!-- Product 8 -->
        <article class="product-card animate-on-scroll stagger-8 bg-white border border-sand rounded-2xl overflow-hidden group cursor-pointer">
            <div class="product-image-wrap relative bg-mist aspect-square">
                <img src="https://placehold.co/300x300/F0EDE8/0F0F0F?text=🏋️&font=outfit" alt="Resistance Band" class="w-full h-full object-cover">
                <span class="absolute top-3 left-3 bg-ember text-white text-xs font-body font-600 px-2 py-0.5 rounded-md">-20%</span>
                <button class="absolute top-3 right-3 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow hover:text-ember transition-colors">
                    <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                </button>
            </div>
            <div class="p-4">
                <p class="text-xs font-body text-gray-400 mb-1">Olahraga</p>
                <h3 class="font-display font-600 text-ink text-sm leading-snug mb-2 line-clamp-2">Resistance Band Set 5 Level Premium</h3>
                <div class="flex items-center gap-1 mb-2">
                    <div class="flex text-yellow-400 text-xs">★★★★<span class="text-gray-300">★</span></div>
                    <span class="text-gray-400 text-xs font-body">(4.3) · 689</span>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-display font-700 text-ink text-base">Rp 75.000</p>
                        <p class="text-xs font-body text-gray-400 line-through">Rp 95.000</p>
                    </div>
                </div>
                <button class="btn-cart mt-3 w-full flex items-center justify-center gap-2 bg-ink text-cream text-sm font-body font-500 py-2 rounded-lg hover:bg-ember transition-colors">
                    <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                    Tambah ke Keranjang
                </button>
            </div>
        </article>

    </div>

    <!-- Load More -->
    <div class="text-center mt-10 animate-on-scroll">
        <button class="inline-flex items-center gap-2 border-2 border-ink text-ink font-body font-600 px-8 py-3 rounded-xl hover:bg-ink hover:text-cream transition-all duration-200">
            <i data-lucide="grid" class="w-4 h-4"></i>
            Lihat Semua Produk
        </button>
    </div>
</section>


<!-- ============================================================
     PROMO / DISKON BANNER
============================================================ -->
<section class="py-6 px-4 sm:px-6 max-w-7xl mx-auto animate-on-scroll">
    <div class="promo-gradient rounded-3xl overflow-hidden relative p-8 sm:p-12 flex flex-col sm:flex-row items-center gap-8">

        <!-- Decorative -->
        <div class="absolute top-0 right-0 w-72 h-72 bg-ember opacity-10 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-48 h-48 bg-ember-light opacity-5 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative flex-1 text-center sm:text-left">
            <div class="inline-flex items-center gap-2 bg-ember/20 border border-ember/30 rounded-full px-3 py-1 mb-4">
                <i data-lucide="timer" class="w-3.5 h-3.5 text-ember-light"></i>
                <span class="text-ember-light text-xs font-body font-600 uppercase tracking-wider">Penawaran Terbatas</span>
            </div>
            <h2 class="font-display font-800 text-3xl sm:text-4xl text-white mb-3">
                Diskon s.d <span class="text-ember-light">70%</span><br>
                + Gratis Ongkir!
            </h2>
            <p class="font-body text-white/60 text-sm mb-6 max-w-sm">
                Berlaku untuk semua produk fashion & elektronik pilihan. Gunakan kode promo <strong class="text-white font-600">MINI70</strong> saat checkout.
            </p>
            <div class="flex items-center gap-3 justify-center sm:justify-start">
                <a href="#" class="inline-flex items-center gap-2 bg-ember hover:bg-ember-light text-white font-body font-600 px-6 py-3 rounded-xl transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-ember/40">
                    Klaim Diskon <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

        <!-- Countdown / Promo visual -->
        <div class="relative flex-shrink-0">
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm text-center min-w-40">
                <p class="text-white/50 text-xs font-body uppercase tracking-widest mb-3">Berakhir dalam</p>
                <div class="flex items-center gap-2 justify-center">
                    <div class="bg-white/10 rounded-lg px-3 py-2 text-center">
                        <span class="font-display font-800 text-white text-2xl leading-none" id="countdown-h">08</span>
                        <p class="text-white/40 text-xs font-body mt-0.5">Jam</p>
                    </div>
                    <span class="text-white/40 font-display font-800 text-xl">:</span>
                    <div class="bg-white/10 rounded-lg px-3 py-2 text-center">
                        <span class="font-display font-800 text-white text-2xl leading-none" id="countdown-m">24</span>
                        <p class="text-white/40 text-xs font-body mt-0.5">Mnt</p>
                    </div>
                    <span class="text-white/40 font-display font-800 text-xl">:</span>
                    <div class="bg-white/10 rounded-lg px-3 py-2 text-center">
                        <span class="font-display font-800 text-ember-light text-2xl leading-none" id="countdown-s">59</span>
                        <p class="text-white/40 text-xs font-body mt-0.5">Det</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- ============================================================
     FOOTER
============================================================ -->
<footer class="bg-ink text-cream mt-6">

    <!-- Newsletter -->
    <div class="border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 flex flex-col sm:flex-row items-center gap-6 justify-between">
            <div>
                <h3 class="font-display font-700 text-xl mb-1">Daftar Newsletter</h3>
                <p class="font-body text-white/50 text-sm">Dapatkan promo eksklusif langsung ke emailmu.</p>
            </div>
            <form class="flex items-center gap-2 w-full sm:w-auto" onsubmit="return false;">
                <input
                    type="email"
                    placeholder="email@kamu.com"
                    class="nl-input flex-1 sm:w-64 bg-white/10 border border-white/20 text-white placeholder:text-white/30 font-body text-sm px-4 py-2.5 rounded-xl transition-colors"
                >
                <button type="submit" class="flex-shrink-0 bg-ember hover:bg-ember-light text-white font-body font-600 px-5 py-2.5 rounded-xl transition-colors">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    <!-- Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 grid grid-cols-2 sm:grid-cols-4 gap-8">

        <!-- Brand -->
        <div class="col-span-2 sm:col-span-1">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-ember rounded-md flex items-center justify-center">
                    <span class="text-white text-sm font-display font-800">M</span>
                </div>
                <span class="font-display font-700 text-xl tracking-tight">Mini</span>
            </div>
            <p class="font-body text-white/50 text-sm leading-relaxed mb-4">
                Belanja lebih mudah, lebih hemat, lebih seru. Temukan produk impianmu di Mini.
            </p>
            <div class="flex items-center gap-3">
                <a href="#" aria-label="Instagram" class="w-9 h-9 bg-white/10 hover:bg-ember rounded-lg flex items-center justify-center transition-colors">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
                <a href="#" aria-label="Twitter/X" class="w-9 h-9 bg-white/10 hover:bg-ember rounded-lg flex items-center justify-center transition-colors">
                    <i data-lucide="twitter" class="w-4 h-4"></i>
                </a>
                <a href="#" aria-label="Facebook" class="w-9 h-9 bg-white/10 hover:bg-ember rounded-lg flex items-center justify-center transition-colors">
                    <i data-lucide="facebook" class="w-4 h-4"></i>
                </a>
                <a href="#" aria-label="TikTok" class="w-9 h-9 bg-white/10 hover:bg-ember rounded-lg flex items-center justify-center transition-colors">
                    <i data-lucide="music-2" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

        <!-- Links: Belanja -->
        <div>
            <h4 class="font-display font-600 text-sm uppercase tracking-widest text-white/40 mb-4">Belanja</h4>
            <ul class="space-y-2.5">
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">Elektronik</a></li>
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">Fashion</a></li>
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">Home & Living</a></li>
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">Kecantikan</a></li>
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">Flash Sale</a></li>
            </ul>
        </div>

        <!-- Links: Bantuan -->
        <div>
            <h4 class="font-display font-600 text-sm uppercase tracking-widest text-white/40 mb-4">Bantuan</h4>
            <ul class="space-y-2.5">
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">Cara Pemesanan</a></li>
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">Pengiriman</a></li>
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">Retur & Refund</a></li>
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">FAQ</a></li>
                <li><a href="#" class="font-body text-sm text-white/70 hover:text-ember transition-colors">Kontak Kami</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h4 class="font-display font-600 text-sm uppercase tracking-widest text-white/40 mb-4">Kontak</h4>
            <ul class="space-y-3">
                <li class="flex items-start gap-2.5">
                    <i data-lucide="map-pin" class="w-4 h-4 text-ember flex-shrink-0 mt-0.5"></i>
                    <span class="font-body text-sm text-white/70">Jl. Sudirman No. 88,<br>Denpasar 10220</span>
                </li>
                <li class="flex items-center gap-2.5">
                    <i data-lucide="phone" class="w-4 h-4 text-ember flex-shrink-0"></i>
                    <a href="tel:+6281234567890" class="font-body text-sm text-white/70 hover:text-ember transition-colors">+62 812-3456-7890</a>
                </li>
                <li class="flex items-center gap-2.5">
                    <i data-lucide="mail" class="w-4 h-4 text-ember flex-shrink-0"></i>
                    <a href="mailto:halo@mini.id" class="font-body text-sm text-white/70 hover:text-ember transition-colors">halo@mini.id</a>
                </li>
            </ul>
        </div>

    </div>

    <!-- Footer Bottom -->
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="font-body text-white/30 text-xs">© {{ date('Y') }} Mini. Dibuat di Indonesia.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="font-body text-white/30 hover:text-white/60 text-xs transition-colors">Syarat & Ketentuan</a>
                <a href="#" class="font-body text-white/30 hover:text-white/60 text-xs transition-colors">Kebijakan Privasi</a>
            </div>
        </div>
    </div>

</footer>


<!-- ============================================================
     JAVASCRIPT
============================================================ -->
<script>
    // Initialize Lucide Icons
    lucide.createIcons();

    // ── Mobile Menu Toggle ──────────────────────────────────────
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen   = document.getElementById('menu-icon-open');
    const iconClose  = document.getElementById('menu-icon-close');

    menuToggle.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.contains('open');
        mobileMenu.classList.toggle('open', !isOpen);
        iconOpen.classList.toggle('hidden', !isOpen);
        iconClose.classList.toggle('hidden', isOpen);
    });

    // ── Scroll Animations ───────────────────────────────────────
    const scrollEls = document.querySelectorAll('.animate-on-scroll');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    scrollEls.forEach(el => observer.observe(el));

    // ── Countdown Timer ─────────────────────────────────────────
    function startCountdown(hours, minutes, seconds) {
        let total = hours * 3600 + minutes * 60 + seconds;

        const elH = document.getElementById('countdown-h');
        const elM = document.getElementById('countdown-m');
        const elS = document.getElementById('countdown-s');

        const tick = () => {
            if (total <= 0) return;
            const h = Math.floor(total / 3600);
            const m = Math.floor((total % 3600) / 60);
            const s = total % 60;
            elH.textContent = String(h).padStart(2, '0');
            elM.textContent = String(m).padStart(2, '0');
            elS.textContent = String(s).padStart(2, '0');
            total--;
        };
        tick();
        setInterval(tick, 1000);
    }

    startCountdown(8, 24, 59);

    // ── Add to Cart Button (toast feedback) ────────────────────
    document.querySelectorAll('.btn-cart').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const original = btn.innerHTML;
            btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Ditambahkan!';
            btn.classList.add('bg-green-600');
            btn.classList.remove('bg-ink', 'hover:bg-ember');
            setTimeout(() => {
                btn.innerHTML = original;
                btn.classList.remove('bg-green-600');
                btn.classList.add('bg-ink', 'hover:bg-ember');
                lucide.createIcons();
            }, 1500);
        });
    });
</script>

</body>
</html>