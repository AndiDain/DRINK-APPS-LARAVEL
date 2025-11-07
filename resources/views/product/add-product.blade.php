<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="nama_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                        <input type="text" name="nama_produk" id="nama_produk" required class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2" value="{{ old('nama_produk') }}">
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <input type="text" name="kategori" id="kategori" required class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2" value="{{ old('kategori') }}">
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                        <input type="number" name="harga" id="harga" required class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2" value="{{ old('harga') }}">
                    </div>

                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Image</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*" class="mt-1 block w-full text-sm text-gray-500">
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('product') }}" class="px-4 py-2 bg-gray-300 rounded">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
