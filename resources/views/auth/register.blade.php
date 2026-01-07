<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"  style="background: url('{{ asset('storage/bg1.jpg') }}') no-repeat center center fixed; 
             background-size: cover;">

<div class="container p-5">

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow text-light" style="background:linear-gradient(#936b42,#edb260)">
            <div class="card-header text-center">
                <h4>Register</h4>
            </div>
            <div class="card-body">

                <form method="POST" action="/register">
                    @csrf

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button class="btn btn-outline-light w-100">Register</button>
                </form>

                <div class="text-center mt-3">
                    <a href="/login" class="text-light text-decoration-none">Already have account?</a>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
