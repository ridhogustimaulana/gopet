<?php

namespace App\Http\Controllers\PetshopAuth;

use App\UserPetshop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetshopController extends Controller
{

    /**
     * PetshopController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:petshop');
    }

    public function profile()
    {
        $user = UserPetshop::find(Auth::user()->id);
        return view('user-petshop.profile', [
            'user' => $user,
        ]);
    }
    
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $this->validate($request, [
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'name' => 'required',
            'email' => "required|email|unique:user_petshops,email,$id,id",
        ]);
        $user = UserPetshop::find($id);
        if ($request->image != null){
            $image = $request->file('image')->store('users');
            if ($user->image != 'default.png'){
                Storage::delete($user->image);
            }
            $user->image = $image;
        }
        $user->name = $request->name;
        if($user->email != $request->email){
            $user->email = $request->email;
        }
        if($request->password != null) {
            $user->password = bcrypt($request->password);
        }
//        return dd($user);
        $user->update();
        return redirect()->route('user-petshop.profile')->with(['success'=>'Your profile has been updated successfully']);
    }
}
