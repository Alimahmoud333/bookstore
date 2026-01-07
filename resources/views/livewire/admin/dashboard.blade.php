<div>
    <h3 class="mb-4">Admin Dashboard</h3>

    <div class="row">

        <div class="col-md-3">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5>Total Orders</h5>
                    <h2>{{ $totalOrders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5>Total Revenue</h5>
                    <h2>${{ $totalRevenue }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5>Pending Orders</h5>
                    <h2>{{ $pendingOrders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-dark mb-3">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h2>{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>

    </div>
</div>
