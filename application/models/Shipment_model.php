<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipment_model extends CI_Model {
    /**
     * You can learn from Codeigniter 3 userguide about active record
     * Reference: https://www.codeigniter.com/userguide3/database/query_builder.html
     */
	public function getindex()
	{
        $this->db->from('shipment');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function createShipment($data)
    {
        $this->db->trans_start();
        $this->db->insert('shipment', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }
    }
    public function getShipment($shipment_id)
    {
        $this->db->select('
            id, 
            name, 
            input_1_name,
            input_2_name,
            input_3_name,
            input_4_name,
            output_1_name,
            output_2_name,
            output_3_name,
            output_4_name
        ');
        $this->db->from('shipment');
        $this->db->where('id', $shipment_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function updateShipment($data, $shipment_id)
    {
        $this->db->trans_start();
        $this->db->where('id', $shipment_id);
        $this->db->update('shipment', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }

    }
    public function deleteShipment($shipment_id)
    {
        $this->db->trans_start();
        $this->db->where('id', $shipment_id);
        $this->db->delete('shipment');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }
    }
}