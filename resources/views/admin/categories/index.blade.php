<x-layouts.admin title="Categories">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-oxford-900">Categories</h1>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-2">
            @csrf
            <input type="text" name="name" placeholder="Category name" class="form-input w-64" required>
            <button type="submit" class="btn-primary btn-sm">Add</button>
        </form>
    </div>

    @if(session('success')) <div class="alert-success mb-4">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert-error mb-4">{{ session('error') }}</div> @endif

    <div class="card overflow-hidden">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Products</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="font-medium text-oxford-900">{{ $category->name }}</td>
                            <td class="muted-text text-sm">{{ $category->slug }}</td>
                            <td><span class="badge-gray">{{ $category->products_count }}</span></td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" class="flex gap-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $category->name }}" class="form-input w-32 text-sm py-1">
                                        <button type="submit" class="btn-icon text-gray-400 hover:text-oxford-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                    </form>
                                    @if($category->products_count == 0)
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon text-gray-400 hover:text-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-12 body-text">No categories yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
