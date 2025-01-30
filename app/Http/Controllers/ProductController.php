<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar todos los productos con su categoría asociada
    // app/Http/Controllers/ProductController.php

    public function index()
    {
        // Obtener todos los productos con sus categorías y el usuario asociado
        $products = Product::with(['category', 'user'])->get();
        
        // Devolver la respuesta con los productos, categorías y usuarios
        return response()->json($products);
    }
    



    // Crear un nuevo producto
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Crear producto
    $product = Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'user_id' => auth()->user()->id,
    ]);

    return response()->json($product, 201); // Retornar el producto creado
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
