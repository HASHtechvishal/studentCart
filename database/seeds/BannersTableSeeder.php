<?php

use Illuminate\Database\Seeder;
use App\Banner;
class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $banner_data = [
        	['id'=>1,'image'=>'1.png','link'=>'','title'=>'black jacket','alt'=>'black jacket','status'=>1],
        	['id'=>2,'image'=>'2.png','link'=>'','title'=>'blue t-shirt','alt'=>'blue t-shirt','status'=>1],
        	['id'=>3,'image'=>'3.png','link'=>'','title'=>'full t-shirt','alt'=>'full t-shirt','status'=>1],

        ];
                Banner::insert($banner_data);

    }
}
