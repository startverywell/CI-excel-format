<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SkuList_model extends CI_Model {
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
    }

	public function getIndex()
	{
        $this->db->from('sku_list');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function createSkuList($data)
    {
        $this->db->trans_start();
        $this->db->insert('sku_list', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }
    }
    public function getSkuList($id)
    {
        $this->db->from('sku_list');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function updateSkuList($data, $id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('sku_list', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }

    }
    public function deleteSkuList($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete('sku_list');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }
    }

    public function checkSku($sku, $qty)
    {
        $this->db->from('sku_list');
        $this->db->where('sku', $sku);
        $this->db->where('qty', $qty);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkSkuName($sku)
    {
        $this->db->from('sku_list');
        $this->db->where('sku', $sku);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function exportExcel()
    {
        $pls = $this->getIndex();
        $file_name = "3PL-SKU-LIST - ".date('Y-m-d');
        $inputFileName='uploads/template/3PL-SKU-LIST.xls';
        /**Load$inputFileNametoaPHPExcelObject**/ 
        $objPHPExcel=PHPExcel_IOFactory::load($inputFileName);
        $objPHPExcel->getProperties() 
            ->setCreator("Albert Cal")
            ->setLastModifiedBy("Albert Cal") 
            ->setTitle($file_name) 
            ->setSubject($file_name) 
            ->setDescription("3PL-SKU-LIST, generated using PHP classes.") 
            ->setKeywords("office 2007 openxml php") 
            ->setCategory('3PL-SKU-LIST');

        //-----------------set header------------------------------
        $objPHPExcel->setActiveSheetIndex(0);
        //---SET DATA
        $row = 4;
        foreach ($pls as $name => $pl) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $pl->sku ?? '');
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $pl->description ?? '');
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $pl->description2 ?? '');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, $pl->qty ?? '');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, $pl->style ?? '');
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, $pl->pack ?? '');
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row, $pl->length ?? '');
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, $pl->width ?? '');
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, $pl->height ?? '');
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, $pl->weight ?? '');
            $row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
        $objWriter->save('php://output');
        exit;
    }

    public function importExcel($file_name)
    {
        $inputFileName='./public/uploads/pl_list/'.$file_name;
        $objPHPExcel=PHPExcel_IOFactory::load($inputFileName);
        $objPHPExcel->getProperties() 
            ->setCreator("Albert Cal")
            ->setLastModifiedBy("Albert Cal") 
            ->setTitle($file_name) 
            ->setSubject($file_name) 
            ->setDescription("3PL-SKU-LIST, generated using PHP classes.") 
            ->setKeywords("office 2007 openxml php") 
            ->setCategory('3PL-SKU-LIST');

        //-----------------set header------------------------------
        $objPHPExcel->setActiveSheetIndex(0);
        //---SET DATA
        $row = 6;
        $blank_count = 0;
        while ($objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue() != '' && $blank_count < 9) {
            if($objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue() == '' ){
                $blank_count++;
                $row++;
                continue;
            } else {
                $blank_count = 0;
            }
            $pl = [];
            $pl['sku'] = $objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue();

            if(!$this->checkSkuName($pl['sku'])){
                $pl['description'] = $objPHPExcel->getActiveSheet()->getCell('B'.$row)->getValue();
                $pl['description2'] = $objPHPExcel->getActiveSheet()->getCell('C'.$row)->getValue();
                $pl['qty'] = $objPHPExcel->getActiveSheet()->getCell('D'.$row)->getValue();
                $pl['style'] = $objPHPExcel->getActiveSheet()->getCell('G'.$row)->getValue();
                $pl['pack'] = $objPHPExcel->getActiveSheet()->getCell('H'.$row)->getValue();
                $pl['length'] = $objPHPExcel->getActiveSheet()->getCell('I'.$row)->getValue();
                $pl['width'] = $objPHPExcel->getActiveSheet()->getCell('J'.$row)->getValue();
                $pl['height'] = $objPHPExcel->getActiveSheet()->getCell('K'.$row)->getValue();
                $pl['weight'] = $objPHPExcel->getActiveSheet()->getCell('L'.$row)->getValue();
                $this->createSkuList($pl);
            }
            $row++;
        }
        return true;
    }
}