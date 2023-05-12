<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container_model extends CI_Model {
    /**
     * You can learn from Codeigniter 3 userguide about active record
     * Reference: https://www.codeigniter.com/userguide3/database/query_builder.html
     */
	public function getindex()
	{
        $query = $this->db->query(
            'SELECT 
                shipment.`name` as shipment_name, 
                container.* 
            from container 
            LEFT JOIN shipment 
                on container.shipment_id = shipment.id'
        );
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getContainers($ship_id)
    {
        $query = $this->db->query(
            'SELECT 
                shipment.`name` as shipment_name, 
                container.* 
            from container 
            LEFT JOIN shipment 
                on container.shipment_id = shipment.id
            WHERE container.shipment_id = '.$ship_id.'
            '
        );
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function createContainer($data)
    {
        $this->db->trans_start();
        $this->db->insert('container', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }
    }
    public function getContainer($container_id)
    {
        $query = $this->db->query(
            'SELECT 
                shipment.`name` as shipment_name, 
                container.* 
            from container 
            LEFT JOIN shipment 
                on container.shipment_id = shipment.id
            WHERE container.id = '.$container_id.'
            '
        );
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function updateContainer($data, $container_id)
    {
        $this->db->trans_start();
        $this->db->where('id', $container_id);
        $this->db->update('container', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
           return false;
        }
        else {
            return true;
        }

    }
    
    public function deleteContainer($container_id)
    {
        $this->db->trans_start();
        $this->db->where('id', $container_id);
        $this->db->delete('container');
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