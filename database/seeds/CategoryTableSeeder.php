<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cate_data = [
        	['id'=>1,'parent_id'=>0,'section_id'=>1,'category_name'=>'t-shirts','category_image'=>'','category_discount'=>0,'description'=>'','url'=>'t-shirts','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status'=>1],
        	['id'=>2,'parent_id'=>1,'section_id'=>1,'category_name'=>'designer t-shirts','category_image'=>'','category_discount'=>0,'description'=>'','url'=>'designer t-shirts','meta_title'=>'','meta_description'=>'','meta_keywords'=>'','status'=>1],
        ];
        Category::insert($cate_data);
    }
}
