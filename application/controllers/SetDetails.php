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
        $this->load->model('Header_model');
        $this->load->model('Details_model');
        $this->load->model('SkuList_model');
        $this->load->model('Upc_model');
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
        $shipment_id = ($this->Container_model->getContainer($container_id)[0])->shipment_id;
        
        $data = array(
            'header_title' => $container->shipment_name.':'.$container->name, 
            'container_id' => $container_id,
            'shipment_id' => $shipment_id,
        );
		$this->load->view('layout/header');
		$this->load->view('setdetail/input', $data);
		$this->load->view('layout/footer');
	}

    public function one($shipment_id)
	{
        $data = array(
            'shipment_id' => $shipment_id,
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
            'shipment_id' => $container->shipment_id,
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
        $shipment_id = ($this->Container_model->getContainer($container_id)[0])->shipment_id;
        $header = $this->Header_model->getHeaderbyShipID($shipment_id)[0];
        $this->Details_model->deleteDetails($id);
        $this->session->set_flashdata('msg_noti', 'Delete Success!');
        redirect('billcheck/pocheck/'.$header->id);
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
            2 => 'asst',
            3 => 'single_top',
            4 => 'multi_top',
            5 => 'description',
            6 => 'description2',
            7 => 'hts',
            8 => 'ctn',
            9 => 'total',
            10 => 'uom',
            11 => 'rcvd',
            12 => 'notes',
            13 => 'upc',
            14 => 'length',
            15 => 'width',
            16 => 'height',
            17 => 'weight',
            18 => 'cbm',
            19 => 'price'
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
                $detail_data['pcs_carton'] = (int)$detail_data['ctn'] != 0 ? ((int)$detail_data['total'])/((int)$detail_data['ctn']) : 0;
                // $detail_data['pcs_carton'] = (int)$detail_data['ctn'];
                

                if($detail_data['single_top'] != '' && $detail_data['single_top'] != 'no'){
                    $detail_data['single_top'] = 1;
                }
                if($detail_data['multi_top'] != '' && $detail_data['multi_top'] != 'no'){
                    $detail_data['multi_top'] = 1;
                }
                if($detail_data['asst'] != '' && $detail_data['asst'] != 'no'){
                    $detail_data['asst'] = 1;
                }

                if($detail_data['single_top'] == 1 || $detail_data['multi_top'] == 1){
                    $sku = $detail_data['notes'] ?? '';
                    $qty = $detail_data['ctn'] ?? '';
                } else if($detail_data['asst'] == 1) {
                    $sku = $detail_data['style'] ?? '';
                    $qty = $detail_data['pcs_carton'] ?? '';
                }
                else {
                    $sku = $detail_data['style'] ?? '';
                    $qty = $detail_data['total'] ?? '';
                }

                $upc = $this->Upc_model->getUpcBySku($sku)[0];
                $detail_data['upc'] = $upc->upc ?? '';

                if(!$this->SkuList_model->checkSku($sku, $qty)){
                    $detail_data['pl_new'] = 1;
                    $detail_data['pl_add_flag'] = 1;

                    // ADD 3PL LIST
                    $pl = [];
                    // check name
                    $pl['sku'] = $this->SkuList_model->checkSkuName($sku) ? $sku.'-'.$qty : $sku;
                    $pl['description'] = $detail_data['description'];
                    $pl['description2'] = $detail_data['description2'];
                    $pl['qty'] = $detail_data['pcs_carton'];
                    $pl['style'] = '';
                    $pl['pack'] = '';
                    $pl['length'] = $detail_data['length'];
                    $pl['width'] = $detail_data['width'];
                    $pl['height'] = $detail_data['height'];
                    $pl['weight'] = $detail_data['weight']; 
                    $this->SkuList_model->createSkuList($pl);

                }
                $this->Details_model->createDetails($detail_data);
                $detail_data = [];
            }
        }

        $this->session->set_flashdata('msg_noti', 'Success create Container');
        redirect('setdetails');
    }

    // set header
	public function saveone()
    {
        $header = [
            0 => 'po',
            1 => 'style',
            2 => 'asst',
            3 => 'single_top',
            4 => 'multi_top',
            5 => 'description',
            6 => 'description2',
            7 => 'hts',
            8 => 'ctn',
            9 => 'total',
            10 => 'uom',
            11 => 'rcvd',
            12 => 'notes',
            13 => 'upc',
            14 => 'length',
            15 => 'width',
            16 => 'height',
            17 => 'weight',
            18 => 'cbm',
            19 => 'price'
        ];
        $container_id = $this->input->post('container_id');
        $shipment_id = ($this->Container_model->getContainer($container_id)[0])->shipment_id;
        $data = json_decode($this->input->post('data'));
        $new_data = [];
        $detail_data = [];

        for ($i=0; $i < count($data); $i++) { 
            if($data[$i][3] != '' && !is_null($data[$i][3])){
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

                $detail_data['pcs_carton'] = (int)$detail_data['ctn'] != 0 ? ((int)$detail_data['total'])/((int)$detail_data['ctn']) : 0;
                
                if($detail_data['single_top'] != '' && $detail_data['single_top'] != 'no'){
                    $detail_data['single_top'] = 1;
                }
                if($detail_data['multi_top'] != '' && $detail_data['multi_top'] != 'no'){
                    $detail_data['multi_top'] = 1;
                }
                if($detail_data['asst'] != '' && $detail_data['asst'] != 'no'){
                    $detail_data['asst'] = 1;
                }

                if($detail_data['single_top'] == 1 || $detail_data['multi_top'] == 1){
                    $sku = $detail_data['notes'] ?? '';
                    $qty = $detail_data['ctn'] ?? '';
                } else if($detail_data['asst'] == 1) {
                    $sku = $detail_data['style'] ?? '';
                    $qty = $detail_data['pcs_carton'] ?? '';
                }
                else {
                    $sku = $detail_data['style'] ?? '';
                    $qty = $detail_data['total'] ?? '';
                }

                $upc = $this->Upc_model->getUpcBySku($sku)[0];
                $detail_data['upc'] = $upc->upc ?? '';

                if(!$this->SkuList_model->checkSku($sku, $qty)){
                    $detail_data['pl_new'] = 1;
                    $detail_data['pl_add_flag'] = 1;

                    // ADD 3PL LIST
                    $pl = [];
                    // check name
                    $pl['sku'] = $this->SkuList_model->checkSkuName($sku) ? $sku.'-'.$qty : $sku;
                    $pl['description'] = $detail_data['description'];
                    $pl['description2'] = $detail_data['description2'];
                    $pl['qty'] = $detail_data['pcs_carton'];
                    $pl['style'] = '';
                    $pl['pack'] = '';
                    $pl['length'] = $detail_data['length'];
                    $pl['width'] = $detail_data['width'];
                    $pl['height'] = $detail_data['height'];
                    $pl['weight'] = $detail_data['weight']; 
                    $this->SkuList_model->createSkuList($pl);
                }
                $this->Details_model->createDetails($detail_data);
                $detail_data = [];
            }
        }

        $this->session->set_flashdata('msg_noti', 'Success create Packing List');
        redirect('billcheck/billone/'.$shipment_id);
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
        $shipment_id = $this->input->post('shipment_id');
        /* Set validation rule for name field in the form */ 
        $this->form_validation->set_rules('style', 'Style', 'required'); 
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('setdetails/updateView/'.$id);
        } 
        else { 
            if ($this->Details_model->updateDetails($this->input->post(), $id)  ) {
                if($this->input->post('single_top') == 1 || $this->input->post('multi_top') == 1){
                    $sku = $this->input->post('notes') ?? '';
                    $qty = $this->input->post('ctn') ?? '';
                } else if($this->input->post('asst') == 1) {
                    $sku = $this->input->post('style') ?? '';
                    $qty = $this->input->post('pcs_carton') ?? '';
                }
                else {
                    $sku = $this->input->post('style') ?? '';
                    $qty = $this->input->post('total') ?? '';
                }
                if(!$this->SkuList_model->checkSku($sku, $qty)){
                    $this->Details_model->updateDetails(['pl_new'=>1], $id);
                    $this->Details_model->updateDetails(['pl_add_flag'=>1], $id);
                    // ADD 3PL LIST
                    $pl = [];
                    // check name
                    $pl['sku'] = $this->SkuList_model->checkSkuName($sku) ? $sku.'-'.$qty : $sku;
                    $pl['description'] = $this->input->post('description');
                    $pl['description2'] = $this->input->post('description2');
                    $pl['qty'] = $this->input->post('pcs_carton');
                    $pl['style'] = '';
                    $pl['pack'] = '';
                    $pl['length'] = $this->input->post('length');
                    $pl['width'] = $this->input->post('width');
                    $pl['height'] = $this->input->post('height');
                    $pl['weight'] = $this->input->post('weight'); 
                    $this->SkuList_model->createSkuList($pl);
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
                $header = $this->Header_model->getHeaderbyShipID($shipment_id)[0];
                // echo 'billcheck/pocheck/'.$header->id;
                redirect('billcheck/pocheck/'.$header->id);
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('setdetails/updateView/'.$id);
                // echo 'setdetails/updateView/'.$id;
            }
        } 
    }
}
