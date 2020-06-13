<?php

namespace App\Http\Controllers\Api;

use App\Medicine;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    public function index()
    {
        return response()->json(Response::transform(Medicine::all(), 'All medicines found', true), 200);
    }

    public function show($id)
    {
        $medicine = Medicine::find($id);
        if (is_null($medicine)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            return response()->json(Response::transform($medicine, "A medicine found", true), 200);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'image' => 'required|mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'seller' => 'required|string',
            'category' => '',
            'description' => ''
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'message' => 'check your request again',
                'status' => false), 400);
        } else {
            $medicine = new Medicine();
            $image = $request->file('image')->store('medicines');
            $medicine->image = $image;
            $medicine->name = $request->name;
            $medicine->price = $request->price;
            $medicine->seller = $request->seller;
            $medicine->category = $request->category;
            $medicine->description = $request->description;
            $medicine->save();

            return response()->json(
                Response::transform($medicine, "A new medicine has been created", true), 201
            );
        }
    }
    
    public function update(Request $request, $id)
    {
        $medicine = Medicine::find($id);
        if ($medicine != null) {
            if ($request->image != null) {
                if ($medicine->image != "default.png") {
                    Storage::delete($medicine->image);
                }
                $image = $request->file('image')->store('medicines');
                $medicine->image = $image;
            }
            if ($request->name != null) {
                $medicine->name = $request->name;
            }
            if ($request->price != null) {
                $medicine->price = $request->price;
            }
            if ($request->seller != null) {
                $medicine->seller = $request->seller;
            }
            if ($request->category != null) {
                $medicine->category = $request->category;
            }
            if ($request->description != null) {
                $medicine->description = $request->description;
            }
            $medicine->update();
            return response()->json(
                array(
                    'message' => 'A chosen medicine has been updated',
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
        $medicine = Medicine::find($id);
        if (is_null($medicine)) {
            return response() -> json(array('message'=>'cannot delete because record not found', 'status'=>false),200);
        } else {
            Medicine::destroy($id);
            return response() -> json(array('message'=>'A chosen medicine has been deleted', 'status' => false), 200);
        }
    }
}
