<?php

namespace App\Http\Controllers\front;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Country;
use App\Product;
use App\Coupon;
use App\Order;
use App\ProductsAttribute;
use App\DeliveryAddress;
use App\OrdersProduct;
use App\Cart;
use App\User;
use Session;
use Auth;
use App\Sms;
use DB;
class product_controller extends Controller
{
    //https://www.youtube.com/watch?v=wDq4IIRyTnE
    public function listing(Request $req){
        Paginator::useBootstrap();//new in laravel 8
//short filter using  ajax video number 
        if ($req->ajax()) { echo "yes"; die;
            
            $data = $req->all();
            //echo "<pre>"; print_r($data); die;
            $url = $data['url'];
            $cate_count = Category::where(['url'=>$url,'status'=>1])->count();

        if ($cate_count > 0) {
            //echo "category exists"; die;
            $category = Category::category_data($url);
            //echo "<pre>"; print_r($category); die;
            $category_pro = Product::with('brand')->whereIn('category_id',$category['cat_id'])->where('status',1);//->paginate(1);//->simplePaginate(1);

        //if sort option selected by user
        /*    if(isset($_GET['sort_item']) && !empty($_GET['sort_item'])){
                if ($_GET['sort_item']=="product_latest") {
                    $category_pro->orderBy('id','Desc');
                }elseif($_GET['sort_item']=="product_name_a_z") {
                    $category_pro->orderBy('id','Asc');
                }elseif($_GET['sort_item']=="product_name_z_a") {
                    $category_pro->orderBy('id','Desc');
                }elseif($_GET['sort_item']=="price_lowest") {
                    $category_pro->orderBy('product_price','Asc');
                }elseif($_GET['sort_item']=="price_highest") { 
                    $category_pro->orderBy('product_price','Desc');
                }  */
 //if  fabric filter is selected
 
        if (isset($data['fabric']) && !empty($data['fabric'])) {
                    $category_pro->whereIn('products.fabric',$data['fabric']);
            } 

        if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $category_pro->whereIn('products.sleeve',$data['sleeve']);
            }  

        if (isset($data['pattern']) && !empty($data['pattern'])) {
                    $category_pro->whereIn('products.pattern',$data['pattern']);
            } 

        if (isset($data['fit']) && !empty($data['fit'])) {
                    $category_pro->whereIn('products.fit',$data['fit']);
            } 

        if (isset($data['occassion']) && !empty($data['occassion'])) {
                    $category_pro->whereIn('products.occassion',$data['occassion']);
            }                

                if(isset($data['sort_item']) && !empty($data['sort_item'])){
                if ($data['sort_item']=="product_latest") {
                    $category_pro->orderBy('id','Desc');
                }elseif($data['sort_item']=="product_name_a_z") {
                    $category_pro->orderBy('id','Asc');
                }elseif($data['sort_item']=="product_name_z_a") {
                    $category_pro->orderBy('id','Desc');
                }elseif($data['sort_item']=="price_lowest") {
                    $category_pro->orderBy('product_price','Asc');
                }elseif($data['sort_item']=="price_highest") { 
                    $category_pro->orderBy('product_price','Desc');
                }


            }else{
                    $category_pro->orderBy('id','Desc');
            }

            $category_pro = $category_pro->paginate(1);
           //echo "<pre>"; print_r($category_pro); die;
            return view('front e-com.products.ajax_listing')->with(compact('category','category_pro','url'));
        }else{
            abort(404);
        }

        }else{
          $url = route::getFacadeRoot()->current()->uri(); 
         $cate_count = Category::where(['url'=>$url,'status'=>1])->count();

        if ($cate_count > 0) {
            //echo "category exists"; die;
            $category = Category::category_data($url);
            //echo "<pre>"; print_r($category); die;
            $category_pro = Product::with('brand')->whereIn('category_id',$category['cat_id'])->where('status',1);//->paginate(1);//->simplePaginate(1);

        /*    //if sort option selected by user
            if(isset($_GET['sort_item']) && !empty($_GET['sort_item'])){
                if ($_GET['sort_item']=="product_latest") {
                    $category_pro->orderBy('id','Desc');
                }elseif($_GET['sort_item']=="product_name_a_z") {
                    $category_pro->orderBy('id','Asc');
                }elseif($_GET['sort_item']=="product_name_z_a") {
                    $category_pro->orderBy('id','Desc');
                }elseif($_GET['sort_item']=="price_lowest") {
                    $category_pro->orderBy('product_price','Asc');
                }elseif($_GET['sort_item']=="price_highest") { 
                    $category_pro->orderBy('product_price','Desc');
                } 
            }else{
                    $category_pro->orderBy('id','Desc');
            } */

            $category_pro = $category_pro->paginate(1);
           //echo "<pre>"; print_r($category_pro); die;

    $product_filter = Product::product_filter();
    //echo "<pre>"; print_r($product_filter); die;
    $fabric_array = $product_filter['fabric_array'];
    $sleeve_array = $product_filter['sleeve_array'];
    $pattern_array = $product_filter['pattern_array']; 
    $fit_array = $product_filter['fit_array'];
    $occassion_array = $product_filter['occassion_array'];

    $page_name = "listing";
            return view('front e-com.products.listing')->with(compact('category','category_pro','url','fabric_array','sleeve_array','pattern_array','fit_array','occassion_array','page_name'));
        }else{

            echo "no";
        } 

        }	 
    } 

    public function details($id){ 
        $productDetails = Product::with(['category','brand','attribute'=>function($query){$query->where('status',1);},'images'])->find($id)->toArray();
        //echo "<pre>"; print_r($productDetails); die;
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');
        //echo "<pre>"; print_r($total_stock); die;
        $relatedProducts = Product::where('category_id',$productDetails['category']['id'])->where('id','!=',$id)->limit(3)->inRandomOrder()->get()->toArray();
        //echo "<pre>"; print_r($relatedProducts); die;
        return view('front e-com.products.prodect_detail')->with(compact('productDetails','total_stock','relatedProducts'));
    }

    public function getProductPrice(Request $req){
        if($req->ajax()){
            $data = $req->all();
            //echo "<pre>"; print_r($data); die;

           // $getProductPrice = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first();

            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'],$data['size']);
            return $getDiscountedAttrPrice;
    }
}

    public function addtocart(Request $req){
        if ($req->isMethod('post')) {
             $data = $req->all();
             //echo "<pre>"; print_r($data); die;

        // check product stock is available or not 
        // compare data by its row in database 
        $getProductSock = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first()->toArray();
        //echo $getProductSock['stock']; die; 
        if ($getProductSock['stock']<$data['quantity']) {
              $msg = "required quantity is not available!";
              Session::flash('login_error',$msg);
              return redirect()->back();
          }

          //generate session id if not exists
          $session_id = Session::get('session_id');
          if (empty($session_id)) {
               $session_id = Session::getId();
               Session::put('session_id',$session_id);
        //same session id is inserted in database as user is same        
           } 

          //save product in cart
         // Cart::insert(['session_id'=>$session_id,'product_id'=>$data['product_id'],'size'=>$data['size'],'quantity'=>$data['quantity']]);
           //by using this insert query there is null in created_at etc

     //user id logged in or not
     if (Auth::check()) {
               # user is logged in use user_is Auth
            $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>Auth::user()->id])->count();
        }else{
            //user is not logged in use session_id
            $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>Session::get('session_id')])->count();
        }      

        //check product if already exist in cart
        if ($countProducts>0) {
            $msg = "product already exists in cart!";
              Session::flash('login_error',$msg);
              return redirect()->back();
        }

        if (Auth::check()) {
            $user_id = Auth::user()->id;
        }else{
            $user_id = 0;
        }

           $cart = new Cart;
           $cart->session_id = $session_id;
           $cart->user_id = $user_id;
           $cart->product_id = $data['product_id'];
           $cart->size = $data['size'];
           $cart->quantity = $data['quantity'];
           $cart->save();

          $msg = 'product has been added in cart!';
          Session::flash('updated',$msg);
          return redirect('cart'); 
        }
    }

    public function cart(){
        $userCartItems = Cart::userCartItems();
        //echo "<pre>"; print_r($userCartItems); die;
        return view('front e-com.products.cart')->with(compact('userCartItems'));
    }

    public function updateCartItemQty(Request $req){
        if ($req->ajax()) {
            $data = $req->all();
            //echo "<pre>"; print_r($data); die;
            //$cartDetails = Cart::find($data)

            //get cart details
            $cartDetails = Cart::find($data['cartid']);

            //get available product stock
            $availableStock = ProductsAttribute::select('stock')->where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size']])->first()->toArray();
            //echo "demanded stock".$data['qty'];
            //echo "having stock".$availableStock['stock']; die;
 
            //check stock is available
            if ($data['qty']>$availableStock['stock']) {
                $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'out of stock',
                    'view'=>(String)View::make('front e-com.products.cart_items')->with(compact('userCartItems'))
                ]);
            }

            //check size availabe
            $availableSize = ProductsAttribute::where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size'],'status'=>1])->count();
            if ($availableSize==0) {
                 
                 $userCartItems = Cart::userCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'product size is not available',
                    'view'=>(String)View::make('front e-com.products.cart_items')->with(compact('userCartItems'))
                ]);
            }

            Cart::where('id',$data['cartid'])->update(['quantity'=>$data['qty']]);
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'status'=>true,
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('front e-com.products.cart_items')->with(compact('userCartItems'))
            ]);
        }
    }

    public function deletCartItem(Request $req){
        if ($req->ajax()) {
            $data = $req->all();
            //echo "<pre>"; print_r($data); die;
            Cart::where('id',$data['cartid'])->delete();
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('front e-com.products.cart_items')->with(compact('userCartItems'))
            ]);

        }
    }

    public function applyCoupon(Request $req){
        if ($req->ajax()) {
            $data = $req->all();
            //echo "<pre>"; print_r($data);
            $userCartItems = Cart::userCartItems();
            $couponCount = Coupon::where('coupon_code',$data['code'])->count();
            //echo "<pre>"; print_r($couponCount); die;
            if ($couponCount==0) {
                $userCartItems = Cart::userCartItems();
                $totalCartItems = totalCartItems();
                 return response()->json([
                    'status'=>false,
                    'message'=>'this coupon is not valid!',
                    'totalCartItems'=>$totalCartItems,
                    'view'=>(String)View::make('front e-com.products.cart_items')->with(compact('userCartItems'))
                    ]);            
                }else{
                //check for ether coupon conditions
                //get coupon fetails
                    $couponDetails = Coupon::where('coupon_code',$data['code'])->first();

                //check the coupon is inactive
                    if ($couponDetails->status==0) {
                         $message = "this coupon is not active";
                    }
                //check if coupon is expired
                $expiry_data = $couponDetails->expiry_data;
                $current_date = date('Y-m-d');
                if ($expiry_data < $current_date) {
                        $message = "This coupon is expired!";
                    }
                //check if coupon is from selected cate
                //get all selected cate from coupon
                $carArr = explode(",",$couponDetails->categories);

                //get cart item
                $userCartItems = Cart::userCartItems();

                 
                //check if coupon is belong to logged in user
                //get all selected users of coupon
                if (!empty($couponDetails->users)) {

                    $userArr = explode(",",$couponDetails->users);

                //get user id of all selected user
                foreach ($userArr as $key => $user) {
                     $getUserId = User::select('id')->where('email',$user)->first()->toArray();
                     $userID[] = $getUserId['id'];
                    }

                }
                
             //get cart total amount
             $total_amount = 0;   

                foreach ($userCartItems as $key => $item) {

                    //check if any item belong to coupon cate
                    if (!in_array($item['product']['category_id'],$carArr)) {
                        $message = "this coupon is not for one of the selected products!";
                    }

                    if (!empty($couponDetails->users)) {
                        if (!in_array($item['user_id'],$userID)) {
                              $message = "This coupon code is not for you!";
                        }
                    }    

                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']);
                    $total_amount = $total_amount + ($attrPrice['discounted_price'] * $item['quantity']);
                 } 
//echo $total_amount; die;
                    if (isset($message)) {
                        $userCartItems = Cart::userCartItems();
                        $totalCartItems = totalCartItems();
                        return response()->json([
                        'status'=>false,
                        'message'=>$message,
                        'totalCartItems'=>$totalCartItems,
                        'view'=>(String)View::make('front e-com.products.cart_items')->with(compact('userCartItems'))
                    ]);

                    }else{
                        //echo "coupon successfully redeemed";
                        //check if amount type is fixed or %
                        if ($couponDetails->amount_type=="Fixed"){
                            $couponAmount = $couponDetails->amount;
                        }else{
                            $couponAmount = $total_amount * ($couponDetails->amount/100);
                        }
                        $grand_total = $total_amount - $couponAmount;
                        //echo $couponAmount;

                        //add coupon code and amount in session var
                        Session::put('couponAmount',$couponAmount);
                        Session::put('couponCode',$data['code']);

                        $message = "Coupon code successfully applied. you are availing discount!";
                        $userCartItems = Cart::userCartItems();
                        $totalCartItems = totalCartItems();
                        return response()->json([
                        'status'=>true,
                        'message'=>$message,
                        'totalCartItems'=>$totalCartItems,
                        'couponAmount'=>$couponAmount,
                        'grand_total'=>$grand_total,
                        'view'=>(String)View::make('front e-com.products.cart_items')->with(compact('userCartItems'))
                    ]);
//if coupon is error then coupon discount will zero then we add plus product it will again show privous discount number will come again                       

                }   
            }
        }
    }

    public function checkout(Request $req){
        if ($req->isMethod('post')) {
            $data = $req->all();
            //echo Session::get('grand_total');
            if (empty($data['address_id'])) {
               $msg = "please select delivery address";
               Session::flash('login_error',$msg);
               return redirect()->back();
            }
            if (empty($data['payment_method'])) {
                $msg = "please select payment method";
                Session::flash('login_error',$msg);
                return redirect()->back();
            }
            //echo "<pre>"; print_r($data); die;

            if ($data['payment_method']=="COD") {
                $pay_by = "COD";
            }else{
                echo "coming soon"; die;
                $pay_by = "Prepaid";
            }

            //get delvery address from address_id

            $deliveryAddress = DeliveryAddress::where('id',$data['address_id'])->first()->toArray();
            //echo "<pre>"; print_r($deliveryAddress); die;

            DB::beginTransaction();

            //insert order details
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddress['name'];
            $order->address = $deliveryAddress['address'];
            $order->city = $deliveryAddress['city'];
            $order->state = $deliveryAddress['state'];
            $order->country = $deliveryAddress['country'];
            $order->pincode = $deliveryAddress['pincode'];
            $order->mobile = $deliveryAddress['mobile'];
            $order->email = Auth::user()->email;
            $order->shipping_charges = 0;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = "New";
            $order->payment_method = $pay_by;
            $order->payment_gateway = $data['payment_method'];
            $order->grand_total = Session::get('grand_total');
            $order->save();

           //get last order id
            $order_id = DB::getPdo()->lastInsertId();

            //get user cart items
            $cartItem = Cart::where('user_id',Auth::user()->id)->get()->toArray();
            foreach ($cartItem as $key => $item) {
                $cart_item = new OrdersProduct;
                $cart_item->order_id = $order_id;
                $cart_item->user_id = Auth::user()->id;

                $getProductDetails = Product::select('product_code','product_name','product_color')->where('id',$item['product_id'])->first()->toArray();

                $cart_item->product_id = $item['product_id'];
                $cart_item->product_code = $getProductDetails['product_code'];
                $cart_item->product_name = $getProductDetails['product_name'];   
                $cart_item->product_color = $getProductDetails['product_color'];
                $cart_item->product_size = $item['size'];

                $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']);

                $cart_item->product_price = $getDiscountedAttrPrice['product_price'];
                $cart_item->product_qty = $item['quantity'];
                $cart_item->save();
            }

            //insert order id in session variable
            Session::put('order_id',$order_id);

            DB::commit(); 

            if ($data['payment_method']=="COD") {

            //send order SMS
         /*   $message = "dear customer your order".$order_id."had been successfully placed with e-com website. we will intimate you once your order is shipped";
            $mobile = Auth::user()->mobile;
            Sms::sendSms($message,$mobile); */

            //send order email
            $orderDetails = Order::with('orders_products')->where('id',$order_id)->first()->toArray();
            //dd($orderDetails); die;
            //email
            $email = Auth::user()->email;
            $messageData = [
                'email' => $email,
                'name' => Auth::user()->name,
                'order_id' => $order_id,
                'orderDetails' => $orderDetails
            ];
            Mail::send('emails.order',$messageData,function($message) use($email){
                $message->to($email)->subject('order placed - e-com website');
            });
                return redirect('/thanks');

            }else{
                echo "prepaid method coming soon"; die;
            }

            echo "order placed"; die; 

        }
        $userCartItems = Cart::userCartItems();
        $deliveryAddress = DeliveryAddress::deliveryAddress();
        return view('front e-com.products.checkout')->with(compact('userCartItems','deliveryAddress'));
    }

    public function thanks(){
        if (Session::has('order_id')) {
            //empty the user cart
           Cart::where('user_id',Auth::user()->id)->delete();
           return view('front e-com.products.thanks');
        }else{
            return redirect('/cart');
        }
        
    }

    public function addEditAddress($id=null, Request $req){
        if ($id=="") {
            $title = "Add delivery address";
            $address = new DeliveryAddress;
            $msg = "delivery address added successfully!";
        }else{
            $title = "Edit delivery address";
            $msg = "delivery address edit successfully!";
            $address = DeliveryAddress::find($id);
        }

        if ($req->isMethod('post')) { 
            $data = $req->all();
            //echo "<pre>"; print_r($data); die;
            $rule = [//use field name of input
                'name' => 'required | regex:/^[\pL\s\-]+$/u',
                'address' => 'required',
                'city' => 'required | regex:/^[\pL\s\-]+$/u',
                'country' => 'required',
                'state' => 'required | regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
              ];
              $own_msg = [
                'name.required' => 'please enter your name',
                'name.regex' => 'please enter valid name',
                'address.required' => 'please enter your address',
                'city.required' => 'please enter your city',
                'city.regex' => 'please enter valid city',
                'country.required' => 'please enter your country',
                'state.required' => 'please enter your address',
                'state.regex' => 'please enter valid state',
                'mobile.required' =>'please enter contact number',
                'mobile.numeric' => 'please enter valide number',
            ];
          $this->validate($req,$rule,$own_msg);  

             $address->user_id = Auth::user()->id;
             $address->name = $data['name'];
             $address->address = $data['address'];
             $address->city = $data['city'];
             $address->state = $data['state'];
             $address->country = $data['country'];
             $address->pincode = $data['pin'];
             $address->mobile = $data['mobile'];
             $address->status = 1;
             $address->save();

            Session::put('updated',$msg);
            Session::forget('login_error');
             return redirect('checkout');
        }
        $country = Country::where('status',1)->get()->toArray();

        return view('front e-com.products.add_edit_address')->with(compact('title','country','address'));
    }

    public function delete_address($id){
        DeliveryAddress::where('id',$id)->delete();
        $msg = "delivery address deleted successfully!";
        Session::put('updated',$msg);
        return redirect()->back();
    }

}
