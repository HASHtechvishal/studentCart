<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create array

        $productRecords = [
        	['id'=>1,'category_id'=>2,'section_id'=>1,'product_name'=>'blue casual t-shirt','product_code'=>'BT001','product_color'=>'blue','product_price'=>'1500','product_discount'=>10,'product_weight'=>200,'product_video'=>'','main_image'=>'','description'=>'test product','wash_care'=>'','fabric'=>'','pattern'=>'','sleeve'=>'','fit'=>'','occassion'=>'','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'No','status'=>1],
            ['id'=>2,'category_id'=>2,'section_id'=>1,'product_name'=>'red casual t-shirt','product_code'=>'BT002','product_color'=>'red ','product_price'=>'2000','product_discount'=>10,'product_weight'=>200,'product_video'=>'','main_image'=>'','description'=>'test product','wash_care'=>'','fabric'=>'','pattern'=>'','sleeve'=>'','fit'=>'','occassion'=>'','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','is_featured'=>'Yes','status'=>1],
        ];

        Product::insert($productRecords);
    }
}
 