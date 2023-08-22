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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#street-name').on('blur', function() {
                var streetName = $(this).val();

                if (streetName !== '') {
                    // Replace 'YOUR_API_KEY' with your actual Google Maps API key
                    var apiKey = 'YOUR_API_KEY';
                    var geocodingApiUrl = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(streetName)}&key=AIzaSyBsMQR7Tbrq05SKwLJrXAITHnARIx9kdG8`;

                    $.get(geocodingApiUrl, function(data) {
                        if (data.status === 'OK' && data.results.length > 0) {
                            var location = data.results[0].geometry.location;
                            $('#altitude').val(location.lng);
                            $('#longitude').val(location.lat);
                        } else {
                            alert('Geocoding error: Unable to retrieve coordinates for the provided street name.');
                        }
                    });
                }
            });
        });
    </script>
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
                    <div class="card-header"><h4>{{ __('Create') }}</h4></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
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
                            <form action="{{ route('offers.store') }}" method="POST" class="form-control" id="editOfferForm">
                                @csrf
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <input type="text" class="form-control" id="user_id" name="user_id"
                                           value="{{ auth::user()->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="item_id">Item to sale</label>
                                    <div class="form-group">
                                        <label for="item_id">Item to sale</label>
                                        <select class="form-control" id="item_id" name="item_id">
                                            @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description">
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <select class="form-select" id="quantity" name="quantity" aria-label="Quantity">
                                        <option value="kg">kg</option>
                                        <option value="l">l</option>
                                        <option value="number">number</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label><br>
                                    <input type="text" id="street-name" class="street-name" value="Street name">
                                    <input type="number" step="any"     id="longitude" name="longitude">
                                    <input type="number" step="any"  id="altitude" name="altitude">
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" href="{{ route('offers.index') }}">{{ __('Close') }}</a>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="container text-center">
        <p>&copy; <strong>SJ 2023</strong></p>
    </footer>
</body>
</html>
