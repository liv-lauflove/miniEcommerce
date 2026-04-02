<x-layouts.admin title="Categories">
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-chocolate-600">Kategori</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $categories->total() }} kategori terdaftar</p>
        </div>
        <button onclick="document.getElementById('addCategoryForm').classList.toggle('hidden')"
                class="btn-primary btn-sm">
            <span class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah
            </span>
        </button>
    </div>

    {{-- Add Category Form (collapsible) --}}
    <div id="addCategoryForm" class="hidden mb-6 bg-cream-50 border border-cream-200 rounded-xl p-5">
        <h3 class="text-sm font-semibold text-chocolate-600 mb-4">Tambah Kategori Baru</h3>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-3">
            @csrf
            <div class="flex-1">
                <input type="text" name="name" placeholder="Nama kategori, contoh: Tepung, Mentega, Cokelat..."
                       class="form-input" required autofocus>
            </div>
            <button type="submit" class="btn-primary btn-sm self-start">
                Simpan
            </button>
            <button type="button" onclick="document.getElementById('addCategoryForm').classList.add('hidden')"
                    class="btn-ghost btn-sm self-start">
                Batal
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert-success mb-4 flex items-center gap-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert-error mb-4">{{ session('error') }}</div>
    @endif

    {{-- Categories Table --}}
    <div class="card overflow-hidden">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Slug</th>
                        <th>Jumlah Produk</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <span class="font-semibold text-gray-800">{{ $category->name }}</span>
                            </td>
                            <td>
                                <code class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded">{{ $category->slug }}</code>
                            </td>
                            <td>
                                <span class="badge-{{ $category->products_count > 0 ? 'cream' : 'gray' }}">
                                    {{ $category->products_count }} produk
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="toggleEdit({{ $category->id }}, '{{ $category->name }}')"
                                            class="btn-icon text-gray-400 hover:text-chocolate-500"
                                            title="Edit kategori">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    @if($category->products_count == 0)
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon text-gray-400 hover:text-red-600" title="Hapus kategori">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                {{-- Inline Edit Panel (hidden by default) --}}
                                <div id="edit-panel-{{ $category->id }}" class="hidden mt-3 p-4 bg-cream-50 border border-cream-200 rounded-lg text-left">
                                    <p class="text-xs font-medium text-gray-500 mb-2">Edit: {{ $category->name }}</p>
                                    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" class="flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" value="{{ $category->name }}"
                                               class="form-input flex-1 text-sm py-2" required>
                                        <button type="submit" class="btn-primary btn-sm">Simpan</button>
                                        <button type="button" onclick="toggleEdit({{ $category->id }})"
                                                class="btn-ghost btn-sm">Batal</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="flex flex-col items-center justify-center py-16 text-center">
                                    <div class="w-14 h-14 bg-cream-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-7 h-7 text-chocolate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Belum ada kategori</p>
                                    <p class="text-sm text-gray-400 mt-1">Tambahkan kategori pertama untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleEdit(id) {
            document.querySelectorAll('[id^="edit-panel-"]').forEach(el => {
                if (el.id !== 'edit-panel-' + id) el.classList.add('hidden');
            });
            document.getElementById('edit-panel-' + id).classList.toggle('hidden');
        }
    </script>
    @endpush
</x-layouts.admin>
