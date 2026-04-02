<x-guest-layout>

    <!-- Page heading -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Buat Akun Baru</h1>
        <p class="mt-1.5 text-sm text-gray-500">Daftar untuk mulai berbelanja di UD Trisna Putra</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="mt-1.5" type="text" name="name"
                          :value="old('name')" required autofocus autocomplete="name"
                          placeholder="Masukkan nama lengkap" />
            <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="mt-1.5" type="email" name="email"
                          :value="old('email')" required autocomplete="username"
                          placeholder="nama@email.com" />
            <x-input-error class="mt-1.5" :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="mt-1.5" type="password"
                          name="password" required autocomplete="new-password"
                          placeholder="Minimal 8 karakter" />
            <x-input-error class="mt-1.5" :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
            <x-text-input id="password_confirmation" class="mt-1.5" type="password"
                          name="password_confirmation" required autocomplete="new-password"
                          placeholder="Ulangi kata sandi" />
            <x-input-error class="mt-1.5" :messages="$errors->get('password_confirmation')" />
        </div>

        <!-- Terms notice -->
        <p class="text-xs text-gray-400 leading-relaxed">
            Dengan mendaftar, Anda menyetujui
            <a href="#" class="text-chocolate-600 hover:underline">Syarat & Ketentuan</a> serta
            <a href="#" class="text-chocolate-600 hover:underline">Kebijakan Privasi</a> kami.
        </p>

        <!-- Submit -->
        <x-primary-button class="w-full mt-1">
            Daftar Akun
        </x-primary-button>
    </form>

    <!-- Divider -->
    <div class="flex items-center gap-3 my-7">
        <div class="flex-1 h-px bg-gray-200"></div>
        <span class="text-xs text-gray-400 font-medium">SUDAH PUNYA AKUN?</span>
        <div class="flex-1 h-px bg-gray-200"></div>
    </div>

    <!-- Login link -->
    <p class="text-center text-sm text-gray-500">
        Sudah terdaftar?
        <a class="font-semibold text-chocolate-600 hover:text-chocolate-700 transition-colors"
           href="{{ route('login') }}">
            Masuk di sini
        </a>
    </p>

</x-guest-layout>
