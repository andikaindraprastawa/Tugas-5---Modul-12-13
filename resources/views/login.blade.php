<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Aplikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h3 class="text-center mb-4">Silakan Login</h3>

            @if(session('msg'))
                <div class="alert alert-danger">{{ session('msg') }}</div>
            @endif

            <form class="border p-4 shadow-sm" method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="em" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="pwd" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Masuk</button>

                <div class="text-center mt-3">
                    <span class="text-muted small">Belum punya akun? </span>
                    <a href="{{ route('register') }}" class="text-decoration-none small">Register di sini</a>
                </div>
                </form>
        </div>
    </div>
</body>
</html>