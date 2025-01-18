<!-- resources/views/create_product.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subir Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ url('/products') }}">
                    @csrf
                    <div class="p-6">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="description" id="description" class="mt-1 block w-full" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                            <input type="number" name="price" id="price" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                            <select name="category_id" id="category_id" class="mt-1 block w-full" required>
                                <!-- Aquí agregas las opciones de categorías -->
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="mt-4 bg-blue-500 text-black py-2 px-4 rounded">Subir Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
