<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CarModel extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        $this->load->model('CarModel_model');
    }

    function createModel(){
		
    	 if(chkRequestType('POST')){

    		$json = file_get_contents("php://input");
    		$data = json_decode($json,true);
    		$imageName = $this->base64ToImage($data['file']);
	        if(!empty($imageName)){
        		unset($data['file']);
	        	$result = $this->CarModel_model->createModel($data,$imageName);	
	        	if(!empty($result)){
           		 	echo response(true,'Model Added successfully','');
	        	}else{
           		 	echo response(false,'Something Went Wrong','');
	        	}			

	        }else{
           		 echo response(false,'Error in uploading Image','');

	        }
	        
	    }
    }

    //getting manufacturer name and color on load of page
    function getInfo(){

    	 if(chkRequestType('GET')){
    	 	$result = $this->CarModel_model->getInfo();
    	 	if(!empty($result)){
            	echo response(true,'Info Data',$result);
    	 	}else{
            	echo response(false,'No data found',$result);
    	 	}
    	 }

    }

    function uploadImage($file){
	    $target_dir =  FCPATH.'assets/images/';
	    $file_name = ($file['name']);
	    $rand = genRandomString();
		$final_filename = $rand.time().'.png';
		$target_file = $target_dir.$final_filename ;
	    if (move_uploaded_file($file['tmp_name'], $target_file)) {
	        $response['status'] = true;       
	        $response['filename'] = $final_filename;
	     } else {
	        $response['status'] =  false;       
	     }
	     
	     return $response;
	}


	function modelData(){
    	 if(chkRequestType('GET')){
			$result =  $this->CarModel_model->modelData();
			if(!empty($result)){
            	echo response(true,'Car Model Data',$result);
			}else{
            	echo response(false,'No data found','');

			}

		}
	}

	function soldModel(){
		 if(chkRequestType('POST')){
        	$json = file_get_contents("php://input");
        	$data = json_decode($json,true);
        	$result = $this->CarModel_model->soldModel($data['id']);

        	if(!empty($result)){
            	echo response(true,'Car Model Sold successfully',$result);
        	}else{
            	echo response(false,'Something Went Wrong ! Please try again later','');

        	}

    	}

	}

	function base64ToImage($imageData){
	    $data = 'data:image/png;base64,AAAFBfj42Pj4';
	    list($type, $imageData) = explode(';', $imageData);
	    list(,$extension) = explode('/',$type);
	    list(,$imageData)      = explode(',', $imageData);
		$target_dir =  FCPATH.'assets/images/';
	    $fileName = uniqid().'.'.$extension;
	    $imageData = base64_decode($imageData);
	    $directory = $target_dir.$fileName;
	    file_put_contents($directory, $imageData);
	    return $fileName;
	}


}



