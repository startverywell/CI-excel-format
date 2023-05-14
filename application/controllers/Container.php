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

    public function one($shipment_id)
	{
        
        foreach ($this->Shipment_model->getindex() as $row) {
            $options[$row->id] = $row->name;
        }

        $data = array(
            'options' => $options, 
            'shipment_id' => $shipment_id
        );
        $this->load->view('layout/header');
		$this->load->view('container/one', $data);
		$this->load->view('layout/footer');
	}

    // view funcion
	public function read($id)
	{
		//get data from Member_modal using getindex() methods
        $data = array(
            'container' => $this->Container_model->getcontainer($id)[0], 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('container/view', $data);
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
            'container' => $this->Container_model->getContainer($id)[0], 
            'options' => $options, 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('container/edit', $data);
		$this->load->view('layout/footer');
	}

	public function delete($id)
	{
		$this->Container_model->deleteContainer($id);    
		$this->session->set_flashdata('msg_noti', 'Success Delete Shipment Header');
		redirect('container/');
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
                $container = $this->Container_model->getContainersByName($this->input->post('shipment_id'), $name);
                redirect('setdetails/one/'.$container->id);
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('container/create');
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
        $this->form_validation->set_rules('shipment_id', 'SHIPMENT NAME', 'required'); 
        $this->form_validation->set_rules('name', 'CONTAINER NAME', 'required'); 
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('container/edit/'.$this->input->post('id'));
        } 
        else { 
            if ($this->Container_model->updateContainer($this->input->post(), $this->input->post('id'))  ) {
                $this->session->set_flashdata('msg_noti', 'Success Update Container');
                redirect('container');
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('container/edit/'.$this->input->post('id'));
            }
        } 
	}
}
