<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Session;

class brand_controller extends Controller
{
    //
    public function brands(){
    	Session::put('page','brands');
    	$brands = Brand::get();
    	$title_brand = "brands";
    	return view('admin dashboard.admin brand.admin_brands')->with(compact('brands','title_brand'));
    }

    public function updateBrandStatus(Request $req){
    	if ($req->ajax()) {
    		 $data = $req->all();
    		 //echo "<pre>"; print_r($data); die;
    		 if ($data['status']=="active") {
    		 	 $status = 0;
    		 }else{
    		 	$status = 1;
    		 }
    		 Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
    		 return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
    }
}

     public function add_edit_brand(Request $req , $id=null){
        if ($id == "") {
        	
        	$title_brand = "add brands";
        	$brand = new Brand;
        	$msg = "brand added successfully!";
        }else{
        	$title_brand = "edit brands";
        	$brand = Brand::find($id);
        	$msg = "brand updated successfully!";
        }

        if ($req->isMethod('post')) {
        	 $data = $req->all();
        	 //echo "<pre>"; print_r($data); die;
        	 //brand validation
         $rule = [//use field name of input
                'brand_name' => 'required | regex:/^[\pL\s\-]+$/u',
              ];
              $own_msg = [
                'brand_name.required' => 'please enter brand name',
                'brand_name.regex' => 'please enter valide brand  name',

            ];
          $this->validate($req,$rule,$own_msg);

          $brand->name = $data['brand_name'];
          $brand->status = 1; //or put defut value in database status 
          $brand->save();
        
        Session::flash('updated',$msg);
        return redirect('admin/brand');
}

        return view('admin dashboard.admin brand.add_edit_brand')->with(compact('title_brand','brand'));

     }

     public function delete_brand($id){
    //delete brand
    Brand::where('id',$id)->delete();
    $msg = 'brand deleted successfully!';
    Session::flash('updated',$msg);
    return redirect()->back();

}
}
 











































