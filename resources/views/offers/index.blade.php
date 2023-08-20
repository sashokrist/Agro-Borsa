{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGJYxe8BCr3Ea4LVHSyJ01Qp9PRuNqgFI&callback=console.debug&libraries=maps,marker&v=beta"></script>--}}

{{--    <div class="container">--}}
{{--        @if(session('status'))--}}
{{--            <div class="alert alert-success">--}}
{{--                {{ session('status') }}--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header text-center"><h1>{{ __('Offers Dashboard') }}</h1></div>--}}

{{--                    <div class="card-body">--}}
{{--                        <div class="text-center">--}}
{{--                            <button type="button" id="newOfferBtn" class="btn btn-success" data-bs-toggle="modal"--}}
{{--                                    data-bs-target="#createOfferModal">New Offer--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <br>--}}
{{--                        <div class="row">--}}
{{--                            <table class="table table-striped">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">Offer/User</th>--}}
{{--                                    <th scope="col">Product</th>--}}
{{--                                    <th scope="col">Description</th>--}}
{{--                                    <th scope="col">Amount/Quantity</th>--}}
{{--                                    <th scope="col">Price</th>--}}
{{--                                    <th scope="col">Location</th>--}}
{{--                                    <th scope="col">Published</th>--}}
{{--                                    <th scope="col">Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($offers as $offer)--}}
{{--                                    <tr>--}}
{{--                                        <th>--}}
{{--                                            {{ $offer->name }} <br> (ID: {{ $offer->id }}) by {{ $offer->user->name }}--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            {{ $offer->item->name }}--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            {{ $offer->description }}--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            {{ $offer->amount }}  {{ $offer->quantity }}.--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            {{ $offer->price }} lv.--}}
{{--                                        </th>--}}
{{--                                        <th id="loc">--}}
{{--                                            {{ $offer->location }}--}}
{{--                                            <div id="map">--}}
{{--                                                <gmp-map center="{{ $offer->position_x }},{{ $offer->position_y }}" zoom="14" map-id="map-container" class="map">--}}
{{--                                                    <gmp-advanced-marker position="{{ $offer->position_x }},{{ $offer->position_y }}" title="My location"></gmp-advanced-marker>--}}
{{--                                                </gmp-map></div>--}}
{{--                                            <div id="address">address</div>--}}
{{--                                        </th>--}}
{{--                                        <th>--}}
{{--                                            {{ $offer->created_at->diffForHumans() }}--}}
{{--                                        </th>--}}
{{--                                        <td>--}}
{{--                                            <div class="">--}}
{{--                                                <div class="col-sm-6">--}}
{{--                                                    <a href="{{ route('offers.show', $offer->id) }}"--}}
{{--                                                                         class="btn btn-primary">Details</a>--}}
{{--                                                    @if($offer->user_id == Auth::user()->id)--}}
{{--                                                        <!-- Button trigger modal -->--}}
{{--                                                        <a href="{{ route('offers.edit', $offer->id) }}"--}}
{{--                                                           class="btn btn-primary">Edit</a>--}}

{{--                                                        <form action="{{ route('offers.destroy', $offer->id) }}"--}}
{{--                                                              method="POST">--}}
{{--                                                            @csrf--}}
{{--                                                            @method('DELETE')--}}
{{--                                                            <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                                                        </form>--}}
{{--                                                    @endif--}}
{{--                                                    <!-- Button trigger modal -->--}}
{{--                                                    <a href="{{ route('offers.edit', $offer->id) }}"--}}
{{--                                                       class="btn btn-primary">Edit</a>--}}
{{--                                                    <a href="{{ route('offers.show', $offer->id) }}"--}}
{{--                                                       class="btn btn-primary">Show</a>--}}
{{--                                                    <form action="{{ route('offers.destroy', $offer->id) }}"--}}
{{--                                                          method="POST">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                                                    </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table> {{ $offers->links('pagination::bootstrap-5') }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- Create Offer Modal -->--}}
{{--    <div class="modal fade" id="createOfferModal" tabindex="-1" role="dialog" aria-labelledby="createOfferModalLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="createOfferModalLabel">Create New Offer</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <form id="createOfferForm" action="{{ route('offers.store') }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="user_id">User</label>--}}
{{--                            <input type="text" class="form-control" id="user_id" name="user_id"--}}
{{--                                   value="{{ Auth::user()->name }}" readonly>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="item_id">Item to sale</label>--}}
{{--                            <select class="form-control" id="item_id" name="item_id">--}}
{{--                                @foreach($items as $item)--}}
{{--                                    <option value="{{ $item->id }}">{{ $item->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="name">Name</label>--}}
{{--                            <input type="text" class="form-control" id="name" name="name">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="description">Description</label>--}}
{{--                            <input type="text" class="form-control" id="description" name="description">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="amount">Amount</label>--}}
{{--                            <input type="number" class="form-control" id="amount" name="amount">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="quantity">Quantity</label>--}}
{{--                            <select class="form-select" id="quantity" name="quantity" aria-label="Quantity">--}}
{{--                                <option value="kg" selected>kg</option>--}}
{{--                                <option value="l">l</option>--}}
{{--                                <option value="number">number</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="price">Price</label>--}}
{{--                            <input type="number" class="form-control" id="price" name="price">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="location">Location</label><br>--}}
{{--                            <label for="longitude">longitude</label>--}}
{{--                            <input type="number" class="form-control" id="location" name="longitude" placeholder="42.69770050048828">--}}
{{--                            <label for="altitude">altitude</label>--}}
{{--                            <input type="number" class="form-control" id="location" name="altitude" placeholder="23.32180404663086">--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" id="closeModal" class="btn btn-secondary closeModal"--}}
{{--                                    data-dismiss="modal">Close--}}
{{--                            </button>--}}
{{--                            <button type="submit" class="btn btn-primary">Create</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <script>--}}
{{--        setTimeout(function () {--}}
{{--            $('.alert-success').fadeOut('slow');--}}
{{--        }, 9000);--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $("#closeModalBtn").on("click", function () {--}}
{{--            // Reset the form--}}
{{--            $("#editOfferForm").reset();--}}
{{--            // Hide the modal--}}
{{--            $("#editOfferModal").style.display = "none";--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
{{--@section('scripts')--}}

{{--    <script>--}}
{{--        function initMap() {--}}
{{--            var map = new google.maps.Map(document.getElementById('map'), {--}}
{{--                center: { lat: 42.69770050048828, lng: 23.32180404663086 },--}}
{{--                zoom: 14--}}
{{--            });--}}

{{--            var geocoder = new google.maps.Geocoder();--}}

{{--            var location = { lat: 42.69770050048828, lng: 23.32180404663086 };--}}
{{--            console.log(location);--}}

{{--            geocoder.geocode({ 'location': location }, function(results, status) {--}}
{{--                if (status === 'OK') {--}}
{{--                    if (results[0]) {--}}
{{--                        var address = results[0].formatted_address;--}}
{{--                        document.getElementById('address').textContent = address;--}}
{{--                    } else {--}}
{{--                        document.getElementById('address').textContent = 'No results found';--}}
{{--                    }--}}
{{--                } else {--}}
{{--                    document.getElementById('address').textContent = 'Geocoder failed due to: ' + status;--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        // Trigger map initialization when the page is fully loaded--}}
{{--        window.onload = function() {--}}
{{--            alert('TEST');--}}
{{--            initMap();--}}
{{--        };--}}
{{--    </script>--}}

{{--@endsection--}}
{{--@section('scripts')--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function () {--}}
{{--            $(".closeModal").click(function (e) {--}}
{{--                e.preventDefault();--}}
{{--                $("#createOfferForm")[0].reset(); // Reset the form--}}
{{--                // Close the modal--}}
{{--                $("#createOfferForm").modal('hide');--}}
{{--            });--}}

{{--            // Handle form submission--}}
{{--            $('#createOfferForm').submit(function (event) {--}}
{{--                event.preventDefault();--}}
{{--                $.ajax({--}}
{{--                    type: 'POST',--}}
{{--                    url: $(this).attr('action'),--}}
{{--                    data: $(this).serialize(),--}}
{{--                    success: function (response) {--}}
{{--                        // Show success message on the index page notification bar--}}
{{--                        $('#notificationBar').text('Offer created successfully').removeClass('d-none');--}}

{{--                        // Close the modal--}}
{{--                        $('#createOfferModal').modal('hide');--}}
{{--                    },--}}
{{--                    error: function (error) {--}}
{{--                        // Handle error--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}

{{--    </script>--}}
{{--@endsection--}}



{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <title>Simple Marker</title>--}}
{{--    <!-- The callback parameter is required, so we use console.debug as a noop -->--}}
{{--    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGJYxe8BCr3Ea4LVHSyJ01Qp9PRuNqgFI&callback=console.debug&libraries=maps,marker&v=beta">--}}
{{--    </script>--}}
{{--    <link rel="stylesheet" href="./style.css"/>--}}
{{--</head>--}}
{{--<style>--}}
{{--    gmp-map {--}}
{{--        height: 200px;--}}
{{--        width: 200px;--}}
{{--    }--}}


{{--</style>--}}
{{--<body>--}}
{{--<table class="table">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th scope="col">location</th>--}}
{{--        <th scope="col">First</th>--}}
{{--        <th scope="col">Last</th>--}}
{{--        <th scope="col">Handle</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    <tr>--}}
{{--        <th id="loc">--}}
{{--            <gmp-map center="42.69770050048828,23.32180404663086" zoom="14" map-id="DEMO_MAP_ID">--}}
{{--                <gmp-advanced-marker position="42.69770050048828,23.32180404663086" title="My location">--}}
{{--                </gmp-advanced-marker>--}}
{{--            </gmp-map>--}}
{{--        </th>--}}
{{--        <td>Mark</td>--}}
{{--        <td>Otto</td>--}}
{{--        <td>@mdo</td>--}}
{{--    </tr>--}}
{{--    </tbody>--}}
{{--</table>--}}
{{--<div id="map"></div>--}}
{{--<div id="address"></div>--}}

{{--<script>--}}
{{--    function initMap() {--}}
{{--        var map = new google.maps.Map(document.getElementById('map'), {--}}
{{--            center: { lat: 42.69770050048828, lng: 23.32180404663086 },--}}
{{--            zoom: 14--}}
{{--        });--}}

{{--        var geocoder = new google.maps.Geocoder();--}}

{{--        var location = { lat: 42.69770050048828, lng: 23.32180404663086 };--}}

{{--        geocoder.geocode({ 'location': location }, function(results, status) {--}}
{{--            if (status === 'OK') {--}}
{{--                if (results[0]) {--}}
{{--                    var address = results[0].formatted_address;--}}
{{--                    document.getElementById('address').textContent = address;--}}
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
{{--</body>--}}
{{--</html>--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Jumbotron Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
        body {
            padding-top: 3.5rem;
        }
        gmp-map {
            height: 200px;
            width: 200px;
        }
    </style>

</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
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
                <div class="card-header text-center"> <h1>Dashboard</h1></div>

                <div class="card-body">
                    <div class="text-center">
                        <button type="button" id="newOfferBtn" class="btn btn-success" data-toggle="modal"
                                data-target="#createOfferModal">New Offer
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createOfferModal">
                            Launch demo modal
                        </button>
                    </div>
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
                                        <gmp-map center="{{ $offer->position_x }},{{ $offer->position_y }}" zoom="14" map-id="map-container" class="map">
                                                    <gmp-advanced-marker position="{{ $offer->position_x }},{{ $offer->position_y }}" title="My location"></gmp-advanced-marker>
                                                </gmp-map>
                                        <div id="map"></div>
                                        <div id="address"></div>
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
<footer class="container">
    <p>&copy; Company 2017-2018</p>
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
                                <input type="number" class="form-control" id="amount" name="amount">
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
                                <input type="number" class="form-control" id="price" name="price">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label><br>
                                <label for="longitude">longitude</label>
                                <input type="number" class="form-control" id="longitude" name="longitude" placeholder="42.69770050048828">
                                <label for="altitude">altitude</label>
                                <input type="number" class="form-control" id="altitude" name="altitude" placeholder="23.32180404663086">
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
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
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 42.69770050048828, lng: 23.32180404663086 },
            zoom: 14
        });

        var geocoder = new google.maps.Geocoder();
        var location = {
            lat: {{ $offer->position_x }},
            lng: {{ $offer->position_y }}
        };

        geocoder.geocode({ 'location': location }, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    var address = results[0].formatted_address;
                    document.getElementById('address').textContent = address;
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
    <script>

    </script>
</html>
