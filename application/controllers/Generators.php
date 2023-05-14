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
		$this->load->helper('download');      
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
		//get data from Member_modal using getindex() methods
        $header =  $this->Header_model->getHeaderbyShipID($shipmpent_id)[0]; 
		if($header->po_check == 1){
			$result = $this->Generator_model->makeExcel($shipmpent_id);
			$this->Shipment_model->updateShipment(['comment'=>'complete'], $shipmpent_id);
			$this->session->set_flashdata('msg_noti', 'SHIPMENT FILE GENERATED SUCCESS');
			// Enter the name of directory
			$pathdir = "uploads/".$header->shipment_name."/"; 
			// Enter the name to creating zipped directory
			$zipcreated = "uploads/".$header->shipment_name."/".$header->shipment_name.".zip";
			// Create new zip class
			$zip = new ZipArchive;
			if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
				// Store the path into the variable
				$dir = opendir($pathdir);
				while($file = readdir($dir)) {
					if(is_file($pathdir.$file)) {
						$zip -> addFile($pathdir.$file, $file);
					}
				}
				$zip ->close();
			}
			if (file_exists($zipcreated)) {
				// Read the file and force a download prompt
				force_download($header->shipment_name.".zip", file_get_contents($zipcreated));
			}
            echo 'SUCCESS.';
		} else {
			$this->session->set_flashdata('msg_error', 'Please Check Step 4 & 5.');
			echo 'error';
		}	
	}
}
