<!DOCTYPE html>

    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <link rel="stylesheet" href="/css/main.css">
            <title>Profile</title>
        </head>

        <body style="height: 100vh">

            @include("partials.navbar")

            <h1 class="text-center text-white mt-5">{{ auth()->user()->name }}</h1>
            <h4 class="text-center text-white mt-3">Level {{ auth()->user()->level }}</h4>

            <div class="profile-pic">

                <label for="file" class="-label">
                    <span class="glyphicon glyphicon-camera"></span>
                    <span>Change Image</span>
                </label>

                <input id="file" type="file" name="avatar" onchange="loadFile(event);"/>

                <img src="{{asset(auth()->user()->avatar)}}" alt="My Test Image" id="output" width="150px" />

            </div>

            <p class="text-center text-white mt-3"><i class='bx bx-wallet text-white'></i> {{ auth()->user()->wallet }} CR</p>

            @foreach(auth()->user()->friendRequestsPending as $requester)
                <div class="text-center mb-3 text-white">
                    {{ $requester->name }} veut être votre ami.
                    <form action="{{ route('friend.accept', $requester->id) }}" method="POST" class="mt-3 mb-3">
                        @csrf
                        <button class="btn btn-success col-1">Accepter</button>
                    </form>
                    <form action="{{ route('friend.decline', $requester->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger col-1">Refuser</button>
                    </form>
                </div>
            @endforeach

            <h2 class="mx-auto text-center text-white">Amis : </h2>

            @foreach(auth()->user()->getFriendsListAttribute() as $friend)
                <div class="text-center mb-3 text-white">
                    <a href="{{ route('find.profile', $friend->name) }}" class="nav-link">
                        {{ $friend->name }}
                    </a>
                </div>
            @endforeach

            <script src="/js/photo.js" defer></script>

        </body>

    </html>
