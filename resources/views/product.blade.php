<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
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

                                @guest
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
                                @endguest

                                @auth
                                    @if(auth()->user()->role !== 'admin')
                                        <div class="mt-4">
                                            <a href="/detail/{{ $item->id }}"
                                                class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-700">
                                                View Detail
                                            </a>
                                        </div>
                                    @else
                                        <div class="mt-4">
                                            <button
                                                class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-700 edit-btn"
                                                type="button" data-id="{{ $item->id }}" data-nama="{{ $item->nama_produk }}"
                                                data-kategori="{{ $item->kategori }}" data-deskripsi="{{ $item->deskripsi }}"
                                                data-harga="{{ $item->harga }}" data-gambar="{{ $item->gambar ?? '' }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('produk.destroy', $item->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="mt-8 flex">
                        <a href="{{ route('produk.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Product
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div id="editModal" class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-2xl mx-4 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Edit Product</h3>
                <button type="button" class="modal-close text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
            </div>

            <!-- Normal Laravel Form - No JavaScript intervention -->
            <form action="" method="POST" enctype="multipart/form-data" class="p-6" id="editForm">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label for="edit_nama_produk"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                        <input type="text" id="edit_nama_produk" name="nama_produk"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                            required>
                    </div>

                    <div>
                        <label for="edit_kategori"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <input type="text" id="edit_kategori" name="kategori"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                            required>
                    </div>

                    <div>
                        <label for="edit_deskripsi"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea id="edit_deskripsi" name="deskripsi" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                            required></textarea>
                    </div>

                    <div>
                        <label for="edit_harga"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                        <input type="number" id="edit_harga" name="harga" step="0.01"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current
                            Image</label>
                        <img id="current_image_display" src="" alt="Current Image" class="h-32 rounded border">
                    </div>

                    <div>
                        <label for="edit_gambar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">New
                            Image</label>
                        <input type="file" id="edit_gambar" name="gambar" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-yellow-500 hover:file:bg-gray-200">
                        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">Leave empty to keep current image</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded hover:bg-gray-400 dark:hover:bg-gray-500 modal-close">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript ONLY handles modal display - nothing else!
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-btn');
            const overlay = document.getElementById('modalOverlay');
            const closeButtons = document.querySelectorAll('.modal-close');
            const editForm = document.getElementById('editForm');
            const currentImageDisplay = document.getElementById('current_image_display');
            // ONLY open modal and populate fields
            editButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const productId = this.dataset.id;

                    // Set form action
                    editForm.action = `/produk/${productId}`;

                    // Populate form fields
                    document.getElementById('edit_nama_produk').value = this.dataset.nama || '';
                    document.getElementById('edit_kategori').value = this.dataset.kategori || '';
                    document.getElementById('edit_deskripsi').value = this.dataset.deskripsi || '';
                    document.getElementById('edit_harga').value = this.dataset.harga || '';

                    // Show current image
                    if (this.dataset.gambar) {
                        currentImageDisplay.src = `/storage/${this.dataset.gambar}`;
                        currentImageDisplay.style.display = 'block';
                    } else {
                        currentImageDisplay.style.display = 'none';
                    }

                    // Show modal
                    overlay.classList.remove('hidden');
                    overlay.classList.add('flex');
                });
            });

            // ONLY close modal
            closeButtons.forEach(btn => {
                btn.addEventListener('click', closeModal);
            });

            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) {
                    closeModal();
                }
            });

            function closeModal() {
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
            }

            // That's it! Form submits normally to Laravel
        });
    </script>

</x-app-layout>