<?php
defined('BASEPATH') OR die('No direct script access allowed!');
    class Report_AbsensiBulan extends CI_Controller
    {
    	public function __construct()
        {
            parent::__construct();
            is_login();
            date_default_timezone_set('Asia/Jakarta');
           
        }
        public function index()
        {
            return $this->List_AbsensiBulan();
        }
        public function List_AbsensiBulan()
        {
            $id_user = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->id_user;
            $nama = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->nama;
            $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
            $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');

            $bagian=$this->input->post('bagian');
            $bulan=$this->input->post('bulan');

            If($bulan=="")  { $bulan=date('m');   } 
            If ($tahun=="") {  $tahun=date('Y');  }
            If($bagian=="") {  $bagian="01";   }
            $Nm_Bagian="";
            if(isset($bagian))
            {
                $check=$this->crud->getDataQuery("Select Nm_Bagian From sdm_bagian Where Kd_Bagian='".$bagian."'");
                if ($check->num_rows()!=0) 
                {
                    foreach ($check->result() as $row)
                    { $Nm_Bagian= $row->Nm_Bagian;}
                }
            }
        
            if(isset($tgl)){
                $tgl=$tgl;
            } else {
                $check=$this->crud->getDataQuery("Select TanggalAbsen From sdm_absensi Order By TanggalAbsen Desc Limit 1");
                if ($check->num_rows()!=0) 
                {
                    foreach ($check->result() as $row)
                    { $tgl=$row->TanggalAbsen;}
                } 
            }
            $data['title']='DAFTAR ABSENSI BULANAN';
            $data['Bagian']=$bagian;
            $data['Nama_Bagian']=$Nm_Bagian;
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['breadcrumb']='';
            $data['all_bulan']=bulan();  
            $data['all_bagian']=$this->crud->getDataQuery("Select * From sdm_bagian Order By Kd_Bagian")->result();
            $data['hari'] = hari_bulan($bulan,$tahun);

            if(isset($bagian))
            {
                $sql="";
                $sql.="Select * From sdm_pegawai Where Aktif='1' And Kd_Bagian='";
                $sql.=$bagian."' Union Select sdm_pegawai.* From sdm_pegawai,sdm_absensi ";
                $sql.="Where sdm_pegawai.Kd_Bagian=sdm_absensi.Kd_Bagian ";
                $sql.="And sdm_pegawai.No_Urut=sdm_absensi.No_Urut AND ";
                $sql.="sdm_pegawai.Aktif='0' AND sdm_pegawai.Kd_Bagian='".$bagian."' ";
                $sql.="And Month(sdm_absensi.TanggalAbsen)=".$bulan." And ";
                $sql.="Year(sdm_absensi.TanggalAbsen)=".$tahun." Order By Kd_Bagian,No_Urut";
                $data['Karyawan'] = $this->crud->getDataQuery($sql)->result();
                $sql="";
                $sql.="Select * from sdm_absensi Where Month(TanggalAbsen)='".$bulan."' And ";
                $sql.="Year(TanggalAbsen)=".$tahun." And Kd_Bagian='".$bagian."'";
                $data['absen'] = $this->crud->getDataQuery($sql)->result();
            // } else {
            //     $sql="";
            //     $sql.="Select * From sdm_pegawai Where Aktif='1' Union Select ";
            //     $sql.="sdm_pegawai.* FROM sdm_pegawai,sdm_absensi Where ";
            //     $sql.="sdm_pegawai.Kd_Bagian=sdm_absensi.Kd_Bagian ";
            //     $sql.="And sdm_pegawai.No_Urut=sdm_absensi.No_Urut And ";
            //     $sql.="sdm_pegawai.Aktif='0' And Month(sdm_absensi.TanggalAbsen)=";
            //     $sql.=$bulan." And Year(sdm_absensi.TanggalAbsen)=".$tahun." ";
            //     $sql.="Order By Kd_Bagian,No_Urut ";
            //     $data['Karyawan'] = $this->crud->getDataQuery($sql)->result();
            //     $sql="Select * from sdm_absensi Where Month(TanggalAbsen)='".$bulan."' And ";
            //     $sql.="Year(TanggalAbsen)=".$tahun." Order By No_Urut";
            //     $data['absen'] = $this->crud->getDataQuery($sql)->result();
            }
            $data['crud'] = $this->crud;
            $this->template->viewAdmin('View_AbsensiBulan',$data);
        }
    }