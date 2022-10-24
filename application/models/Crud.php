<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model {

    public function getDataWhere($tbl,$data){
        return $this->db->get_where($tbl,$data);
    }

    public function insertDataSave($tbl,$data){
        $this->db->insert($tbl,$data);
        $last_id = $this->db->insert_id();
        if($this->db->affected_rows() > 0){
            $return = array(
                'code' => 0,
                'message' => "Data saved",
                'last_id' => $last_id
            );
        }
        else{
            $return = array(
                'code' => 1,
                'message' => "Data not saved"
            );
        }
        return $return;
    }

    public function getDataQuery($sql){
        return $this->db->query($sql);
    }

    public function updData($tbl,$where,$data){
        $this->db->where($where);
        $this->db->update($tbl,$data);
        if($this->db->affected_rows() > 0){
            $return = array(
                'code' => 0,
                'message' => "Update successful"
            );
        }
        else{
            $return = array(
                'code' => 1,
                'message' => "Update unsuccessful"
            );
        }
        return $return;
    }

    public function selectAll($tbl){
        return $this->db->get($tbl);
    }

    public function selectAllOrderby($tbl,$col,$order){
        $this->db->order_by($col,$order);
        return $this->db->get($tbl);
    }

    public function getBulan($bln){
        $m = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        return $m[$bln];
    }
    public function getHari($Tgl){
        // $Hr=date('l', strtotime($tgl));
        $daftar_hari = array(
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        );
        $namahari=date('l', strtotime($Tgl));
        return $daftar_hari[$namahari];
    }
    public function tgl_indo($tanggal){
        $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
 
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    
    public function CekHariLibur($tanggal)
    {
        $Libur=false;
        If(date('l', strtotime($tanggal))=='Sunday')  {  $Libur=true;  }
        $qry="";
        $qry.="Select NamaHariLibur From hrd_harilibur Where Tanggal='".$tanggal."'";
        if($this->db->query($qry)->row() !=0) { $Libur=true;  }
        return $Libur;
    }
}