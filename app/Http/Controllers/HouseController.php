<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\House;

class HouseController extends Controller
{
    public function index(){
        return view('houses.index');
    }

    public function create(){
        return view('houses.create');
    }

    public function store(Request $request){
        //Store the house listing in the database.
        // dd($request->all());

        // try{
        //     House::create($request->all());
        // } catch(\Exception $e){
        //     return redirect()->back()->with('error', 'Something went wrong.');
        // }

        $request->validate([
            'address_street' => 'required|max:200',
            'address_city' => 'required|max:200',
            'address_state' => 'required|max:2',
            'address_zip' => 'required|max:10|regex:/^\d{5}([\-]?\d{4})?$/',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'required'
        ]);

        House::create($request->all());

        return redirect()->back()->with('message', 'House listing created.');
    }

    public function edit(){
        return view('houses.edit');
    }

}
