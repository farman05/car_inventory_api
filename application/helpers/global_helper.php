<?php

function response($success,$msg,$result = "",$name = ""){

   $response = array(
                    "success"=>$success,
                    'msg'=>$msg,
                    'result'=>$result
   );     

 return empty($name) ? json_encode($response) :$response ; 

}

function pr($data){
    echo "<pre>";
    print_r($data);
}

