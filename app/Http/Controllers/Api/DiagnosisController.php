<?php

namespace App\Http\Controllers\Api;

use App\Diagnosis;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DiagnosisController extends Controller
{


    /**
     * DiagnosisController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function history()
    {
        $histories = Diagnosis::where('id_user', Auth::user()->id)->get();
        // return response()->json(Response::transform($histories, "All histories found", true), 200);
        $result=[];
        foreach($histories as $history){
            $result[] = [
                'id' => $history->id,
                'pet_name' => $history->pet_name,
                'id_doctor' => $history->doctor->id,
                'doctor' => $history->doctor->name,
                'diagnosis' => $history->diagnosis,
                'created_at' => $history->created_at->format('d-M-Y')
            ];
        }

        if ($result==[]) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        }else{
            return response()->json(
                [
                    'message' => "All Histories Found",
                    'status' => true,
                    'data' => $result
                ], 200
            );
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'id_doctor' => 'required',
            'pet_name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array(
                'message' => 'check your request again',
                'status' => false), 400);
        } else {
            $diagnosis = new Diagnosis();
            $diagnosis->id_doctor = $request->id_doctor;
            $diagnosis->id_user = Auth::user()->id;
            $diagnosis->pet_name = $request->pet_name;
            $diagnosis->save();
            return response()->json(
                Response::transform($diagnosis, "A new diagnosis has been created", true), 201
            );
        }
    }
}
