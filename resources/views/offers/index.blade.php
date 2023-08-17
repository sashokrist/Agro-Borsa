@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
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
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($offers as $offer)
                                        <tr>
                                            <th scope="row">{{ $offer->item->name }}</th>
                                            <td>
                                                {{ $offer->name }}
                                            </td>
                                            <td>
                                                {{ $offer->description }}
                                            </td>
                                            <td>
                                                {{ $offer->amount }}
                                            </td>
                                            <td>
                                                {{ $offer->quantity }}
                                            </td>
                                            <td>
                                                {{ $offer->price }}
                                            </td>
                                            <td>
                                                {{ $offer->location }}
                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                                <div class="">
                                                    <div class="col-sm-6">
                                                        <a href="javascript:void(0)" id="show-offer"  class="btn btn-primary btn-show"
                                                           data-id="{{ $offer->id }}"
                                                           data-name="{{ $offer->name }}"
                                                           data-description="{{ $offer->description }}"
                                                           data-item-id="{{ $offer->item->id }}"
                                                           data-quantity="{{ $offer->quantity }}"
                                                           data-amount="{{ $offer->amount }}"
                                                           data-price="{{ $offer->price }}"
                                                           data-location="{{ $offer->location }}"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#showOfferModal">Show</a>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                           data-bs-target="#editModal">Edit</a>
                                                    </div>
                                                    <div class="col-sm-6">
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
    </div>
    <!-- Show Offer Modal -->
    <div class="modal fade" id="showOfferModal" tabindex="-1" role="dialog" aria-labelledby="showOfferModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showOfferModalLabel">Offer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Display offer details here -->
                    <h4><strong>Product:</strong> <span id="offer-item-id">{{ $offer->item->name }}</span></h4>
                    <h4><strong>Name:</strong> <span id="name">{{ $offer->name }}</span></h4>
                    <h4><strong>Description:</strong> <span id="description">{{ $offer->description }}</span></h4>
                    <h4><strong>Amount:</strong> <span id="amount">{{ $offer->amount }}</span></h4>
                    <h4><strong>Quantity:</strong> <span id="quantity">{{ $offer->quantity }}</span></h4>
                    <h4><strong>Price:</strong> <span id="price">{{ $offer->price }}</span></h4>
                    <h4><strong>Location:</strong> <span id="location">{{ $offer->location }}</span></h4>
                    <!-- Add more offer details as needed -->
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
                            <button type="button" id="closeModalBtn" class="btn btn-secondary closeModal"
                                    data-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-primary">Create Offer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function () {
            $('.alert-success').fadeOut('slow');
        }, 9000);
    </script>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".closeModal").click(function (e) {
                e.preventDefault();
                $("#createOfferForm")[0].reset(); // Reset the form
                // Close the modal
                $("#createOfferModal").modal('hide');
            });

            // Pass items data to modal when it's shown
            $('#createOfferModal').on('show.bs.modal', function (event) {
                // ... Existing code ...

                // Enable draggable and resizable
                modal.find('.draggable').draggable();
                modal.find('.resizable').resizable();
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

            // Show Offer Modal
            $('.btn-show').click(function () {
                var offerId = $(this).data('offer-id');
                var product = $(this).data('item-id');
                var name = $(this).data('offer-name');
                var description = $(this).data('offer-description');
                var amount = $(this).data('offer-amount');
                var quantity = $(this).data('offer-quantity');
                var price = $(this).data('offer-price');
                var location = $(this).data('offer-location');

                console.log(offerId);


                // Populate modal with offer details
                $('#item-id').text(product);
                $('#name').text(name);
                $('#description').text(description);
                $(e.currentTarget).find('input[name="user_id"]').val(offerId);
                // Show the modal
                $('#showOfferModal').modal('show');
            });

            // Handle modal hidden event
            $('#showOfferModal').on('hidden.bs.modal', function () {
                // Reset the offer details when the modal is closed
                $('#name').text('');
                $('#description').text('');
            });
        });
    </script>
@endsection
