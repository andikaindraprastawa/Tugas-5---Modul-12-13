<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container pt-5">
    
    @auth
    <div class="row justify-content-end mb-4">
        <div class="col-auto">
            Halo, <strong>{{ Auth::user()->name }}</strong>! 
            <a href="/logout" class="btn btn-sm btn-danger ms-2">Logout</a>
        </div>
    </div>
    @endauth

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>