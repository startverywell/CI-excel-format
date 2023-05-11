<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetHeader extends CI_Controller {

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
    

	// set header
	public function save()
    {
        /* Load form helper */ 
        $this->load->helper(array('form'));
			
        /* Load form validation library */ 
        $this->load->library('form_validation');
           
        /* Set validation rule for name field in the form */ 
        $this->form_validation->set_rules('date_entered', 'DATE ENTERED', 'required'); 
        $this->form_validation->set_rules('shipment_type', 'SHIPMENT TYPE', 'required'); 
        $this->form_validation->set_rules('factory', 'Factory name', 'required'); 
        // $this->form_validation->set_rules('carrier', 'CARRIER', 'required'); 
        // $this->form_validation->set_rules('bl', 'BL#', 'required'); 
        // $this->form_validation->set_rules('bill_date', 'BILL/INV DATE', 'required'); 
        // $this->form_validation->set_rules('docs_date', 'DOCS RCVD DATE', 'required'); 
        // $this->form_validation->set_rules('bill', 'Bill#', 'required'); 
        $this->form_validation->set_rules('amount', 'Amount', 'required');
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('setheader/create');
        } 
        else { 
            if ($this->Header_model->createHeader($this->input->post())  ) {
                $this->session->set_flashdata('msg_noti', 'Success create Shipment Header');
                redirect('setheader');
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('setheader/create');
            }
        } 
	}
}
