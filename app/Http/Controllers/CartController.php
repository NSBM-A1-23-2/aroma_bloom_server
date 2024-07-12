<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'candle_id' => 'required|exists:candles,id',
            'quantity' => 'required|integer|min:1'
        ]);
    
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();
    
        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }
    
        // Ensure customer_id is correctly set when creating or finding the cart
        $cart = Cart::firstOrCreate(['customer_id' => $customer->id], ['customer_id' => $customer->id]);
    
        // Now, continue with creating/updating the cart item as needed
        $cartItem = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'candle_id' => $request->candle_id],
            ['quantity' => $request->quantity]
        );
    
        // Return the cart item with a 201 status code
        return response()->json($cartItem, 201);
    }
    

    public function edit(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);
        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json($cartItem, 200);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id'
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);
        $cartItem->delete();

        return response()->json(['message' => 'Cart item deleted successfully'], 200);
    }

    public function index()
    {
        $cart = Cart::with('cartItems.candle')->where('customer_id', Auth::id())->first();

        return response()->json($cart, 200);
    }
}
