<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Owner Dashboard' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <div>
                    <a href="{{ route('owner.dashboard') }}" class="text-xl font-bold text-purple-600">
                        Owner Dashboard
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-gray-700 hover:text-purple-600">
                        Pesanan
                    </a>

                    <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-gray-700 hover:text-purple-600">
                        Produk
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-lg bg-purple-600 px-4 py-2 text-sm font-bold text-white hover:bg-purple-700">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-6 py-8">
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">
                    <p class="font-bold">Ada input yang perlu diperbaiki:</p>
                    <ul class="mt-2 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
