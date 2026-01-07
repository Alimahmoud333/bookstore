<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Book Store')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     @livewireStyles

     <style>
        
    body.bg-cover {
    background: 
        linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)),
        url("{{ asset('storage/bg1.jpg') }}");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

@media (max-width: 768px) {
    body.bg-cover {
        background-attachment: scroll;
    }
}
</style>
        
   
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container">
        <!-- LOGO -->
        <a class="navbar-brand" href="#">
            <img src="{{ asset('storage/logo2.jpg') }}" alt="Logo" height="60" class="me-2 rounded-circle">
            Book Store
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="{{ route('user.home')}}">Home</a></li>
                <li class="nav-item"><a href="/user/categories" class="nav-link">Categories</a></li>
                <li class="nav-item"><a href="{{ route('user.books') }}" class="nav-link">Books</a></li>
                <li class="nav-item"><a href="/user/cart" class="nav-link">Cart</a></li>
                <li class="nav-item"><a href="/user/orders" class="nav-link">Orders</a></li>
            </ul>

            <!-- Logout button aligned right -->
            @auth
            <form method="POST" action="/logout" class="ms-lg-auto">
                @csrf
                <button class="btn btn-outline-dark btn-sm">Logout</button>
            </form>
            @endauth
        </div>
    </div>
</nav>
<div class="container mt-5">  
     
    @yield('content')
 
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@livewireScripts
</body>

</html>
