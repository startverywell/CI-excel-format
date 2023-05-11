<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetDetails extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');        
		$this->load->model('Container_model');
        $this->load->model('Shipment_model');
        $this->load->model('Details_model');
    }


	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('setdetails/index');
		$this->load->view('layout/footer');
	}

    public function inputData($container_id)
	{
        $container = $this->Container_model->getContainer($container_id)[0];
        $data = array(
            'header_title' => $container->shipment_name.':'.$container->name, 
            'container_id' => $container_id
        );
		$this->load->view('layout/header');
		$this->load->view('setdetails/input', $data);
		$this->load->view('layout/footer');
	}
    

	// set header
	public function save()
    {
        $header = [
            0 => 'po',
            1 => 'style',
            2 => 'description',
            3 => 'hts',
            4 => 'pcs_carton',
            5 => 'ctn',
            6 => 'total',
            7 => 'uom',
            8 => 'ds',
            9 => 'customer',
            10 => 'ship',
            11 => 'cancel',
            12 => 'customer_po',
            13 => 'so',
            14 => 'inv',
            15 => 'ext_req',
            16 => 'rcvd',
            17 => 'short_over',
            18 => 'notes',
            19 => 'upc',
            20 => 'length',
            21 => 'width',
            22 => 'height',
            23 => 'weight',
            24 => 'cbm',
            25 => 'price'
        ];
        $container_id = $this->input->post('container_id');
        $shipment_id = ($this->Container_model->getContainer($container_id)[0])->shipment_id;
        $data = json_decode($this->input->post('data'));
        $new_data = [];
        $detail_data = [];

        foreach ($data as $key => $row) {
            $new_data[$row->row][$row->col] = $row->newValue ?? '';
        }
        // var_export($new_data); die;
        foreach ($new_data as $key => $value) {
            $detail_data['container_id'] = $container_id;
            $detail_data['shipment_id'] = $shipment_id;
            foreach ($value as $key1 => $row) {
                $detail_data[$header[$key1]] = $row ?? '';
            }
            $this->Details_model->createDetails($detail_data);
            $detail_data = [];
        }

        $this->session->set_flashdata('msg_noti', 'Success create Container');
        redirect('setdetails');
    }
}
