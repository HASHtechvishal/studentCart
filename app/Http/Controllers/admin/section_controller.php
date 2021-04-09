<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use Session;

class section_controller extends Controller
{
    //
    public function section(){
    	 Session::put('page','sections');
    	$section = Section::get();
    	return view('admin dashboard.admin section.admin_section')->with(compact('section')); //same as variable 
    }

    public function updateSectionStatus(Request $req){
    	if ($req->ajax()) {
    		 $data = $req->all();
    		 //echo "<pre>"; print_r($data); die;
    		 if ($data['status']=="active") {
    		 	 $status = 0;
    		 }else{
    		 	$status = 1;
    		 }
    		 Section::where('id',$data['section_id'])->update(['status'=>$status]);
    		 return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
    }
}
}

