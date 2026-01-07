<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Category;
use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class HomePage extends Component
{
    public $categories;
    public $books;

    public function mount()
    {
        // Load some categories (e.g., first 6)
        $this->categories = Category::take(6)->get();

        // Load some books (e.g., latest 8)
        $this->books = Book::latest()->take(8)->get();
    }

    /**
     * Add book to cart directly (no emit)
     */
    public function addToCart($bookId)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please login first');
            return;
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('book_id', $bookId)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'book_id' => $bookId,
                'quantity' => 1,
            ]);
        }

        session()->flash('success', 'Book added to cart');
    }

    public function render()
    {
        return view('livewire.user.home-page');
    }
}