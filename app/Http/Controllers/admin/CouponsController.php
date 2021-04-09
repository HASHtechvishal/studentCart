<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
use Session;
use App\Section;
use App\User;

class CouponsController extends Controller
{ 
    //
    public function coupons(){
    	Session::put('page','coupon');
    	$coupons = Coupon::get()->toArray();
    	//echo "<pre>"; print_r($coupons); die;
    	return view('admin dashboard.admin coupons.coupons')->with(compact('coupons'));
    } 

    public function updateCouponStatus(Request $req){
    	if ($req->ajax()) {
    		 $data = $req->all();
    		 //echo "<pre>"; print_r($data); die;
    		 if ($data['status']=="active") {
    		 	 $status = 0;
    		 }else{
    		 	$status = 1; 
    		 }
    		 Coupon::where('id',$data['coupon_id'])->update(['status'=>$status]);
    		 return response()->json(['status'=>$status,'coupon_id'=>$data['coupon_id']]);
    } 
}

     public function addedit_coupon(Request $req, $id=null){
     	if ($id=="") {
     		# add coupon
     		$coupon = new Coupon;
     		$selCats = array();
     		$selUsers = array();   
     		$title = "Add coupon";
     		$msg = 'coupon added successfully!';
     	}else{
     		//update coupon
     		$coupon = Coupon::find($id);
     		$selCats = explode(',',$coupon['categories']);
     		$selUsers = explode(',',$coupon['users']); 
     		$title = "edit coupon";
     		$msg = 'coupon updated successfully!';
     	}

     	if ($req->isMethod('post')) {
     		$data = $req->all();
     		//echo "<pre>"; print_r($data); die;

     		$rule = [//use field name of input
                'category' => 'required', 
                'coupon_option' => 'required',
                'amount_type' => 'required',
                'amount' => 'required | numeric',
                'expiry_date' => 'required',
              ];
              $own_msg = [
                'category.required' => 'please select category name',
                'coupon_option.required' => 'please select coupon option',
                'amount_type.required' => 'please select amount type',
                'amount.required' =>'please enter amount',
                'amount.numeric' =>'please enter valid amount',
                'expiry_date.required' => 'please enter expiry date',
            ];
          $this->validate($req,$rule,$own_msg);


     		if (isset($data['users'])) {
     			$user = implode(',', $data['users']); 
     		}else{
     			$user = "";
     		}
     		if (isset($data['category'])) {
     			$category = implode(',', $data['category']);
     			     		//echo $category; die; 
     		}
     		if ($data['coupon_option']=="Automatic") {
     			$coupon_code =  bin2hex(openssl_random_pseudo_bytes(5));
     		}else{
     			$coupon_code = $data['coupon_code'];
     		}
     		//echo $coupon_code; die;
     		$coupon->coupon_option = $data['coupon_option'];
     		$coupon->coupon_code = $coupon_code;
     		$coupon->categories = $category;
     		$coupon->users = $user;
     		$coupon->coupon_type = $data['coupon_type'];
     		$coupon->amount_type = $data['amount_type'];
     		$coupon->amount = $data['amount'];
     		$coupon->expiry_data = $data['expiry_date'];
     		$coupon->status = 1;
     		$coupon->save();

             Session::flash('updated',$msg);
             return redirect('admin/coupons');

     	}

     	//sections with categories and sub categories
    $categories = Section::with('categories')->get();
    $categories = json_decode(json_encode($categories),true);
    //echo "<pre>"; print_r($categories); die;

    //user 
    $users = User::select('email')->where('status',1)->get()->toArray();

     	return view("admin dashboard.admin coupons.add_edit_coupon")->with(compact('title','coupon','categories','users','selCats','selUsers'));
     }


     public function deleteCoupon($id){
    //delete brand
    Coupon::where('id',$id)->delete();
    $msg = 'coupon deleted successfully!';
    Session::flash('updated',$msg);
    return redirect()->back();

}


}
