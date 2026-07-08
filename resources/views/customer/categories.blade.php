@extends('customer.layout')

@section('content')
    <section class="space-y-8">
        {{-- Page Header Card --}}
        <div class="border-t-4 border-[#006B3F] rounded-[2rem] bg-white p-5 shadow-sm ring-1 ring-[#006B3F]/10 sm:p-7 lg:p-8">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-[#D42027]">
                        Katalog Produk
                    </p>

                    <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
                        {{ $selectedCategory ? $selectedCategory->name : 'Semua Produk' }}
                    </h1>

                    <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500 sm:text-base">
                        Jelajahi produk berdasarkan kategori. Untuk mencari produk tertentu, gunakan kolom pencarian di navbar.
                    </p>
                </div>

                @if (request('search'))
                    <a
                        href="{{ route('categories.index', request('category_id') ? ['category_id' => request('category_id')] : []) }}"
                        class="inline-flex w-fit items-center rounded-full bg-[#D42027]/10 px-4 py-2 text-sm font-bold text-[#D42027] transition hover:bg-[#D42027]/20"
                    >
                        Hapus pencarian: "{{ request('search') }}"
                    </a>
                @endif
            </div>

            {{-- Category Filter Pills --}}
            <div class="mt-7 flex gap-3 overflow-x-auto pb-1 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                <a
                    href="{{ route('categories.index', request('search') ? ['search' => request('search')] : []) }}"
                    class="{{ request('category_id') ? 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-[#006B3F]/10 hover:text-[#006B3F] hover:ring-[#006B3F]/30' : 'bg-[#006B3F] text-white ring-2 ring-[#006B3F]/50' }} whitespace-nowrap rounded-full px-5 py-2.5 text-sm font-black transition-all duration-200"
                >
                    Semua
                </a>

                @foreach ($categories as $category)
                    <a
                        href="{{ route('categories.index', array_filter(['category_id' => $category->id, 'search' => request('search')])) }}"
                        class="{{ (string) request('category_id') === (string) $category->id ? 'bg-[#006B3F] text-white ring-2 ring-[#006B3F]/50' : 'bg-white text-slate-600 ring-1 ring-slate-200 hover:bg-[#006B3F]/10 hover:text-[#006B3F] hover:ring-[#006B3F]/30' }} whitespace-nowrap rounded-full px-5 py-2.5 text-sm font-black transition-all duration-200"
                    >
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Product Grid --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($products as $product)
                @include('customer.partials.product-card', ['product' => $product])
            @empty
                <div class="col-span-full rounded-[2rem] border-2 border-dashed border-[#006B3F]/20 bg-white p-10 text-center">
                    {{-- Empty State Icon --}}
                    <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-[#006B3F]/5">
                        <svg class="h-10 w-10 text-[#006B3F]/40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>

                    <h3 class="text-xl font-black text-slate-950">
                        Produk tidak ditemukan
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Coba pilih kategori lain atau gunakan kata kunci pencarian yang berbeda.
                    </p>

                    <a href="{{ route('categories.index') }}" class="mt-5 inline-flex rounded-full bg-[#006B3F] px-5 py-2.5 text-sm font-black text-white transition hover:bg-[#005432]">
                        Lihat Semua Produk
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $products->links() }}
        </div>
    </section>
@endsection