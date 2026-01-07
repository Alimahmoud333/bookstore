<div class="row">

    <div class="col-md-4">
        @if($book->image)
            <img src="{{ asset('storage/'.$book->image) }}"
                 class="img-fluid rounded shadow">
        @endif
    </div>

    <div class="col-md-8">
        <h3>{{ $book->title }}</h3>

        <p class="text-muted">
            Author: {{ $book->author->name }} |
            Category: {{ $book->category->name }}
        </p>

        <p class="mt-3">
            {{ $book->description }}
        </p>

        <h4 class="text-success mt-3">${{ $book->price }}</h4>

        <p class="text-muted">
            Stock: {{ $book->stock }}
        </p>
<button wire:click="$dispatch('add-to-cart', { bookId: {{ $book->id }} })"
        class="btn btn-secondary btn-sm">
    Add to Cart
</button>
    </div>

</div>
