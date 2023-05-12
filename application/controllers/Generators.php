<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generators extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');        
		$this->load->model('Header_model');
        $this->load->model('Shipment_model');
		$this->load->model('Generator_model');
    }

	public function index()
	{
		foreach ($this->Shipment_model->getindex() as $row) {
            $options[$row->id] = $row->name;
        }
        $data = array(
            'options' => $options, 
        );
        $this->load->view('layout/header');
		$this->load->view('generators/index', $data);
		$this->load->view('layout/footer');
	}

	public function excel()
	{
		$shipmpent_id = $_POST['shipment_id'];
		$result = $this->Generator_model->makeExcel($shipmpent_id);
		
		echo $result;
	}
}
