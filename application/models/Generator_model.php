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
        foreach ($container_data as $key => $container) {
            $details[$container->name] = $this->Details_model->getIndex($container->id);
        }
        $this->makeShipment($header_data, $details);
        $this->makeReciver($header_data);
        $this->makeMaster($header_data);
        $this->makePLS($header_data);
        
    }

    public function makeShipment($header_data, $details)
    {
        $file_name = "SHIPMENT FILE   ".$header_data->shipment_name;
        /**Create anew PHPExcelObject**/ 
        $objPHPExcel=new PHPExcel();
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
        $row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', "S#"); 
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', "ADDED");
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', "TYPE");
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', "FACTORY");
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', "CUSTOMER/SB");
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', "FWDR");
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', "BL#");
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', "CONT/FCR#");
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', "ETD/DROPOFF");
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', "ETA /VSSL");
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', "3PL ETA");
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', "RCVD/CLOSED");
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', "NOTES");
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', "BILL/INV DATE");
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', "DOCS RCVD");
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', "BILL#");
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', "AMOUNT");

        //-----color
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('868df1');
        $objPHPExcel->getActiveSheet()->getStyle('H1:J1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('ff0011');
        $objPHPExcel->getActiveSheet()->getStyle('K1:K1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('ff8811');
        $objPHPExcel->getActiveSheet()->getStyle('L1:M1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('1188cc');
        $objPHPExcel->getActiveSheet()->getStyle('N1:Q1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('11cc11');

        //----column
        // $objPHPExcel->getActiveSheet()->getColumnDimension('B')->;
        //----font 

        $style = $objPHPExcel->getActiveSheet()->getStyle('A1:Q2');
        $border = $style->getBorders();
        $border->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $border->getAllBorders()->setColor(new PHPExcel_Style_Color('FF0000'));
        $font = new PHPExcel_Style_Font();
        //set the name of the font
        $font->setName('Calibri');
        //set the size of the font
        $font->setSize(11);
        //set the bold property to true
        $font->setBold(true);

        //apply the font to the style object
        $style->setFont($font);                                                                             
        $objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); 

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

        $objPHPExcel->getActiveSheet()->SetTitle("SHIPMENT HEADER",0);

             
        //-----SECOND PART
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(1)->setTitle('SHIPMENT DETAILS');

        // SET HEADER
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', "S#"); 
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', "TYPE");
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', "ETD");
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', "3PL ETA/POE VSSL");
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', "FACTORY");
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', "SB PO");
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', "STYLE");
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', "DESCRIPTION");
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', "HTS");
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', "PCS/CTN");
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', "CTN");
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', "TOTAL");
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', "UOM");
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', "DS");
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', "CUSTOMER");
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', "SHIP");
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', "CANCEL");
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', "CUSTOMER PO");
        $objPHPExcel->getActiveSheet()->SetCellValue('S1', "SO");
        $objPHPExcel->getActiveSheet()->SetCellValue('T1', "INV");
        $objPHPExcel->getActiveSheet()->SetCellValue('U1', "EXT REQ");
        $objPHPExcel->getActiveSheet()->SetCellValue('V1', "RCVD");
        $objPHPExcel->getActiveSheet()->SetCellValue('W1', "SHORT/OVER");
        $objPHPExcel->getActiveSheet()->SetCellValue('X1', "NOTES");
        $objPHPExcel->getActiveSheet()->SetCellValue('Y1', "LATE");
        
        //-----color
        $objPHPExcel->getActiveSheet()->getStyle('A1:A1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('0011ff');
        $objPHPExcel->getActiveSheet()->getStyle('B1:E1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('ff0011');
        $objPHPExcel->getActiveSheet()->getStyle('F1:M1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('ff8811');
        $objPHPExcel->getActiveSheet()->getStyle('N1:S1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('1188cc');
        $objPHPExcel->getActiveSheet()->getStyle('T1:T1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('11cc11');
        $objPHPExcel->getActiveSheet()->getStyle('U1:Y1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()->setRGB('11ccFF');

        $style = $objPHPExcel->getActiveSheet()->getStyle('A1:Y100');
        // $border = $style->getBorders();
        // $border->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        // $border->getAllBorders()->setColor(new PHPExcel_Style_Color('FF0000'));
        $font = new PHPExcel_Style_Font();
        //set the name of the font
        $font->setName('Calibri');
        //set the size of the font
        $font->setSize(11);
        //set the bold property to true
        $font->setBold(true);

        //apply the font to the style object
        $style->setFont($font);                                                                             
        $objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE); 

        //---SET DATA
        $row = 2;
        foreach ($details as $name => $container) {
            foreach ($container as $key => $detail) {
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
            }
            $row++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
        $objWriter->save("uploads/".$header_data->shipment_name."/".$file_name.".xlsx");
        return $this->Shipment_model->updateShipment(['out_1_name'=>$file_name.".xlsx"],$header_data->shipment_id);
    }

    public function makePLS($header_data)
    {
        $file_name = "PL ".$header_data->shipment_name." Cont ".$header_data->shipment_name;
        /**Create anew PHPExcelObject**/ 
        $objPHPExcel=new PHPExcel();
        $objPHPExcel->getProperties() 
            ->setCreator("Albert Cal")
            ->setLastModifiedBy("Albert Cal") 
            ->setTitle($file_name) 
            ->setSubject($file_name) 
            ->setDescription("PL S# XXXX Cont # XXX, generated using PHP classes.") 
            ->setKeywords("office 2007 openxml php") 
            ->setCategory($header_data->shipment_name);
        
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
        $objWriter->save("uploads/".$header_data->shipment_name."/".$file_name.".xlsx");
        return $this->Shipment_model->updateShipment(['out_4_name'=>$file_name.".xlsx"],$header_data->shipment_id);
    }

    public function makeReciver($header_data)
    {
        $inputFileName='uploads/template/Receiver Upload.xlsx';
        /**Load$inputFileNametoaPHPExcelObject**/ 
        $objPHPExcel=PHPExcel_IOFactory::load($inputFileName);
        
        $file_name = "Receiver Upload ".$header_data->shipment_name."- Cont ";
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
        
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
        $objWriter->save("uploads/".$header_data->shipment_name."/".$file_name.".xlsx");
        return $this->Shipment_model->updateShipment(['out_2_name'=>$file_name.".xlsx"],$header_data->shipment_id);
    }

    public function makeMaster($header_data)
    {
        $file_name = "MASTER FILE IMPORT FILE - ".$header_data->shipment_name."- Cont ";
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

                                                                               
        
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
        $objWriter->save("uploads/".$header_data->shipment_name."/".$file_name.".xlsx");
        return $this->Shipment_model->updateShipment(['out_3_name'=>$file_name.".xlsx"],$header_data->shipment_id);
    }

}