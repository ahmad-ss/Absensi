<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Checker extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('is_login') != true) {
            redirect('auth');
        }
        $this->load->model('karyawan_model');
        $this->load->model('gaji_model');
        $this->load->model('absensi_model');
    }
    public function checkabsensibulanan()
    {
        $tahun= $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
        $bulan= $this->input->post('bulan') ? $this->input->post('bulan') : date('m');
        $Devisi = $this->input->post('bagian');

        If($bulan=="")  {  $bulan=date('m'); } 
        If($tahun=="") {  $tahun=date('Y'); }
        If($Devisi=="") {  $Devisi=""; }

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['all_bulan']=bulan();
        $data['hari'] = hari_bulan($bulan,$tahun);
        
        $timestamp    = strtotime($tahun.'-'.$bulan);
        $Mulai = date('Y-m-01', $timestamp);
        $Akhir  = date('Y-m-t', $timestamp);
        $tglmin = $this->absensi_model->gettglmin($Mulai, $Akhir);
        $tglmax = $this->absensi_model->gettglmax($Mulai, $Akhir);
        
        if($Devisi == "Warehouse"){
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$Mulai' AND '$Akhir'
                AND `Devisi` IN ('Produksi-Pembahanan','Produksi-Finishing','Produksi-Packing' ,'Produksi-Bongkar Muat' ,'Sample' ) ) 
                GROUP BY k.`ID_Krj`";
                //OR= 'Produksi-Pembahanan'  `Devisi` = 'Produksi-Finishing' OR `Devisi` = 'Produksi-Packing' OR `Devisi` = 'Produksi-Bongkar Muat' OR `Devisi` = 'Sample'
        }else{
            $DataPegawai = "SELECT * 
                FROM `hrd_biodata` k
                JOIN `hrd_joinbagian` j ON k.`ID_Krj` = j.`ID_Krj` 
                WHERE k.`ID_Krj` in (SELECT DISTINCT `ID_Krj` 
                FROM `hrd_detail_absensi` 
                WHERE `Tanggal_Masuk` 
                BETWEEN '$Mulai' AND '$Akhir' AND `Devisi` = '$Devisi') 
                GROUP BY k.`ID_Krj`";
                //AND j.`Tanggal_Keluar` = 'NULL' OR j.`Tanggal_Keluar` = '0000-00-00'
        }
        $query = $this->db->query($DataPegawai);
        $data['all_bagian'] = $this->db->get('hrd_divisi')->result();
        
        $data['Devisi'] = $Devisi;
        $data['tglmin'] = $tglmin;
        $data['tglmax'] = $tglmax;
        $data['Karyawan'] = $query->result_array();
        $data['title'] = 'Check Absensi';
        $data['breadcrumb'] = '';
        $data['crud'] = $this->crud;
        $this->template->viewAdmin('AbsensiChecker/checkAbsensiBln', $data);
    }
    public function kartuabsensi()
    {
            $tahun= $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
            $bulan= $this->input->post('bulan') ? $this->input->post('bulan') : date('m');
            $karyawan=$this->input->post('pegawai');

            If($bulan=="")  {  $bulan=date('m'); } 
            If ($tahun=="") {  $tahun=date('Y'); }

            $data['title']='KARTU ABSENSI';
            $data['karyawan']=$karyawan;
            
            $Nm_Karyawan="";
            $Nm_Bagian="";
            $ID_Krj="";
            

            If(isset($karyawan))
            {
                $pecah = explode(",", $karyawan);
                $ID_Krj = $pecah[1];
                $this->db->select('*'); $this->db->from('hrd_joinbagian'); $this->db->where('ID_Krj', $ID_Krj);
                $check=$this->db->get();
                if ($check->num_rows()!=0) 
                {
                    foreach ($check->result() as $row)
                    { 
                        $Nm_Karyawan= $row->NamaLengkap;
                        $Nm_Bagian= $row->Jabatan;
                    }
                }
            }

            $data['ID_Krj'] = $ID_Krj;
            $data['namakaryawan']=$Nm_Karyawan;
            $data['bagian']=$Nm_Bagian;    
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['breadcrumb']='';
            $data['all_bulan']=bulan();  
            $data['hari'] = hari_bulan($bulan,$tahun);

            $this->db->select('*');
            $this->db->from('hrd_biodata');
            $this->db->join('hrd_joinbagian', 'hrd_joinbagian.ID_Krj=hrd_biodata.ID_Krj');
            $this->db->where('hrd_joinbagian.Kd_Gaji', 'HR');
            $this->db->where('hrd_joinbagian.Tanggal_Keluar', NULL);
            $this->db->or_where('hrd_joinbagian.Tanggal_Keluar', '0000-00-00');
            $this->db->group_by('hrd_biodata.ID_Krj');
            $this->db->order_by('hrd_joinbagian.id');
            
            $data['All_karyawan'] = $this->db->get()->result();
            //$this->crud->getDataQuery($sql)->result();
            $sql="";
            $sql.="Select * from hrd_detail_absensi Where Month(Tanggal_Masuk)='".$bulan."' And ";
            $sql.="Year(Tanggal_Masuk)=".$tahun." And ID_Krj='".$ID_Krj."' And Jabatan='".$Nm_Bagian."'";
            
            $data['absen'] = $this->crud->getDataQuery($sql)->result();
            
            $data['crud'] = $this->crud;
            $this->template->viewAdmin('AbsensiChecker/kartuabsensi',$data);
    }
    

}

?>