<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Category;

class Categories extends Component
{
    public function render()
    {
        return view('livewire.user.categories', [
            'categories' => Category::latest()->get()
        ]);
    }
}