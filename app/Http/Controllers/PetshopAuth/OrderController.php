<?php

namespace App\Http\Controllers\PetshopAuth;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    //
    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:petshop');
    }

    public function index() {
        $orders = Order::orderBy('created_at', 'DESC')->where('id_petshop', Auth::user()->id)->paginate(10);
        return view('user-petshop.order.order', [
            'orders' => $orders,
            'total' => $orders->total(),
            'perPage' => $orders->perPage(),
            'currentPage' => $orders->currentPage(),
        ]);
    }

    public function update(Request $request, $id) {
        $order = Order::find($id);
        if ($order->status){
            $order->status = false;
        } else {
            $order->status = true;
        }
        $order->update();
        return redirect()->route('user-petshop.order');
    }
}
