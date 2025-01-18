<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json($category, 201);
    }

  

    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5', 
            'comment' => 'nullable|string|max:500', 
        ]);

        // Crear la reseña para el producto
        $review = Review::create([
            'user_id' => auth()->id(), 
            'product_id' => $productId, 
            'rating' => $request->rating, 
            'comment' => $request->comment,
        ]);

        return response()->json(['success' => 'Reseña enviada con éxito.'], 201);
    }

    public function show($productId)
    {
        // Obtener las reseñas para un producto específico
        $product = Product::with('reviews.user')->findOrFail($productId);

        return response()->json($product->reviews);
    }
}



