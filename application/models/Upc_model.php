<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upc_model extends CI_Model {
    /**
     * You can learn from Codeigniter 3 userguide about active record
     * Reference: https://www.codeigniter.com/userguide3/database/query_builder.html
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->helper('url');       
		$this->load->library('PHPExcel');
        $this->load->library('pagination');
    }

    public function record_count($search) {
        $this->db->like('sku',$search,'both'); 
		return $this->db->count_all('upc'); 
	}
	//for general database query 
	public function run_query($limitstart, $per_page, $search){ 
        $this->db->select('*');
        $this->db->from('upc');
        $this->db->like('sku',$search,'both');
        $this->db->limit($per_page, $limitstart); // Limit to 10 results, starting at row 6 (offset of 5)
        $query = $this->db->get();
        return $query->result();
    }

	public function getIndex()
	{
        $this->db->from('upc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function createUpc($data)
    {
        $this->db->trans_start();
        $this->db->insert('upc', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }
    }
    public function getUpc($id)
    {
        $this->db->from('upc');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function updateUpc($data, $id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('upc', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }

    }
    public function deleteUpc($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete('upc');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }
    }

    public function getUpcBySku($sku)
    {
        $this->db->from('upc');
        $this->db->where('sku', $sku);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function checkUpcBySku($sku)
    {
        $this->db->from('upc');
        $this->db->where('sku', $sku);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // public function exportExcel()
    // {
    //     $pls = $this->getIndex();
    //     $file_name = "3PL-SKU-LIST - ".date('Y-m-d');
    //     $inputFileName='uploads/template/3PL-SKU-LIST.xls';
    //     /**Load$inputFileNametoaPHPExcelObject**/ 
    //     $objPHPExcel=PHPExcel_IOFactory::load($inputFileName);
    //     $objPHPExcel->getProperties() 
    //         ->setCreator("Albert Cal")
    //         ->setLastModifiedBy("Albert Cal") 
    //         ->setTitle($file_name) 
    //         ->setSubject($file_name) 
    //         ->setDescription("3PL-SKU-LIST, generated using PHP classes.") 
    //         ->setKeywords("office 2007 openxml php") 
    //         ->setCategory('3PL-SKU-LIST');

    //     //-----------------set header------------------------------
    //     $objPHPExcel->setActiveSheetIndex(0);
    //     //---SET DATA
    //     $row = 4;
    //     foreach ($pls as $name => $pl) {
    //         $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $pl->sku ?? '');
    //         $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $pl->description ?? '');
    //         $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $pl->description2 ?? '');
    //         $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, $pl->qty ?? '');
    //         $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, $pl->style ?? '');
    //         $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, $pl->pack ?? '');
    //         $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row, $pl->length ?? '');
    //         $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, $pl->width ?? '');
    //         $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, $pl->height ?? '');
    //         $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, $pl->weight ?? '');
    //         $row++;
    //     }

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
    //     header('Cache-Control: max-age=0');

    //     $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
    //     $objWriter->save('php://output');
    //     exit;
    // }

    public function importExcel($file_name)
    {
        $inputFileName='./public/uploads/upc_list/'.$file_name;
        $objPHPExcel=PHPExcel_IOFactory::load($inputFileName);
        $objPHPExcel->getProperties() 
            ->setCreator("Albert Cal")
            ->setLastModifiedBy("Albert Cal") 
            ->setTitle($file_name) 
            ->setSubject($file_name) 
            ->setDescription("3PL-SKU-LIST, generated using PHP classes.") 
            ->setKeywords("office 2007 openxml php") 
            ->setCategory('UPC-LIST');

        //-----------------set header------------------------------
        $objPHPExcel->setActiveSheetIndex(0);
        //---SET DATA
        $row = 3;
        $blank_count = 0;
        while ($objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue() != '' && $objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue() != NULL && $blank_count < 9) {
            if($objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue() == '' || $objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue() != NULL ){
                $blank_count++;
                $row++;
                continue;
            } else {
                $blank_count = 0;
            }
            $pl = [];
            $pl['sku'] = $objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue() ?? '';

            if(!$this->checkUpcBySku($pl['sku'])){
                $pl['upc'] = $objPHPExcel->getActiveSheet()->getCell('F'.$row)->getValue() ?? '';
                $this->createUpc($pl);
            }
            $row++;
        }
        return true;
    }
}