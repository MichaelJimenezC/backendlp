<!-- resources/views/cart.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Carrito de Compras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">Productos en tu carrito</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mt-4">
                    @foreach ($cart as $item)
                        <div class="relative bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                            <img class=" h-48 " src="https://placehold.co/600x400" alt="{{ $item['name'] }}">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 truncate">
                                    {{ $item['name'] }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">
                                    ${{ number_format($item['price'], 2) }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">
                                    Cantidad: {{ $item['quantity'] }}
                                </p>
                                <p class="text-blue-500 font-bold mt-3 text-xl">
                                    Subtotal: ${{ number_format($item['subtotal'], 2) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Total: ${{ number_format($total, 2) }}</h3>
                    <a href="{{ url('/checkout') }}" class="mt-4 bg-blue-500 text-white px-6 py-2 rounded-md">
                        Proceder al Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
