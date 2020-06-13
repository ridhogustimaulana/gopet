<?php

namespace App\Http\Controllers;

use App\BuyingAnimal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BuyingAnimalController extends Controller
{
    /**
     * BuyingAnimalController constructor.
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
        $buyingAnimals = BuyingAnimal::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.buying-animal.buying-animal', [
            'buyingAnimals' => $buyingAnimals,
            'total' => $buyingAnimals->total(),
            'perPage' => $buyingAnimals->perPage(),
            'currentPage' => $buyingAnimals->currentPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.buying-animal.create');
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
            'address' => 'required',
            'phone' => 'required',
            'description' => ''
        ]);

        $buyingAnimal = new BuyingAnimal();
        $image = $request->file('image')->store('buying-animal');
        $buyingAnimal->image = $image;
        $buyingAnimal->name = $request->name;
        $buyingAnimal->address = $request->address;
        $buyingAnimal->phone = $request->phone;
        $buyingAnimal->description = $request->description;

        $buyingAnimal->save();

        return redirect()->route('admin.buying-animal')->with(['success' => 'A new buying animal has been created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BuyingAnimal  $buyingAnimal
     * @return \Illuminate\Http\Response
     */
    public function show(BuyingAnimal $buyingAnimal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BuyingAnimal  $buyingAnimal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buyingAnimal = BuyingAnimal::find($id);
        return view('admin.buying-animal.edit', [
            'buyingAnimal' => $buyingAnimal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BuyingAnimal  $buyingAnimal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'address' => 'required',
            'phone' => 'required',
            'description' => ''
        ]);

        $buyingAnimal = BuyingAnimal::find($id);

        if ($request->image != null) {
            if ($buyingAnimal->image != 'default.png') {
                Storage::delete($buyingAnimal->image);
            }
            $image = $request->file('image')->store('buying-animal');
            $buyingAnimal->image = $image;
        }

        $buyingAnimal->name = $request->name;
        $buyingAnimal->address = $request->address;
        $buyingAnimal->phone = $request->phone;
        $buyingAnimal->description = $request->description;

        $buyingAnimal->update();
        return redirect()->route('admin.buying-animal')->with(['success' => 'A chosen animal has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BuyingAnimal  $buyingAnimal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buyingAnimal = BuyingAnimal::find($id);
        $buyingAnimal->delete();
        return redirect()->route('admin.buying-animal')->with(['success' => 'A chosen animal has been removed']);
    }
}
