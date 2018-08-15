<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        $this->load->model('Manufacturer_model');
    }
    
    //getting all maufacturer list
    function getAllManufacturers(){

        $result = $this->Manufacturer_model->getAllManufacturers();

        if(!empty($result)){
            echo response(true,'manufacturer List',$result);
        }else{
            echo response(false,'No data found',$result);
            
        }
    }

    //create manufacturer

    function createManufacturer(){
       
        if(chkRequestType('POST')){
        $json = file_get_contents("php://input");
        $data = json_decode($json,true);
        // echo response(false,'asdsads',$this->input->post());
            $result = $this->Manufacturer_model->createManufacturer($data);
            if(!empty($result['success'])){
                echo response(true,$result['msg'],$result['result']);
            
            }else{
                echo response(false,$result['msg'],$result['result']);
            }
        }
        
    }

}