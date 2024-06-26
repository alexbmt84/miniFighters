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
            <link rel="stylesheet" href="../css/main.css">
            <link rel="stylesheet" href="../css/bigcard.css">
        </head>

        <body class="bg-dark text-white">

            @include('partials.navbar')

            <main class="d-flex flex-column align-items-center">

{{--                <h1 class="mt-5">{{ $name }}</h1>--}}

                <div class="fighterContainer2 mt-5 mb-5">

                    <a class="fighter-link">

                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <div class="avatar-container">
                                        <img class="fighterAvatar2" src="{{ $avatar }}" alt="Generated Avatar">
                                        <div class="stars2">
                                            @if($fighter->hp <= 200)
                                                <i class='bx bxs-star star-big-card' ></i>
                                            @elseif($fighter->hp <= 400)
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                            @elseif($fighter->hp <= 600)
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                            @elseif($fighter->hp <= 800)
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                            @elseif($fighter->hp > 800)
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                                <i class='bx bxs-star star-big-card' ></i>
                                            @endif
                                        </div>
                                        @if($isMyFighter)

                                            @if($isInMarketPlace)
                                                <form action="/remove/{{ $fighter->id }}" method="POST" class="mt-5 form-manage-fighters">
                                                    @csrf
                                                    <button class="uppercase mt-5 bg-black text-white font-bold py-2 px-4 rounded btn btn-generate sell" type="submit"><i class='bx bx-arrow-from-top' ></i>Remove of Marketplace</button>
                                                </form>
                                            @else
                                                <form action="/sell/{{ $fighter->id }}" method="POST" class="mt-5 form-manage-fighters">
                                                    @csrf
                                                    <button class="uppercase mt-5 bg-black text-white font-bold py-2 px-4 rounded btn btn-generate sell" type="submit"><i class='bx bx-money-withdraw'></i>Sell on Marketplace</button>
                                                </form>
                                            @endif

                                            <form action="/delete/{{ $fighter->id }}" method="POST" class="form-manage-fighters">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="uppercase mt-5 bg-black text-white font-bold py-2 px-4 rounded btn btn-generate sell" type="submit"><i class='bx bxs-trash' ></i>Delete</button>
                                            </form>

                                        @else
                                            @if($isInMarketPlace)
                                                <form action="/buy/{{ $fighter->id }}" method="POST" class="mt-5 form-manage-fighters">
                                                    @csrf
                                                    <button class="uppercase mt-5 bg-black text-white font-bold py-2 px-4 rounded btn btn-generate sell" type="submit"><i class='bx bx-cart-add'></i>Buy</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="text-container">
                                        <p class="title">{{$fighter->name}}</p>
                                        <p class="hp mt-3">{{ $fighter->hp }} PV</p>
                                        <p class="desc">{{ $fighter->description }} <i class='bx bx-edit cursor-pointer'></i></p>
                                        <div class="attacks-cont mb-5">
                                            <p class="attack1">{{ $fighter->attack_name_1 }} - {{ $fighter->attack_damages_1 }} DG</p>
                                            <p class="attack2 mb-5">{{ $fighter->attack_name_2 }}  - {{ $fighter->attack_damages_2 }} DG</p>
                                        </div>
                                        <div class="attacks-cont">
                                            <h3>FORCE</h3>
                                            <div class="container bar">
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar" style="width: 60%">
                                                    </div>
                                                </div>
                                            </div>
                                            <h3>INTELLIGENCE</h3>
                                            <div class="container bar">
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar"  style="width: 80%">
                                                    </div>
                                                </div>
                                            </div>
                                            <h3>AGILITE</h3>
                                            <div class="container bar">
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar"  style="width: 40%">
                                                    </div>
                                                </div>
                                            </div>
                                            <h3>ENDURANCE</h3>
                                            <div class="container bar">
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar"  style="width: 30%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </a>

                </div>



            </main>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const descElement = document.querySelector('.desc');
                    const editIcon = descElement.querySelector('.cursor-pointer');

                    editIcon.addEventListener('click', function() {
                        const currentDesc = descElement.textContent.trim();
                        const inputElement = document.createElement('textarea');

                        inputElement.type = 'text';
                        inputElement.style.width = "800px";
                        inputElement.style.height = "190px";
                        inputElement.style.textAlign = "justify"
                        inputElement.value = currentDesc;
                        inputElement.addEventListener('blur', function() {
                            descElement.innerHTML = `${inputElement.value} <i class='bx bx-edit cursor-pointer'></i>`;
                        });

                        descElement.innerHTML = '';
                        descElement.appendChild(inputElement);
                        inputElement.focus();
                    });
                });

            </script>
        </body>

    </html>
