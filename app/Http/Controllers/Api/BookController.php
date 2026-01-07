<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

    public function index(){
        return Book::with('author', 'category')->get(); 
    }

    public function byCategory($id){
        return Book::where('category_id', $id)->with('author')->get();
    }

    public function show($id){
         return Book::with('author','category')->findOrFail($id);
    }
    
}