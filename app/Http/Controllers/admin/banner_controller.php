<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use Session;
use Image;

class banner_controller extends Controller
{
    //
    public function banner(){ 
       Session::put('page','banners');
    	$banners = Banner::get()->toArray();
    	//dd($banner); die;
    	return view('admin dashboard.admin banner.admin_banner')->with(compact('banners'));
    }

     public function updateBanner(Request $req){
    	if ($req->ajax()) {
    		 $data = $req->all();
    		 //echo "<pre>"; print_r($data); die;
    		 if ($data['status']=="active") {
    		 	 $status = 0;
    		 }else{
    		 	$status = 1; 
    		 }
    		 Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
    		 return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
    } 
}


 public function deleteBanner($id){
    //get benner image
     $banner_image = Banner::where('id',$id)->first();

     //get banner image path
    $banner_image_path = 'e-com images/banner images/';

    //delete banner image if exists in banner folder
     if (file_exists($banner_image_path.$banner_image->image)) {
     	  unlink($banner_image_path.$banner_image->image);
     }

     //delete banner from banners table
     Banner::where('id',$id)->delete();

     Session::flash('updated','banner delete successfully');
     return redirect()->back();

}



public function addedit_banner(Request $req, $id = null){
            
            if($id == ""){ 
                //add banner
                $banner_data = new Banner;
                $title = "add banner image";
                $msg = "banner added successfully";
            }else{
                 //edit banner
                $banner_data = Banner::find($id);
                $title = "edit banner image";
                $msg = "banner updated successfully";
            }

            if ($req->isMethod('post')) {
                 
                 $data = $req->all();
                 //echo "<pre>"; print_r($data); die;
                 if (empty($data['link'])) {
                      $banner_data->link = "";
                 }else{
                      $banner_data->link = $data['link'];
                 }
                 
                 if (empty($data['title'])) {
                      $banner_data->title = "";
                 }else{
                      $banner_data->title = $data['title'];
                 }if (empty($data['alt'])) {
                      $banner_data->alt = "";
                 }else{
                      $banner_data->alt = $data['alt'];
                 }

                $banner_data->status = 1;


                 //upload banner image
          if ($req->hasFile('image')) {//check that main image is comming or not
            $image_tmp = $req->file('image');//image tempory path 
            if ($image_tmp->isValid()) {//if image is valide then go further
                
                //uploade image after resize
              $image_name = $image_tmp->getClientOriginalName();
              $extension =  $image_tmp->getClientOriginalExtension();

              //create new name of image
              $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;
              $banner_image_path = 'e-com images/banner images/'.$image_new_name;
              
              //upload banner image after resize
              Image::make($image_tmp)->resize(1170,480)->save($banner_image_path);
              //save banner image
              $banner_data->image = $image_new_name;

            }
          }

          $banner_data->save();
          Session::flash('updated',$msg);
          return redirect('admin/banner');

            }

            return view('admin dashboard.admin banner.add_edit_banner')->with(compact('title','banner_data'));
}
}


























 