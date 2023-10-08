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
            <style>
                .spinner {
                    display: none;
                    position: absolute;
                    top: 115px;
                    left: 195px;
                    background-image: linear-gradient(rgb(186, 66, 255) 35%,rgb(0, 225, 255));
                    width: 40px;
                    height: 40px;
                    animation: spinning82341 1.7s linear infinite;
                    text-align: center;
                    border-radius: 50px;
                    filter: blur(1px);
                    box-shadow: 0px -5px 20px 0px rgb(186, 66, 255), 0px 5px 20px 0px rgb(0, 225, 255);
                }

                .spinner1 {
                    background-color: rgb(36, 36, 36);
                    width: 40px;
                    height: 40px;
                    border-radius: 50px;
                    filter: blur(10px);
                }

                .wait {
                    display: none;
                    color: white;
                    position: absolute;
                    font-size: 20px;
                    font-style: normal;
                    z-index: 1;
                    top: -40px;
                    left: 65px;
                    font-family: 'Staatliches', cursive;
                    transition: 0.5s;
                }

                @keyframes spinning82341 {
                    to {
                        transform: rotate(360deg);
                    }
                }
            </style>
        </head>

        <body class="bg-dark">

            @include("partials.navbar")

            <div class="d-flex flex-column align-items-center mt-5 vh-100">

                @auth()
                    <h1 class="text-center text-white mb-5">Welcome {{ auth()->user()->name }}</h1>
                  @else
                    <h1 class="text-center text-white mb-5">Welcome</h1>
                    <h2 class="text-center text-white" id="subtitle">Login or create an account and generate your unique cards !</h2>
                @endauth

{{--                <img src="/storage/fighters/Dimitri.png" alt="" srcset="" width="400px">--}}

                <form class="container" action="{{ route('generate') }}" method="POST">

                    @csrf

                    <div class="input-container">
                        <p class="wait" id="wait">Please wait... Estimated wait time : 30 sec...</p>

                        <div class="input-content">
                            <div class="input-dist">
                                <div class="input-type">
                                    <input placeholder="Enter name" name="name" type="text" class="input-is" required>
                                    <input placeholder="Add an optional short description" name="description" type="text" class="input-is">
                                    <div class="spinner" id="spinner">
                                        <div class="spinner1" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-generate col-12" type="submit">Generate a card !</button>
                    </div>

                    <label>
                        <select name="type" style="z-index: 99;
    position: relative;
    width: 374px;
    height: 60px;
    border-radius: 5px;
    background-color: #202020;
    color: white;
    font-size: 22px;
    text-align: center;
    border: solid rgba(69,118,134,0.81);
    top: -63px;
    left: -5px;">
                            <option value="Fighter">Fighter</option>
                            <option value="Civilian">Civilian</option>
                        </select>
                    </label>

                </form>

            @if (isset($avatar))

                    <img src="{{ $avatar }}" alt="Generated Avatar">

                @endif

            </div>

        <script>
            document.querySelector('.container').addEventListener('submit', function() {
                document.getElementById('spinner').style.display = 'block';
                document.getElementById('wait').style.display = 'block';
            });

        </script>

        </body>

    </html>
