<?php

namespace App\Http\Controllers;

use App\WashingAndSpa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WashingAndSpaController extends Controller
{
    /**
     * WashingAndSpaController constructor.
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
        $washingAndSpas = WashingAndSpa::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.washing-and-spa.washing-and-spa', [
            'washingAndSpas' => $washingAndSpas,
            'total' => $washingAndSpas->total(),
            'perPage' => $washingAndSpas->perPage(),
            'currentPage' => $washingAndSpas->currentPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.washing-and-spa.create');
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

        $washingAndSpa = new WashingAndSpa();
        $image = $request->file('image')->store('washing-and-spa');
        $washingAndSpa->image = $image;
        $washingAndSpa->name = $request->name;
        $washingAndSpa->description = $request->description;
        $washingAndSpa->street = $request->street;
        $washingAndSpa->districts = $request->districts;
        $washingAndSpa->city = $request->city;
        $washingAndSpa->latitude = $request->latitude;
        $washingAndSpa->longitude = $request->longitude;

        $washingAndSpa->save();

        return redirect()->route('admin.washing-and-spa')->with(['success' => 'A new washing and spa has been created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WashingAndSpa  $washingAndSpa
     * @return \Illuminate\Http\Response
     */
    public function show(WashingAndSpa $washingAndSpa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WashingAndSpa  $washingAndSpa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $washingAndSpa = WashingAndSpa::find($id);
        return view('admin.washing-and-spa.edit', [
            'washingAndSpa' => $washingAndSpa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WashingAndSpa  $washingAndSpa
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

        $washingAndSpa = WashingAndSpa::find($id);
        if ($request->image != null) {
            if ($washingAndSpa->image != 'default.png') {
                Storage::delete($washingAndSpa->image);
            }
            $image = $request->file('image')->store('medicines');
            $washingAndSpa->image = $image;
        }
        $washingAndSpa->name = $request->name;
        $washingAndSpa->description = $request->description;
        $washingAndSpa->street = $request->street;
        $washingAndSpa->districts = $request->districts;
        $washingAndSpa->city = $request->city;
        $washingAndSpa->latitude = $request->latitude;
        $washingAndSpa->longitude = $request->longitude;

        $washingAndSpa->update();

        return redirect()->route('admin.washing-and-spa')->with(['success' => 'A chosen washing and spa has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WashingAndSpa  $washingAndSpa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $washingAndSpa = WashingAndSpa::find($id);
        $washingAndSpa->delete();
        return redirect()->route('admin.washing-and-spa')->with(['success' => 'A chosen washing and spa has been deleted']);
    }
}
