@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Offer: ') }} {{ $offer->id }}</div>

                <div class="card-body offer">
                    <div class=" text-center">
                        <a href="{{ route('offers.index') }}" class="btn btn-primary" id="back-button">back ot all offers</a>
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
                                <h4>{{ $offer->price }}</h4>
                            </div>
                            <div class="list-group-item">
                                <h3 class="mb-0">Location:</h3>
                                <h4>{{ $offer->location }}</h4>
                                <div id="streetName">
                                    <div id="map"></div>
                                    <div id="address"></div>
                                </div>
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
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 42.69770050048828, lng: 23.32180404663086 },
            zoom: 14
        });

        var geocoder = new google.maps.Geocoder();

        var location = { lat: 42.69770050048828, lng: 23.32180404663086 };

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
@endsection
