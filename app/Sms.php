<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;
    public function sendSms($message,$mobile){
    	
/*Code for SMS Script Starts*/
$request ="";
$param['authorization']="Fj6fIMyYNwmstD84VXARu7xerQoBWc59LZJzTKOkngPG2qv3U1HNWSqrFdlZu6kUoGe2sg5zBxODvbA0";
$param['sender_id'] = 'FSTSMS';
$param['message']= $message;
$param['numbers']= $mobile;
$param['language']="english";
$param['route']="p";

foreach($param as $key=>$val) {
    $request.= $key."=".urlencode($val);
    $request.= "&";
}
$request = substr($request, 0, strlen($request)-1);

$url ="https://www.fast2sms.com/dev/bulk?".$request;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
/*Code for SMS Script Ends*/
    }
    //https://www.youtube.com/watch?v=slhzSm1SlVk&list=PLLUtELdNs2ZaHaFmydqjcQ-YyeQ19Cd6u&index=117
}
