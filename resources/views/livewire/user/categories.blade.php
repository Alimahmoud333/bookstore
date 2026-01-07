<div>
    <h3 class="mb-4 text-center">Book Categories</h3>

    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">

                    @if($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}"
                             class="card-img-top"
                             style="height:200px;object-fit:cover">
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $category->name }}</h5>

                        <a href="{{ route('user.category.books', $category->id) }}"
                           class="btn btn-outline-secondary btn-sm mt-2">
                            View Books
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
