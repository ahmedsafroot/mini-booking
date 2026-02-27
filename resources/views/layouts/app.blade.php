<!DOCTYPE html>
<html>
<head>
    <title>Mini Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('dashboard') }}">
            Mini booking
        </a>

        <div class="ms-auto">

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-light me-2">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">
                    Login
                </a>
            @endguest

        </div>

    </div>
</nav>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>
