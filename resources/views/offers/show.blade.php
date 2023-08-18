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
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
