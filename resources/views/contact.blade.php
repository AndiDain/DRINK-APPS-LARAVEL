<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 items-center justify-center">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Hubungi Kami</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <h4 class="text-lg font-semibold text-yellow-600 dark:text-yellow-400">Address</h4>
                            <p class="text-gray-600 dark:text-gray-300">123 Drink Street</p>
                            <p class="text-gray-600 dark:text-gray-300">Jakarta, Indonesia 12345</p>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold text-yellow-600 dark:text-yellow-400">Contact Information</h4>
                            <p class="text-gray-600 dark:text-gray-300">Phone: +62 123 456 789</p>
                            <p class="text-gray-600 dark:text-gray-300">Email: info@MinumanChan.com</p>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold text-yellow-600 dark:text-yellow-400">Business Hours</h4>
                            <p class="text-gray-600 dark:text-gray-300">Monday - Friday: 9:00 AM - 6:00 PM</p>
                            <p class="text-gray-600 dark:text-gray-300">Saturday: 10:00 AM - 4:00 PM</p>
                            <p class="text-gray-600 dark:text-gray-300">Sunday: Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
