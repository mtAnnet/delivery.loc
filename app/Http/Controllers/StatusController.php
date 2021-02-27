<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function cancel($id){
        $order = Order::find($id);
        $order->status_id = 3; //Отменен
        $order->save();
        return redirect(route('admin.orders.info', ['id'=>$id]));
    }
    public function done($id){
        $order = Order::find($id);
        $order->status_id = 1; //Выполнен
        $order->save();
        return redirect(route('admin.orders.info', ['id'=>$id]));
    }
}
