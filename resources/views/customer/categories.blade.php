@extends('customer.layout')

@section('content')
    <section class="space-y-8">
        <div class="rounded-[2rem] bg-white p-5 shadow-sm ring-1 ring-slate-200/70 sm:p-7 lg:p-8">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-red-600">
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
                        class="inline-flex w-fit items-center rounded-full bg-red-50 px-4 py-2 text-sm font-bold text-red-600 transition hover:bg-red-100"
                    >
                        Hapus pencarian: "{{ request('search') }}"
                    </a>
                @endif
            </div>

            <div class="mt-7 flex gap-3 overflow-x-auto pb-1">
                <a
                    href="{{ route('categories.index', request('search') ? ['search' => request('search')] : []) }}"
                    class="{{ request('category_id') ? 'bg-slate-100 text-slate-600 ring-slate-200' : 'bg-yellow-400 text-slate-950 ring-yellow-300' }} whitespace-nowrap rounded-full px-5 py-2.5 text-sm font-black ring-1 transition hover:bg-yellow-400 hover:text-slate-950"
                >
                    Semua
                </a>

                @foreach ($categories as $category)
                    <a
                        href="{{ route('categories.index', array_filter(['category_id' => $category->id, 'search' => request('search')])) }}"
                        class="{{ (string) request('category_id') === (string) $category->id ? 'bg-yellow-400 text-slate-950 ring-yellow-300' : 'bg-slate-100 text-slate-600 ring-slate-200' }} whitespace-nowrap rounded-full px-5 py-2.5 text-sm font-black ring-1 transition hover:bg-yellow-400 hover:text-slate-950"
                    >
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($products as $product)
                @include('customer.partials.product-card', ['product' => $product])
            @empty
                <div class="col-span-full rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center">
                    <h3 class="text-xl font-black text-slate-950">
                        Produk tidak ditemukan
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Coba pilih kategori lain atau gunakan kata kunci pencarian yang berbeda.
                    </p>

                    <a href="{{ route('categories.index') }}" class="mt-5 inline-flex rounded-full bg-yellow-400 px-5 py-2.5 text-sm font-black text-slate-950 transition hover:bg-yellow-300">
                        Lihat Semua Produk
                    </a>
                </div>
            @endforelse
        </div>

        <div>
            {{ $products->links() }}
        </div>
    </section>
@endsection