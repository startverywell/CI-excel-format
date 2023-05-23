<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header_model extends CI_Model {
    /**
     * You can learn from Codeigniter 3 userguide about active record
     * Reference: https://www.codeigniter.com/userguide3/database/query_builder.html
     */
	public function getindex()
	{
        $query = $this->db->query(
            'SELECT 
                shipment.`name` as name, 
                shipment_header.* 
            from shipment_header 
            LEFT JOIN shipment 
                on shipment_header.shipment_id = shipment.id'
        );
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function createHeader($data)
    {
        $data['date_entered'] = $this->changeDate($data['date_entered']);
        $data['bill_date'] = $this->changeDate($data['bill_date']);
        $data['docs_date'] = $this->changeDate($data['docs_date']);
        
        $this->db->trans_start();
        $this->db->insert('shipment_header', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }
    }
    public function getHeader($header_id)
    {
        $query = $this->db->query(
            'SELECT 
                shipment.`name` as shipment_name, 
                shipment_header.* 
            from shipment_header 
            LEFT JOIN shipment 
                on shipment_header.shipment_id = shipment.id
            WHERE  shipment_header.id = '.$header_id.'  
            '
        );
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getHeaderbyShipID($id)
    {
        $query = $this->db->query(
            'SELECT 
                shipment.`name` as shipment_name, 
                shipment_header.* 
            from shipment_header 
            LEFT JOIN shipment 
                on shipment_header.shipment_id = shipment.id
            WHERE  shipment_header.shipment_id = '.$id.'  
            '
        );
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function updateHeader($data, $header_id)
    {
        $this->db->trans_start();
        $this->db->where('id', $header_id);
        $this->db->update('shipment_header', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }

    }
    public function deleteHeader($header_id)
    {
        $this->db->trans_start();
        $this->db->where('id', $header_id);
        $this->db->delete('shipment_header');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }
    }

    // convert mm-dd-yyyy to Y-m-d
    private function changeDate($date)
    {
        $dates = explode('-', $date);
        if(count($dates) == 3)
            return $dates[2].'-'.$dates[0].'-'.$dates[1];
        else{
            $dates = explode('/', $date);
            return $dates[2].'-'.$dates[0].'-'.$dates[1];
        }
    }
}