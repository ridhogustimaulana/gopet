<?php

namespace App\Http\Controllers\Api;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        foreach ($items as $item) {
            $result[] = [
                'id' => $item->id,
                'image' => $item->image,
                'name' => $item->name,
                'price' => "Rp. ".number_format($item->price, 0, ',', '.'),
                'description' => $item->description,
                'category' => $item->category,
                'id_petshop' => $item->userPetshop->id,
                'petshop' => $item->userPetshop->name,
            ];
        }
        return response()->json([
            'message' => 'All item found',
            'status' => true,
            'data' => $result
        ],200);
    }

    public function show($id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            return response()->json([
                'mesaage' => 'A item found',
                'status' => true,
                'data' => [
                    'id' => $item->id,
                    'image' => $item->image,
                    'name' => $item->name,
                    'price' => "Rp. ".number_format($item->price, 0, ',', '.'),
                    'description' => $item->description,
                    'category' => $item->category,
                    'id_petshop' => $item->userPetshop->id,
                    'petshop' => $item->userPetshop->name
                ]
            ], 200);
        }
    }
}
