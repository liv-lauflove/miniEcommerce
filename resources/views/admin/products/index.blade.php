<x-layouts.admin title="Products">
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-chocolate-600">Produk</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $products->total() }} produk ditemukan</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-primary btn-sm">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Produk
            </span>
        </a>
    </div>

    {{-- Filter Bar --}}
    <div class="flex items-center gap-3 mb-6 flex-wrap">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex items-center gap-2 flex-1 min-w-0">
            <div class="relative flex-1 max-w-sm">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari produk..."
                       class="form-input pl-10 py-2 text-sm">
            </div>
            <select name="category" class="form-select w-44 py-2 text-sm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-secondary btn-sm whitespace-nowrap">Filter</button>
            @if(request()->has('search') || request()->has('category'))
                <a href="{{ route('admin.products.index') }}" class="btn-ghost btn-sm text-red-500">Reset</a>
            @endif
        </form>
    </div>

    {{-- Products Table --}}
    <div class="card overflow-hidden">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            {{-- Product --}}
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 bg-cream-50 rounded-lg overflow-hidden flex-shrink-0 border border-cream-100 flex items-center justify-center">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                 alt="{{ $product->name }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-5 h-5 text-chocolate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-gray-800 truncate max-w-[200px]">{{ $product->name }}</p>
                                        <p class="text-xs muted-text truncate max-w-[200px]">{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Category --}}
                            <td>
                                @if($product->category)
                                    <span class="badge-cream">{{ $product->category->name }}</span>
                                @else
                                    <span class="muted-text">—</span>
                                @endif
                            </td>

                            {{-- Price --}}
                            <td class="font-semibold text-gray-800">{{ $product->formatted_price }}</td>

                            {{-- Stock --}}
                            <td>
                                @if($product->stock <= 0)
                                    <span class="badge-red">Habis</span>
                                @elseif($product->stock < 5)
                                    <span class="badge-yellow"> {{ $product->stock }} unit</span>
                                @else
                                    <span class="badge-green">{{ $product->stock }} unit</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                <span class="badge-{{ $product->is_active ? 'green' : 'gray' }}">
                                    {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="btn-icon text-gray-400 hover:text-chocolate-500" title="Edit produk">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                                          class="inline" onsubmit="return confirm('Hapus produk ini? Tindakan tidak bisa dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon text-gray-400 hover:text-red-600" title="Hapus produk">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="flex flex-col items-center justify-center py-16 text-center">
                                    <div class="w-14 h-14 bg-cream-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-7 h-7 text-chocolate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Tidak ada produk ditemukan</p>
                                    <p class="text-sm text-gray-400 mt-1">
                                        @if(request()->has('search') || request()->has('category'))
                                            Coba ubah filter pencarian
                                        @else
                                            Tambahkan produk pertama Anda
                                        @endif
                                    </p>
                                    @if(!request()->has('search') && !request()->has('category'))
                                        <a href="{{ route('admin.products.create') }}" class="btn-primary btn-sm mt-4">
                                            + Tambah Produk
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif
    </div>
</x-layouts.admin>
