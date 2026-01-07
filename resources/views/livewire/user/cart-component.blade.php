<div>
    <h3 class="mb-4 text-center">My Cart</h3>

    {{-- Messages --}}
    @if(session()->has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Cart Items --}}
    @if($cart && $cart->items->count())
    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Book</th>
                <th>Price</th>
                <th width="140">Quantity</th>
                <th>Subtotal</th>
                <th width="100">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($cart->items as $item)
            <tr>
                <td>{{ $item->book->title }}</td>
                <td>${{ $item->book->price }}</td>
                <td>
                    <div class="d-flex justify-content-center align-items-center">
                        <button wire:click="decrement({{ $item->id }})"
                            class="btn btn-sm btn-outline-secondary">−</button>
                        <span class="mx-2">{{ $item->quantity }}</span>
                        <button wire:click="increment({{ $item->id }})"
                            class="btn btn-sm btn-outline-secondary">+</button>
                    </div>
                </td>
                <td>${{ $item->book->price * $item->quantity }}</td>
                <td class="text-center">
                    <button wire:click="removeItem({{ $item->id }})" class="btn btn-danger btn-sm">Remove</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Total --}}
    <div class="d-flex justify-content-between align-items-center">
        <h5>Total: <strong>${{ $total }}</strong></h5>

        @if(!$checkoutMode)
        <button wire:click="$set('checkoutMode', true)" class="btn btn-secondary">
            Proceed to Checkout
        </button>
        @endif
    </div>

    {{-- Checkout Form --}}
    @if($checkoutMode)
    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">Shipping Address</div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" wire:model="full_name" class="form-control" placeholder="Full Name">
                    @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" wire:model="phone" class="form-control" placeholder="Phone">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" wire:model="country" class="form-control" placeholder="Country">
                    @error('country') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" wire:model="city" class="form-control" placeholder="City">
                    @error('city') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" wire:model="street_address" class="form-control" placeholder="Street Address">
                    @error('street_address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" wire:model="postal_code" class="form-control" placeholder="Postal Code">
                    @error('postal_code') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <button wire:click="placeOrder" class="btn btn-secondary">Place Order</button>
            </div>
        </div>
    </div>
    @endif
    @else
    <div class="alert text-center">Your cart is empty</div>
    @endif
</div>