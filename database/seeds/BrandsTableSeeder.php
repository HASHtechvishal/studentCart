<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $brand_data = [
        	['id'=>1,'name'=>'arrow','status'=>1],
        	['id'=>2,'name'=>'gap','status'=>1],
        	['id'=>3,'name'=>'lee','status'=>1],
        	['id'=>4,'name'=>'monte carlo','status'=>1],
        	['id'=>5,'name'=>'peter england','status'=>1],
        ];

        Brand::insert($brand_data);
    }
}
 