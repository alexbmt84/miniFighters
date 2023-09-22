<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('home') }}">AVATARS</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                @auth()
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i class='bx bx-wallet'></i> {{ auth()->user()->wallet }}</a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('avatars') }}">Avatars</a>
                </li>

                @auth()

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>

                @endauth

                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('fight') }}">Fight</a>
                </li> --}}

            </ul>

            <form class="d-flex" role="search">

                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>

            </form>

        </div>

    </div>

</nav>
