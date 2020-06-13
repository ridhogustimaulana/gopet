<?php

namespace App\Http\Controllers\Api;

use App\Response;
use App\WashingAndSpa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WashingAndSpaController extends Controller
{
    public function index()
    {
        return response()->json(Response::transform(WashingAndSpa::all(), 'All washing and spa found', true), 200);
    }

    public function show($id)
    {
        $washingAndSpa = WashingAndSpa::find($id);
        if (is_null($washingAndSpa)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            return response()->json(Response::transform($washingAndSpa, "A washing and spa found", true), 200);
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
            $washingAndSpa = new WashingAndSpa();
            $image = $request->file('image')->store('washing-and-spa');
            $washingAndSpa->image = $image;
            $washingAndSpa->name = $request->name;
            $washingAndSpa->description = $request->description;
            $washingAndSpa->street = $request->street;
            $washingAndSpa->districts = $request->districts;
            $washingAndSpa->city = $request->city;

            $washingAndSpa->save();
            return response()->json(
                Response::transform($washingAndSpa, "A new washing and spa has been created", true), 201
            );
        }
    }

    public function update(Request $request, $id)
    {
        $washingAndSpa = WashingAndSpa::find($id);
        if ($washingAndSpa != null) {
            if ($request->image != null) {
                if ($washingAndSpa->image != "default.png") {
                    Storage::delete($washingAndSpa->image);
                }
                $image = $request->file('image')->store('washing-and-spa');
                $washingAndSpa->image = $image;
            }
            if ($request->name != null) {
                $washingAndSpa->name = $request->name;
            }
            if ($request->description != null) {
                $washingAndSpa->description = $request->description;
            }
            if ($request->street != null) {
                $washingAndSpa->street = $request->street;
            }
            if ($request->districts != null) {
                $washingAndSpa->districts = $request->districts;
            }
            if ($request->city != null) {
                $washingAndSpa->city = $request->city;
            }
            $washingAndSpa->update();
            return response()->json(
                array(
                    'message' => 'A chosen washing and spa has been updated',
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
        $washingAndSpa = WashingAndSpa::find($id);
        if (is_null($washingAndSpa)) {
            return response() -> json(array('message'=>'cannot delete because record not found', 'status'=>false),200);
        } else {
            WashingAndSpa::destroy($id);
            return response() -> json(array('message'=>'A chosen washing and spa has been deleted', 'status' => false), 200);
        }
    }

}
