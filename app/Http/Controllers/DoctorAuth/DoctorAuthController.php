<?php

namespace App\Http\Controllers\DoctorAuth;

use App\Doctor;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:doctor')->except('logoutDoctor');
    }

    public function showFormLogin()
    {
        return view('doctor.login');
    }

    public function login(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password], $request->member)) {
            return back()->withInput($request->only('email', 'remember'))->with(['error'=>'please insert correct email or password']);
        }
        return redirect()->route('doctor.home');
    }

    public function logoutDoctor() {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.showFormLogin');
    }
}
