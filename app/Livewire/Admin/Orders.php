<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
class Orders extends Component
{

     public $orders;
    public $selectedOrder;

    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orders = Order::with(['user','items.book','address'])
            ->latest()
            ->get();
    }

    public function viewOrder($id)
    {
        $this->selectedOrder = Order::with(['user','items.book','address'])->findOrFail($id);
    }

    public function updateStatus($id, $status)
    {
        Order::findOrFail($id)->update([
            'status' => $status
        ]);

        $this->loadOrders();
    }

    public function remove($id){

        Order::findOrFail($id)->delete();


         $this->loadOrders();

    }

    public function render()
    {
        return view('livewire.admin.orders');
    }
}