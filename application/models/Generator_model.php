<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generator_model extends CI_Model {
	public function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->helper('url');       
		$this->load->library('PHPExcel');
        $this->load->model('Header_model');
        $this->load->model('Details_model');
        $this->load->model('Container_model');
        $this->load->model('Shipment_model');
        $this->load->model('Upc_model');
    }

	public function get_data()
	{
        $Sdetail_query = $this->db->query("select * from shipment_details as a left join shipment as b on a.shipment_id = b.id")->result_array();       
        $Sheader_query = $this->db->query("select * from shipment_header as a left join shipment as b on a.shipment_id = b.id")->result_array();

        return $result  = array('shipment_detail' => $Sdetail_query, 'shipment_header' => $Sheader_query);
    }

    public function makeExcel($shipment_id)
    {
        $header_data = $this->Header_model->getHeaderbyShipID($shipment_id)[0];
        $container_data = $this->Container_model->getContainers($shipment_id);
        $container_name = '';
        foreach ($container_data as $key => $container) {
            $details[$container->name] = $this->Details_model->getIndex($container->id);
            $container_name = $container->name;
            if (!file_exists('public/uploads/'. $header_data->shipment_name.'/'.$container_name)) {
				mkdir('public/uploads/'. $header_data->shipment_name.'/'.$container_name, 0777, true);
			} 
            $this->makeReciver($header_data, $this->Details_model->getIndex($container->id),$container_name);
            $this->makeMaster($header_data, $this->Details_model->getIndex($container->id),$container_name);
            $this->makePLS($header_data,$container_name);
        }
        $this->makeShipment($header_data, $details);
        // $this->makeReciver($header_data, $details,$container_name);
        // $this->makeMaster($header_data, $details,$container_name);
        // $this->makePLS($header_data,$container_name);
        
    }

    public function makeShipment($header_data, $details)
    {
        $file_name = "SHIPMENT FILE   ".$header_data->shipment_name;
        $inputFileName='uploads/template/SHIPMENT FILE.xlsx';
        /**Load$inputFileNametoaPHPExcelObject**/ 
        $objPHPExcel=PHPExcel_IOFactory::load($inputFileName);
        /**Create anew PHPExcelObject**/ 
        // $objPHPExcel=new PHPExcel();
        $objPHPExcel->getProperties() 
            ->setCreator("Albert Cal")
            ->setLastModifiedBy("Albert Cal") 
            ->setTitle($file_name) 
            ->setSubject($file_name) 
            ->setDescription("SHIPMENT FILE, generated using PHP classes.") 
            ->setKeywords("office 2007 openxml php") 
            ->setCategory($header_data->shipment_name);

        //-----------------set header------------------------------
        $objPHPExcel->setActiveSheetIndex(0);
        //------set data----
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', $header_data->shipment_name); 
        $objPHPExcel->getActiveSheet()->SetCellValue('B2', $header_data->date_entered ?? '');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2', $header_data->shipment_type ?? '');
        $objPHPExcel->getActiveSheet()->SetCellValue('D2', $header_data->factory ?? '');
        $objPHPExcel->getActiveSheet()->SetCellValue('E2', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('F2', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('G2', $header_data->bl ?? '');
        $objPHPExcel->getActiveSheet()->SetCellValue('H2', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('I2', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('J2', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('K2', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('L2', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('M2', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('N2', $header_data->bill_date ?? '');
        $objPHPExcel->getActiveSheet()->SetCellValue('O2', $header_data->docs_date ?? '');
        $objPHPExcel->getActiveSheet()->SetCellValue('P2', $header_data->bill ?? '');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q2', $header_data->amount ?? '');

        // $objPHPExcel->getActiveSheet()->SetTitle("SHIPMENT HEADER",0);

             
        //-----SECOND PART
        // $objPHPExcel->createSheet();
        // $objPHPExcel->setActiveSheetIndex(1)->setTitle('SHIPMENT DETAILS');
        $objPHPExcel->setActiveSheetIndex(1);

        //---SET DATA
        $row = 2;
        foreach ($details as $name => $container) {
            for ($i=0; $i < count($container); $i++) { 
                $detail = $container[$i];
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $header_data->shipment_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, $detail->po ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, $detail->style ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, $detail->description ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row, $detail->hts ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, $detail->pcs_carton ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, $detail->ctn ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, $detail->total ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, $detail->uom ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row, $detail->ds ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row, $detail->customer ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row, $detail->ship ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row, $detail->cancel ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row, $detail->customer_po ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row, $detail->so ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row, $detail->inv ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row, $detail->ext_req ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row, $detail->rcvd ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row, $detail->short_over ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row, $detail->notes ?? '');
                $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row, '');

                $row++;
            }   
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
        $objWriter->save("public/uploads/".$header_data->shipment_name."/".$file_name.".xlsx");
        return $this->Shipment_model->updateShipment(['out_1_name'=>$file_name.".xlsx"],$header_data->shipment_id);
    }

    
    public function makeReciver($header_data, $container,$container_name)
    {
        $inputFileName='uploads/template/Receiver Upload.xlsx';
        /**Load$inputFileNametoaPHPExcelObject**/ 
        $objPHPExcel=PHPExcel_IOFactory::load($inputFileName);
        $entered_date = date('m.d.y', strtotime($header_data->date_entered));
        //Receiver Upload #6130 - 10.12.22 - TGHU0169472
        $file_name = "Receiver Upload ".str_replace('S#','#', $header_data->shipment_name)." - ".$entered_date.' - '.$container_name;
        /**Create anew PHPExcelObject**/ 
        // $objPHPExcel=new PHPExcel();
        $objPHPExcel->getProperties() 
            ->setCreator("Albert Cal")
            ->setLastModifiedBy("Albert Cal") 
            ->setTitle($file_name) 
            ->setSubject($file_name) 
            ->setDescription("Receiver Upload #XXXX - CONT , generated using PHP classes.") 
            ->setKeywords("office 2007 openxml php") 
            ->setCategory($header_data->shipment_name);                                                                             
        
        $row = 2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', $container_name.'-'.$header_data->shipment_name); //container #
        for ($i=0; $i < count($container); $i++) { 
            $detail = $container[$i];
            if($detail->single_top == 1 || $detail->multi_top == 1){
                $sku = $detail->notes ?? '';
                $qty = $detail->ctn ?? '';
            } else if($detail->asst == 1) {
                $sku = $detail->style ?? '';
                $qty = $detail->ctn ?? '';
            }
            else {
                $sku = $detail->style ?? '';
                $qty = $detail->total ?? '';
            }
            
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $detail->po ?? ''); //PO#
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, $sku); //SKU
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, $qty ?? ''); //QTY ???
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, $detail->po ?? ''); // Lot# ???
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, 'systemset'); // LocationField3
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, 'Pallet'); // LocationField4
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row, '48'); // COST
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row, '40'); // VarUoMavg
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row, '48'); // ASN or RMA
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row, '100'); // TrackingNumber
            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row, 'CreateMultipleMUs:False'); // MULabel
            $row++;
        }   

        $cellRange = 'A2:Z20';

        // get the alignment object
        $alignment = $objPHPExcel->getActiveSheet()->getStyle($cellRange)->getAlignment();

        // set the horizontal alignment to center
        $alignment->setHorizontal('center');

        // set the vertical alignment to middle
        // $alignment->setVertical('middle');
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
        $objWriter->save("public/uploads/".$header_data->shipment_name."/".$container_name."/".$file_name.".xlsx");
        return $this->Shipment_model->updateShipment(['out_2_name'=>$file_name.".xlsx"],$header_data->shipment_id);
    }

    public function makeMaster($header_data, $container,$container_name)
    {
        // MASTER FILE IMPORT FILE - #6130X 10.12.22 - TGHU0169472
        $entered_date = date('m.d.y', strtotime($header_data->date_entered));
        //Receiver Upload #6130 - 10.12.22 - TGHU0169472
        $file_name = "MASTER FILE IMPORT FILE - ".str_replace('S#','#', $header_data->shipment_name)." ".$entered_date.' - '.$container_name;
        $inputFileName='uploads/template/MASTER FILE IMPORT FILE.xls';
        /**Load$inputFileNametoaPHPExcelObject**/ 
        $objPHPExcel=PHPExcel_IOFactory::load($inputFileName);
        /**Create anew PHPExcelObject**/ 
        
        $objPHPExcel->getProperties() 
            ->setCreator("Albert Cal")
            ->setLastModifiedBy("Albert Cal") 
            ->setTitle($file_name) 
            ->setSubject($file_name) 
            ->setDescription("MASTER FILE IMPORT FILE - #XXXX - CONT, generated using PHP classes.") 
            ->setKeywords("office 2007 openxml php") 
            ->setCategory($header_data->shipment_name);

        $row = 3;                                                                    
        for ($i=0; $i < count($container); $i++) { 
            $detail = $container[$i];
            if ($detail->pl_new == 1) {
                // if($detail->upc == ''){
                //     $upc = $this->Upc_model->getUpcBySku($detail->style)[0];
                //     $upc = $upc->upc ?? '';
                // } else
                    $upc = $detail->upc;
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $detail->style ?? ''); //sku
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $detail->description ?? ''); // description
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $detail->description2); // description2
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, $upc.'' ?? ''); // UPC
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, 'TRUE'); // 
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, 'FALSE'); //
                $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row, 'FALSE'); //
                $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row, $detail->asst == 1 ? 'carton' : 'each'); // Primary Unit of Measure
                $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row, 'Carton'); //
                $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row, $detail->asst == 1 ? '1' : $detail->pcs_carton ?? ''); // Packing UoM QTY
                $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row, round(($detail->length)/2.54,2) ?? ''); // length
                $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row, round(($detail->width)/2.54,2) ?? ''); // width
                $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row, round(($detail->height)/2.54,2) ?? ''); // height
                $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row, round(($detail->weight)*2.205,2) ?? ''); // weight
                $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row, 'TRUE'); // 
                $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row, 'FALSE'); //
                $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row, 'FALSE'); //
                $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$row, 'FALSE'); //
                $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row, 'FALSE'); //
                $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$row, 'FALSE'); //
                $row++;
            }
            
        }   
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
        $objWriter->save("public/uploads/".$header_data->shipment_name."/".$container_name."/".$file_name.".xlsx");
        return $this->Shipment_model->updateShipment(['out_3_name'=>$file_name.".xlsx"],$header_data->shipment_id);
    }

    public function makePLS($header_data,$container_name)
    {
        $shipment_data = $this->Shipment_model->getShipment($header_data->shipment_id)[0];

        $file_path = './public/uploads/'.$shipment_data->name.'/'.$shipment_data->name.'/'.$shipment_data->input_3_name; // Set the source file path
        $extension = explode('.',$shipment_data->input_3_name)[1];
        //PL S# 6130 Cont # TGHU0169472
        $file_name = "PL ".str_replace('S#','S# ', $header_data->shipment_name)." Cont # ".$container_name.'.'.$extension;
        $destination_path = "./public/uploads/".$header_data->shipment_name."/".$container_name."/".$file_name; // Set the destination file path
        
        // Copy the file using the CodeIgniter copy() function
        if (copy($file_path, $destination_path)) {
            return $this->Shipment_model->updateShipment(['out_4_name'=>$file_name],$header_data->shipment_id);
        } else {
            echo 'Unable to copy file.';
        }
        
    }

}