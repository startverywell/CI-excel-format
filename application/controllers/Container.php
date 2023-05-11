<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');        
		$this->load->model('Shipment_model');
        $this->load->model('Container_model');
    }


	public function index()
	{
        $data = array(
            'containerList' => $this->Container_model->getindex(), 
        );
		$this->load->view('layout/header');
		$this->load->view('container/index', $data);
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
		$this->load->view('container/create', $data);
		$this->load->view('layout/footer');
	}
    

	// set header
	public function save()
    {
        /* Load form helper */ 
        $this->load->helper(array('form'));
			
        /* Load form validation library */ 
        $this->load->library('form_validation');
           
        /* Set validation rule for name field in the form */ 
        $this->form_validation->set_rules('shipment_id', 'SHIPMENT NAME', 'required'); 
        $this->form_validation->set_rules('name', 'CONTAINER NAME', 'required'); 
        
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('container/create');
        } 
        else { 
            if ($this->Container_model->createContainer($this->input->post())  ) {
                $this->session->set_flashdata('msg_noti', 'Success create Container');
                redirect('container');
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('container/create');
            }
        } 
	}
}
