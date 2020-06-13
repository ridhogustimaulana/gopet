<?php

namespace App\Http\Controllers\PetshopAuth;

use App\PetShop;
use App\UserPetshop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PetshopAuthController extends Controller
{


    /**
     * PetshopAuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest:petshop')->except('logoutUserPetshop');
    }

    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function showFormRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:user_petshops',
            'password' => 'required|min:6',
        ]);

        UserPetshop::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('user-petshop.show-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (!Auth::guard('petshop')->attempt(['email' => $request->email, 'password' => $request->password], $request->member)) {
            return back()->withInput($request->only('email', 'remember'))->with(['error'=>'please insert correct email or password']);
        }
        return redirect()->route('user-petshop.home');
    }

    public function logoutUserPetshop() {
        Auth::guard('petshop')->logout();
        return redirect('petshop/login');
    }
}
