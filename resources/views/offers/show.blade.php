<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Jumbotron Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsMQR7Tbrq05SKwLJrXAITHnARIx9kdG8&callback=console.debug&libraries=maps,marker&v=beta"  async defer></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    {{--    <<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGJYxe8BCr3Ea4LVHSyJ01Qp9PRuNqgFI&callback=console.debug&libraries=maps,marker&v=beta" defer></script>--}}


    <style>
        body {
            padding-top: 3.5rem;
        }

        gmp-map {
            height: 400px;
            width: 400px;
        }
    </style>

</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="{{ route('offers.index') }}">Home</a>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
            @endguest
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('offers.index') }}" id="dropdown01" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('offers.index') }}>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="color: blue;">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else

            @endguest
        </ul>
        <button type="button" id="newOfferBtn" class="btn btn-success" data-toggle="modal"
                data-target="#createOfferModal">New Offer
        </button>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Offer: ') }} {{ $offer->id }}</div>

                <div class="card-body offer">
                    <div class=" text-center">
                        <a href="{{ route('offers.index') }}" class="btn btn-primary" id="back-button">back</a>
                        <div class="list-group">
                            <div class="list-group-item">
                                <h3 class="mb-0">Product:</h3>
                                <h4>{{ $offer->item->name }}</h4>
                            </div>
                            <div class="list-group-item">
                                <h3 class="mb-0">Name:</h3>
                                <h4>{{ $offer->name }}</h4>
                            </div>
                            <div class="list-group-item">
                                <h3 class="mb-0">Description:</h3>
                                <h4>{{ $offer->description }}</h4>
                            </div>
                            <div class="list-group-item">
                                <h3 class="mb-0">Amount:</h3>
                                <h4>{{ $offer->amount }} ({{ $offer->quantity }})</h4>
                            </div>
                            <div class="list-group-item">
                                <h3 class="mb-0">Price:</h3>
                                <h4>{{ $offer->price }}lv.</h4>
                            </div>
                            <div class="list-group-item">
                                <h3 class="mb-0">Location:</h3>
                                <gmp-map center="{{ $offer->position_x }},{{ $offer->position_y }}" zoom="10" map-id="map-container" class="map text-center">
                                    <gmp-advanced-marker position="{{ $offer->position_x }},{{ $offer->position_y }}" title="My location"></gmp-advanced-marker>
                                </gmp-map>
                                <div id="map"></div>
                                <div id="address"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="container text-center">
    <p>&copy; <strong>SJ 2023</strong></p>
</footer>
</body>
<script>
    function initMap() {
        var positionX = parseFloat({{ $offer->position_x }});
        var positionY = parseFloat({{ $offer->position_y }});

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: positionX, lng: positionY},
            zoom: 14
        });

        var geocoder = new google.maps.Geocoder();
        var location = { lat: positionX, lng: positionY };

        geocoder.geocode({ 'location': location }, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    document.getElementById('address').textContent = results[0].formatted_address;
                } else {
                    document.getElementById('address').textContent = 'No results found';
                }
            } else {
                document.getElementById('address').textContent = 'Geocoder failed due to: ' + status;
            }
        });
    }
    initMap();
</script>
</html>
