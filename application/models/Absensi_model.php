<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Absensi_model extends CI_Model
{
    public function get_absen($id_user, $bulan, $tahun)
    {
        $this->db->select("DATE_FORMAT(a.tgl, '%d-%m-%Y') AS tgl, a.waktu AS jam_masuk, (SELECT waktu FROM absensi al WHERE al.tgl = a.tgl AND id_user = '6' AND al.keterangan != a.keterangan) AS jam_pulang");
        $this->db->where('id_user', $id_user);
        $this->db->where("DATE_FORMAT(tgl, '%m') = ", $bulan);
        $this->db->where("DATE_FORMAT(tgl, '%Y') = ", $tahun);
        $this->db->group_by("tgl");
        $result = $this->db->get('absensi a');
        return $result->result_array();
    }

    public function absen_harian_user($id_user)
    {
        $today = date('Y-m-d');
        $this->db->where('tgl', $today);
        $this->db->where('id_user', $id_user);
        $data = $this->db->get('absensi');
        return $data;
    }

    public function insert_data($data)
    {
        $result = $this->db->insert('absensi', $data);
        return $result;
    }

    public function get_jam_by_time($time)
    {
        $this->db->where('start', $time, '<=');
        $this->db->or_where('finish', $time, '>=');
        $data = $this->db->get('jam');
        return $data->row();
    }

    public function cek_absen($idkrj, $tgl)
    {
        $PanggilAbsen = "SELECT * FROM `hrd_detail_absensi` WHERE `ID_Krj` = '$idkrj' AND `Tanggal_Masuk` = '$tgl'";
        $this->db->select('*');
        $this->db->where('ID_Krj', $idkrj);
        $this->db->where('Tanggal_Masuk', $tgl);
        $absen = $this->db->get('hrd_detail_absensi')->result_array();
        if ($absen == null) {
            //return A;
        } else {
            $cek = $absen['0'];
            if ($cek['Jam_Masuk'] == $cek['Absen_Masuk']) {
                //return M;
            } else {
                //return T;
            }
        }
    }

    public function gettglmin($mulai, $akhir)
    {
        $this->db->select_min('Tanggal_Masuk');
        $this->db->where('Tanggal_Masuk >=', $mulai);
        $this->db->where('Tanggal_Masuk <=', $akhir);
        $result = $this->db->get('hrd_detail_absensi')->result_array();

        return $result['0']['Tanggal_Masuk'];
    }
    public function gettglmax($mulai, $akhir)
    {
        $this->db->select_max('Tanggal_Masuk');
        $this->db->where('Tanggal_Masuk >=', $mulai);
        $this->db->where('Tanggal_Masuk <=', $akhir);
        $result = $this->db->get('hrd_detail_absensi')->result_array();

        return $result['0']['Tanggal_Masuk'];
    }
}



/* End of File: d:\Ampps\www\project\absen-pegawai\application\models\Absensi_model.php */