<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\HouseCreateAndEditRequest;
use App\Models\House;

class HouseController extends Controller
{
    public function __construct(){
        // $this->middleware('auth', ['except' => [
        //     'allListings', 'show'
        // ]]);
        $this->middleware('auth');
    }

    public function index(){
        $houses = auth()->user()->houses()->orderBy('created_at')->get();
        return view('houses.index')->with('houses', $houses);
    }

    public function create(){
        return view('houses.create');
    }

    public function store(HouseCreateAndEditRequest $request){
        auth()->user()->houses()->create($request->all());
        return redirect()->back()->with('message', 'House listing created.');
    }

    public function show(House $house){
        $dataToPassToView = [
            'house' => $house,
            'houseAddressString' => $house->address_street . ", " . $house->address_city . " " . $house->address_state . ", " . $house->address_zip
        ];
        return view('houses.show')->with($dataToPassToView);
    }

    public function edit(House $house){
        return view('houses.edit')->with('house', $house);
    }

    public function update(HouseCreateAndEditRequest $request, House $house){
        if(auth()->user()->id === $house->user_id){
            $house->update([
                'address_street' => $request->address_street,
                'address_city' => $request->address_city,
                'address_state' => $request->address_state,
                'address_zip' => $request->address_zip,
                'price' => $request->price,
                'description' => $request->description,
                'sold' => $request->sold
            ]);
            return redirect(route('houses.index'))->with('message', 'House listing updated.');
        } else {
            return redirect()->back()->with('error', 'You may only edit your own listings!');
        }
    }

    public function destroy(House $house){
        if(auth()->user()->id === $house->user_id){
            $house->delete();
            return redirect()->back()->with('message', 'House listing deleted.');
        } else {
            return redirect()->back()->with('error', 'You may only delete your own listings!');
        }
    }

    public function allListings(){
        $houses = House::all()->sortBy('created_at');
        return view('houses.all-listings')->with('houses', $houses);
    }

    //Ajax Routes:
    public function allListingsAjax(){
        $houses = House::all()->sortBy('created_at');
        return response()->json($houses);
    }

    public function getListingsByZipCodeAjax($zipCode){
        $houses = House::where('address_zip', 'LIKE', '%' . $zipCode .'%')->orderBy('created_at')->get();
        return response()->json($houses);
    }

    public function getListingsByStateAjax($twoLetterState){
        $twoLetterState = strtoupper($twoLetterState);
        $houses = House::where('address_state', $twoLetterState)->orderBy('created_at')->get();
        return response()->json($houses);
    }

}
