<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Gaji_model extends CI_Model
{
    public function Hari_Libur()
    {
        $data = array(
            "Tanggal" => $this->input->post('tgl'),
            "NamaHariLibur" => $this->input->post('namahrlbr')
        );
        return $this->db->insert('Hrd_HariLibur');
    }
}
