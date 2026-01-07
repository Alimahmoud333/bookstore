<div>
    <h3 class="mb-4 text-center">My Orders</h3>

    @if($orders->count())
        @foreach($orders as $order)
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Order {{ $order->id }}</span>
                    <span class="badge 
                        @if($order->status=='pending') bg-warning
                        @elseif($order->status=='completed') bg-success
                        @elseif($order->status=='processing') bg-warning
                        @elseif($order->status=='cancelled') bg-danger
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                 
                    
                </div>

                <div class="card-body">
                    <h6>Shipping Address:</h6>
<p class="mb-2">
    {{ optional($order->address)->full_name }}, 
    {{ optional($order->address)->street_address }}, 
    {{ optional($order->address)->city }}, 
    {{ optional($order->address)->country }} - 
    {{ optional($order->address)->postal_code }}<br>
    Phone: {{ optional($order->address)->phone }}
</p>


                    <h6>Items:</h6>
                    <ul class="list-group mb-2">
                        @foreach($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->book->title }} (x{{ $item->quantity }})
                                <span>${{ $item->price * $item->quantity }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-outline-danger" wire:click="remove({{ $order->id }})" onclick="return confirm('are you sure you want to delete this order?')">cancel order</button>
                        <h6 class="text-end">Total: ${{ $order->total }}</h6>

                    </div>

                    
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-muted">You have no orders yet.</p>
        
    @endif
</div>
