<!DOCTYPE html>

    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <link rel="stylesheet" href="/css/main.css">
            <title>Welcome</title>
        </head>

        <body class="bg-dark">

            @include("partials.navbar")

            <div class="d-flex flex-column align-items-center mt-5 vh-100">

                <h1 class="text-center text-white mb-5">Welcome</h1>
                <h2 class="text-center text-white"> Let's create a new card !</h2>

{{--                <img src="/storage/fighters/Dimitri.png" alt="" srcset="" width="400px">--}}

                <form class="container" action="{{ route('generate') }}" method="POST">

                    @csrf

                    <div class="input-container">
                        <div class="input-content">
                            <div class="input-dist">
                                <div class="input-type">
                                    <input placeholder="Enter name" name="name" type="text" class="input-is" required>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-dark mt-5 col-12" type="submit">Generate a card !</button>
                    </div>

                </form>

                @if (isset($avatar))

                    <img src="{{ $avatar }}" alt="Generated Avatar">

                @endif

            </div>

        </body>

    </html>
