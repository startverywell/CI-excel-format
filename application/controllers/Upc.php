<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upc extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');        
		$this->load->model('Upc_model');
    }


	public function index()
	{
        $data = array(
            'upc_list' => $this->Upc_model->getIndex(), 
        );
		$this->load->view('layout/header');
		$this->load->view('upc/index', $data);
		$this->load->view('layout/footer');
	}

    // view funcion
	public function read($id)
	{
		//get data from Member_modal using getindex() methods
        $data = array(
            'upc' => $this->Upc_model->getUpc($id)[0], 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('upc/view', $data);
		$this->load->view('layout/footer');
	}

    // edit function
    public function edit($id)
	{
		//get data from Member_modal using getindex() methods
        $data = array(
            'upc' => $this->Upc_model->getUpc($id)[0], 
        );
        //load view
        $this->load->view('layout/header');
		$this->load->view('upc/update', $data);
		$this->load->view('layout/footer');
	}

    // create funcion
	public function create()
    {
        $this->load->view('layout/header');
		$this->load->view('upc/create');
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
        $this->form_validation->set_rules('upc', 'UPC', 'required'); 
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('upc/create');
        } 
        else { 
            if ($this->Upc_model->createUpc($this->input->post())  ) {
                $this->session->set_flashdata('msg_noti', 'Success create new UPC');
                redirect('upc');
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('upc/create');
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
        $this->form_validation->set_rules('upc', 'UPC', 'required'); 
           
        if ($this->form_validation->run() == FALSE) { 
            $this->session->set_flashdata('msg_error', validation_errors());
            redirect('upc');
        } 
        else { 
            if ($this->Upc_model->updateUpc($this->input->post(),$this->input->post('id'))  ) {
                $this->session->set_flashdata('msg_noti', 'Success update UPC');
                redirect('upc');
            } else {
                $this->session->set_flashdata('msg_error', 'save error');
                redirect('upc');
            }
        } 
    }

    // delete function
    public function delete($id)
	{
		//get data from Member_modal using getindex() methods
        if($this->Upc_model->deleteUpc($id)){
            $this->session->set_flashdata('msg_noti', 'Success delete item');
        } else {
            $this->session->set_flashdata('msg_error', 'delete error');
        }
        redirect('upc');
	}

    // // export excel
    // public function export()
    // {
    //     if($this->Upc_model->exportExcel()){
    //         $this->session->set_flashdata('msg_noti', 'Success download');
    //         redirect('upc');
    //     } else {
    //         $this->session->set_flashdata('msg_error', 'Download error');
    //         redirect('upc');
    //     }
    // }

    // import excel
    public function import()
    {
        $this->load->view('layout/header');
		$this->load->view('upc/import');
		$this->load->view('layout/footer');
    }

    // import data
    public function importData()
    {
        $name = 'UPC_'.date('Y-m-d');
        if (!file_exists('public/uploads/upc_list')) {
            mkdir('public/uploads/upc_list', 0777, true);
        } 

        $config['upload_path'] = './public/uploads/upc_list/';
        $config['allowed_types'] = 'xlsx|xls|';
        $config['file_name'] = 'UPC_'.date('Y-m-d');

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('upload_upc')) {
            $this->session->set_flashdata('msg_error', $this->upload->display_errors());
            redirect('upc/import');
        } 
        $extension = pathinfo($_FILES['upload_upc']['name'], PATHINFO_EXTENSION);
        $this->Upc_model->importExcel($name.".".$extension);
        redirect('upc');
    }

    public function pagenation()
    {
        $limitstart                = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $search = $_POST['sku_search'] ?? '';
        $config['base_url']        = site_url('/upc/pagenation');
        $config['total_rows']      = $this->Upc_model->record_count($search);
        $config['per_page']        = 10;
        $config["full_tag_open"]   = '<div class="pagination1 mt-3">';
        $config["full_tag_close"]  = '</div>';
        $config["first_tag_open"]  = '<a>';
        $config["first_tag_close"] = '</a>';
        $config["last_tag_open"]   = '<a>';
        $config["last_tag_close"]  = '</li>';
        $config["next_tag_open"]   = '<a>';
        $config["next_tag_close"]  = '</a>';
        $config["prev_tag_open"]   = '<a>';
        $config["prev_tag_close"]  = '</a>';
        $config["num_tag_open"]    = '<a>';
        $config["num_tag_close"]   = '</a>';
        $config["cur_tag_open"]    = '<a class="active1">';
        $config["cur_tag_close"]   = '</a>';
        $config['first_link']      = "Previous";
        $config['last_link']       = "Next";
        $this->pagination->initialize($config);
        $this->data["paginetionlinks"] = $this->pagination->create_links();
        $this->data["returndata"]      = $this->Upc_model->run_query($limitstart,$config['per_page'],$search);
        $this->data["search"] = $search;

        $this->load->view('layout/header');
		$this->load->view('upc/page', $this->data);
		$this->load->view('layout/footer');
    }
}
