<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class Categories extends Component
{

    use WithFileUploads;

    public $name,$image,$category_id;
    public $isEdit =false;

    protected $rules =[
        'name' => 'required|string|max:100',
        'image' => 'nullable|image|max:2048',

    ];


    public function save()
    {
        $this->validate();

        $imagePath = $this->image
            ? $this->image->store('categories', 'public')
            : null;

        Category::create([
            'name' => $this->name,
            'image' => $imagePath,
        ]);

        $this->resetForm();
    }


    public function edit($id){
        $category = Category::findOrFail($id);

        $this->category_id = $id;
        $this->name = $category->name;
        $this->isEdit = true;
        
    }



    public function update()
    {
        $this->validate();

        $category = Category::findOrFail($this->category_id);

        if ($this->image) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->image = $this->image->store('categories', 'public');
        }

        $category->update([
            'name' => $this->name,
            'image' => $category->image,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();
    }

    public function resetForm()
    {
        $this->reset(['name','image','category_id','isEdit']);
    }

    public function render()
    {
        return view('livewire.admin.categories', [
            'categories' => Category::latest()->get()
        ]);
    }


    

}