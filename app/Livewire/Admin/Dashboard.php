<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalOrders' => Order::count(),
            'totalUsers' => User::count(),
            'totalBooks' => Book::count(),
            'totalRevenue' => Order::where('status','completed')->sum('total'),
            'pendingOrders' => Order::where('status','pending')->count(),
        ]);
    }
}