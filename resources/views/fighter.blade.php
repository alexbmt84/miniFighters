<!DOCTYPE html>

    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>New fighter</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <link rel="stylesheet" href="./css/main.css">
            <link rel="stylesheet" href="../css/card.css">
        </head>

        <body>

            @include('partials.navbar')

            <main class="d-flex flex-column align-items-center">

                <h1 class="mt-5">{{ $name }}</h1>

                <div class="fighterContainer mt-5">

                    <a href="{{ route('fighter', $fighter->id) }}">

                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <p class="title">{{$fighter->name}}</p>
                                    <img class="fighterAvatar" src="{{ $avatar }}" alt="Generated Avatar">
                                    <p class="hp">{{ $fighter->hp }} PV</p>
                                </div>
                                <div class="flip-card-back">
                                    <p class="title-2">{{ $fighter->attack_name_1 }}</p>
                                    <p class="title-2">{{ $fighter->attack_damages_1 }} DG</p>

                                    <p class="title-2">{{ $fighter->attack_name_2 }}</p>
                                    <p class="title-2">{{ $fighter->attack_damages_2 }} DG</p>
                                </div>
                            </div>
                        </div>

                    </a>

                </div>

                <form action="/delete/{{ $fighter->id }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="uppercase mt-5 bg-black text-white font-bold py-2 px-4 rounded" type="submit">Delete</button>
                </form>

            </main>


        </body>

    </html>
