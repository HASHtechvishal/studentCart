<?php

use Illuminate\Database\Seeder;
use App\ProductsAttribute;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productsAttribute_data = [
        	['id'=>1,'product_id'=>5,'size'=>'small','price'=>1200,'stock'=>10,'sku'=>'BT003-s','status'=>1],
        	['id'=>2,'product_id'=>5,'size'=>'medium','price'=>1300,'stock'=>10,'sku'=>'BT003-m','status'=>1],
        	['id'=>3,'product_id'=>5,'size'=>'large','price'=>1400,'stock'=>20,'sku'=>'BT003-l','status'=>1],

        ];

        ProductsAttribute::insert($productsAttribute_data);
    }
}
