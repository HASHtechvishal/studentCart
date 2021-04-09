<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\User;
use Session;
use Auth;
use App\Cart; 
use App\Sms;
use App\Country;

class UsersController extends Controller
{
    public function loginRegister(){
    	return view('front e-com.user.login_register');
    }

    public function RegisterUser(Request $req){ 
    	if($req->isMethod('post')){
            Session::forget('login_error');
            Session::forget('updated');

    		$data = $req->all();
    		//echo "<pre>"; print_r($data); die;

    		//check user already exist
    		$userCount = User::where('email',$data['email'])->count();
    		//echo $userCount; die;
    		if ($userCount>0) {
    			$msg = "email already exists";
    			Session::flash('login_error',$msg);
    			return redirect()->back();
    		}else{
    			//register the user
    			$user = new User;
    			$user->name = $data['name'];
    			$user->mobile = $data['mobile'];
    			$user->email = $data['email'];
    			$user->password = bcrypt($data['password']);
    			$user->status = 0;
    			$user->save();

                //send confirmation email,[]
                $email = $data['email'];
                $messageData = [
                    'email'=>$data['email'],
                    'name'=>$data['name'],
                    'code'=>base64_encode($data['email'])
                ];
                Mail::send('emails.confirmation',$messageData,function($message) use($email){
                    $message->to($email)->subject('confirm your account');
                });
                //redirect back with success message
                $msg = "please confirm your email to activate your account";
                Session::put('updated',$msg);
                return redirect()->back(); 

    //			if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {

//update user cart with user id
    //                if (!empty(Session::get('session_id'))) {
    //                    $user_id = Auth::user()->id;
    //                    $session_id = Session::get('session_id');
    //                    Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
    //                }

                    //send register sms
                   // $message = "Dear user, thanks for login, your login is successfully your orders is on the way";
                   // $mobile = $data['mobile'];
                  //  Sms::sendSms($message,$mobile);

                    //send register email
    //                $email = $data['email'];
    //                $messageData = ['name'=>$data['name'],'mobile'=>$data['mobile'],'email'=>$data['email']];
    //                Mail::send('emails.register',$messageData,function($message) use($email){
    //                    $message->to($email)->subject('welcome to e-com website');
    //                });
    				 //echo "<pre>"; print_r(Auth::user()); die;
    //				return redirect('/');
    //			}
    		} 
    	}
    }


    public function confirmAccount($email){
        Session::forget('login_error');
            Session::forget('updated');

        //decode user email
        $email = base64_decode($email);
        //echo $email; die;

        //check user email exist
        $userCount = User::where('email',$email)->count();
        if ($userCount>0) {
            # user email is already activated or not
            $userDetails = User::where('email',$email)->first();
            if ($userDetails->status == 1) {
                $msg = "your email account is already activated. please login";
                Session::put('login_error',$msg);
                return redirect('login-register');
            }else{
                //update user status to 1 
                User::where('email',$email)->update(['status'=>1]);

                    //send register email
                    $messageData = ['name'=>$userDetails['name'],'mobile'=>$userDetails['mobile'],'email'=>$email];
                    Mail::send('emails.register',$messageData,function($message) use($email){
                        $message->to($email)->subject('welcome to e-com website');
                    });

                $msg = "your email account is activated. please login now";
                Session::put('updated',$msg);
                return redirect('login-register');
            }
        }else{
            about(404);
        }

    }

    public function checkEmail(Request $req){
    	//check if email exist
    	$data = $req->all();
    	$emailCount = User::where('email',$data['email'])->count();
    	if ($emailCount>0) {
    		return "false";
    	}else{
    		return "true";
    	} 
    }

    public function loginUser(Request $req){
            Session::forget('login_error');
            Session::forget('updated');

        if ($req->isMethod('post')) {
            $data = $req->all();
            //echo "<pre>"; print_r($data); die;
            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {

                //check email is activated or not
                $userStatus = User::where('email',$data['email'])->first();
                if ($userStatus->status == 0) {
                    Auth::logout();
                    $msg = "your account is not activated yet! please confirm your email to activate!";
                    Session::put('login_error',$msg);
                    return redirect()->back();
                }

                //update user cart with user id
                if (!empty(Session::get('session_id'))) {
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                }
                return redirect('/');
            }else{
                $msg = "invalide username or password";
                Session::flash('login_error',$msg);
                return redirect()->back();
            }
        }
    }
 
    public function logoutUser(){
    	Auth::logout();
    	return redirect('/');
    }

    public function forgotPassword(Request $req){
       
        if ($req->isMethod('post')) {
            $data = $req->all();
            //echo "<pre>"; print_r($data); die;
            $emailCount = User::where('email',$data['email'])->count();
            if ($emailCount==0) {
                $msg = "email does not exists!, please register your email";
                Session::put('login_error',$msg);
                return redirect()->back();
            }
            //generate random pass
            $random_pass = bin2hex(openssl_random_pseudo_bytes(10));
            //echo $random_pass; die;
            //encode password
            $new_password = bcrypt($random_pass);

            //update password
            USer::where('email',$data['email'])->update(['password'=>$new_password]);
            //get user name
            $userName = User::select('name')->where('email',$data['email'])->first();

            //send forgot password email
            $email = $data['email'];
            $name = $userName->name;
            $messageData = [
                'email' => $email,
                'name' => $name,
                'password' => $random_pass
            ];
            Mail::send('emails.forgot_password',$messageData,function($message) use($email){
                $message->to($email)->subject('new password of your account');
            });
            $msg = "please check your email for new password";
                Session::put('updated',$msg);
            Session::forget('updated');
                return redirect('login-register');

        }
        return view('front e-com.user.forgot_password');
    }

    public function account(Request $req){
                    Session::forget('updated');
        $user_id = Auth::user()->id;
        //echo $user_id; die;
        $userDetails = User::find($user_id)->toArray();
        //echo "<pre>"; print_r($userDetails); die;
        
        $country = Country::where('status',1)->get()->toArray();
        //echo "<pre>"; print_r($country); die;

        if ($req->isMethod('post')) {  
             $data = $req->all();
             //echo "<pre>"; print_r($data); die;

              $rule = [//use field name of input
                'name' => 'required | regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric',
              ];
              $own_msg = [
                'name.required' => 'please enter your name',
                'name.regex' => 'please enter valid name',
                'mobile.required' =>'please enter contact number',
                'mobile.numeric' => 'please enter valide number',
            ];
          $this->validate($req,$rule,$own_msg);


             $user = User::find($user_id);
             $user->name = $data['name'];
             $user->address = $data['address'];
             $user->city = $data['city'];
             $user->state = $data['state'];
             $user->country = $data['country'];
             $user->pincode = $data['pin'];
             $user->mobile = $data['mobile'];
             $user->save();

            $msg = "your account details has been updated successfully!";
            Session::put('updated',$msg);
            Session::forget('login_error');
             return redirect()->back();

        }
        return view('front e-com.user.account')->with(compact('userDetails','country'));
    }

    public function chkUserPassword(Request $req){
        if ($req->isMethod('post')) {
             $data = $req->all();
             //echo "<pre>"; print_r($data); die;
             $user_id = Auth::user()->id;
             $chkPassword = User::select('password')->where('id',$user_id)->first();
             if (Hash::check($data['current_pwd'],$chkPassword->password)) {
                  return "true";
             }else{
                return "false";
             }
        }
    }


    public function updateUserPassword(Request $req){
        Session::forget('updated');
        if ($req->isMethod('post')) {
             $data = $req->all();
             //echo "<pre>"; print_r($data); die;
             $user_id = Auth::user()->id; 
             $chkPassword = User::select('password')->where('id',$user_id)->first();
             if (Hash::check($data['current_pwd'],$chkPassword->password)) {
            //update current password
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',$user_id)->update(['password'=>$new_pwd]);

            $msg = "password updated successfully!";
            Session::put('updated',$msg);
            Session::forget('login_error');
             return redirect()->back();

             }else{

            $msg = "Current password is Incurrent!";
            Session::put('login_error',$msg);
            Session::forget('updated');
             return redirect()->back();

             }
        }
    }
}
