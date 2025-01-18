<!-- resources/views/products.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <div class="relative bg-gray-50 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:scale-105 transform transition-all duration-300">
                            <img 
                                class=" h-48 " 
                                src="https://placehold.co/600x400" 
                                alt="{{ $product->name }}">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 truncate">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">
                                    {{ Str::limit($product->description, 60) }}
                                </p>
                                <p class="text-blue-500 font-bold mt-3 text-xl">
                                    ${{ number_format($product->price, 2) }}
                                </p>
                                <a href="{{ url('/products/' . $product->id) }}" 
                                   class="block mt-4 text-center bg-blue-500 text-black hover:bg-blue-600 py-2 rounded-md">
                                    Ver más
                                </a>
                                  <!-- Botones de Ver Reseñas y Escribir Reseña -->
                                  <div class="mt-4">
                                    <a href="{{ url('/products/' . $product->id . '/reviews') }}" 
                                       class="block mt-4 text-center bg-green-500 text-black hover:bg-green-600 py-2 rounded-md">
                                        Ver Reseñas
                                    </a>
                                    @auth
                                        <form action="{{ url('/products/' . $product->id . '/reviews') }}" method="POST" class="mt-4">
                                            @csrf
                                            <label for="rating" class="block text-gray-700">Calificación:</label>
                                            <select name="rating" id="rating" required class="block w-full mt-2 mb-4 rounded-md border-gray-300">
                                                <option value="1">1 Estrella</option>
                                                <option value="2">2 Estrellas</option>
                                                <option value="3">3 Estrellas</option>
                                                <option value="4">4 Estrellas</option>
                                                <option value="5">5 Estrellas</option>
                                            </select>

                                            <label for="comment" class="block text-gray-700">Comentario:</label>
                                            <textarea name="comment" id="comment" rows="3" class="block w-full mt-2 mb-4 rounded-md border-gray-300" placeholder="Deja tu comentario"></textarea>

                                            <button type="submit" class="block mt-4 text-center bg-yellow-500 text-black hover:bg-yellow-600 py-2 rounded-md">
                                                Enviar Reseña
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="number" name="quantity" value="1" min="1" class="w-16 border rounded-md p-2" required>
                                    <button type="submit" class="block mt-4 text-center bg-blue-500 text-black hover:bg-blue-600 py-2 rounded-md">
                                        Agregar al carrito
                                    </button>
                                </form>
                            </div>
                            <span class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">
                                Nuevo
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
