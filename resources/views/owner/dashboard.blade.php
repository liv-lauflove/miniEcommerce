@extends('customer.layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-black text-emerald-800 mb-6">Dashboard Owner</h1>

    <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
        <p class="text-gray-600">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>

        <div class="mt-6 flex gap-4 justify-center flex-wrap">
            <a href="{{ route('home') }}"
               class="inline-flex rounded-xl bg-emerald-600 px-5 py-3 font-bold text-white hover:bg-emerald-700">
                Lanjut Belanja
            </a>
            <a href="{{ route('dashboard') }}"
               class="inline-flex rounded-xl bg-yellow-400 px-5 py-3 font-bold text-gray-900 hover:bg-yellow-300">
                Dashboard Admin
            </a>
        </div>
    </div>
</div>
@endsection
