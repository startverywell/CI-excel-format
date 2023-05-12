<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SkuList_model extends CI_Model {
    /**
     * You can learn from Codeigniter 3 userguide about active record
     * Reference: https://www.codeigniter.com/userguide3/database/query_builder.html
     */
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
        $this->db->select('
            id, 
            sku, 
            description,
            description2,
            qty,
        ');
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

    public function checkSku($sku)
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
}