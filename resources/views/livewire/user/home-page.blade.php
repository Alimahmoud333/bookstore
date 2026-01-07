<div>

    {{-- Carousel --}}
    <div id="homeCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow-sm">
            @foreach($categories as $key => $category)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="position-relative">
                        <img src="{{ asset('storage/'.$category->image) }}" class="d-block w-100" style="height: 400px; object-fit: cover;">
                        {{-- Gradient overlay --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100" 
                             style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.6));">
                        </div>
                        <div class="carousel-caption d-none d-md-block text-start text-white">
                            <h2 class="fw-bold">{{ $category->name }}</h2>
                            <p class="lead">Explore amazing books in this category!</p>
                            <a href="{{ route('user.category.books', $category->id) }}" class="btn btn-lg btn-secondary shadow">Browse</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon shadow rounded-circle p-2" style="background-color: rgba(0,0,0,0.5);"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon shadow rounded-circle p-2" style="background-color: rgba(0,0,0,0.5);"></span>
        </button>
    </div>

    {{-- Categories Section --}}
    <h3 class="mb-4 fw-bold">Browse Categories</h3>
    <div class="row mb-5">
        @foreach($categories as $category)
            <div class="col-md-3 mb-4">
                <a href="{{ route('user.category.books', $category->id) }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm border-0 hover-scale rounded-4 overflow-hidden">
                        <img src="{{ asset('storage/'.$category->image) }}" class="card-img-top" style="height:250px; object-fit:cover;">
                        <div class="card-body text-center">
                            <h6 class="card-title fw-bold">{{ $category->name }}</h6>
                            <p class="small text-muted">Discover amazing books here</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Featured Books --}}
    <h3 class="mb-4 fw-bold">Featured Books</h3>
    <div class="row">
        @foreach($books as $book)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm rounded-4 hover-scale">
                    @if($book->image)
                        <img src="{{ asset('storage/'.$book->image) }}" class="card-img-top" style="height:220px; object-fit:cover;">
                    @endif
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold">{{ $book->title }}</h6>
                        <p class="text-muted small">{{ $book->author->name }}</p>
                        <p class="fw-bold text-primary">${{ $book->price }}</p>

                        <button wire:click="addToCart({{ $book->id }})" class="btn btn-sm btn-primary mb-1">Add to Cart</button>
                        <a href="{{ route('user.book.details', $book->id) }}" class="btn btn-outline-secondary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

