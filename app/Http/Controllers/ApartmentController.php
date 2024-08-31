<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $user_id=Auth::id();
        $catalogue=Apartment::where('user_id', $user_id)->get();
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
        $data=[
            'apartment'=>$apartment,
        ];
        
        return view('apartment.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        $data=[
            'apartment'=>$apartment,
        ];

        return view('apartment.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $data=$request->all();

        $apartment->title=$data['title'];
        $apartment->rooms=$data['rooms'];
        $apartment->beds=$data['beds'];
        $apartment->bathrooms=$data['bathrooms'];
        $apartment->dimension_mq=$data['dimension_mq'];
        $apartment->image=$data['image'];
        $apartment->latitude=$data['latitude'];
        $apartment->longitude=$data['longitude'];
        $apartment->address_full=$data['address_full'];
        $apartment->is_visible=$data['is_visible'];

        $apartment->update();

        return redirect()->route('apartment.show',['apartment'=>$apartment]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return to_route('apartments.index')->with('message','Appartamento eliminato.'); 
    }
}
