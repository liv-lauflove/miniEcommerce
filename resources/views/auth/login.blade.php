<x-guest-layout>

    <!-- Page heading -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Masuk ke Akun</h1>
        <p class="mt-1.5 text-sm text-gray-500">Masukkan kredensial Anda untuk mengakses akun</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="mt-1.5" type="email" name="email"
                          :value="old('email')" required autofocus autocomplete="username"
                          placeholder="nama@email.com" />
            <x-input-error class="mt-1.5" :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="mt-1.5" type="password"
                          name="password" required autocomplete="current-password"
                          placeholder="Masukkan kata sandi" />
            <x-input-error class="mt-1.5" :messages="$errors->get('password')" />
        </div>

        <!-- Submit -->
        <x-primary-button class="w-full mt-2">
            Masuk
        </x-primary-button>
    </form>

    <!-- Divider -->
    <div class="flex items-center gap-3 my-7">
        <div class="flex-1 h-px bg-gray-200"></div>
        <span class="text-xs text-gray-400 font-medium">BARU DI UD TRISNA PUTRA?</span>
        <div class="flex-1 h-px bg-gray-200"></div>
    </div>

    <!-- Register CTA -->
    <p class="text-center text-sm text-gray-500">
        Belum punya akun?
        <a class="font-semibold text-chocolate-600 hover:text-chocolate-700 transition-colors"
           href="{{ route('register') }}">
            Daftar sekarang
        </a>
    </p>

</x-guest-layout>
