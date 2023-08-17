<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with('item')->orderByDesc('id')->paginate(5);
        $items = Item::all();
        return view('offers.index', compact('offers', 'items'));
    }

    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $items = Item::all();
        return view('offers.edit', compact('offer', 'items'));
    }

    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        return view('offers.show', compact('offer'));
    }

    public function store(Request $request)
    {
      //  dd($request->all());
        //dd($request->all());
        // Validate the request data
//        $validatedData = $request->validate([
//            'user_id' => 'required', // You can adjust the validation rules as needed
//            'item_id' => 'required',
//            'description' => 'required',
//            'amount' => 'required|numeric',
//            'quantity' => 'required',
//            'price' => 'required|numeric',
//            'location' => 'required',
//        ]);
//
//        if($validatedData->fails()){
//            return response()->json(['message' => 'Offer created successfully']);
//        }

        // Create a new offer using the validated data
        $offer = new Offer();
        $offer->user_id = auth()->user()->id;
        $offer->name = $request->name;
        $offer->description = $request->description;
        $offer->amount = $request->amount;
        $offer->quantity = $request->quantity;
        $offer->price = $request->price;
        $offer->location = $request->location;
        $offer->item()->associate($request->item_id);
        $offer->save();

        // Return a success response
        session()->flash('status', 'Offer was created');
        return redirect()->back()->with('status', 'Offer created successfully');
    }

    public function update(Request $request, $id)
    {
        // Validate and process the request data, then update the offer
        // ...

        return response()->json(['message' => 'Offer updated successfully']);
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        $offer->delete();
        return redirect()->back()->with('status', 'Offer deleted successfully');
    }
}
