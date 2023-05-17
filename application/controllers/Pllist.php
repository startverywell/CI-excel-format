<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pllist extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');        
		$this->load->model('SkuList_model');
    }


	public function index()
	{
        $data = array(
            'pl_list' => $this->SkuList_model->getIndex(), 
        );
		$this->load->view('layout/header');
		$this->load->view('pll_list/index', $data);
		$this->load->view('layout/footer');
	}

    // view funcion
	public function read($id)
	{
		//get data from Member_modal using getindex() methods
        $data = array(
            'pl' => $this->SkuList_model->getSkuList($id)[0], 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('pll_list/view', $data);
		$this->load->view('layout/footer');
	}

    // edit function
    public function edit($id)
	{
		//get data from Member_modal using getindex() methods
        $data = array(
            'pl' => $this->SkuList_model->getSkuList($id)[0], 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('pll_list/update', $data);
		$this->load->view('layout/footer');
	}

    // create funcion
	public function create()
    {
        $this->load->view('layout/header');
		$this->load->view('pll_list/create');
		$this->load->view('layout/footer');
    }

    public function save()
    {
        /* Load form helper */ 
        $this->load->helper(array('form'));
			
        /* Load form validation library */ 
        $this->load->library('form_validation');
           
        /* Set validation rule for name field in the form */ 
        $this->form_validation->set_rules('sku', 'SKU', 'required'); 
        $this->form_validation->set_rules('description', 'Description', 'required'); 
        $this->form_validation->set_rules('qty', 'Packing UoM QTY', 'required'); 
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('plist/create');
        } 
        else { 
            if ($this->SkuList_model->createSkuList($this->input->post())  ) {
                $this->session->set_flashdata('msg_noti', 'Success create new 3PL');
                redirect('pllist');
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('pllist/create');
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
        $this->form_validation->set_rules('sku', 'SKU', 'required'); 
        $this->form_validation->set_rules('description', 'Description', 'required'); 
        $this->form_validation->set_rules('qty', 'Packing UoM QTY', 'required'); 
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('plist');
        } 
        else { 
            if ($this->SkuList_model->updateSkuList($this->input->post(),$this->input->post('id'))  ) {
                $this->session->set_flashdata('msg_noti', 'Success update new 3PL');
                redirect('pllist');
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('pllist');
            }
        } 
    }

    // delete function
    public function delete($id)
	{
		//get data from Member_modal using getindex() methods
        if($this->SkuList_model->deleteSkuList($id)){
            $this->session->set_flashdata('msg_noti', 'Success delete item');
        } else {
            $this->session->set_flashdata('msg_error', 'delete error');
        }
        redirect('pllist');
	}

    // export excel
    public function export()
    {
        if($this->SkuList_model->exportExcel()){
            $this->session->set_flashdata('msg_noti', 'Success download');
            redirect('pllist');
        } else {
            $this->session->set_flashdata('msg_error', 'Download error');
            redirect('pllist');
        }
    }

    // import excel
    public function import()
    {
        $this->load->view('layout/header');
		$this->load->view('pll_list/import');
		$this->load->view('layout/footer');
    }

    // import data
    public function importData()
    {
        $name = 'PL_LIST_'.date('Y-m-d');
        if (!file_exists('public/uploads/pl_list')) {
            mkdir('public/uploads/pl_list', 0777, true);
        } 

        $config['upload_path'] = './public/uploads/pl_list/';
        $config['allowed_types'] = 'xlsx|xls|';
        $config['file_name'] = 'PL_LIST_'.date('Y-m-d');

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload_pl')) {
            $this->session->set_flashdata('msg_error', $this->upload->display_errors());
            redirect('pllist/import');
        } 
        $extension = pathinfo($_FILES['upload_pl']['name'], PATHINFO_EXTENSION);
        $this->SkuList_model->importExcel($name.".".$extension);
        redirect('pllist');
    }
}
