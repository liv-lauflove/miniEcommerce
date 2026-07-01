@extends('customer.layout')

@section('content')

<div class="max-w-2xl mx-auto px-4 py-16">

    <div class="bg-white rounded-3xl shadow-sm p-10 text-center">

        <div class="text-6xl mb-5">
            ✅
        </div>

        <h1 class="text-3xl font-black text-emerald-700 mb-3">
            Pesanan Berhasil!
        </h1>

        <p class="text-slate-500 mb-8">
            Terima kasih sudah berbelanja.
            Pesanan Anda sedang diproses.
        </p>

        <div class="bg-slate-50 rounded-2xl p-6 text-left space-y-3">

            <div class="flex justify-between">
                <span class="text-slate-500">
                    Order ID
                </span>

                <span class="font-bold">
                    #{{ $order->id }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-slate-500">
                    Total Pembayaran
                </span>

                <span class="font-bold text-emerald-700">
                    Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-slate-500">
                    Metode Pembayaran
                </span>

                <span class="font-bold uppercase">
                    {{ $order->payment_method }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-slate-500">
                    Status
                </span>

                <span class="font-bold text-yellow-600">
                    {{ $order->status }}
                </span>
            </div>

        </div>

        <a
            href="{{ route('home') }}"
            class="inline-block mt-8 rounded-2xl bg-emerald-600 px-6 py-3 font-bold text-white hover:bg-emerald-700 transition"
        >
            Kembali Belanja
        </a>

    </div>

</div>

@endsection