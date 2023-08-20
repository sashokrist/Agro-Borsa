@extends('layouts.app')

@section('content')
    <div class="container">
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

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"><h1>{{ __('Offers Dashboard') }}</h1></div>

                    <div class="card-body">
                        <div class="text-center">
                            <button type="button" id="newOfferBtn" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#createOfferModal">New Offer
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
                                        <th id="loc">
                                            {{ $offer->location }}
                                            <gmp-map center="42.69770050048828,23.32180404663086" zoom="14" map-id="map-container" class="map">
                                                <gmp-advanced-marker position="42.69770050048828,23.32180404663086" title="My location"></gmp-advanced-marker>
                                            </gmp-map>
                                        </th>
                                        <th>
                                            {{ $offer->created_at->diffForHumans() }}
                                        </th>
                                        <td>
                                            <div class="">
                                                <div class="col-sm-6">
                                                    <!-- Button trigger modal -->
                                                    <a href="{{ route('offers.edit', $offer->id) }}"
                                                       class="btn btn-primary">Edit</a>
                                                    <a href="{{ route('offers.show', $offer->id) }}"
                                                       class="btn btn-primary">Show</a>
                                                    <form action="{{ route('offers.destroy', $offer->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table> {{ $offers->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location">
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
@endsection
@section('scripts')
    <script>
        function initMap() {
            var mapContainer = $('.map-container');
            var map = new google.maps.Map(mapContainer, {
                center: { lat: 42.69770050048828, lng: 23.32180404663086 },
                zoom: 14
            });

            var marker = new google.maps.Marker({
                position: { lat: 42.69770050048828, lng: 23.32180404663086 },
                map: map,
                title: 'My location'
            });
        }

        // Trigger map initialization when the page is fully loaded
        window.onload = function() {
            initMap();
        };
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGJYxe8BCr3Ea4LVHSyJ01Qp9PRuNqgFI&callback=console.debug&libraries=maps,marker&v=beta" defer></script>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".closeModal").click(function (e) {
                e.preventDefault();
                $("#createOfferForm")[0].reset(); // Reset the form
                // Close the modal
                $("#createOfferForm").modal('hide');
            });

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
    </script>
@endsection
