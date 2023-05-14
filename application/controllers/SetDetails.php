<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setdetails extends CI_Controller {

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
        $this->load->model('SkuList_model');
    }


	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('setdetail/index');
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
		$this->load->view('setdetail/input', $data);
		$this->load->view('layout/footer');
	}

    public function one($container_id)
	{
        $container = $this->Container_model->getContainer($container_id)[0];
        $data = array(
            'header_title' => $container->shipment_name.':'.$container->name, 
            'container_id' => $container_id
        );
		$this->load->view('layout/header');
		$this->load->view('setdetail/one', $data);
		$this->load->view('layout/footer');
	}

    public function edit($container_id)
	{
        $container = $this->Container_model->getContainer($container_id)[0];
        $data = array(
            'header_title' => $container->shipment_name.':'.$container->name, 
            'container_id' => $container_id,
            'data' => $this->Details_model->getIndex($container_id)
        );
		$this->load->view('layout/header');
		$this->load->view('setdetail/edit', $data);
		$this->load->view('layout/footer');
	}

    public function delete($id)
    {
        $detail = $this->Details_model->getDetails($id)[0];
        $container_id = $detail->container_id;
        $this->Details_model->deleteDetails($id);
        $this->session->set_flashdata('msg_noti', 'Delete Success!');
        redirect('setdetails/edit/'.$container_id);
    }

    public function updateView($id)
    {
        $detail = $this->Details_model->getDetails($id)[0];
        $container_id = $detail->container_id;
        $container = $this->Container_model->getContainer($container_id)[0];
        $data = array(
            'header_title' => $container->shipment_name.':'.$container->name, 
            'detail' => $detail
        );
        $this->load->view('layout/header');
		$this->load->view('setdetail/update', $data);
		$this->load->view('layout/footer');
    }

    public function view($id)
    {
        $detail = $this->Details_model->getDetails($id)[0];
        $container_id = $detail->container_id;
        $container = $this->Container_model->getContainer($container_id)[0];
        $data = array(
            'header_title' => $container->shipment_name.':'.$container->name, 
            'detail' => $detail
        );
        $this->load->view('layout/header');
		$this->load->view('setdetail/view', $data);
		$this->load->view('layout/footer');
    }
    

	// set header
	public function save()
    {
        $header = [
            0 => 'po',
            1 => 'style',
            2 => 'description',
            3 => 'description2',
            4 => 'hts',
            5 => 'pcs_carton',
            6 => 'ctn',
            7 => 'total',
            8 => 'uom',
            9 => 'ds',
            10 => 'customer',
            11 => 'ship',
            12 => 'cancel',
            13 => 'customer_po',
            14 => 'so',
            15 => 'inv',
            16 => 'ext_req',
            17 => 'rcvd',
            18 => 'short_over',
            19 => 'notes',
            20 => 'upc',
            21 => 'length',
            22 => 'width',
            23 => 'height',
            24 => 'weight',
            25 => 'cbm',
            26 => 'price'
        ];
        $container_id = $this->input->post('container_id');
        $shipment_id = ($this->Container_model->getContainer($container_id)[0])->shipment_id;
        $data = json_decode($this->input->post('data'));
        $new_data = [];
        $detail_data = [];

        for ($i=0; $i < count($data); $i++) { 
            if($data[$i][0] != '' && !is_null($data[$i][0])){
                $new_data[] = $data[$i];
            }
        }
        // var_export($new_data); die();
        
        if(count($new_data) > 0){
            for ($j=0; $j < count($new_data); $j++) { 
                $detail_data['container_id'] = $container_id;
                $detail_data['shipment_id'] = $shipment_id;
                for ($k=0; $k < count($data[$j]); $k++) { 
                    $detail_data[$header[$k]] = $data[$j][$k];
                }
                $this->Details_model->createDetails($detail_data);
                $detail_data = [];
            }
        }

        $this->session->set_flashdata('msg_noti', 'Success create Container');
        redirect('setdetails');
    }

    // save detail
    public function detailSave()
    {
        /* Load form helper */ 
        $this->load->helper(array('form'));
			
        /* Load form validation library */ 
        $this->load->library('form_validation');
           
        $id = $this->input->post('id');
        $container_id = $this->input->post('container_id');
        /* Set validation rule for name field in the form */ 
        $this->form_validation->set_rules('style', 'Style', 'required'); 
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('setdetails/updateView/'.$id);
        } 
        else { 
            if ($this->Details_model->updateDetails($this->input->post(), $id)  ) {
                if(!$this->SkuList_model->checkSku($this->input->post('style'))){
                    $this->Details_model->updateDetails(['pl_new'=>1], $id);
                    $this->Details_model->updateDetails(['pl_add_flag'=>1], $id);
                }
                if($this->input->post('single_top') != 1){
                    $this->Details_model->updateDetails(['single_top'=>0], $id);
                }
                if($this->input->post('multi_top') != 1){
                    $this->Details_model->updateDetails(['multi_top'=>0], $id);
                }
                if($this->input->post('asst') != 1){
                    $this->Details_model->updateDetails(['asst'=>0], $id);
                }
                $this->session->set_flashdata('msg_noti', 'Success update Detail');
                echo './setdetails/edit/'.$container_id;
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                echo 'setdetails/updateView/'.$id;
            }
        } 
    }
}
