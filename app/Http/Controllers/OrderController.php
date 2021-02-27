<?php

namespace App\Http\Controllers;

use App\Order;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public static function getAllOrders(){
        $orders = Order::with('user', 'items', 'status')->latest()->get();
        return $orders;
    }
     public function filter(Request $request){
         if(!isset($request->date) && !isset($request->status)){
             return redirect(route('admin.orders'));
         }
         $query = Order::with('user', 'items', 'status');
         if(isset($request->status)){
             $query->where('status_id', 'LIKE', '%' . $request->status . '%');
         }
         if(isset($request->date)){
             $query->where('created_at', 'LIKE', '%' . $request->date . '%');
         }
         return view('admin.orders', ['orders' => $query->get()], ['statuses'=>Status::all()]);

     }
    public function info($id){
        $order = Order::with('user', 'items', 'status')->find($id);
        return view('admin.order_full_info')->with('order', $order);
    }
    public function userOrders(){
        $orders = Order::with('user', 'items', 'status')
            ->where('user_id', '=', Auth::id())
            ->latest()
            ->get();
        return view ('user.orders')->with('orders', $orders);
    }
}
