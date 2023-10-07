<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fighters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/card.css">
</head>

<body class="" style="background: rgb(33,33,33);
background: linear-gradient(180deg, rgba(33,33,33,1) 0%, rgba(0,0,0,1) 57%, rgba(51,41,60,1) 100%);">

@include('partials.navbar')

<h1 class="text-white text-center mt-5 mb-3">MARKETPLACE</h1>

<main>

    @foreach ($fighters as $fighter)

        <div class="fighterContainer">

            <a href="{{ route('fighter', $fighter->id) }}">

                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <div class="fighter-name">
                                <p class="title">{{$fighter->name}}</p>
                            </div>
                            <img class="fighterAvatar" src="storage/{{ $fighter->avatar_path }}" alt="Generated Avatar">
                            <p class="hp">{{ $fighter->hp }} PV</p>
                        </div>

                        <div class="flip-card-back">
                            <div class="atk-cont">

                                <div class="card-back-header">
                                    <div class="avatar-circle">
                                        <img class="fighterAvatar2" src="storage/{{ $fighter->avatar_path }}" alt="Generated Avatar">
                                    </div>

                                    <div class="stars">
                                        @if($fighter->hp <= 25)
                                            <i class='bx bxs-star' ></i>
                                        @elseif($fighter->hp <= 40)
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                        @elseif($fighter->hp <= 60)
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                        @elseif($fighter->hp <= 80)
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                        @elseif($fighter->hp > 80)
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                            <i class='bx bxs-star' ></i>
                                        @endif
                                    </div>
                                    <p class="title-back">{{$fighter->name}} <span class="title-back">- {{ $fighter->hp }} PV</span></p>
                                </div>

                                <p class="title-2">{{ $fighter->attack_name_1 }}</p>
                                <p class="atk-dg">| {{ $fighter->attack_damages_1 }} DG |</p>

                                <p class="title-2">{{ $fighter->attack_name_2 }}</p>
                                <p class="atk-dg">| {{ $fighter->attack_damages_2 }} DG |</p>

                            </div>
                        </div>

                    </div>
                </div>

            </a>
            <a href="/profile/{{ $user->name }}" class="nav-link">
                <p class="mt-3 text-white" id="owner"><i class='bx bxs-user' ></i> {{ $user->name }}</p>
            </a>

        </div>

    @endforeach

</main>

</body>
</html>
