<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        $this->load->model('User_model');
    }
    
    


    function login(){
        if(chkRequestType('POST')){
        $json = file_get_contents("php://input");
        $data = json_decode($json,true);
        // echo response(false,'asdsads',$this->input->post());
            $result = $this->User_model->login($data);
            if(!empty($result['success'])){
                echo response(true,$result['msg'],$result['result']);
            
            }else{
                echo response(false,$result['msg'],$result['result']);
            }
        }
        
    }

}