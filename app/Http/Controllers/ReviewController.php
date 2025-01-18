<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;

class ReviewController  extends Controller
{
    public function index()
    {
        return response()->json(Review::all());
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



