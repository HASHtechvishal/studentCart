<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class DeliveryAddress extends Model
{
    use HasFactory;
    public static function deliveryAddress(){
    	$user_id = Auth::user()->id;
    	$deliveryAddress = DeliveryAddress::where('user_id',$user_id)->get()->toArray();
    	return $deliveryAddress;
    }
}
