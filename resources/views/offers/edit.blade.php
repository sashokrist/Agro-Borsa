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
        <a href="{{ route('offers.create') }}" class="btn btn-success">New Offer</a>
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
                    <div class="card-header"><h4>{{ __('Edit') }}</h4></div>

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
                            <form action="{{ route('offers.update', $offer->id) }}" method="POST" class="form-control" id="editOfferForm">
                                @csrf
                                @method('PUT')
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
                                                <option value="{{ $item->id }}" @if(old('item_id', $offer->item_id) == $item->id) selected @endif>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $offer->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ $offer->description }}">
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $offer->amount }}">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <select class="form-select" id="quantity" name="quantity" aria-label="Quantity">
                                        <option value="kg" @if(old('quantity', $offer->quantity) == 'kg') selected @endif>kg</option>
                                        <option value="l" @if(old('quantity', $offer->quantity) == 'l') selected @endif>l</option>
                                        <option value="number" @if(old('quantity', $offer->quantity) == 'number') selected @endif>number</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $offer->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label><br>
                                    <label for="longitude">longitude</label>
                                    <input type="number" class="form-control" id="location" name="longitude" placeholder="42.69770050048828">
                                    <label for="altitude">altitude</label>
                                    <input type="number" class="form-control" id="location" name="altitude" placeholder="23.32180404663086">
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" href="{{ route('offers.index') }}">{{ __('Close') }}</a>
                                    <button type="submit" class="btn btn-primary">Edit</button>
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

