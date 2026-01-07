<div>
    <h3 class="mb-4">Authors</h3>

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="{{ $authorId ? 'update' : 'store' }}"
          class="card card-body mb-4">

        <input type="text"
               wire:model="name"
               class="form-control mb-2"
               placeholder="Author name">

        <textarea wire:model="bio"
                  class="form-control mb-2"
                  placeholder="Author bio"></textarea>

        <button class="btn btn-primary">
            {{ $authorId ? 'Update Author' : 'Add Author' }}
        </button>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Bio</th>
            <th>Books</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach($authors as $author)
            <tr>
                <td>{{ $author->id }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ Str::limit($author->bio, 50) }}</td>
                <td>{{ $author->books()->count() }}</td>
                <td>
                    <button wire:click="edit({{ $author->id }})"
                            class="btn btn-warning btn-sm">Edit</button>

                    <button wire:click="delete({{ $author->id }})"
                            class="btn btn-danger btn-sm"
                            onclick="confirm('Delete author?') || event.stopImmediatePropagation()">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
