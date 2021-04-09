<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Order;
use Auth;

class OrdersController extends Controller
{
    public function  orders(){
    	$orders = Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
    	//dd($orders); die;

    	return view('front e-com.orders.order')->with(compact('orders')); 
    }

    public function ordersDetails($id){
    	$orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
    	//dd($orderDetails); die;
    	return view('front e-com.orders.order_detail')->with(compact('orderDetails'));
    }
}
