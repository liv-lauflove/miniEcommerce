<x-layouts.admin title="Add Product">
    <div class="max-w-2xl">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-xl font-bold text-chocolate-600">Add Product</h1>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="card p-6 space-y-4">
                <h2 class="font-semibold text-chocolate-600">Product Information</h2>
                <div>
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
                    @error('name') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Category *</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-textarea">{{ old('description') }}</textarea>
                    @error('description') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="card p-6 space-y-4">
                <h2 class="font-semibold text-chocolate-600">Pricing & Stock</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Price (Rp) *</label>
                        <input type="number" name="price" value="{{ old('price') }}" min="0" step="0.01" class="form-input" required>
                        @error('price') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Stock *</label>
                        <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="form-input" required>
                        @error('stock') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="card p-6 space-y-4">
                <h2 class="font-semibold text-chocolate-600">Image & Status</h2>
                <div>
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" accept="image/*" class="form-input file:border-0 file:bg-cream-50 file:text-cream-700 file:font-medium file:rounded-lg file:px-4 file:py-2 file:mr-3">
                    @error('image') <p class="form-error">{{ $message }}</p> @enderror
                    <p class="text-xs muted-text mt-1">Max 2MB. JPG, PNG, or WebP.</p>
                </div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-chocolate-500 focus:ring-chocolate-500" {{ old('is_active', true) ? 'checked' : '' }}>
                    <span class="text-sm font-medium text-chocolate-600">Active (visible on store)</span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Save Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</x-layouts.admin>
