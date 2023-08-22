<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title> agro Borsa</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

{{--    <script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
{{--            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>--}}
    {{--    <<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGJYxe8BCr3Ea4LVHSyJ01Qp9PRuNqgFI&callback=console.debug&libraries=maps,marker&v=beta" defer></script>--}}

    <style>
        body {
            padding-top: 3.5rem;
        }

        gmp-map {
            height: 300px;
            width: 300px;
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
{{--        <button type="button" id="newOfferBtn" class="btn btn-success" data-toggle="modal"--}}
{{--                data-target="#createOfferModal">New Offer--}}
{{--        </button>--}}
        <a href="{{ route('offers.create') }}" class="btn btn-success">New Offer</a>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<main role="main">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="card">
            <div class="card-header text-center"><h1>Dashboard</h1></div>
            <div class="card-body">
{{--                <div class="text-center">--}}
{{--                    <button type="button" id="newOfferBtn" class="btn btn-success" data-toggle="modal"--}}
{{--                            data-target="#createOfferModal">New Offer--}}
{{--                    </button>--}}
{{--                </div>--}}
                <br>
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Offer/User</th>
                            <th scope="col">Product</th>
                            <th scope="col">Description</th>
                            <th scope="col">Amount/Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Location</th>
                            <th scope="col">Published</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offers as $offer)
                            <tr  style="{{ $offer->created_at->diffInDays(now()) > 30 ? 'background: red;' : '' }}">
                                <th>
                                    {{ $offer->name }} <br> (ID: {{ $offer->id }}) by {{ $offer->user->name }}
                                </th>
                                <th>
                                    {{ $offer->item->name }}
                                </th>
                                <th>
                                    {{ $offer->description }}
                                </th>
                                <th>
                                    {{ $offer->amount }}  {{ $offer->quantity }}.
                                </th>
                                <th>
                                    {{ $offer->price }} lv.
                                </th>
                                <th>
                                    <gmp-map center="{{ $offer->position_x }},{{ $offer->position_y }}" zoom="8"
                                             map-id="map-container" class="map">
                                        <gmp-advanced-marker
                                            position="{{ $offer->position_x }},{{ $offer->position_y }}"
                                            title="My location"></gmp-advanced-marker>
                                    </gmp-map>
                                    <div id="map"></div>
                                    <div id="address"></div>
{{--                                    <div id="streetName">--}}
{{--                                        <div id="map"></div>--}}
{{--                                        <div id="address"></div>--}}
{{--                                    </div>--}}
                                </th>
                                <th>
                                    {{ $offer->created_at->diffForHumans() }}
                                </th>
                                <th>
                                    <div class="">
                                        <div class="col-sm-6">
                                            <a href="{{ route('offers.show', $offer->id) }}"
                                               class="btn btn-primary">Details</a>
                                            @if($offer->user_id == Auth::user()->id)
                                                <!-- Button trigger modal -->
                                                <a href="{{ route('offers.edit', $offer->id) }}"
                                                   class="btn btn-primary">Edit</a>

                                                <form action="{{ route('offers.destroy', $offer->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                        {{ $offers->links('pagination::bootstrap-4') }}
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
    <footer class="container text-center">
        <p>&copy; <strong>SJ 2023</strong></p>
    </footer>
    <!-- Create Offer Modal -->
{{--   --}}
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsMQR7Tbrq05SKwLJrXAITHnARIx9kdG8&callback=console.debug&libraries=maps,marker&v=beta"  async defer></script>

<script>
    $(document).ready(function () {
    setTimeout(function () {
        $('.alert-success').fadeOut('slow');
    }, 9000);
</script>
</html>
