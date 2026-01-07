<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Author;

class Authors extends Component
{


    public $authors;
    public $authorId;
    public $name;
    public $bio;

    protected $rules = [
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string',
    ];
    

    public function mount()
    {
        $this->loadAuthors();
    }

    public function loadAuthors()
    {
        $this->authors = Author::latest()->get();
    }

    public function store()
    {
        $this->validate();

        Author::create([
            'name' => $this->name,
            'bio'  => $this->bio,
        ]);

        $this->resetForm();
        $this->loadAuthors();
    }



    public function edit(Author $author)
    {
        $this->authorId = $author->id;
        $this->name = $author->name;
        $this->bio = $author->bio;
    }

    public function update()
    {
        $this->validate();

        Author::findOrFail($this->authorId)->update([
            'name' => $this->name,
            'bio'  => $this->bio,
        ]);

        $this->resetForm();
        $this->loadAuthors();
    }

  public function delete($id)
    {
        $author = Author::findOrFail($id);

        if ($author->books()->exists()) {
            session()->flash('error', 'Cannot delete author with books.');
            return;
        }

        $author->delete();
        $this->loadAuthors();
    }

    private function resetForm()
    {
        $this->reset(['authorId', 'name', 'bio']);
    }

    
    public function render()
    {
        return view('livewire.admin.authors');
    }
}