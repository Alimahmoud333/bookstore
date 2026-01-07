<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;

class CartController extends Controller
{


    public function index(Request $request)
    {
        return Cart::where('user_id', $request->user()->id)
            ->with('items.book')
            ->first();
    }

    public function add(Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);

        $item = CartItem::firstOrCreate(
            ['cart_id' => $cart->id, 'book_id' => $request->book_id],
            ['quantity' => 0]
        );

        $item->increment('quantity');

        return response()->json(['message' => 'Added to cart']);
    }

    public function remove($id)
    {
        CartItem::findOrFail($id)->delete();
        return response()->json(['message' => 'Removed']);
    }
        
    




    
    
}