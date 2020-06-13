<?php

namespace App\Http\Controllers;

use App\PetShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetShopController extends Controller
{
    /**
     * PetShopController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petshops = PetShop::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.petshop.petshop', [
            'petshops' => $petshops,
            'total' => $petshops->total(),
            'perPage' => $petshops->perPage(),
            'currentPage' => $petshops->currentPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.petshop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'description' => '',
            'street' => 'required',
            'districts' => 'required',
            'city' => 'required',
        ]);

        $petshop = new PetShop();
        $image = $request->file('image')->store('petshop');
        $petshop->image = $image;
        $petshop->name = $request->name;
        $petshop->description = $request->description;
        $petshop->street = $request->street;
        $petshop->districts = $request->districts;
        $petshop->city = $request->city;
        $petshop->latitude = $request->latitude;
        $petshop->longitude = $request->longitude;

        $petshop->save();

        return redirect()->route('admin.petshop')->with(['success' => 'A new petshop has been created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PetShop  $petShop
     * @return \Illuminate\Http\Response
     */
    public function show(PetShop $petShop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PetShop  $petShop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $petshop = PetShop::find($id);
        return view('admin.petshop.edit', [
            'petshop' => $petshop,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PetShop  $petShop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'description' => '',
            'street' => 'required',
            'districts' => 'required',
            'city' => 'required',
        ]);

        $petshop = PetShop::find($id);
        if ($request->image != null) {
            if ($petshop->image != 'default.png') {
                Storage::delete($petshop->image);
            }
            $image = $request->file('image')->store('petshop');
            $petshop->image = $image;
        }
        $petshop->name = $request->name;
        $petshop->description = $request->description;
        $petshop->street = $request->street;
        $petshop->districts = $request->districts;
        $petshop->city = $request->city;
        $petshop->latitude = $request->latitude;
        $petshop->longitude = $request->longitude;

        $petshop->update();

        return redirect()->route('admin.petshop')->with(['success' => 'A chosen petshop has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PetShop  $petShop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $petshop = PetShop::find($id);
        $petshop->delete();
        return redirect()->route('admin.petshop')->with(['success' => 'A chosen petshop has been deleted']);
    }
}
