<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Editp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load Helper for Form
        $this->load->helper('url', 'form');
        $this->load->library('form_validation');
        $this->load->model('karyawan_model');
    }

    public function update_karyawan()
    {

        $DataKaryawan = $this->input->post();
        //ambil data

        /*$cbg = $this->db->get_where('hrd_cabang', array('Kd_Cabang' => $DataKaryawan['cbg']))->result_array();
        $jbtn = $this->db->get_where('hrd_jabatan', array('Kd_Jabatan' => $DataKaryawan['jbtn']))->result_array();
        $div = $this->db->get_where('hrd_divisi', array('Kd_Divisi' => $DataKaryawan['div']))->result_array();
        if ($cbg == NULL || $jbtn == NULL || $div == NULL) {
            $cbg['0']['Cabang'] = NULL;
            $jbtn['0']['Jabatan'] = NULL;
            $div['0']['Devisi'] = NULL;
        }*/

        $DataKaryawan = $this->input->post();
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
        $gjlembur = $DataKaryawan['gajilembur'];
        /*$Kd_gaji = $DataKaryawan['kdgaji'];
        $wgaji = $this->db->get_where('hrd_waktugajian', array('Kd_Waktu' => $Kd_gaji))->result_array();
        $wgajian = $wgaji['0']['Waktu'];
        $kdCabang = $DataKaryawan['cbg'];
        $cabang = $cbg['0']['Cabang'];
        $kdJabatan = $DataKaryawan['jbtn'];
        $Jabatan = $jbtn['0']['Jabatan'];
        $Jabatan = strtoupper($Jabatan); //Gedein
        $kdDivisi = $DataKaryawan['div'];
        $Divisi = $div['0']['Devisi'];*/
        //TIDAK TERPAKAI KARENA SEKARANG DIDISABLE
        //$Kd_gaji, $wgajian, $kdCabang, $cabang, $kdJabatan, $Jabatan, $kdDivisi, $Divisi, 
        $Tgl_Masuk = $DataKaryawan['tglmasuk'];
        $Nama_user = $DataKaryawan['usr'];
        $Pass = $DataKaryawan['pass'];
        $idkrj = $this->uri->segment(3);

        $this->load->model('karyawan_model');
        $insert = $this->karyawan_model->update_karyawan($idkrj, $NIK, $NKK, $NIP, $NamaLengkap, $BPJS_KIS, $BPJS_TK, $Tempat_Lahir, $Tgl_Lahir, $Tgl_Masuk, $Nama_user, $Pass, $gaji, $gjlembur);
        if ($insert == TRUE) {
            echo "<script type=\"text/javascript\">alert('" . $idkrj . " Update Berhasil Tersimpan');</script>";
            redirect(base_url('dashboard/Editkary/' . $idkrj), 'refresh');
        } else {
            echo "<script type=\"text/javascript\">alert('" . $idkrj . " Eror');</script>";
            redirect(base_url('dashboard/Editkary/' . $idkrj), 'refresh');
        }
    }
    public function update_bpjs()
    {
        $potbpjs = $this->input->post('potbpjs');
        $id = $this->input->post('idkrj');
        $pecah = explode(",", $id);
        $idkrj = $pecah[0];
        if ($idkrj == 'Pilih Karyawan' || $id == null) {
            echo "<script type=\"text/javascript\">alert('Mohon Pilih Karyawan Yang Benar');</script>";
            redirect(base_url('dashboard/Potbpjs'), 'refresh');
        }
        $this->load->model('karyawan_model');
        $insert = $this->karyawan_model->update_potbpjs($idkrj, $potbpjs);
        if ($insert == TRUE) {
            echo "<script type=\"text/javascript\">alert('" . $idkrj . ":" . $potbpjs . " Berhasil Tersimpan');</script>";
            redirect(base_url('dashboard/Potbpjs'), 'refresh');
        }
    }
    public function update_gajikary_harian()
    {
        $id = $this->input->post('idkrj');
        $pecah = explode(",", $id);
        $idkrj = $pecah[0];
        $gaji = $this->input->post('gaji');
        $getkdgaji = $this->db->get_where('hrd_gajikarywan', array('ID_Krj' => $idkrj))->result_array();
        if ($getkdgaji == NULL || $id == null) {
            echo "<script type=\"text/javascript\">alert('Mohon Pilih Karyawan Yang Benar');</script>";
            redirect(base_url('dashboard/Naikgaji'), 'refresh');
        }
        $Kd_gaji = $getkdgaji['0']['Kd_Gaji'];

        $this->load->model('karyawan_model');
        $insert = $this->karyawan_model->naik_gaji_harian($idkrj, $Kd_gaji, $gaji);
        $insert = true;
        if ($insert == TRUE) {
            echo "<script type=\"text/javascript\">alert('" . $idkrj . ":" . $gaji . " Berhasil Tersimpan');</script>";
            redirect(base_url('dashboard/Naikgaji'), 'refresh');
        }
    }
    public function pecat_karyawan()
    {
        $id = $this->input->post('kryw');
        $pecah = explode(",", $id);
        $idkrj = $pecah[0];
        if ($idkrj == 'Pecat/Resign') {
            echo "<script type=\"text/javascript\">alert('Mohon Pilih Karyawan Yang Benar');</script>";
            redirect(base_url('dashboard/Pecatkary'), 'refresh');
        }
        $tglklr = $this->input->post('tglklr');
        $alasan = $this->input->post('alasan');

        $this->load->model('karyawan_model');
        $insert = $this->karyawan_model->pecat_tkaryawan($idkrj, $tglklr, $alasan);
        if ($insert == TRUE) {
            echo "<script type=\"text/javascript\">alert('Telah Di Pecat" . $idkrj . " : " . $tglklr . " alasan : " . $alasan . "');</script>";
            redirect(base_url('dashboard/Pecatkary'), 'refresh');
        }
    }
    public function pindah_bagian()
    {
        $id = $this->input->post('kryw');
        $pecah = explode(",", $id);
        $idkrj = $pecah[0];
        if ($idkrj == 'Pilih Karyawan') {
            echo "<script type=\"text/javascript\">alert('Mohon Pilih Karyawan Yang Benar');</script>";
            redirect(base_url('dashboard/Pindah_Bagian'), 'refresh');
        }
        $DataKaryawan = $this->input->post();
        //ambil data
        if (!isset($DataKaryawan['cbg'])) {
            $cbg = NULL;
        } elseif (!isset($DataKaryawan['jbtn'])) {
            $jbtn = NULL;
        } elseif (!isset($DataKaryawan['div'])) {
            $div = NULL;
        } else {
            $jbtn = $DataKaryawan['jbtn'];
            $cbg = $DataKaryawan['cbg'];
            $div = $DataKaryawan['div'];
        }

        $cbng = $this->db->get_where('hrd_cabang', array('Kd_Cabang' => $cbg))->result_array();
        $jtn = $this->db->get_where('hrd_jabatan', array('Kd_Jabatan' => $jbtn))->result_array();
        $divi = $this->db->get_where('hrd_divisi', array('Kd_divisi' => $div))->result_array();
        if ($cbng == NULL) {
            $cbng['0']['Cabang'] = NULL;
        }
        if ($jtn == NULL) {
            $jtn['0']['Jabatan'] = NULL;
        }
        if ($divi == NULL) {
            $divi['0']['Devisi'] = NULL;
        }

        $cabang = $cbng['0']['Cabang'];
        $jabatan = $jtn['0']['Jabatan'];
        $divisi = $divi['0']['Devisi'];
        //////////////////update joinbagian
        $this->load->model('karyawan_model');
        $update = $this->karyawan_model->pindah_tkaryawan($idkrj, $jbtn, $cbg, $jabatan, $cabang, $div, $divisi);
        //UPDATE IDKRJ
        // $idkrj_baru = $this->karyawan_model->rubah_idkrj($idkrj);
        // $this->karyawan_model->update_idkrj($idkrj, $idkrj_baru, 'hrd_biodata');
        // $this->karyawan_model->update_idkrj($idkrj, $idkrj_baru, 'hrd_gajikarywan');
        // $this->karyawan_model->update_idkrj($idkrj, $idkrj_baru, 'hrd_joinbagian');
        //REDIRECT
        if ($update == true) {
            echo "<script type=\"text/javascript\">alert('Berhasil Pindah Bagian" . $idkrj . " : " . $cabang . " - " . $jabatan . " - " . $divisi . "');</script>";
            redirect(base_url('dashboard/Pindah_Bagian'), 'refresh');
        }
    }
    public function uploadfoto()
    {
        $idkrj = $this->uri->segment(3);
        $nik = $this->input->post('nik');
        if (!is_dir('./Profil/')) {
            mkdir('./Profil/');
        }
        $path = './Profil/' . $nik . '/';
        if (!is_dir($path)) {
            mkdir($path);
        }

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        //$config['max_size'] = 2000;
        $config['overwrite'] = true;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            echo "<script type=\"text/javascript\">alert('" . $error['error'] . "');</script>";
            redirect(base_url('dashboard/Editkary/' . $idkrj), 'refresh');
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $namafile = $data['image_metadata']['file_name'];
            $dt = array('Foto' => $path . $namafile);
            $this->karyawan_model->upload_tfoto($idkrj, $dt);
            echo "<script type=\"text/javascript\">alert('" . $namafile . "-- Berhasil Upload');</script>";
            redirect(base_url('dashboard/Editkary/' . $idkrj), 'refresh');
        }
    }
    public function uploadberkas()
    {
        $this->load->model('karyawan_model');
        $idkrj = $this->uri->segment(3);
        $nik = $this->input->post('nik');
        if (!is_dir('./Softcopy_Data_Karyawan/')) {
            mkdir('./Softcopy_Data_Karyawan/');
        }
        $path = './Softcopy_Data_Karyawan/' . $nik . '/';
        if (!is_dir($path)) {
            mkdir($path);
        }
        /////////////////////////////////////////
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        //$config['max_size'] = 2000;
        $config['overwrite'] = true;
        $this->load->library('upload', $config);
        //Mulai upload
        if (!$this->upload->do_upload('bpjskis')) {
            $bpjskis = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $bpjskis = $data['image_metadata']['file_name'];
            $dt = $path . $bpjskis;
            $bkis = array('Foto_BPJS_KIS' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $bkis);
        }
        //////////////////
        if (!$this->upload->do_upload('bpjstk')) {
            $bpjstk = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $bpjstk = $data['image_metadata']['file_name'];
            $dt = $path . $bpjstk;
            $btk = array('Foto_BPJS_TK' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $btk);
        }
        ///////////////
        if (!$this->upload->do_upload('kk')) {
            $kk = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $kk = $data['image_metadata']['file_name'];
            $dt = $path . $kk;
            $fkk = array('Foto_KK' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $fkk);
        }
        ////////////////
        if (!$this->upload->do_upload('ktp')) {
            $ktp = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $ktp = $data['image_metadata']['file_name'];
            $dt = $path . $ktp;
            $fktp = array('Foto_KTP' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $fktp);
        }
        ////////////
        if (!$this->upload->do_upload('akte')) {
            $akte = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $akte = $data['image_metadata']['file_name'];
            $dt = $path . $akte;
            $fakte = array('Foto_Akte' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $fakte);
        }
        ///////////
        if (!$this->upload->do_upload('kontrak')) {
            $kontrak = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $kontrak = $data['image_metadata']['file_name'];
            $dt = $path . $kontrak;
            $fkontrak = array('Foto_Kontrak' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $fkontrak);
        }
        ///////////
        if (!$this->upload->do_upload('lamaran')) {
            $lamaran = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $lamaran = $data['image_metadata']['file_name'];
            $dt = $path . $lamaran;
            $flamaran = array('Foto_Lamaran' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $flamaran);
        }
        ////////////
        if (!$this->upload->do_upload('skck')) {
            $skck = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $skck = $data['image_metadata']['file_name'];
            $dt = $path . $skck;
            $fskck = array('Foto_SKCK' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $fskck);
        }
        ////////////
        if (!$this->upload->do_upload('ijazah')) {
            $ijazah = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $ijazah = $data['image_metadata']['file_name'];
            $dt = $path . $ijazah;
            $fijazah = array('Foto_Ijazah' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $fijazah);
        }
        ////////////
        if (!$this->upload->do_upload('cv')) {
            $cv = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $cv = $data['image_metadata']['file_name'];
            $dt = $path . $cv;
            $fcv = array('Foto_CV' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $fcv);
        }
        /////////
        if (!$this->upload->do_upload('sertif')) {
            $sertif = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $sertif = $data['image_metadata']['file_name'];
            $dt = $path . $sertif;
            $fsertifikat = array('Foto_Sertifikat' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $fsertifikat);
        }
        //////////
        if (!$this->upload->do_upload('sim')) {
            $sim = NULL;
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $sim = $data['image_metadata']['file_name'];
            $dt = $path . $sim;
            $fsim = array('Foto_SIM' => $dt);
            $this->karyawan_model->upload_tberkas($idkrj, $fsim);
        }
        //$return = $this->karyawan_model->upload_tberkas($idkrj, $bpjskis, $bpjstk, $kk, $ktp, $akte, $kontrak, $lamaran, $skck, $ijazah, $cv, $sertif, $sim);
        redirect(base_url('dashboard/Editkary/' . $idkrj), 'refresh');
    }
}
