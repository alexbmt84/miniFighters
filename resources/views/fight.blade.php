<!DOCTYPE html>

    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>Fight</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <link rel="stylesheet" href="../css/main.css">
            <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
            <style>
                .navbar {
                    border-bottom: 2px solid white;
                }
            </style>
            <script>

                document.addEventListener("DOMContentLoaded", function(event) {

                    // Pusher setup
                    Pusher.logToConsole = true;
                    var gameCode = '{{ $game->code }}';

                    var pusher = new Pusher('ec80d36be857ebfe0e5a', {
                        cluster: 'eu',
                        authEndpoint: '/broadcasting/auth',
                        auth: {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        }
                    });

                    var channel = pusher.subscribe('private-miniFighters.' + gameCode);

                    // Binding for Fight event
                    channel.bind('Fight', function(data) {
                        console.log(data.message);
                        var playerName = data.message.newPlayerName;
                        var li = document.createElement('li');
                        li.textContent = playerName;
                        var level = data.message.level;
                        var li2 = document.createElement('li');
                        li2.textContent = "Level " + level;
                        document.getElementById('playerList').appendChild(li);
                        document.getElementById('playerList').appendChild(li2);
                        alert(JSON.stringify(data.message));
                    });

                    // Global event for logging (if necessary)
                    channel.bind_global(function(event, data) {
                        console.log("Event received: ", event, data);
                    });

                });


            </script>
        </head>

        <body class="bg-dark text-white">

            @include('partials.navbar')

            <main style="height: 100vh">

                <div style="width: 100%">

                    <h1 class="text-center mt-5 mb-5">Arena</h1>

                    <h2 class="text-center mx-auto my-auto">Room code : {{ $game->code }}</h2>

                    <ul id="playerList" class="text-center mt-3" style="list-style-type: none; font-size: 28px; font-weight: bold; padding: 0">
                        @foreach($game->users as $user)
                            <li class="text-center">{{ $user->name }}</li>
                            <li class="text-center">Level {{ $user->level }}</li>
                        @endforeach
                    </ul>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                </div>

            </main>

        </body>

    </html>
