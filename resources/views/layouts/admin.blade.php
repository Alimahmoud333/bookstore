<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @livewireStyles
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 py-3">
    <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/admin/dashboard">
            <img src="{{ asset('storage/logo2.jpg') }}" height="40" class="me-2">
            <strong>Admin Panel</strong>
        </a>

        <!-- Toggle (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                       href="/admin/dashboard">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/categories') ? 'active' : '' }}"
                       href="/admin/categories">Categories</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/authors') ? 'active' : '' }}"
                       href="/admin/authors">Authors</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/books') ? 'active' : '' }}"
                       href="/admin/books">Books</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}"
                       href="/admin/orders">Orders</a>
                </li>

            </ul>

            <!-- Logout -->
            <form method="POST" action="/logout" class="d-flex">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@livewireScripts
</body>
</html>
