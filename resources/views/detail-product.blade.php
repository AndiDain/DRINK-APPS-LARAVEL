<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div class="bg-gray-100 dark:bg-gray-900 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                 alt="{{ $produk->nama_produk }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <!-- Product Information -->
                        <div class="space-y-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $produk->nama_produk }}
                                </h1>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Category: {{ $produk->kategori }}
                                </p>
                            </div>

                            <div class="border-t border-b border-gray-200 dark:border-gray-700 py-4">
                                <p class="text-2xl font-semibold text-yellow-600 dark:text-yellow-400">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </p>
                            </div>

                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                    Description
                                </h2>
                                <p class="text-gray-600 dark:text-gray-300 whitespace-pre-line">
                                    {{ $produk->deskripsi }}
                                </p>
                            </div>

                            @guest
                                <div class="mt-8">
                                    <a href="{{ route('login') }}" 
                                       class="inline-block px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                                        Login to Order
                                    </a>
                                </div>
                            @endguest

                            @auth
                                @if(auth()->user()->role !== 'admin')
                                
                                @endif
                            @endauth

                            <div class="mt-4">
                                <a href="{{ route('product') }}" 
                                   class="text-yellow-600 dark:text-yellow-400 hover:underline">
                                    &larr; Back to Products
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>