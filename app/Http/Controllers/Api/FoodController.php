<?php

namespace App\Http\Controllers\Api;

use App\Food;
use App\UserPetshop;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        // return response()->json(Response::transform(Food::all(), 'All foods found', true), 200);
        foreach($foods as $food) {
            $result[] = [
                'id' => $food->id,
                'image' => $food->image,
                'name' => $food->name,
                'price' => $food->price,
                'description' => $food->description,
                'category' => $food->category,
                'id_petshop' => $food->userPetshop->id,
                'petshop' => $food->userPetshop->name,
            ];
        }

        return response()->json([
            'message' => 'All Food Found',
            'status' => true,
            'data' => $result
        ],200);
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
            $food = new Food();
            $image = $request->file('image')->store('foods');
            $food->image = $image;
            $food->name = $request->name;
            $food->price = $request->price;
            $food->seller = $request->seller;
            $food->category = $request->category;
            $food->description = $request->description;
            $food->save();

            return response()->json(
                Response::transform($food, "A new food has been created", true), 201
            );
        }
    }

    public function show($id)
    {
        $food = Food::find($id);
        if (is_null($food)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            // return response()->json(Response::transform($food, "a food found", true), 200);

            return response()->json([
                'mesaage' => 'A food found',
                'status' => true,
                'data' => [
                    'id' => $food->id,
                    'image' => $food->image,
                    'name' => $food->name,
                    'price' => $food->price,
                    'description' => $food->description,
                    'category' => $food->category,
                    'id_petshop' => $food->userPetshop->id,
                    'petshop' => $food->userPetshop->name
                ]
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        if ($food != null) {
            if ($request->image != null) {
                if ($food->image != "default.png") {
                    Storage::delete($food->image);
                }
                $image = $request->file('image')->store('foods');
                $food->image = $image;
            }
            if ($request->name != null) {
                $food->name = $request->name;
            }
            if ($request->price != null) {
                $food->price = $request->price;
            }
            if ($request->seller != null) {
                $food->seller = $request->seller;
            }
            if ($request->category != null) {
                $food->category = $request->category;
            }
            if ($request->description != null) {
                $food->description = $request->description;
            }
            $food->update();
            return response()->json(
                array(
                    'message' => 'A chosen food has been updated',
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
        $food = Food::find($id);
        if (is_null($food)) {
            return response() -> json(array('message'=>'cannot delete because record not found', 'status'=>false),200);
        } else {
            Food::destroy($id);
            return response() -> json(array('message'=>'A chosen food has been deleted', 'status' => false), 200);
        }
    }
}
