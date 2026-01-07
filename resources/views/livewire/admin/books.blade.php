<div>

    <h3 class="mb-4">Books Management</h3>

    <form wire:submit.prevent="{{ $bookId ? 'update' : 'store' }}"
          enctype="multipart/form-data"
          class="card card-body mb-4">

        <input type="text" wire:model="title" class="form-control mb-2" placeholder="Book title">

        <textarea wire:model="description" class="form-control mb-2" placeholder="Description"></textarea>

        <input type="number" wire:model="price" class="form-control mb-2" placeholder="Price">

        <input type="number" wire:model="stock" class="form-control mb-2" placeholder="Stock">

        <select wire:model="author_id" class="form-control mb-2">
            <option value="">Select Author</option>
            @foreach($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
        </select>



        <select wire:model="category_id" class="form-control mb-2">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <input type="file" wire:model="image" class="form-control mb-2">

        <button class="btn btn-primary">
            {{ $bookId ? 'Update Book' : 'Add Book' }}
        </button>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach($books as $book)
            <tr>
                <td>
                    @if($book->image)
                        <img src="{{ asset('storage/'.$book->image) }}" width="60">
                    @endif
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author->name }}</td>
                <td>{{ $book->category->name }}</td>
                <td>${{ $book->price }}</td>
                <td>{{ $book->stock }}</td>
                <td>
                    <button wire:click="edit({{ $book->id }})" class="btn btn-warning btn-sm">Edit</button>
                    <button wire:click="delete({{ $book->id }})"
                            class="btn btn-danger btn-sm"
                            onclick="confirm('Delete book?') || event.stopImmediatePropagation()">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
