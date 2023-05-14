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

	public function save(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
        
		if ($this->form_validation->run() == TRUE) {
			$name = "S#".$this->input->post('name');
			mkdir('public/uploads/'. $name, 0777, true);
			if (!file_exists('uploads/'. $name)) {
				mkdir('public/uploads/'. $name, 0777, true);
			} 

			$config['upload_path'] = './public/uploads/'.$name.'/';
			$config['allowed_types'] = 'xlsx|xls|pdf';

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('input_1_name')) {
				$this->session->set_flashdata('msg_error', $this->upload->display_errors());
				redirect('dragdrop/create');
			} 

			if (!$this->upload->do_upload('input_2_name')) {
				$this->session->set_flashdata('msg_error', $this->upload->display_errors());
				redirect('dragdrop/create');
			} 

			if (!$this->upload->do_upload('input_3_name')) {
				$this->session->set_flashdata('msg_error', $this->upload->display_errors());
				redirect('dragdrop/create');
			} 

			if (!$this->upload->do_upload('input_4_name')) {
				$this->session->set_flashdata('msg_error', $this->upload->display_errors());
				redirect('dragdrop/create');
			} 
			$ship_data = array(
                'name'      => $name,
				'input_1_name' => $_FILES['input_1_name']['name'],
				'input_2_name' => $_FILES['input_2_name']['name'],
				'input_3_name' => $_FILES['input_3_name']['name'],
				'input_4_name' => $_FILES['input_4_name']['name'],
            );
			
			if ($this->Shipment_model->createShipment($ship_data)  ) {
				$this->session->set_flashdata('msg_noti', 'Success create Shipment');
				$shipment = $this->Shipment_model->getShipmentbyName($name)[0];
				redirect('setheader/one/'.$shipment->id);
			} else {
				$this->session->set_flashdata('msg_error', 'save error');
				redirect('dragdrop/create');
			}
			
		} else {
			$this->session->set_flashdata('msg_error', validation_errors());
			redirect('dragdrop/create');
		}
	}
	// view funcion
	public function read($id)
	{
		//get data from Member_modal using getindex() methods
        $data = array(
            'shipment' => $this->Shipment_model->getShipment($id)[0], 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('dragdrop/view', $data);
		$this->load->view('layout/footer');
	}

	public function delete($id)
	{
		$this->Shipment_model->deleteShipment($id);    
		$this->session->set_flashdata('msg_noti', 'Success Delete Shipment');
		redirect('dragdrop/');
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

	public function download($name)
	{
		$pathdir = "uploads/".$name."/"; 
		// Enter the name to creating zipped directory
		$zipcreated = "uploads/".$name."/".$name.".zip";
		if (file_exists($zipcreated)) {
			force_download($name.".zip", file_get_contents($zipcreated));
			redirect('dragdrop/');
		}
		redirect('dragdrop/');
	}

	public function createone(){
		$this->load->view('layout/header');
		$this->load->view('dragdrop/one');
		$this->load->view('layout/footer');
	}
}
