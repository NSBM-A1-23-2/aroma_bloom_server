<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);


        $cart = Cart::with('cartItems')->findOrFail($request->cart_id);


        $order = new Order([
            'customer_id' => $cart->customer_id,
        ]);
        $order->save();


        foreach ($cart->cartItems as $cartItem) {
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'candle_id' => $cartItem->candle_id,
                'quantity' => $cartItem->quantity,
            ]);
            $orderItem->save();
        }

        $order->save();


        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
}
