<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Response;
use App\User;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'phone' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'api_token' => bcrypt($request->email),
        ]);

        return response()->json(
            Response::transform($user, "A user has been registered", true), 201
        );
    }
}
