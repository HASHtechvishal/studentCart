<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Session;
use App\Section;
use App\Category;
use Image;
use App\ProductsAttribute; 
use App\ProductsImage;
use App\Brand;
//https://www.youtube.com/watch?v=aBygN_4yulU&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=32
//every e-com website str timing-10:41
class product_controller extends Controller
{
    //  

    public function items(){
    	Session::put('page','products');
    	$products = Product::with(['category','section'])->get();
 //we can add subquery also for fetching particular data ad id is importent we have to add id
    	$products = json_decode(json_encode($products));
    	//echo "<pre>"; print_r($products); die;
    	return view('admin dashboard.admin product.admin_product')->with(compact('products'));	
 
    }

          public function updateProductStatus(Request $req){
    	if ($req->ajax()) {
    		 $data = $req->all();
    		 //echo "<pre>"; print_r($data); die;
    		 if ($data['status']=="active") {
    		 	 $status = 0;
    		 }else{
    		 	$status = 1;
    		 }
    		 Product::where('id',$data['product_id'])->update(['status'=>$status]);
    		 return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
    }
}

public function delete_product($id){
    //delete Product
    Product::where('id',$id)->delete();
    $msg = 'Product deleted successfully!';
    Session::flash('updated',$msg);
    return redirect()->back();

}

public function add_edit_pro(Request $req ,$id=null){

    if ($id == "") {//for add product
          $title_product = "add product";
          //echo "id is not comming";

          $product = new Product;
          $product_data = array();
          $msg = "product added successfully";

    }else{//for edit product
           $title_product = "edit product"; 
           //echo "id is comming";
           $product_data = Product::find($id);//editing
           $product_data = json_decode(json_encode($product_data),true);
           //echo "<pre>"; print_r($product_data); die;
           $product = Product::find($id);
          $msg = "product edit successfully";
    }
    if ($req->isMethod('post')) { 
         $data = $req->all();
         //echo "<pre>"; print_r($data); die;
//product validation
         $rule = [//use field name of input
                'category_name' => 'required', 
                'brand' => 'required',
                'pro_name' => 'required | regex:/^[\pL\s\-]+$/u',
                'code_name' => 'required | regex:/^[\w-]*$/',
                'price_name' => 'required | numeric',
                'color_name' => 'required | regex:/^[\pL\s\-]+$/u'
              ];
              $own_msg = [
                'category_name.required' => 'please select category name',
                'brand.required' => 'please select brand name',
                'pro_name.required' => 'please enter product name',
                'pro_name.regex' =>'please enter valid product name',
                'code_name.required' =>'please enter product code',
                'code_name.regex' => 'please enter valid product code',
                'price_name.required' => 'please enter product price',
                'price_name.regex' => 'please enter valid product price',
                'color_name.required' => 'please enter product color',
                'color_name.regex' => 'please enter valid product color',
            ];
          $this->validate($req,$rule,$own_msg);

       
          //non imp fields  //if in config>>database.php>> in connection strict is false then no need of this all if conditions
       if (empty($data['fabric'])) { 
               $data['fabric'] = "";
          }
        if (empty($data['weight_name'])) {
               $data['weight_name'] = "";
          }
        if (empty($data['pro_des'])) {
               $data['pro_des'] = "";
          }
         if (empty($data['wash_care'])) {
               $data['wash_care'] = "";
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
          if (empty($data['pattern'])) {
               $data['pattern'] = "";
          }
          if (empty($data['sleeve'])) {
               $data['sleeve'] = "";
          }
          if (empty($data['fit'])) {
               $data['fit'] = "";
          }
          if (empty($data['occassion'])) {
               $data['occassion'] = "";
          }        

          //upload product image
          if ($req->hasFile('pro_img')) {//check that main image is comming or not
            $image_tmp = $req->file('pro_img');//image tempory path 
            if ($image_tmp->isValid()) {//if image is valide then go further
                
                //uploade image after resize
              $image_name = $image_tmp->getClientOriginalName();
              $extension =  $image_tmp->getClientOriginalExtension();

              //create new name of image
              $image_new_name = $image_name.'-'.rand(111,99999).'.'.$extension;
              $large_image_path = 'e-com images/product images/large_img/'.$image_new_name;
              $medium_image_path = 'e-com images/product images/medium_img/'.$image_new_name;
              $small_image_path = 'e-com images/product images/small_img/'.$image_new_name;
              Image::make($image_tmp)->save($large_image_path);//w:1040 h:1200 user should added
              Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
              Image::make($image_tmp)->resize(260,300)->save($small_image_path);
              $product->main_image = $image_new_name;

            }
          }

          //upload product video
          if ($req->hasFile('product_video')) {
               $video_tmp = $req->file('product_video');

               if ($video_tmp->isValid()) {
                   //upload video
                $video_name = $video_tmp->getClientOriginalName();
                $extension = $video_tmp->getClientOriginalExtension();

                //video new name
                $video_new_name = $video_name.'-'.rand().'.'.$extension;
                $video_path = 'e-com video/product_videos';
                $video_tmp->move($video_path,$video_new_name);
                //save video in product table
                $product->product_video = $video_new_name;
               }
          } 

          //save product details in products table
          $cate_data = Category::find($data['category_name']);
          //echo "<pre>"; print_r($cate_data); die;
          $product->section_id = $cate_data['section_id'];
          $product->brand_id = $data['brand'];
          $product->category_id = $data['category_name'];
          $product->product_name = $data['pro_name'];
          $product->product_code = $data['code_name'];
          $product->product_color = $data['color_name'];
          $product->product_price = $data['price_name'];
          $product->product_discount = $data['pro_dis'];
          $product->product_weight = $data['weight_name'];
          $product->description = $data['pro_des'];
          $product->wash_care = $data['wash_care'];
          $product->fabric = $data['fabric'];
          $product->pattern = $data['pattern'];
          $product->sleeve = $data['sleeve'];
          $product->fit = $data['fit'];
          $product->occassion = $data['occassion'];
          $product->meta_title = $data['meta_t'];
          $product->meta_description= $data['meta_des'];
          $product->meta_keywords = $data['meta_key'];
             //for is_feature
          if (!empty($data['is_feature'])) {//enum 'yes','no' in db
          $product->is_featured = $data['is_feature'];
          }else{
          $product->is_featured = "No";
          }
          $product->status = 1;
          $product->save();

          Session::flash('updated',$msg);
          return redirect('admin/products');


    }
 
    //filter array //make filters table also 
  /*  $fabric_array = array('cotton','polyester','wool'); 
    $sleeve_array = array('full sleeve','half sleeve','short sleeve','sleeveless');
    $pattern_array = array('checked','plain','peinted','self','solid');
    $fit_array = array('regular','slim');
    $occassion_array = array('casual','formal');  */

    $product_filter = Product::product_filter();
    //echo "<pre>"; print_r($product_filter); die;
    $fabric_array = $product_filter['fabric_array'];
    $sleeve_array = $product_filter['sleeve_array'];
    $pattern_array = $product_filter['pattern_array'];
    $fit_array = $product_filter['fit_array'];
    $occassion_array = $product_filter['occassion_array'];

    //sections with categories and sub categories
    $categories = Section::with('categories')->get();
    $categories = json_decode(json_encode($categories),true);
    //echo "<pre>"; print_r($categories); die;

    //get all active brand
    $brands = Brand::where('status',1)->get();
    $brands = json_decode(json_encode($brands),true);


    return view('admin dashboard.admin product.add_edit_product')->with(compact('title_product','fabric_array','sleeve_array','pattern_array','fit_array','occassion_array','categories','product_data','brands'));

}

public function delete_pro_image($id){
   $product_image = Product::select('main_image')->where('id',$id)->first();
    //get product image path
    $small_image_path = 'e-com images/product images/small_img/';
  $medium_image_path = 'e-com images/product images/medium_img/';
    $large_image_path = 'e-com images/product images/large_img/';


    //delete product image from product_images folder if exists
    if(file_exists($small_image_path.$product_image->main_image)){
        unlink($small_image_path.$product_image->main_image);
    }
  if(file_exists($medium_image_path.$product_image->main_image)){
        unlink($medium_image_path.$product_image->main_image);
    }
  if(file_exists($large_image_path.$product_image->main_image)){
        unlink($large_image_path.$product_image->main_image);
    }


    //delete product image from product table
    Product::where('id',$id)->update(['main_image'=>'']);

    $msg = 'product image deleted successfully!';
    Session::flash('updated',$msg);
    return redirect()->back();
}
public function delete_pro_video($id){

   $product_video = Product::select('product_video')->where('id',$id)->first();
    //get product video path
    $video_path = 'e-com video/product_videos/';

    //delete product video from product_videos folder if exists
    if(file_exists($video_path.$product_video->product_video)){
        unlink($video_path.$product_video->product_video);
    }

    //delete product video from categories table
    Product::where('id',$id)->update(['product_video'=>'']);

    $msg = 'product video deleted successfully!';
    Session::flash('updated',$msg);
    return redirect()->back();
}

public function add_attribute(Request $req,$id){

  if ($req->isMethod('post')) { 
      
      $data = $req->all();
      echo "<pre>"; print_r($data); die;
      foreach ($data['sku'] as $key => $value) {

         if (!empty($value)) { 

          //sku already exists
          $sku_attr = ProductsAttribute::where('sku',$value)->count();

          if ($sku_attr > 0) {
              
              $msg = "SKU already exisits. please add another SKU!";
              Session::flash('login_error',$msg);
              return redirect()->back();
          }
            //size already exists
      $size_attr = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
           if ($size_attr > 0) {
              
              $msg = "size already exisits. please add another size!";
              Session::flash('login_error',$msg);
              return redirect()->back();
          }

              
              $attribute = new ProductsAttribute;
              $attribute->product_id = $id;
              $attribute->sku = $value;
              $attribute->size = $data['size'][$key]; 
              $attribute->price = $data['price'][$key];
              $attribute->stock = $data['stock'][$key];
              $attribute->status = 1;
              $attribute->save();

         }


         
      }
      $msg = "product attributes added successfully!";
              Session::flash('updated',$msg);
              return redirect()->back();
 
  }

  $product_data = Product::select('id','product_name','product_code','product_color','main_image')->with('attribute')->find($id);
  $product_data = json_decode(json_encode($product_data),true);
  //echo "<pre>"; print_r($product_data); die;
  $title_attr = "product attributes";
  return view('admin dashboard.admin product.add_edit_attribute')->with(compact('product_data','title_attr'));
} 

public function edit_attribute(Request $req , $id){
    
    if ($req->isMethod('post')) { 
        
        $data = $req->all();
       // echo "<pre>"; print_r($data); die;
        foreach ($data['attr_id'] as $key => $attr) {
            
            if (!empty($attr)) {
                
                ProductsAttribute::where(['id'=>$data['attr_id'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                //Undefined offset: 10 error because in database table some colmun is empty  
 
            } 
        }

          $msg = "product attributes updated successfully!";
              Session::flash('updated',$msg);
              return redirect()->back();

    }

}

        public function updateAttribute(Request $req){
      if ($req->ajax()) {
         $data = $req->all();
         //echo "<pre>"; print_r($data); die;
         if ($data['status']=="active") {
           $status = 0;
         }else{
          $status = 1;
         }
         ProductsAttribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
         return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
    }
}

public function deleteAttribute($id){
    //delete Product attribute
    ProductsAttribute::where('id',$id)->delete();
    $msg = 'Product attribute deleted successfully!';
    Session::flash('updated',$msg);
    return redirect()->back();

}

public function add_image(Request $req, $id){ 

  if ($req->isMethod('post')) {
       $data = $req->all();
      //echo "<pre>"; print_r($data); die;
      if ($req->hasFile('image')) {
       //  echo "test"; die;
        $images = $req->file('image');
           //echo "<pre>"; print_r($images); die;

        foreach ($images as $key => $img) {
             $product_image = new ProductsImage;
             $imgs = Image::make($img);
             $extension = $img->getClientOriginalExtension();//getClientOriginalName() it is the orignal name of image
             $imageName = rand(111,999999).time().".".$extension;

              $large_image_path = 'e-com images/product images/large_img/'.$imageName;
              $medium_image_path = 'e-com images/product images/medium_img/'.$imageName;
              $small_image_path = 'e-com images/product images/small_img/'.$imageName;
              Image::make($imgs)->save($large_image_path);//w:1040 h:1200 user should added
              Image::make($imgs)->resize(520,600)->save($medium_image_path);
              Image::make($imgs)->resize(260,300)->save($small_image_path);
              $product_image->image = $imageName; 
              $product_image->product_id = $id;
              $product_image->status = 1;
              $product_image->save();
              
              }
              $msg = 'Product images added successfully!';
              Session::flash('updated',$msg);
                 return redirect()->back();

      }
  }
        
          $product_image = Product::with('images')->select('id','product_name','product_code','product_color','main_image')->find($id); //hense there i no image till now so it show blank array
          $product_image = json_decode(json_encode($product_image),true);
          //echo "<pre>"; print_r($product_image); die;
          $title_image = "product images";
          return view('admin dashboard.admin product.add_images')->with(compact('product_image','title_image'));
}

   public function updateImage(Request $req){
      if ($req->ajax()) {
         $data = $req->all();
         //echo "<pre>"; print_r($data); die;
         if ($data['status']=="active") {
           $status = 0;
         }else{
          $status = 1;
         }
         ProductsImage::where('id',$data['images_id'])->update(['status'=>$status]);
         return response()->json(['status'=>$status,'images_id'=>$data['images_id']]);
    }
}

public function deleteImage($id){
   $product_image = ProductsImage::select('image')->where('id',$id)->first();
    //get product image path
    $small_image_path = 'e-com images/product images/small_img/';
  $medium_image_path = 'e-com images/product images/medium_img/';
    $large_image_path = 'e-com images/product images/large_img/';


    //delete product image from product_images folder if exists
    if(file_exists($small_image_path.$product_image->image)){
        unlink($small_image_path.$product_image->image);
    }
  if(file_exists($medium_image_path.$product_image->image)){
        unlink($medium_image_path.$product_image->image);
    }
  if(file_exists($large_image_path.$product_image->image)){
        unlink($large_image_path.$product_image->image);
    }


    //delete product image from product table
    ProductsImage::where('id',$id)->delete();

    $msg = 'product image deleted successfully!';
    Session::flash('updated',$msg);
    return redirect()->back();
}


} 



























