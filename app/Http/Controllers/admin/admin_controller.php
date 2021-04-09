<?php 

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use App\admin;
use Image;


class admin_controller extends Controller
{
    //
    public function dash(){
      Session::put('page','dashboard'); 
    	return view('admin dashboard.admin_dash');
    }
//////////////////////////////////////////////////////////////////
    
    public function login(Request $req){ 
    	//echo $pass = Hash::make('12345678');
    	//die;
    	if ($req->isMethod('post')) {
    		$data = $req->all();
    		//echo "<pre>";
    		//print_r($data); die;
        $valid = $req->validate([
            'email' => 'required|max:255',
            'pass' => 'required',
        ]);//we also use custome message also


    		if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['pass']])){

    			return redirect('/admin/dashboard');

    		}else{
               Session::flash('login_error','invalid email or password');
    			return redirect()->back(); 
    		}
    	}
    	return view('admin dashboard.admin_login');
    }
//////////////////////////////////////////////////////////////////

    public function out(){

        Auth::guard('admin')->logout();
        return redirect('/admin/login');
 
    }
//////////////////////////////////////////////////////////////////

    public function set(){
      Session::put('page','reset admin password');
       //echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
        $admin_data = admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin dashboard.admin_settings')->with(compact('admin_data'));
    }
//////////////////////////////////////////////////////////////////

    public function check_pass(Request $req){
        $data = $req->all();
        //echo "<pre>"; print_r($data);   //die;
       // echo "<pre>"; print_r(Auth::guard('admin')->user()->password);    die;
        if (Hash::check($data['current_id'],Auth::guard('admin')->user()->password)) {
             
             echo "true";
        }else{
            echo "false";
        }
    }
//////////////////////////////////////////////////////////////////

    public function update(Request $req){
        if ($req->isMethod('post')) {
             $data = $req->all();
            // echo "<pre>"; print_r($data); die;
             //check if current password is correct
         if (Hash::check($data['current_name'],Auth::guard('admin')->user()->password)) {
            //check if new and confirm password is matching
            if ($data['new_name']===$data['confirm_name']) {
                 admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_name'])]);
                 Session::flash('updated','password has been updated successfully');
                  return redirect()->back();

            }else{
                Session::flash('login_error','new password and confirm password not match');
                return redirect()->back();
            }
             
        }else{
             Session::flash('login_error','your current password is incorrect');
             return redirect()->back();
        }
        }
    }
//////////////////////////////////////////////////////////////////

    public function update_admin(Request $req){
      Session::put('page','update admin data');
        if ($req->isMethod('post')) { 
              $data = $req->all();
             // echo "<pre>"; print_r($data); die;
              $rule = [//use field name of input
                'name_name' => 'required | regex:/^[\pL\s\-]+$/u',
                'num_name' => 'required|numeric',
                'img_name' => 'image'
              ];
              $own_msg = [
                'name_name.required' => 'please enter your name',
                'name_name.regex' => 'please enter valid name',
                'num_name.required' =>'please enter contact number',
                'num_name.numeric' => 'please enter valide number',
                'img_name.image' => 'please enter valid image '
            ];
          $this->validate($req,$rule,$own_msg);
          //upload image
          if ($req->hasFile('img_name')) {
              $image = $req->file('img_name');
              if ($image->isValid()) {//get image extension
                $extension = $image->getClientOriginalExtension();
                //generate new image name
                $image_name = rand(111,99999).'.'.$extension;
                $image_path = 'e-com images/admin images/admin_pic/'.$image_name;
                //upload the image
                Image::make($image)->save($image_path);//resize(300,400)
              }elseif (!empty($data['admin_image'])) {
                 $image_name = $data['admin_image'];
              }else{
                $image_name = "";
              }
           } 
          //update admin data
          admin::where('email',Auth::guard('admin')->user()->email)->update(['name'=>$data['name_name'],'contact'=>$data['num_name'],'image'=>$image_name]);
          Session::flash('updated','admin data updated');
          return redirect()->back(); 
        }
        return view('admin dashboard.admin_data_update');
    }
}






























