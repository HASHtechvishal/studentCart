<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    public static function section(){//use static fun to use fun in view file also
    	$get_section = Section::with('categories')->where('status',1)->get();//where if status is 0 then it will not show in front//
    	$get_section = json_decode(json_encode($get_section),true);
    	//echo "<pre>"; print_r($get_section); die;
    	return $get_section;
    } 

    public function categories(){
    	return $this->hasMany('App\Category','section_id')->where(['parent_id'=>'null','status'=>1])->with('subCategories');
    	//every categories has many sub categories
    }
}  
 