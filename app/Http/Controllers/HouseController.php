<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HouseCreateAndEditRequest;
use App\Models\House;

class HouseController extends Controller
{
    public function index(){
        $houses = House::all();
        return view('houses.index')->with('houses', $houses);
    }

    public function create(){
        return view('houses.create');
    }

    public function store(HouseCreateAndEditRequest $request){
        //Store the house listing in the database.
        // dd($request->all());

        // try{
        //     House::create($request->all());
        // } catch(\Exception $e){
        //     return redirect()->back()->with('error', 'Something went wrong.');
        // }

        // $request->validate([
        //     'address_street' => 'required|max:200',
        //     'address_city' => 'required|max:200',
        //     'address_state' => 'required|max:2',
        //     'address_zip' => 'required|max:10|regex:/^\d{5}([\-]?\d{4})?$/',
        //     'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        //     'description' => 'required'
        // ]);

        House::create($request->all());

        return redirect()->back()->with('message', 'House listing created.');
    }

    public function edit(House $house){
        return view('houses.edit')->with('house', $house);
    }

    public function update(HouseCreateAndEditRequest $request, House $house){
        //Update house listing in the database:
        // dd($request->all());

        $house->update([
            'address_street' => $request->address_street,
            'address_city' => $request->address_city,
            'address_state' => $request->address_state,
            'address_zip' => $request->address_zip,
            'price' => $request->price,
            'description' => $request->description,
            'sold' => $request->sold
        ]);

        return redirect(route('my-listings'))->with('message', 'House listing updated.');
    }

    public function details(){
        return "House details.";
    }

    public function myListings(){
        $houses = House::all();
        return view('houses.my-listings')->with('houses', $houses);
    }

    public function delete(House $house){
        $house->delete();
        return redirect()->back()->with('message', 'House listing deleted.');
    }

}
