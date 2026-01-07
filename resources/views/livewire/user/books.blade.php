<div>
    <h3 class="mb-4 text-center">All Books</h3>

    <div class="row">
        @forelse($books as $book)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">


                    @if($book->image)
                        <img src="{{ asset('storage/'.$book->image) }}"
                             class="card-img-top"
                             style="height:200px;object-fit:cover">
                    @endif

                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $book->title }}</h6>

                        <p class="text-muted small mb-1">
                            {{ $book->author->name }}
                        </p>

                        <span class="badge bg-secondary mb-2">
                            {{ $book->category->name }}
                        </span>

                        <p class="fw-bold mt-2">${{ $book->price }}</p>
                        <button wire:click="addToCart({{ $book->id }})"
                                class="btn btn-primary btn-sm">
                            Add to Cart
                        </button>
                        <a href="{{ route('user.book.details', $book->id) }}"
                             class="btn btn-outline-secondary btn-sm">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No books available.</p>
        @endforelse
    </div>
</div>
