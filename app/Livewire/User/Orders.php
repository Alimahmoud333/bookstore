<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class Orders extends Component
{

    public $orders;

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orders = Order::with(['items.book', 'address'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }

public function remove($id)
{
    Order::where('id', $id)
         ->where('user_id', Auth::id())
         ->delete();

    $this->loadOrders();
}



    
    public function render()
    {
        return view('livewire.user.orders');
    }
}