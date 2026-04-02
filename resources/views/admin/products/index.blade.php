<x-layouts.admin title="Products">
    <div class="flex items-center justify-between mb-6">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex gap-3 flex-1 max-w-lg">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="form-input flex-1">
            <select name="category" class="form-select w-40">
                <option value="">All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-secondary btn-sm">Filter</button>
        </form>
        <a href="{{ route('admin.products.create') }}" class="btn-primary btn-sm ml-4">
            + Add Product
        </a>
    </div>

    <div class="card overflow-hidden">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-medium text-chocolate-600">{{ $product->name }}</p>
                                        <p class="text-xs muted-text">{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->category?->name ?? '—' }}</td>
                            <td class="font-medium">{{ $product->formatted_price }}</td>
                            <td>
                                @if($product->stock <= 0)
                                    <span class="badge-red">Out</span>
                                @elseif($product->stock < 5)
                                    <span class="badge-yellow">{{ $product->stock }}</span>
                                @else
                                    <span class="badge-green">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge-{{ $product->is_active ? 'green' : 'gray' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-icon text-gray-400 hover:text-chocolate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" class="inline" onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon text-gray-400 hover:text-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 body-text">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</x-layouts.admin>
