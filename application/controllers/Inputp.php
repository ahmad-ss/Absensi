<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Inputp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata() != true) {
            redirect('auth');
        }
        $this->load->model('karyawan_model');
        $this->load->model('gaji_model');
    }
    public function add_karyawan()
    {
        //buat id
        /*$tahun = date('Y');
        $bulan = date('m');
        $data = $this->buatkode($tahun, $bulan);
        $idkrj = $data['idkrj'];
        $id = $data['id'];
        */
        $DataKaryawan = $this->input->post();
        //ambil data

        $cbg = $this->db->get_where('hrd_cabang', array('Kd_Cabang' => $DataKaryawan['cbg']))->result_array();
        $jbtn = $this->db->get_where('hrd_jabatan', array('Kd_Jabatan' => $DataKaryawan['jbtn']))->result_array();
        $div = $this->db->get_where('hrd_divisi', array('Kd_Divisi' => $DataKaryawan['div']))->result_array();
        if ($cbg == NULL) {
            $cbg['0']['Cabang'] = NULL;
        }
        if ($jbtn == NULL) {
            $jbtn['0']['Jabatan'] = NULL;
        }
        if ($div == NULL) {
            $div['0']['Devisi'] = NULL;
        }
        //$DataKaryawan = $this->input->post();
        $NIK = $DataKaryawan['NIK'];
        $NKK = $DataKaryawan['NKK'];
        $NIP = $DataKaryawan['NIP'];
        $NamaLengkap = $DataKaryawan['NAMA'];
        $NamaLengkap = strtoupper($NamaLengkap); //Gedein
        $BPJS_KIS = $DataKaryawan['bpjskis'];
        $BPJS_TK = $DataKaryawan['bpjstk'];
        $Tempat_Lahir = $DataKaryawan['TmptLhr'];
        $Tgl_Lahir = $DataKaryawan['TglLhr'];
        $gaji = $DataKaryawan['gaji'];
        $gajilembur = $DataKaryawan['gajilembur'];
        $Kd_gaji = $DataKaryawan['kdgaji'];
        $wgajian = $DataKaryawan['waktu'];
        $kdCabang = $DataKaryawan['cbg'];
        $cabang = $cbg['0']['Cabang'];
        $kdJabatan = $DataKaryawan['jbtn'];
        $Jabatan = $jbtn['0']['Jabatan'];
        $Jabatan = strtoupper($Jabatan); //Gedein
        $kdDivisi = $DataKaryawan['div'];
        $Divisi = $div['0']['Devisi'];
        $Tgl_Masuk = $DataKaryawan['tglmasuk'];
        //$Nama_user = $DataKaryawan['namausr'];
        //$Pass = $DataKaryawan['pwd'];
        //*********Buat ID_Krj harian,jabatan,divis
        $idcode = $this->GenerateCode($Kd_gaji, $kdJabatan, $kdDivisi);
        echo $idcode . " ---  wkkwkwkwkkkwkwkwkkw";

        $this->load->library('session');
        $this->load->model('karyawan_model');
        $insert = $this->karyawan_model->input_karyawan($idcode, $NIK, $NKK, $NIP, $NamaLengkap, $BPJS_KIS, $BPJS_TK, $Tempat_Lahir, $Tgl_Lahir, $Kd_gaji, $wgajian, $kdCabang, $cabang, $kdJabatan, $Jabatan, $kdDivisi, $Divisi, $Tgl_Masuk, $gaji, $gajilembur);
        if ($insert == TRUE) {
            echo "<script type=\"text/javascript\">alert('" . $NamaLengkap . " Berhasil Tersimpan');</script>";
            redirect(base_url('dashboard/Editkary/' . $idcode), 'refresh');
        }
    }
    function buatkode($tahun, $bulan)
    {
        $getid = $this->db->query('SELECT MAX(id) AS LastId FROM hrd_biodata')->result_array();
        $lastid = $getid['0']['LastId'];
        $lastid = $lastid + 1;
        $idkrj = $tahun . $bulan . $lastid;
        $data['idkrj'] = $idkrj;
        $data['id'] = $lastid;
        return $data;
    }

    public function add_harilibur()
    {
        $Datahrlbr = $this->input->post();
        $namahrlbr = $Datahrlbr['namahr'];
        $tgllbr = $Datahrlbr['tgllbr'];

        $this->load->model('karyawan_model');
        $insert = $this->karyawan_model->input_hrlbr($namahrlbr, $tgllbr);
        if ($insert == TRUE) {
            echo "<script type=\"text/javascript\">alert('" . $namahrlbr . " Berhasil Tersimpan');</script>";
            redirect(base_url('dashboard/Hari_Libur'), 'refresh');
        }
    }
    public function GenerateCode($tipe, $jabatan, $divisi)
    {
        $alpabhetcode = $tipe . $jabatan . $divisi;
        $countcode = $this->karyawan_model->countcode($alpabhetcode);

        $idcode = $alpabhetcode . $countcode;

        return $idcode;
    }
}
