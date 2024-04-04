<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark main_navbar py-3">
        <div class="container">
            <a class="navbar-brand text-light" href="{{ route('home') }}">Blog Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-light"></span>
            </button>
            <div class="collapse navbar-collapse text-light" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 content_right text-light">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Categories</a>
                    </li>

                    <li class="nav-item">
                        @if (Route::has('login'))
                            <div class="">
                                @auth
                                    <div class="dropdown">
                                        <a class="nav-link text-light dropdown-toggle" href="" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            My Account
                                        </a>

                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a></li>
                                            <li class="">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf

                                                    <x-dropdown-link :href="route('logout')"
                                                            onclick="event.preventDefault();
                                                                        this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </x-dropdown-link>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- ==========end-navbar==== --}}
    @yield('client_content')
    {{-- ========footer========== --}}
    <footer class="mt-5 pt-5">
        <p class="text-center py-4 bg-dark text-white">© 2024 amrito. All rights reserved.</p>
    </footer>



    {{-- ==========script========= --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
