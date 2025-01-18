<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar todos los productos con su categoría asociada
    public function index()
{
    $products = Product::with('category')->get(); // Obtener todos los productos con sus categorías
    return view('products', compact('products')); // Pasar datos a la vista
}


    // Crear un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // Validar que la categoría exista
        ]);

        // Crear producto asociado al usuario autenticado
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id, // Asignar el usuario autenticado
        ]);

        return response()->json($product, 201); // Retornar el producto creado con el código de estado 201
    }

    // Mostrar un solo producto con su categoría y reseñas asociadas
    public function show($id)
    {
        $product = Product::with(['category', 'reviews.user', 'user:id,name'])
            ->findOrFail($id);
    
        return response()->json($product);
    }
    
    public function create()
    {
        // Obtener todas las categorías para mostrar en el formulario
        $categories = Category::all();

        return view('create_product', compact('categories'));
    }
}
