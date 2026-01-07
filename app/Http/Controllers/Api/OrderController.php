<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;


class OrderController extends Controller
{



public function store(Request $request)
{
    $request->validate([
        'full_name'       => 'required',
        'phone'           => 'required',
        'country'         => 'required',
        'city'            => 'required',
        'street_address'  => 'required',
        'postal_code'     => 'nullable',
    ]);

    $cart = Cart::where('user_id', $request->user()->id)
        ->with('items.book')
        ->first();

    if (!$cart || $cart->items->isEmpty()) {
        return response()->json(['message' => 'Cart empty'], 400);
    }

    $total = $cart->items->sum(
        fn ($i) => $i->book->price * $i->quantity
    );

    $order = Order::create([
        'user_id' => $request->user()->id,
        'total'   => $total,
        'status'  => 'pending'
    ]);

    foreach ($cart->items as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'book_id'  => $item->book_id,
            'quantity' => $item->quantity,
            'price'    => $item->book->price
        ]);
    }


    Address::create([
        'order_id'        => $order->id,
        'full_name'       => $request->full_name,
        'phone'           => $request->phone,
        'country'         => $request->country,
        'city'            => $request->city,
        'street_address'  => $request->street_address,
        'postal_code'     => $request->postal_code,
    ]);

    $cart->items()->delete();

    return response()->json([
        'message' => 'Order placed successfully',
        'order_id' => $order->id
    ]);
}

public function index(Request $request)
{
    return Order::where('user_id', $request->user()->id)
        ->with(['items.book', 'address'])
        ->get();
}    

} 