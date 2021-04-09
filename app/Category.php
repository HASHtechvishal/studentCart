<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //create subcategory relation 
    public function subCategories(){
    	return $this->hasMany('App\Category','parent_id')->where('status',1);//pich all id from parent_id //use this sub ate with categoey level function
    } 

    //create relation on section
    public function section(){
    	return $this->belongsTo('App\Section','section_id')->select('id','name');
    	//if u want particular data from db
    	//now remove the sub query from controller
    }
 
    public function parent_cate(){//for showing parent thrn use parent_id
    	return $this->belongsTo('App\Category','parent_id')->select('id','category_name');
    }//parent_id show for those who having its parent
 

    public static function category_data($url){
        $category_data = Category::select('id','parent_id','category_name','url','description')->with(['subCategories'=>function($query){
            $query->select('id','parent_id','category_name','url','description')->where('status',1);
        }])->where('url',$url)->first()->toArray();
        //dd($category_data); die;

        if ($category_data['parent_id']==0) {
            #only show main category in breadcrumb
            $breadcrumb = '<a href="'.url($category_data['url']).'">'.$category_data['category_name'].'</a>';
        }else{
            //show main and subCategory in breadcrumb
            $parent_cate = Category::select('category_name','url')->where('id',$category_data['parent_id'])->first()->toArray();
            $breadcrumb = '<a href="'.url($parent_cate['url']).'">'.$parent_cate['category_name'].'</a>&nbsp;<span class="divider">/</span>&nbsp;<a href="'.url($category_data['url']).'">'.$category_data['category_name'].'</a>';
        }
        $cat_id = array();
        $cat_id[] = $category_data['id'];
        foreach ($category_data['sub_categories'] as $key => $subcat){
            $cat_id[] = $subcat['id'];
        }
        //dd($cat_id); die;
        return array('cat_id'=>$cat_id,'category_data'=>$category_data,'breadcrumb'=>$breadcrumb);

    }
  
}
