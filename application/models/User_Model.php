<?php
defined('BASEPATH') OR die('No direct script access allowed');

class User_Model extends CI_Model
{
    public function find_by($query, $return = FALSE)
    {
        $data = $this->db->query($query);
        if ($return) {
            return $data->row();
        }
        return $data;
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_user', $id);
        $result = $this->db->update('users', $data);
        return $result;
    }
}

