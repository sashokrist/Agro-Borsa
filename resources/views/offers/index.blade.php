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
        <button type="button" id="newOfferBtn" class="btn btn-success" data-toggle="modal"
                data-target="#createOfferModal">New Offer
        </button>
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
                            <tr>
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
    <div class="modal fade" id="createOfferModal" tabindex="-1" role="dialog" aria-labelledby="createOfferModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createOfferModalLabel">Create New Offer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createOfferForm" action="{{ route('offers.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <input type="text" class="form-control" id="user_id" name="user_id"
                                   value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="item_id">Item to sale</label>
                            <select class="form-control" id="item_id" name="item_id">
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <div><label>Amount $
                                    <input type="number" id="amount" name="amount" placeholder="0.00" required min="0"
                                           value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="
                                        this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <select class="form-select" id="quantity" name="quantity" aria-label="Quantity">
                                <option value="kg" selected>kg</option>
                                <option value="l">l</option>
                                <option value="number">number</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label><br>
                            <label for="longitude">longitude</label>
                            <input type="number" class="form-control" id="longitude" name="longitude"
                                   placeholder="42.69770050048828">
                            <label for="altitude">altitude</label>
                            <input type="number" class="form-control" id="altitude" name="altitude"
                                   placeholder="23.32180404663086">
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeModal" class="btn btn-secondary closeModal"
                                    data-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"--}}
{{--        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"--}}
{{--        crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"--}}
{{--        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"--}}
{{--        crossorigin="anonymous"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsMQR7Tbrq05SKwLJrXAITHnARIx9kdG8&callback=console.debug&libraries=maps,marker&v=beta"  async defer></script>

<script>
    $(document).ready(function () {
        // Handle form submission
        $('#createOfferForm').submit(function (event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (response) {
                    // Show success message on the index page notification bar
                    $('#notificationBar').text('Offer created successfully').removeClass('d-none');

                    // Close the modal
                    $('#createOfferModal').modal('hide');
                },
                error: function (error) {
                    // Handle error
                }
            });
        });
    });
    setTimeout(function () {
        $('.alert-success').fadeOut('slow');
    }, 9000);
</script>
{{--<script>--}}
{{--    function initMap() {--}}
{{--        var positionX = parseFloat({{ $offer->position_x }});--}}
{{--        var positionY = parseFloat({{ $offer->position_y }});--}}

{{--        var map = new google.maps.Map(document.getElementById('map'), {--}}
{{--            center: {lat: positionX, lng: positionY},--}}
{{--            zoom: 14--}}
{{--        });--}}

{{--        var geocoder = new google.maps.Geocoder();--}}
{{--        var location = { lat: positionX, lng: positionY };--}}

{{--        geocoder.geocode({ 'location': location }, function(results, status) {--}}
{{--            if (status === 'OK') {--}}
{{--                if (results[0]) {--}}
{{--                    document.getElementById('address').textContent = results[0].formatted_address;--}}
{{--                } else {--}}
{{--                    document.getElementById('address').textContent = 'No results found';--}}
{{--                }--}}
{{--            } else {--}}
{{--                document.getElementById('address').textContent = 'Geocoder failed due to: ' + status;--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--    initMap();--}}
{{--</script>--}}
{{--<script>--}}
{{--    function initMap() {--}}
{{--        var map = new google.maps.Map(document.getElementById('map'), {--}}
{{--            center: {lat: {{ $offer->position_x }}, lng: {{ $offer->position_y }}},--}}
{{--            zoom: 14--}}
{{--        });--}}

{{--        var geocoder = new google.maps.Geocoder();--}}

{{--        var location = {--}}
{{--            lat: {{ $offer->position_x }},--}}
{{--            lng: {{ $offer->position_y }}--}}
{{--        };--}}
{{--        console.log(location);--}}

{{--        geocoder.geocode({'location': location}, function (results, status) {--}}
{{--            if (status === 'OK') {--}}
{{--                if (results[0]) {--}}
{{--                    var streetName = getAddressComponent(results[0], 'route');--}}
{{--                    document.getElementById('streetName').textContent = 'Street Name: ' + streetName;--}}
{{--                } else {--}}
{{--                    document.getElementById('streetName').textContent = 'No results found';--}}
{{--                }--}}
{{--            } else {--}}
{{--                document.getElementById('streetName').textContent = 'Geocoder failed due to: ' + status;--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}

{{--    function getAddressComponent(result, type) {--}}
{{--        for (var i = 0; i < result.address_components.length; i++) {--}}
{{--            var component = result.address_components[i];--}}
{{--            for (var j = 0; j < component.types.length; j++) {--}}
{{--                if (component.types[j] === type) {--}}
{{--                    return component.long_name;--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}
{{--        return '';--}}
{{--    }--}}

{{--    initMap();--}}
{{--</script>--}}

</html>
