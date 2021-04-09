<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //create 2 relation between name of category product belongsTo
    //belongsto to which section 
    public function category(){//we will check category_id in product from categories table
    	return $this->belongsTo('App\Category','category_id');
    }

    public function section(){//we will check section_id in product from section table
    	return $this->belongsTo('App\Section','section_id');
    }//it help to get delalis from another table

    public function attribute(){//product has many relation
    	return $this->hasMany('App\ProductsAttribute');
    }

    public function images(){
        return $this->hasMany('App\ProductsImage');
    }

    public function brand(){
        return $this->belongsTo('App\Brand','brand_id');
    } 

    //for use function anywhare use static function
    public static function product_filter(){

    $product_filter['fabric_array'] = array('cotton','polyester','wool'); 
    $product_filter['sleeve_array'] = array('full sleeve','half sleeve','short sleeve','sleeveless');
    $product_filter['pattern_array'] = array('checked','plain','peinted','self','solid');
    $product_filter['fit_array'] = array('regular','slim');
    $product_filter['occassion_array'] = array('casual','formal' );

    return $product_filter;
    } 

    public static function getDiscountrPrice($product_id){
        $proDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first()->toArray();
        //echo "<pre>"; print_r($proDetails); die;

        $catDetails = Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();

        if ($proDetails['product_discount']>0) {
            //if product discount is added from admin panel
             $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['product_discount'] / 100);
             //sale price = cost price - discount price
             // 450 = 500 - (500 *10/100 = 50)
         } elseif($catDetails['category_discount']>0){
            //if product discount is not added and category discount added from admin panel
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price'] * $catDetails['category_discount'] / 100);

         }else{
            $discounted_price = 0;
         }

         return $discounted_price;
    }

    public static function getDiscountedAttrPrice($product_id,$size){
        $proAttrPrice = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
        $proDetails = Product::select('product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $catDetails = Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();

        if ($proDetails['product_discount']>0) {
            //if product discount is added from admin panel
             $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $proDetails['product_discount'] / 100);
             //sale price = cost price - discount price
             // 450 = 500 - (500 *10/100 = 50)
            $discount = $proAttrPrice['price'] - $discounted_price;

         } elseif($catDetails['category_discount']>0){
            //if product discount is not added and category discount added from admin panel
            $discounted_price = $proAttrPrice['price'] - ($proAttrPrice['price'] * $catDetails['category_discount'] / 100);

            $discount = $proAttrPrice['price'] - $discounted_price;

         }else{
            $discounted_price = $proAttrPrice['price'];
            $discount = 0;
         }

         return array('product_price'=>$proAttrPrice['price'],'discounted_price'=>$discounted_price,'discount'=>$discount);

    }

    public static function getProductImage($product_id){
        $getProductImage = Product::select('main_image')->where('id',$product_id)->first()->toArray();
        //dd($getProductImage); die;
        return $getProductImage['main_image'];
    }

} 
