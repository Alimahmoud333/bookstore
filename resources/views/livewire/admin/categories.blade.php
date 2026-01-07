<div>
    <h3 class="mb-4">Categories</h3>

    <!-- FORM -->
    <div class="card mb-4">
        <div class="card-body">

            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" wire:model="name" class="form-control">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" wire:model="image" class="form-control">
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button class="btn btn-success">
                    {{ $isEdit ? 'Update' : 'Save' }}
                </button>

                @if($isEdit)
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">
                        Cancel
                    </button>
                @endif
            </form>

        </div>
    </div>

    <!-- TABLE -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th width="150">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}" width="50">
                        @endif
                    </td>
                    <td>
                        <button wire:click="edit({{ $category->id }})"
                                class="btn btn-sm btn-primary">
                            Edit
                        </button>

                        <button wire:click="delete({{ $category->id }})"
                                class="btn btn-sm btn-danger"
                                onclick="confirm('Delete this category?') || event.stopImmediatePropagation()">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
