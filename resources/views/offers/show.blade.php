@extends('layouts.app')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsMQR7Tbrq05SKwLJrXAITHnARIx9kdG8&callback=console.debug&libraries=maps,marker&v=beta"  async defer></script>
<style>
    body {
        /*padding-top: 3.5rem;*/
    }

    gmp-map {
        height: 400px;
        width: 400px;
    }
</style>
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
                            <div>
                                <h3 class="mb-0">Location:</h3>
                                <gmp-map center="{{ $offer->position_x }},{{ $offer->position_y }}" zoom="14" map-id="map-container" class="map">
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
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: {{ $offer->position_x }}, lng: {{ $offer->position_y }}},
            zoom: 14
        });

        var geocoder = new google.maps.Geocoder();

        var location = { lat: {{ $offer->position_x }}, lng: {{ $offer->position_y }} };

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
@endsection
