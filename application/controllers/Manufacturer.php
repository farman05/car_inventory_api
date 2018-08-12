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

        $this->form_validation->set_rules('name', 'Manufacturer Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $errors =  validation_errors();
            echo response(false,'Validation errors',$errors);
        }else{
            $result = $this->Manufacturer_model->createManufacturer($this->input->post());
            if(!empty($result['success'])){
                echo response(true,$result['msg'],$result['result']);
            
            }else{
                echo response(false,$result['msg'],$result['result']);
            }
        } 
    }

}