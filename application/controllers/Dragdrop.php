<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dragdrop extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');        
		$this->load->model('Shipment_model');
    }

	public function index()
	{
		//get data from Member_modal using getindex() methods
        $data = array(
            'shipList' => $this->Shipment_model->getindex(), 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('dragdrop/index', $data);
		$this->load->view('layout/footer');
	}

	public function create()
	{
		$this->load->view('layout/header');
		$this->load->view('dragdrop/create');
		$this->load->view('layout/footer');
	}

	 // File upload
	 public function fileUpload($id){
		$firstFolderName = $id;
		mkdir('uploads/S#'. $firstFolderName, 0777, true);
		if (!file_exists('uploads/S#'. $firstFolderName)) {
			mkdir('uploads/S#'. $firstFolderName, 0777, true);
		}
		else{
			$this->session->set_flashdata('msg_error', 'name:Error create Shipment');
            redirect('dragdrop/create');
		}
		if(!empty($_FILES['upload']['name'])){
			$ship_data = array(
                'name'      => 'S#$firstFolderName'
            );
			
			for($i=0; $i<count($_FILES['upload']['name']); $i++){

				$target_path = "uploads/S#".$firstFolderName."/";
				$ext = explode('.', basename( $_FILES['upload']['name'][$i]));
				$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext)-1]; 
				$ship_data['input_'.($i+1).'name'] = $_FILES['upload']['name'][$i]['name'];
				if(move_uploaded_file($_FILES['upload']['tmp_name'][$i], $target_path)) {
					echo "success";
				} else{
					$this->session->set_flashdata('msg_error', 'File:Error create Shipment');
            		redirect('dragdrop/create');
				}
			}
			$create_user = $this->Shipment_model->createShipment($ship_data);    
			$this->session->set_flashdata('msg_noti', 'Success create Shipment');
        	redirect('dragdrop/');
		}else{
			$this->session->set_flashdata('msg_error', 'File:Error create Shipment');
            redirect('dragdrop/create');
		}
	}
}
