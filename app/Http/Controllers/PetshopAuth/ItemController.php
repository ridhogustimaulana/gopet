<?php

namespace App\Http\Controllers\PetshopAuth;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    /**
     * ItemController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:petshop');
    }

    public function index()
    {
        $items = Item::where('id_petshop', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('user-petshop.items.items', [
            'items' => $items,
            'total' => $items->total(),
            'perPage' => $items->perPage(),
            'currentPage' => $items->currentPage(),
        ]);
    }

    public function create()
    {
        return view('user-petshop.items.create');
    }

    public function edit($id)
    {
        $item = Item::find($id);
        return view('user-petshop.items.edit',[
           'item' => $item
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category' => '',
            'description' => ''
        ]);

        $item = new Item();
        $image = $request->file('image')->store('items');
        $item->image = $image;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->id_petshop = Auth::user()->id;
        $item->category = $request->category;
        $item->description = $request->description;
        $item->save();

        return redirect()->route('user-petshop.item')->with(['success' => 'A new item has been created']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category' => '',
            'description' => ''
        ]);

        $item = Item::where('id', $id)->first();
        if ($request->image != null) {
            if ($item->image != 'default.png') {
                Storage::delete($item->image);
            }
            $image = $request->file('image')->store('items');
            $item->image = $image;
        }
        $item->name = $request->name;
        $item->price = $request->price;
        $item->category = $request->category;
        $item->description = $request->description;
        $item->update();
        return redirect()->route('user-petshop.item')->with(['success' => 'A chosen item has been updated']);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        Storage::delete($item->image);
        $item->delete();
        return redirect()->route('user-petshop.item')->with(['success' => 'A chosen item has been removed']);
    }
}
