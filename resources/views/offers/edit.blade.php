@extends('layouts.app')

@section('content')
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
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="{{ $offer->location }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="closeModalBtn">Close</button>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

