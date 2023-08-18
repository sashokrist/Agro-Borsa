Product: {{ $offer->item->name }}<br>
Name: {{ $offer->name }}<br>
Description: {{ $offer->description }}<br>
Amount: {{ $offer->amount }}( {{ $offer->quantity }}.)<br>
Price: {{ $offer->price }}<br>
Location: {{ $offer->location }}<br>
<div class="">
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
