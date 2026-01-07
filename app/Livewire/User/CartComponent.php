<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $cart;
    public $total = 0;

    // Checkout fields
    public $full_name, $phone, $country, $city, $street_address, $postal_code;
    public $checkoutMode = false;

    protected $rules = [
        'full_name' => 'required|string|max:255',
        'phone' => 'required|string|max:50',
        'country' => 'required|string|max:100',
        'city' => 'required|string|max:100',
        'street_address' => 'required|string|max:255',
        'postal_code' => 'required|string|max:50',
    ];

    public function mount()
    {
        $this->loadCart();
    }

    // Load or create cart
    public function loadCart()
    {
        $this->cart = CartModel::firstOrCreate(['user_id' => Auth::id()]);
        $this->cart->load('items.book');
        $this->total = $this->cart->items->sum(fn($item) => $item->book->price * $item->quantity);
    }

    // Add a book to cart directly
    public function addToCart($bookId)
    {
        $cartItem = CartItem::where('cart_id', $this->cart->id)
            ->where('book_id', $bookId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $this->cart->id,
                'book_id' => $bookId,
                'quantity' => 1,
            ]);
        }

        $this->loadCart();
        session()->flash('success', 'Book added to cart');
    }

    public function increment($itemId)
    {
        CartItem::findOrFail($itemId)->increment('quantity');
        $this->loadCart();
    }

    public function decrement($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        if ($item->quantity > 1) {
            $item->decrement('quantity');
        }
        $this->loadCart();
    }

    public function removeItem($itemId)
    {
        CartItem::findOrFail($itemId)->delete();
        $this->loadCart();
    }

    public function placeOrder()
    {
        $this->validate();

        if ($this->cart->items->isEmpty()) {
            session()->flash('error', 'Your cart is empty');
            return;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $this->total,
            'status' => 'pending',
        ]);

        foreach ($this->cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book_id,
                'quantity' => $item->quantity,
                'price' => $item->book->price,
            ]);
        }

        Address::create([
            'order_id' => $order->id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'street_address' => $this->street_address,
            'postal_code' => $this->postal_code,
        ]);

        $this->cart->items()->delete();
        $this->checkoutMode = false;
        $this->loadCart();

        session()->flash('success', 'Order placed successfully!');
    }

    public function render()
    {
        return view('livewire.user.cart-component');
    }
}