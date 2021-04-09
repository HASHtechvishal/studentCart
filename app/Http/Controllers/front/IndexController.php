<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Product; 

class IndexController extends Controller      
{
    //
    public function index(){
  //get featured items
  //echo 
    	$featured_item_count = Product::where('is_featured','Yes')->where('status',1)->count();
  //die; 

        $featured_item = Product::where('is_featured','Yes')->where('status',1)->get()->toArray();//toArray is to collerst data into array && asme as json_decode
          //dd($featured_item); die;	

        $featured_item_chunk = array_chunk($featured_item, 4);//use to number of array in one place if we wanted to show 4 array in page


        //get new product desc 
        $newProduct = Product::orderBy('id','Desc')->where('status',1)->limit(6)->get()->toArray();
        //echo "<pre>"; print_r($newProduct); die;

        //echo "<pre>"; print_r($featured_item_chunk); die; 
    	$page_name = "index";//give the name to the page
     	return view('front e-com.index')->with(compact('page_name','featured_item_chunk','featured_item_count','newProduct'));
    }
}   
 