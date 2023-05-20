<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billcheck extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');        
		$this->load->model('Header_model');
        $this->load->model('Shipment_model');
        $this->load->model('Details_model');
    }


	public function index()
	{
        $data = array(
            'headerList' => $this->Header_model->getindex(), 
        );
		$this->load->view('layout/header');
		$this->load->view('billcheck/index', $data);
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
		$this->load->view('billcheck/view', $data);
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
		$this->load->view('billcheck/edit', $data);
		$this->load->view('layout/footer');
	}

    // edit funcion
	public function billone($shipment_id)
	{
		//get data from Member_modal using getindex() methods
        $data = array(
            'header' => $this->Header_model->getHeaderbyShipID($shipment_id)[0], 
            'details' => $this->Details_model->getAll($shipment_id),
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('billcheck/billone', $data);
		$this->load->view('layout/footer');
	}

    public function pocheck($id)
    {
		$header = $this->Header_model->getHeader($id)[0];
        $details = $this->Details_model->getAll($header->shipment_id);
		//get data from Member_modal using getindex() methods
        $data = array(
            'header' => $header, 
            'details' => $details, 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('billcheck/pocheck', $data);
		$this->load->view('layout/footer');
    }

    public function update()
    {
        /* Load form helper */ 
        $this->load->helper(array('form'));
			
        /* Load form validation library */ 
        $this->load->library('form_validation');
           
        if ($this->Header_model->updateHeader(['bill_check'=>1], $this->input->post('id'))  ) {
            $this->session->set_flashdata('msg_noti', 'Success CHECK Shipment Header');
            redirect('billcheck/pocheck/'.$this->input->post('id'));
        } else {
            $this->session->set_flashdata('msg_error', 'save error');
            redirect('billcheck/billone/'.$this->input->post('id'));
        }
    }
    
    public function checkall()
    {
        /* Load form helper */ 
        $this->load->helper(array('form'));
			
        /* Load form validation library */ 
        $this->load->library('form_validation');
           
        if ($this->Header_model->updateHeader(['po_check'=>1], $this->input->post('id'))  ) {
            $this->session->set_flashdata('msg_noti', 'Success CHECK Shipment Details');
            redirect('generators/one/'.$this->input->post('shipment_id'));
        } else {
            $this->session->set_flashdata('msg_error', 'save error');
            redirect('billcheck');
        }
    }
}
