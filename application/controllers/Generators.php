<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generators extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');  
		$this->load->helper('download');      
		$this->load->model('Header_model');
        $this->load->model('Shipment_model');
		$this->load->model('Generator_model');
    }

	public function index()
	{
		foreach ($this->Shipment_model->getindex() as $row) {
            $options[$row->id] = $row->name;
        }
        $data = array(
            'options' => $options, 
        );
        $this->load->view('layout/header');
		$this->load->view('generators/index', $data);
		$this->load->view('layout/footer');
	}

	public function one($shipment_id)
	{
		$data = array(
            'shipment_id' => $shipment_id, 
        );
        $this->load->view('layout/header');
		$this->load->view('generators/one', $data);
		$this->load->view('layout/footer');
	}

	public function excel()
	{
		$shipment_id = $_POST['shipment_id'];
		//get data from Member_modal using getindex() methods
        $header =  $this->Header_model->getHeaderbyShipID($shipment_id)[0]; 
		if($header->po_check == 1){
			$result = $this->Generator_model->makeExcel($shipment_id);
			$this->Shipment_model->updateShipment(['comment'=>'complete'], $shipment_id);
			$this->session->set_flashdata('msg_noti', 'SHIPMENT FILE GENERATED SUCCESS');
			// Enter the name of directory
			$pathdir = "uploads/".$header->shipment_name."/"; 
			// Enter the name to creating zipped directory
			$zipcreated = "uploads/".$header->shipment_name."/".$header->shipment_name.".zip";
			// Create new zip class
			$zip = new ZipArchive;
			if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
				// Store the path into the variable
				$dir = opendir($pathdir);
				while($file = readdir($dir)) {
					if(is_file($pathdir.$file)) {
						$zip -> addFile($pathdir.$file, $file);
					}
				}
				$zip ->close();
			}
			if (file_exists($zipcreated)) {
				// Read the file and force a download prompt
				force_download($header->shipment_name.".zip", file_get_contents($zipcreated));
			}
            echo 'SUCCESS.';
		} else {
			$this->session->set_flashdata('msg_error', 'Please Check Step 4 & 5.');
			echo 'error';
		}	
	}

	public function make()
	{
		$shipment_id = $this->input->post('shipment_id');
		$header =  $this->Header_model->getHeaderbyShipID($shipment_id)[0]; 
		if($header->po_check == 1){
			$result = $this->Generator_model->makeExcel($shipment_id);
			$this->Shipment_model->updateShipment(['comment'=>'complete'], $shipment_id);
			$this->session->set_flashdata('msg_noti', 'SHIPMENT FILE GENERATED SUCCESS');
			// Enter the name of directory
			$pathdir = "public/uploads/".$header->shipment_name."/"; 
			// Enter the name to creating zipped directory
			$zipcreated = "public/uploads/".$header->shipment_name."/".$header->shipment_name.".zip";
			// Create new zip class
			$zip  = $this->zipDir($pathdir,$zipcreated);
			if (file_exists($zipcreated)) {
				// Read the file and force a download prompt
				force_download($header->shipment_name.".zip", file_get_contents($zipcreated));
			}
			$this->session->set_flashdata('msg_noti', 'Generate Success');
            redirect('generators/success/'.$shipment_id);
		} else {
			$this->session->set_flashdata('msg_error', 'Please Check Step 4 & 5.');
			echo 'error';
		}
	}

	public function success($shipment_id)
	{
		$shipment = $this->Shipment_model->getShipment($shipment_id)[0];
        $data = array(
            'shipment_name' => $shipment->name,
        );
        $this->load->view('layout/header');
		$this->load->view('generators/success', $data);
		$this->load->view('layout/footer');
	}

	/**
     * Zip a folder (including itself).
     * 
     * Usage:
     * Folder path that should be zipped.
     * 
     * @param $sourcePath string 
     * Relative path of directory to be zipped.
     * 
     * @param $outZipPath string 
     * Path of output zip file. 
     *
     */
    public function zipDir($sourcePath, $outZipPath){
        $pathInfo = pathinfo($sourcePath);
        $parentPath = $pathInfo['dirname'];
        $dirName = $pathInfo['basename'];
    
        $z = new ZipArchive();
        $z->open($outZipPath, ZipArchive::CREATE);
        $z->addEmptyDir($dirName);
        if($sourcePath == $dirName){
            dirToZip($sourcePath, $z, 0);
        }else{
            self::dirToZip($sourcePath, $z, strlen("$parentPath/"));
        }
        $z->close();
        
        return true;
    }
    
    /**
     * Add files and sub-directories in a folder to zip file.
     * 
     * @param $folder string
     * Folder path that should be zipped.
     * 
     * @param $zipFile ZipArchive
     * Zip file where files end up.
     * 
     * @param $exclusiveLength int 
     * Number of text to be excluded from the file path. 
     *
     */
    private function dirToZip($folder, &$zipFile, $exclusiveLength){
        $handle = opendir($folder);
        while(FALSE !== $f = readdir($handle)){
            // Check for local/parent path or zipping file itself and skip
            if($f != '.' && $f != '..' && $f != basename(__FILE__)){
                $filePath = "$folder/$f";
                // Remove prefix from file path before add to zip
                $localPath = substr($filePath, $exclusiveLength);
                if(is_file($filePath)){
                    $zipFile->addFile($filePath, $localPath);
                }elseif(is_dir($filePath)){
                    // Add sub-directory
                    $zipFile->addEmptyDir($localPath);
                    self::dirToZip($filePath, $zipFile, $exclusiveLength);
                }
            }
        }
        closedir($handle);
    }
}
