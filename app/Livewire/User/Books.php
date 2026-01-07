<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Category;
use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class Books extends Component
{

    
    /**
     * ADD BOOK TO CART (DIRECT – NO EMIT)
     */
public function addToCart($bookId)
{
    if (!Auth::check()) {
        session()->flash('error', 'Please login first');
        return;
    }

    // Get or create cart
    $cart = Cart::firstOrCreate(
        ['user_id' => Auth::id()]
    );

    // Get or create cart item
    $item = CartItem::firstOrCreate(
        [
            'cart_id' => $cart->id,
            'book_id' => $bookId,
        ],
        [
            'quantity' => 0,
        ]
    );

    $item->increment('quantity');

    session()->flash('success', 'Book added to cart successfully');
}

    public function render()
    {
            return view('livewire.user.books', [
            'books' => Book::with(['author','category'])
                ->latest()
                ->get()
        ]);
    }
}