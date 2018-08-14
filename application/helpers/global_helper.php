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

function chkRequestType($type){

	if ($_SERVER['REQUEST_METHOD'] === $type) {
		return true;

	}

	return false;
}

//global function for getting data
function getData($tableName,$type='row',$select = '',$whereCondition=array()){
        $CI =& get_instance();

       	if(isset($select) && !empty($select)){
       		$CI->db->select($select);
       	}else{
       		$CI->db->select('*');
       	} 	

       	if(!empty($whereCondition)){
       		foreach ($whereCondition as $key => $value) {
       			$CI->db->where($key,$value);
       		}
       	}

       	if($type=='row'){
       		return $CI->db->get($tableName)->row_array();
       	}else{
       		return $CI->db->get($tableName)->result_array();

       	}

}

function genRandomString($length=5) {
    $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";

    $real_string_length = strlen($characters) ;     
    $string="id";

    for ($p = 0; $p < $length; $p++) 
    {
        $string .= $characters[mt_rand(0, $real_string_length-1)];
    }

    return strtolower($string);
}

