<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPetshopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:petshop');
    }

    public function index() {
        return view('user-petshop.app');
    }
}
