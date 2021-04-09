<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Order;
use App\Sms;
use Session;
use App\User;
use App\OrderStatus;
use App\OrdersLog;

class OrdersController extends Controller
{
    public function orders(){
    	Session::put('page','orders');
    	$orders = Order::with('orders_products')->orderBy('id','Desc')->get()->toArray();
    	//dd($orders); die;
    	return view('admin dashboard.admin order.adminOrder')->with(compact('orders')); 
    }

    public function ordersDetails($id){
    	$orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
    	//dd($orderDetails); die;
    	$userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
    	//dd($userDetails); die;

    	$orderStatus = OrderStatus::where('status',1)->get()->toArray();
    	//dd($orderStatus); die;

        //get all order logs
        $orderLog = OrdersLog::where('order_id',$id)->orderBy('id','Desc')->get()->toArray();
    	return view('admin dashboard.admin order.adminOrder_details')->with(compact('orderDetails','userDetails','orderStatus','orderLog'));
    }


    public function updateOrderStatus(Request $req){
    	if ($req->isMethod('post')) {
    		$data = $req->all();
    		//echo "<pre>"; print_r($data); die;
    		Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
    		Session::put('updated','order status has been updated successfully');
            //update courier name and number
            if (!empty($data['courier_name']) && !empty($data['tracking_number'])) {
                
                Order::where('id',$data['order_id'])->update(['courier_name'=>$data['courier_name'],'tracking_number'=>$data['tracking_number']]);
            }
            //get user mobile
            $deliveryDetails = Order::select('mobile','email','name')->where('id',$data['order_id'])->first()->toArray();

            //sms register sms
        /*    $message = "dear customer your order #".$data['order_id']." status has been updated to ".$data['order_status']." placed with e-com website";
            $mobile = $deliveryDetails['mobile'];
            Sms::sendSms($message,$mobile); */

            //send order email
            $orderDetails = Order::with('orders_products')->where('id',$data['order_id'])->first()->toArray();
            //dd($orderDetails); die;
            //email
            $email = $deliveryDetails['email'];
            $messageData = [
                'email' => $email,
                'name' => $deliveryDetails['name'],
                'order_id' => $data['order_id'],
                'courier_name' => $data['courier_name'],
                'tracking_number' => $data['tracking_number'],
                'order_status' => $data['order_status'],
                'orderDetails' => $orderDetails
            ];
            Mail::send('emails.order_status',$messageData,function($message) use($email){
                $message->to($email)->subject('order Status Updated - e-com website');
            });

            //update order logs
            $log = new OrdersLog;
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();

            return redirect()->back();
    	}
    }


    public function viewOrderInvoice($id){
        $orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
        $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();

        return view('admin dashboard.admin order.adminOrder_invoice')->with(compact('orderDetails','userDetails'));
    }
}
