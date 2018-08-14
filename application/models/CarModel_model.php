<?php

class CarModel_model extends CI_Model{
    

    function createModel($data,$imageName){
        	$data['added_on'] = date('Y-m-d H:i:s');	
        	if($this->db->insert('models',$data)){
        		$insertId = $this->db->insert_id();
        		$image['model_id'] = $insertId;
        		$image['image'] = $imageName;
        		$image['added_on'] = date('Y-m-d H:i:s');
        		$this->db->insert('model_images',$image);
        		return true;
        	}else{
        		return false;
        	}
    }

    function getInfo(){

    	$manufacturer = getData('manufacturers','result','',array('is_deleted'=>0));
    	$color = getData('colors','result','','');

    	$returnArray['manufacturers'] = $manufacturer;
    	$returnArray['colors'] = $color;

    	return $returnArray;

    }


    function modelData(){

    	$this->db->select('models.*,manufacturers.name as manufacturer_name,colors.name as color_name,model_images.image');
    	$this->db->join('manufacturers','manufacturers.id = models.manufacturer_id');
    	$this->db->join('colors','colors.id = models.color_id');
    	$this->db->join('model_images','model_images.model_id = models.id');
    	return $this->db->get_where('models',array('quantity >'=>0))->result_array();


    }

    function soldModel($id){

		$modelData = getData('models','row','',array('id'=>$id));

		if(!empty($modelData)){
			$quantity = $modelData['quantity'] - 1;
			$this->db->update('models',array('quantity'=>$quantity),array('id'=>$id));
			return true;
		}

		return false;
	}


}
