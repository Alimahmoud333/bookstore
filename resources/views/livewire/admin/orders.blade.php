<div>
    <h3 class="mb-4">Orders Management</h3>

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>${{ $order->total }}</td>
                <td>
                    <select wire:change="updateStatus({{ $order->id }}, $event.target.value)"
                            class="form-select form-select-sm">
                        <option {{ $order->status=='pending'?'selected':'' }}>pending</option>
                        <option {{ $order->status=='processing'?'selected':'' }}>processing</option>
                        <option {{ $order->status=='completed'?'selected':'' }}>completed</option>
                        <option {{ $order->status=='cancelled'?'selected':'' }}>cancelled</option>
                    </select>





                </td>
                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                <td>

                    <button wire:click="viewOrder({{ $order->id }})"
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#orderModal">
                        View
                    </button>
                    <button class="btn btn-outline-danger" wire:click="remove({{ $order->id }})">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Order Details Modal -->
    <div wire:ignore.self class="modal fade" id="orderModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                @if($selectedOrder)
                <div class="modal-header">
                    <h5>Order #{{ $selectedOrder->id }}</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p><strong>User:</strong> {{ $selectedOrder->user->name }}</p>
                    <p><strong>Address:</strong>
                        {{ $selectedOrder->address->street_address }},
                        {{ $selectedOrder->address->city }},
                        {{ $selectedOrder->address->country }}
                    </p>

                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Book</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($selectedOrder->items as $item)
                            <tr>
                                <td>{{ $item->book->title }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ $item->price }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <h5 class="text-end">Total: ${{ $selectedOrder->total }}</h5>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
