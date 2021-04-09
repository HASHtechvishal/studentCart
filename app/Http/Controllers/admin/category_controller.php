<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Session;
use App\Section;
use Image;

class category_controller extends Controller
{
    // 
    public function cate(){
    	    Session::put('page','categories');

    	    $cates = Category::with('section','parent_cate')->get();
//with(['section'=>function($query){
//$query->select('id','name');
//}])->get();
//it help to show id and name              
    	    $cates = json_decode(json_encode($cates));//for debug error
    	    //echo "<pre>"; print_r($cates); die;
    	    return view('admin dashboard.admin category.admin_category')->with(compact('cates'));

    }
        public function updateCategoryStatus(Request $req){
    	if ($req->ajax()) {
    		 $data = $req->all();
    		 //echo "<pre>"; print_r($data); die;
    		 if ($data['status']=="active") {
    		 	 $status = 0;
    		 }else{
    		 	$status = 1;
    		 }
    		 Category::where('id',$data['category_id'])->update(['status'=>$status]);
    		 return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
    }
} 
        
        public function add_edit(Request $req, $id=null){
            if ($id=="") {
                $title = "add category";
                //add category functionality
                $cate = new Category;//in case of geting data from form post method is common for both case but different is in add category ake we need insert query in add 
                $edit_cate = array();
                $get_cate = array();//to show the cate level
                $msg = "category added successfully!";//for session msg for added
            }else{
                $title = "edit category";
                //edit category function
                //in case of edit we need update query for edit
                //$cate = new Category;
                $edit_cate = Category::where('id',$id)->first();
                $edit_cate = json_decode(json_encode($edit_cate),true);
                 //echo "<pre>"; print_r($edit_cate); die;
                $get_cate = Category::with('subCategories')->where(['parent_id'=>0,'section_id'=>$edit_cate['section_id']])->get();
                $get_cate = json_decode(json_encode($get_cate),true);
                //echo "<pre>"; print_r($edit_cate); die;
                $cate = Category::find($id);//dont cange the variable //this is for update cate
                $msg = "category updated successfully!"; //for update   
            }

            if ($req->isMethod('post')) {
                 $data = $req->all();
                // echo "<pre>"; print_r($data); die;

                 $rule = [//use field name of input
                'cate_name' => 'required | regex:/^[\pL\s\-]+$/u',
                'section_name' => 'required',
                'cate_url' => 'required',
                'cate_img' => 'image'
              ];
              $own_msg = [
                'cate_name.required' => 'please enter category name',
                'cate_name.regex' => 'please enter valid name',
                'section_name.required' =>'please select section',
                'cate_url.required' =>'please enter url',
                'cate_img.image' => 'please enter valid image ',
            ];
          $this->validate($req,$rule,$own_msg);

                 // Upload Category Image
            if($req->hasFile('cate_img')){
                $image_tmp = $req->file('cate_img');
                if($image_tmp->isValid()){
                    // Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'e-com images/category images/'.$imageName;
                    // Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                    // Save Category Image
                    $cate->category_image = $imageName;
                }
            }
                //I was edit database.php, I changed 'strict' from 'true' to 'false'.
//Now the path in db no longer properly saved (field is empty), and image folder is also empty..

            if (empty($data['cate_dis'])) {//agar user koe b field nai fill karna chata to if conition kare de
                 $data['cate_dis'] = "";
            }
            if (empty($data['cate_des'])) {
                 $data['cate_des'] = "";
            }
            if (empty($data['meta_t'])) {
                 $data['meta_t'] = "";
            }
            if (empty($data['meta_des'])) {
                 $data['meta_des'] = "";
            }
            if (empty($data['meta_key'])) {
                 $data['meta_key'] = "";
            }

                 $cate->parent_id = $data['parent_name'];
                 $cate->section_id = $data['section_name'];
                 $cate->category_name = $data['cate_name'];
                 $cate->category_discount = $data['cate_dis'];
                 $cate->description = $data['cate_des'];
                 $cate->url = $data['cate_url'];
                 $cate->meta_title = $data['meta_t'];
                 $cate->meta_description = $data['meta_des'];
                 $cate->meta_keywords = $data['meta_key'];
                 $cate->status = 1;
                 $cate->save(); 
               // echo "<pre>"; print_r($data); die;

                 Session::flash('updated',$msg);
                 return redirect('admin/categories');
            }

            //get all section
            $get_section = Section::get();

            return view('admin dashboard.admin category.admin_add_edit')->with(compact('title','get_section','edit_cate','get_cate'));
   //we have to add empty array of $edit_cate in add category so it dont show error          
        }

public function cateLevel(Request $req){
 
    if ($req->ajax()) { //add csrf skip token in verifycsrftoken.php file
         $data = $req->all();
         //echo "<pre>"; print_r($data); die;
         $get_cate_level = Category::with('subCategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();//only those section is active will shown
         //parent_id , status from database
         $get_cate_level = json_decode(json_encode($get_cate_level),true);
         //echo "<pre>"; print_r($get_cate_level); die;
         return view('admin dashboard.admin category.admin_category_level')->with(compact('get_cate_level'));
    }

}

public function delete_image($id){//we have to delete image from folder and database  
 //https://www.youtube.com/watch?v=hWhXswKwYHw&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=27   
    //get category image
    $cate_image = Category::select('category_image')->where('id',$id)->first();
    //get category image path
    $image_path = 'e-com images/category images/';

    //delete category image from category_images folder if exists
    if(file_exists($image_path.$cate_image->category_image)){
        unlink($image_path.$cate_image->category_image);
    }

    //delete category image from categories table
    Category::where('id',$id)->update(['category_image'=>'']);

    $msg = 'category image deleted successfully!';
    Session::flash('updated',$msg);
    return redirect()->back();


}

public function delete_category($id){
    //delete category
    Category::where('id',$id)->delete();
    $msg = 'category deleted successfully!';
    Session::flash('updated',$msg);
    return redirect()->back();

}

}









































