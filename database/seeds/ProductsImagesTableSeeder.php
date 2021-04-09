<?php

use Illuminate\Database\Seeder;
use App\ProductsImage;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $image_data = [
        	['id'=>1,'product_id'=>1,'image'=>'product image.png','status'=>1]
        ];
        ProductsImage::insert($image_data);
    }
}
 