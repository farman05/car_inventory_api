<?php

Class Manufacturer_model extends CI_Model{


        function getAllManufacturers(){

            return $this->db->get_where('manufacturers',array('is_deleted'=>0))->result_array();
        }


        function createManufacturer($data){
            $manufacturerExit = $this->db->get_where('manufacturers',array('name'=>$data['name']))->row_array();
            if(empty($manufacturerExit)){
                $insertData = array(
                    'name'=>$data['name'],
                    'added_on'=>date('Y-m-d H:i:s')
                );

                if($this->db->insert('manufacturers',$insertData)){
                return response(true,'Manufacturer Added successfully','','model');
                }
                return response(false,'Something Went Wrong','','model');
                
            }else{
                return response(false,'Manufacturer already exist','','model');
            }
            


        }


}