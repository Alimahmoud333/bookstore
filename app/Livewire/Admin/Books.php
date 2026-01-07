<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class Books extends Component
{


    use WithFileUploads;

    public $books;
    public $authors;
    public $categories;

    public $bookId;
    public $title;
    public $description;
    public $price;
    public $stock;
    public $image;
    public $oldImage;
    public $author_id;
    public $category_id;


    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ];

         
    }

   public function mount(){
    $this->authors =Author::all();
    $this->categories= Category::all();
    $this->loadBooks();
   }


   public function loadBooks(){
        $this->books = Book::with('author', 'category')->latest()->get();
   }

    public function store()
    {
        $this->validate();

        $imagePath = $this->image
            ? $this->image->store('books', 'public')
            : null;

        Book::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $imagePath,
            'author_id' => $this->author_id,
            'category_id' => $this->category_id,
        ]);

        $this->resetForm();
        $this->loadBooks();
    }


    public function edit(Book $book){

        $this->bookId = $book->id;
        $this->title = $book->title;
        $this->description = $book->description;
        $this->price = $book->price;
        $this->stock = $book->stock;
        $this->author_id = $book->author_id;
        $this->category_id = $book->category_id;
        $this->oldImage = $book->image;
        
    }


    public function update()
    {
        $this->validate();

        $book = Book::findOrFail($this->bookId);

        if ($this->image) {
            if ($this->oldImage) {
                Storage::disk('public')->delete($this->oldImage);
            }
            $book->image = $this->image->store('books', 'public');
        }

        $book->update([

            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'author_id' => $this->author_id,
            'category_id' => $this->category_id,

        ]);

        
        $this->resetForm();
        $this->loadBooks();
    }


        public function delete($id)
    {
        $book = Book::findOrFail($id);

        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();
        $this->loadBooks();
    }

    public function resetForm()
    {
        $this->reset([
            'bookId',
            'title',
            'description',
            'price',
            'stock',
            'image',
            'author_id',
            'category_id',
            'oldImage',
        ]);
    }
    
    
    public function render()
    {
        return view('livewire.admin.books');
    }
}