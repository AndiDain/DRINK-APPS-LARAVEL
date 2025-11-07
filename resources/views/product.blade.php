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
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                    alt="{{ $item->nama_produk }}" class="object-cover w-full h-full">
                            </div>

                            <div class="p-4 flex-1 flex flex-col">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                    {{ $item->nama_produk }}
                                </h3>

                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2 flex-1">
                                    {{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}
                                </p>

                                @if (auth()->user()->role === 'admin')
                                    <div class="mt-4">
                                        <a href="#"
                                            class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-indigo-700">
                                            Edit
                                        </a>
                                    </div>
                                @else
                                    <div class="mt-4">
                                        <a href="#"
                                            class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-indigo-700">
                                            Pesan
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @if (auth()->check() && auth()->user()->role === 'admin')
                    <div class="mt-8 flex">
                        <a href="/product/create"
                           class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add New Product
                        </a>
                    </div> 
                @endif
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
