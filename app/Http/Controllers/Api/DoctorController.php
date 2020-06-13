<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        return response()->json(Response::transform(Doctor::all(), 'All Doctor found', true), 200);
    }

    public function show($id)
    {
        $doctor = Doctor::find($id);
        if (is_null($doctor)) {
            return response()->json(array('message' => 'record not found', 'status' => false), 200);
        } else {
            return response()->json(Response::transform($doctor, "A doctor found", true), 200);
        }
    }
}
