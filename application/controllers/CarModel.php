<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CarModel extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        $this->load->model('Manufacturer_model');
    }
}