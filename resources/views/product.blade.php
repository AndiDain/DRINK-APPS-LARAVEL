<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- grid: 3 columns on md+, wraps to next row for additional items -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($produk as $item)
                        <div class="flex flex-col bg-gray-50 dark:bg-gray-900 rounded-lg overflow-hidden shadow">
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}"
                                    class="object-cover w-full h-full">
                            </div>

                            <div class="p-4 flex-1 flex flex-col">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                    {{ $item->nama_produk }}
                                </h3>

                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 flex-1">
                                    {{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}
                                </p>

                                @if (auth()->check() && auth()->user()->role !== 'admin')
                                    <div class="mt-4">
                                        <a href="/login"
                                            class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-700">
                                            Pesan
                                        </a>
                                        <a href="/detail/{{ $item->id }}"
                                            class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-700">
                                            View Detail
                                        </a>
                                    </div>
                                @endif
                                @auth
                                    @if (auth()->check() && auth()->user()->role === 'admin')
                                        <div class="mt-4">
                                            <!-- Edit button opens modal and populates form -->
                                            <button
                                                class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-700 edit-btn"
                                                type="button" data-id="{{ $item->id }}"
                                                data-nama="{{ $item->nama_produk }}" data-kategori="{{ $item->kategori }}"
                                                data-deskripsi="{{ $item->deskripsi }}" data-harga="{{ $item->harga }}"
                                                data-gambar="{{ $item->gambar ?? '' }}">
                                                Edit
                                            </button>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                    @auth
                        @if (auth()->check() && auth()->user()->role === 'admin')
                            <div class="mt-8 flex">
                                <a href="#"
                                    class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add New Product
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div id="editModal" class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-2xl mx-4 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Edit Product</h3>
                <button type="button" class="modal-close text-gray-600 hover:text-gray-900">&times;</button>
            </div>

            <form action="" method="POST" enctype="multipart/form-data" class="p-6" id="editForm">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                        <input type="text" name="nama_produk"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <input type="text" name="kategori"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                        <input type="number" name="harga"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Current Image</label>
                        <img id="currentImage" src="" alt="Current Image" class="mt-2 h-32 object-cover">
                        <input type="hidden" name="current_image" id="current_image">
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">New Image</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 modal-close">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>
    <form id="deleteForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');
            const overlay = document.getElementById('modalOverlay');
            const modal = document.getElementById('editModal');
            const closeButtons = document.querySelectorAll('.modal-close');
            const editForm = document.getElementById('editForm');
            const currentImage = document.getElementById('currentImage');

            editButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Set form action URL
                    editForm.action = `/produk/${btn.dataset.id}`;

                    // Populate form fields
                    editForm.querySelector('[name="nama_produk"]').value = btn.dataset.nama || '';
                    editForm.querySelector('[name="kategori"]').value = btn.dataset.kategori || '';
                    editForm.querySelector('[name="deskripsi"]').value = btn.dataset.deskripsi ||
                        '';
                    editForm.querySelector('[name="harga"]').value = btn.dataset.harga || '';

                    // Update image preview
                    if (btn.dataset.gambar) {
                        currentImage.src = `/storage/${btn.dataset.gambar}`;
                    } else {
                        currentImage.src = '/placeholder.jpg'; // Add a default placeholder image
                    }

                    // Show modal
                    overlay.classList.remove('hidden');
                    overlay.classList.add('flex');
                });
            });

            closeButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    overlay.classList.add('hidden');
                    overlay.classList.remove('flex');
                    editForm.reset();
                });
            });

            // Close on overlay click
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    overlay.classList.add('hidden');
                    overlay.classList.remove('flex');
                    editForm.reset();
                }
            });
        });
    </script>
</x-app-layout>
