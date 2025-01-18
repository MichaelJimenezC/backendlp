<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class CartController extends Controller
{
    public function show()
    {
        // Obtener los datos del carrito desde la base de datos
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as &$item) {
            $product = Product::find($item['id']);
            if ($product) {
                $item['name'] = $product->name;
                $item['price'] = $product->price;
                $item['subtotal'] = $product->price * $item['quantity'];
                $total += $item['subtotal'];
            }
        }

        return response()->json([
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    public function checkout(Request $request)
    {
        // Validar que el carrito no esté vacío
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['error' => 'El carrito está vacío.'], 400);
        }

        // Validar el método de pago
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Crear el pedido en la base de datos
        $order = Order::create([
            'user_id' => auth()->id(), // Suponiendo que tienes autenticación
            'total' => array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart)),
            'payment_method' => $request->input('payment_method'),
        ]);

        // Guardar los detalles del pedido
        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Vaciar el carrito
        session()->forget('cart');

        return response()->json(['success' => 'Compra realizada con éxito.']);
    }

    public function initializeCart()
    {
        // Agregar productos de prueba al carrito
        session()->put('cart', [
            ['id' => 1, 'quantity' => 2],
            ['id' => 2, 'quantity' => 1],
        ]);

        return response()->json(['success' => 'Carrito inicializado con datos de prueba.']);
    }
    public function addToCart(Request $request)
    {
        // Validar los datos
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Obtener el carrito actual de la sesión
        $cart = session()->get('cart', []);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Verificar si el producto ya está en el carrito
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Si no, agregamos el producto al carrito
            $product = Product::find($productId);
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito!');
    }
}

