<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Details_model extends CI_Model {
    /**
     * You can learn from Codeigniter 3 userguide about active record
     * Reference: https://www.codeigniter.com/userguide3/database/query_builder.html
     */
	public function getIndex($container_id)
	{
        $this->db->from('shipment_details');
        $this->db->where('container_id', $container_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function createDetails($data)
    {
        $this->db->trans_start();
        $this->db->insert('shipment_details', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }
        else {
            return true;
        }
    }

    public function getDetails($id)
    {
        $this->db->from('shipment_details');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function updateDetails($data, $Details_id)
    {
        $this->db->trans_start();
        $this->db->where('id', $Details_id);
        $this->db->update('shipment_details', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }

    }
    public function deleteDetails($Details_id)
    {
        $this->db->trans_start();
        $this->db->where('id', $Details_id);
        $this->db->delete('shipment_details');
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