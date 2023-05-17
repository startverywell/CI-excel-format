<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setheader extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');        
		$this->load->model('Header_model');
        $this->load->model('Shipment_model');
    }


	public function index()
	{
        $data = array(
            'headerList' => $this->Header_model->getindex(), 
        );
		$this->load->view('layout/header');
		$this->load->view('setheader/index', $data);
		$this->load->view('layout/footer');
	}

    public function create()
	{
        foreach ($this->Shipment_model->getindex() as $row) {
            $options[$row->id] = $row->name;
        }

        $data = array(
            'options' => $options, 
        );
        $this->load->view('layout/header');
		$this->load->view('setheader/create', $data);
		$this->load->view('layout/footer');
	}

    public function one($shipment_id)
	{
        $shipment = $this->Shipment_model->getShipment($shipment_id)[0];
        $data = array(
            'shipment_id' => $shipment_id, 
            'shipment_name' => $shipment->name,
        );
        $this->load->view('layout/header');
		$this->load->view('setheader/one', $data);
		$this->load->view('layout/footer');
	}

    // view funcion
	public function read($id)
	{
		//get data from Member_modal using getindex() methods
        $data = array(
            'header' => $this->Header_model->getHeader($id)[0], 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('setheader/view', $data);
		$this->load->view('layout/footer');
	}

    // edit funcion
	public function edit($id)
	{
        foreach ($this->Shipment_model->getindex() as $row) {
            $options[$row->id] = $row->name;
        }

        
		//get data from Member_modal using getindex() methods
        $data = array(
            'header' => $this->Header_model->getHeader($id)[0], 
            'options' => $options, 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('setheader/edit', $data);
		$this->load->view('layout/footer');
	}

	public function delete($id)
	{
		$this->Header_model->deleteHeader($id);    
		$this->session->set_flashdata('msg_noti', 'Success Delete Shipment Header');
		redirect('setheader/');
	}
    

	// set header
	public function save()
    {
        /* Load form helper */ 
        $this->load->helper(array('form'));
			
        /* Load form validation library */ 
        $this->load->library('form_validation');
           
        /* Set validation rule for name field in the form */ 
        // $this->form_validation->set_rules('date_entered', 'DATE ENTERED', 'required'); 
        $this->form_validation->set_rules('shipment_type', 'SHIPMENT TYPE', 'required'); 
        // $this->form_validation->set_rules('factory', 'Factory name', 'required'); 
        // $this->form_validation->set_rules('amount', 'Amount', 'required');
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('setheader/create');
        } 
        else {
            $old_header = $this->Header_model->getHeaderbyShipID($this->input->post('shipment_id'));
            if(!$old_header){
                if ($this->Header_model->createHeader($this->input->post())  ) {
                    $this->session->set_flashdata('msg_noti', 'Success create Shipment Header');
                    redirect('container/copy/'.$this->input->post('shipment_id'));
                } else {
                    $this->session->set_flashdata('msg_error', 'save error');
                    redirect('setheader/create');
                }
            }
            else {
                $id = $old_header[0];
                if ($this->Header_model->updateHeader($this->input->post(),$id->id)) {
                    $this->session->set_flashdata('msg_noti', 'Success create Shipment Header');
                    redirect('container/copy/'.$this->input->post('shipment_id'));
                } else {
                    $this->session->set_flashdata('msg_error', 'save error');
                    redirect('setheader/create');
                }
            }
        } 
	}

    public function update()
    {
        /* Load form helper */ 
        $this->load->helper(array('form'));
			
        /* Load form validation library */ 
        $this->load->library('form_validation');
           
        /* Set validation rule for name field in the form */ 
        $this->form_validation->set_rules('date_entered', 'DATE ENTERED', 'required'); 
        $this->form_validation->set_rules('shipment_type', 'SHIPMENT TYPE', 'required'); 
        $this->form_validation->set_rules('factory', 'Factory name', 'required'); 
        $this->form_validation->set_rules('amount', 'Amount', 'required');
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('setheader/edit/'.$this->input->post('id'));
        } 
        else { 
            if ($this->Header_model->updateHeader($this->input->post(), $this->input->post('id'))  ) {
                $this->session->set_flashdata('msg_noti', 'Success Update Shipment Header');
                redirect('setheader');
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('setheader/edit/'.$this->input->post('id'));
            }
        } 
	}
}
