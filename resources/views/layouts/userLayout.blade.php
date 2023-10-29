<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css” />

</head>

<style>
    .main{
        height: 100vh;
        justify-content: space-between;
        align-items: center;
    }
    .center-form{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        flex-grow: 1;
    }

    .search-input {
        width: 350px;

    }

    .star-input {
        display: none;
    }

    .star-label {
        font-size: 25px;
        color: #ccc;
        cursor: pointer;
    }

    .star-label::before {
        content: '\2605';
    }

    .star-input:checked + label.star-label,
    .star-input:checked ~ .star-input + label.star-label {
        color: #ffcc00;
    }
</style>


</style>
<body>
    <div class="main">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('images/bukk.png') }}" width="30" height="30" class="d-inline-block align-text-top me-0">
                    Perpustakaan
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                <!-- Periksa apakah pengguna adalah tamu (belum terotentikasi) -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @endguest
                <!-- Jika pengguna sudah terotentikasi -->
                @auth
                <form action="{{ route('riwayat') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link btn">Riwayat</button>
                </form>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nama }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>


                </div>
            </div>
        </nav>
        <div class="body-content">
            <div class="row g-0 h-100">
                <div class="content p-5">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    // JavaScript to check stars before the selected one
    const starInputs = document.querySelectorAll('.star-input');
    starInputs.forEach((input, index) => {
        input.addEventListener('change', () => {
            for (let i = 0; i <= index; i++) {
                starInputs[i].checked = true;
            }
        });
    });

    </script>
</body>


</html>