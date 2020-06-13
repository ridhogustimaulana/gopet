<?php

namespace App\Http\Controllers\Api;

use App\PetShop;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PetShopController extends Controller
{
    public function index()
    {
        return response()->json(Response::transform(PetShop::all(), "All Petshop found", true), 200);
    }

    public function show($id)
    {
        $petshop = PetShop::find($id);
        if (is_null($petshop)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            return response()->json(Response::transform($petshop, "A petshop found", true), 200);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'image' => 'required|mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'description' => '',
            'street' => 'required',
            'districts' => 'required',
            'city' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'message' => 'check your request again',
                'status' => false), 400);
        } else {
            $petshop = new PetShop();
            $image = $request->file('image')->store('petshop');
            $petshop->image = $image;
            $petshop->name = $request->name;
            $petshop->description = $request->description;
            $petshop->street = $request->street;
            $petshop->districts = $request->districts;
            $petshop->city = $request->city;

            $petshop->save();
            return response()->json(
                Response::transform($petshop, "A new petshop has been created", true), 201
            );
        }
    }

    public function update(Request $request, $id)
    {
        $petshop = PetShop::find($id);
        if ($petshop != null) {
            if ($request->image != null) {
                if ($petshop->image != "default.png") {
                    Storage::delete($petshop->image);
                }
                $image = $request->file('image')->store('petshop');
                $petshop->image = $image;
            }
            if ($request->name != null) {
                $petshop->name = $request->name;
            }
            if ($request->description != null) {
                $petshop->description = $request->description;
            }
            if ($request->street != null) {
                $petshop->street = $request->street;
            }
            if ($request->districts != null) {
                $petshop->districts = $request->districts;
            }
            if ($request->city != null) {
                $petshop->city = $request->city;
            }
            $petshop->update();
            return response()->json(
                array(
                    'message' => 'A chosen petshop has been updated',
                    'status' => true,
                ), 200
            );
        } else {
            return response()->json(
                array(
                    'message' => 'Cannot update any data because no record found on this id',
                    'status' => false,
                ), 200
            );
        }
    }

    public function destroy($id)
    {
        $petshop = PetShop::find($id);
        if (is_null($petshop)) {
            return response() -> json(array('message'=>'cannot delete because record not found', 'status'=>false),200);
        } else {
            PetShop::destroy($id);
            return response() -> json(array('message'=>'A chosen petshop has been deleted', 'status' => false), 200);
        }
    }
}
