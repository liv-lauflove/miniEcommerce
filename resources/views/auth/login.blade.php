@extends('customer.layout')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl overflow-hidden border-t-8 border-yellow-500">
        <div class="p-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tighter italic">LOGIN USER</h2>
                <p class="text-gray-500 text-sm mt-1 font-semibold tracking-tight">Selamat datang di UD Trisna Putra</p>
            </div>
            
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-black text-gray-800 uppercase tracking-widest mb-2 ml-1 text-left">NOMOR HP</label>
                    <input name="no_hp" type="text" required 
                        class="w-full px-4 py-3 bg-white border-2 border-gray-100 rounded-xl focus:ring-4 focus:ring-yellow-500/20 focus:border-yellow-500 outline-none transition duration-200 text-sm font-bold shadow-sm" 
                        placeholder="08xxxxxxxxxx">
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-800 uppercase tracking-widest mb-2 ml-1 text-left">PASSWORD</label>
                    <input name="password" type="password" required 
                        class="w-full px-4 py-3 bg-white border-2 border-gray-100 rounded-xl focus:ring-4 focus:ring-yellow-500/20 focus:border-yellow-500 outline-none transition duration-200 text-sm font-bold shadow-sm" 
                        placeholder="••••••••">
                </div>

                <button type="submit" 
                    class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-black py-4 rounded-xl shadow-lg shadow-yellow-500/30 transition duration-300 uppercase tracking-widest mt-4 text-sm">
                    MASUK SEKARANG
                </button>
            </form>

            <div class="mt-10 text-center border-t border-gray-100 pt-6">
                <p class="text-sm text-gray-600 font-bold">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-yellow-600 font-black hover:text-yellow-700 transition">Daftar Akun</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
