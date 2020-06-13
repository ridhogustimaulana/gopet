<?php

namespace App\Http\Controllers;

use App\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommunityController extends Controller
{
    /**
     * CommunityController constructor.
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
        $communities = Community::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.community.community', [
            'communities' => $communities,
            'total' => $communities->total(),
            'perPage' => $communities->perPage(),
            'currentPage' => $communities->currentPage(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.community.create');
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
            'leader' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $community = new Community();
        $image = $request->file('image')->store('community');
        $community->image = $image;
        $community->name = $request->name;
        $community->description = $request->description;
        $community->leader = $request->leader;
        $community->address = $request->address;
        $community->phone = $request->phone;

        $community->save();

        return redirect()->route('admin.community')->with(['success' => 'A new community has been created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $community = Community::find($id);
        return view('admin.community.edit', [
           'community' => $community,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'description' => '',
            'leader' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $community = Community::find($id);

        if ($request->image != null) {
            if ($community->image != 'default.png') {
                Storage::delete($community->image);
            }
            $image = $request->file('image')->store('community');
            $community->image = $image;
        }

        $community->name = $request->name;
        $community->description = $request->description;
        $community->leader = $request->leader;
        $community->address = $request->address;
        $community->phone = $request->phone;

        $community->update();
        return redirect()->route('admin.community')->with(['success' => 'A chosen community has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $community = Community::find($id);
        $community->delete();
        return redirect()->route('admin.community')->with(['success' => 'A chosen community has been removed']);
    }
}
