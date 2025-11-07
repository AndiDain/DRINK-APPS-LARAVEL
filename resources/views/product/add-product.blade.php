<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="nama_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                        <input type="text" name="nama_produk" id="nama_produk" required 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500" 
                            value="{{ old('nama_produk') }}">
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <input type="text" name="kategori" id="kategori" required 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500" 
                            value="{{ old('kategori') }}">
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" required 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                        <input type="number" name="harga" id="harga" required 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500" 
                            value="{{ old('harga') }}">
                    </div>

                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Image</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*" 
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Upload a product image (max 2MB)</p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('product') }}" 
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded hover:bg-gray-400 dark:hover:bg-gray-500">
                            Cancel
                        </a>
                        <button type="submit" 
                            class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>