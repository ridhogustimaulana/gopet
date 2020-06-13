<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\UserPetshop;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }
    
    public function userPetshop()
    {
        $userPetshops = UserPetshop::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.user-petshop.user-petshop', [
            'userPetshops' => $userPetshops,
            'total' => $userPetshops->total(),
            'perPage' => $userPetshops->perPage(),
            'currentPage' => $userPetshops->currentPage(),
        ]);
    }

    public function user()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.user.user', [
            'users' => $users,
            'total' => $users->total(),
            'perPage' => $users->perPage(),
            'currentPage' => $users->currentPage(),
        ]);
    }

    public function item()
    {
        $items = Item::orderBy('created_at', 'DESC')->paginate();
        return view('admin.item.item', [
            'items' => $items,
            'total' => $items->total(),
            'perPage' => $items->perPage(),
            'currentPage' => $items->currentPage(),
        ]);
    }
}
