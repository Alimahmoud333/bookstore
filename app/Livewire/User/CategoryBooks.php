<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Category;
use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CategoryBooks extends Component
{
    public $category;
    public $books;

    public function mount($category)
    {
        $this->category = Category::findOrFail($category);

        $this->books = Book::where('category_id', $category)
            ->latest()
            ->get();
    }

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
        return view('livewire.user.category-books');
    }
}