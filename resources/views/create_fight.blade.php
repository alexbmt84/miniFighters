<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/main.css">
    <style>
        .navbar {
            border-bottom: 2px solid white;
        }
    </style>
</head>

<body class="bg-dark text-white">

@include('partials.navbar')

<h1 class="text-center mt-5 mb-5">Fight</h1>

<main class="container text-center mx-auto my-0 fight-cont">

    <h2 style="font-style: normal">Créer une arène</h2>

    <form action="{{ route('fight') }}" method="get">

        <button type="submit" class="btn btn-dark mb-5 btn-create-room"><i class='bx bx-dice-6' ></i>Créer</button>

    </form>
    <h2 style="font-style: normal">Rejoindre une arène</h2>
    <form action="{{ route('game.joinWithCode') }}" method="post" class="join-with-code">
        @csrf
        <label>
            <input placeholder="Room code" name="code" type="text" class="input-is" required>
        </label>
        <button type="submit" class="btn btn-dark mt-3 mb-5 btn-create-room"><i class='bx bx-search-alt' ></i>Rejoindre un salon</button>
    </form>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

</main>

</body>

</html>
