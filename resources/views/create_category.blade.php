<!-- resources/views/create_category.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <form action="{{ url('/categories') }}" method="POST" class="max-w-lg mx-auto mt-6 bg-white p-6 rounded-lg shadow-lg">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Category Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>

        <div class="mt-6 text-center">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-black rounded-full text-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition duration-300">
                Create Category
            </button>
        </div>
    </form>
</x-app-layout>
