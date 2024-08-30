<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogue=Apartment::all();
        $data=
        [
            'catalogue'=>$catalogue,
        ];
        return view('admin.apartment.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apartment.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validating data inserted
        $data=$request->validate([
            "user_id"=>"required|unique",
            "title"=>"string|required",
            "rooms"=>"required|numeric",
            "beds"=>"required|numeric",
            "bathrooms"=>"required|numeric",
            "dimension_mq"=>"required|numeric",
            "image"=>"required",
            "latitude"=>"required|numeric",
            "longitude"=>"required|numeric",
            "address_full"=>"required|string",
            "is_visible"=>"required|boolean",

        ]);
        //creating new istance of Apartment
        $newApartment= new Apartment();
        $newApartment->fill($data);
        dd($data);
        $newApartment->save();
        return redirect()->route('apartment.show',['apartment'=>$newApartment]); 

    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
