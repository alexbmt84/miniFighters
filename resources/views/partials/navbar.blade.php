<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container-fluid">

        <img src="/img/logo.png" width="300" class="logo">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <a href="/home" class="">
                <i class='bx bx-home text-white'></i>
                </a>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link">|</a>
                </li>

                @auth()
                    <a href="/avatars" class="">
                        <i class='bx bx-book-content text-white'></i>
                    </a>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('avatars') }}">Cards</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link">|</a>
                    </li>

                    <a href="/profile" class="">
                    <i class='bx bxs-user text-white'></i>
                    </a>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('profile') }}">Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link">|</a>
                    </li>

                    <a href="/fight" class="">
                        <i class='bx bxs-invader text-white'></i>
                    </a>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('create.fight') }}">Fight</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link">|</a>
                    </li>

                    <a href="{{ route('marketplace') }}" class="">
                        <i class='bx bxs-store text-white'></i>
                    </a>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('marketplace') }}">Marketplace</a>
                    </li>

                @else

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link">|</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                    </li>

                @endauth

                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('fight') }}">Fight</a>
                </li> --}}

            </ul>

            @auth()
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}"><i class='bx bx-wallet text-white'></i> {{ auth()->user()->wallet }} cr</a>
                </li>

                    <li class="nav-item">
                        <a class="nav-link">|</a>
                    </li>

                    <i class='bx bx-power-off text-white'></i>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            @endauth
{{--            <form class="d-flex" role="search">--}}

{{--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <button class="btn btn-outline-light" type="submit">Search</button>--}}

{{--            </form>--}}

        </div>

    </div>

</nav>
