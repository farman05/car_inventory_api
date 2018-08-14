<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CarModel extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        $this->load->model('CarModel_model');
    }

    function createModel(){

    	 if(chkRequestType('POST')){
	       
	        $uploadImage = $this->uploadImage($_FILES['myFile']);
	        if(!empty($uploadImage['status'])){
	        	$imageName = $uploadImage['filename'];
	        	$result = $this->CarModel_model->createModel($this->input->post(),$imageName);	
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

}


