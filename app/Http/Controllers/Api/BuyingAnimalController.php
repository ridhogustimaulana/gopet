<?php

namespace App\Http\Controllers\Api;

use App\BuyingAnimal;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Monolog\Handler\IFTTTHandler;

class BuyingAnimalController extends Controller
{
    public function index()
    {
        return response()->json(Response::transform(BuyingAnimal::all(), 'All Animals found', true), 200);
    }

    public function show($id)
    {
        $buyingAnimal = BuyingAnimal::find($id);
        if (is_null($buyingAnimal)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            return response()->json(Response::transform($buyingAnimal, "An animal found", true), 200);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'image' => 'required|mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'address' => 'required',
            'phone' => 'required',
            'description' => '',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'message' => 'check your request again',
                'status' => false), 400);
        } else {
            $buyingAnimal = new BuyingAnimal();
            $image = $request->file('image')->store('buying-animal');
            $buyingAnimal->image = $image;
            $buyingAnimal->name = $request->name;
            $buyingAnimal->address = $request->address;
            $buyingAnimal->phone = $request->phone;
            $buyingAnimal->description = $request->description;

            $buyingAnimal->save();

            return response()->json(
                Response::transform($buyingAnimal, "A new animal has been created", true), 201
            );
        }
    }

    public function update(Request $request, $id)
    {
        $buyingAnimal = BuyingAnimal::find($id);
        if ($buyingAnimal != null) {
            if ($request->image != null) {
                if ($buyingAnimal->image != "default.png") {
                    Storage::delete($buyingAnimal->image);
                }
                $image = $request->file('image')->store('buying-animal');
                $buyingAnimal->image = $image;
            }
            if ($request->name != null) {
                $buyingAnimal->name = $request->name;
            }
            if ($request->address != null) {
                $buyingAnimal->address = $request->address;
            }
            if ($request->phone != null) {
                $buyingAnimal->phone = $request->phone;
            }
            if ($request->description != null) {
                $buyingAnimal->description = $request->description;
            }
            $buyingAnimal->update();
            return response()->json(
                array(
                    'message' => 'A chosen animal has been updated',
                    'status' => true,
                ),200
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
        $buyingAnimal = BuyingAnimal::find($id);
        if (is_null($buyingAnimal)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            BuyingAnimal::destroy($id);
            return response() -> json(array('message'=>'A chosen animal has been deleted', 'status' => false), 200);
        }
    }

}
