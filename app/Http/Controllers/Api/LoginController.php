<?php

namespace App\Http\Controllers\Api;

use App\Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return response()->json(
                Response::transform($user, "Logged in", true), 201
            );
        } else {
            return response()->json(['error'=> 'Unathorized'], 401);
        }
    }
}
