<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }


	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('setdetails/index');
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
        $this->form_validation->set_rules('carrier', 'CARRIER', 'required'); 
        $this->form_validation->set_rules('bl', 'BL#', 'required'); 
        $this->form_validation->set_rules('bill_date', 'BILL/INV DATE', 'required'); 
        $this->form_validation->set_rules('doc_date', 'DOCS RCVD DATE', 'required'); 
        $this->form_validation->set_rules('bill', 'Bill#', 'required'); 
        $this->form_validation->set_rules('amount', 'Amount', 'required');
           
        if ($this->form_validation->run() == FALSE) { 
            $this->load->view('layout/header');
            $this->load->view('setheader/index');
            $this->load->view('layout/footer');
        } 
        else { 
           $_SESSION['date_entered']  = $_POST['date_entered'] ;
           $_SESSION['shipment_type'] = $_POST['shipment_type'] ;
           $_SESSION['factory']       = $_POST['factory'] ;
           $_SESSION['carrier']       = $_POST['carrier'] ;
           $_SESSION['bl']            = $_POST['bl'] ;
           $_SESSION['bill_date']     = $_POST['bill_date'] ;
           $_SESSION['doc_date']      = $_POST['doc_date'] ;
           $_SESSION['bill']          = $_POST['bill'] ;
           $_SESSION['amount']        = $_POST['amount'] ;
        } 
	}
}
