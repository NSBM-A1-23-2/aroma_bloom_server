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


        $cart = $customer->carts()->firstOrCreate([]);


        $cartItem = new CartItem([
            'candle_id' => $request->input('candle_id'),
            'quantity' => $request->input('quantity'),
        ]);


        $cart->cartItems()->save($cartItem);
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
        $user = Auth::user();


        $customer = Customer::where('user_id', $user->id)->first();

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }


        $cart = Cart::with('cartItems.candle')
                    ->where('customer_id', $customer->id)
                    ->first();

        if (!$cart) {
            return response()->json(['error' => 'Cart not found for this customer.'], 404);
        }

        return response()->json($cart, 200);
    }
}
