<?php
defined('BASEPATH') OR die('No direct script access allowed!');
    class Report_KartuAbsensi extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            is_login();
            date_default_timezone_set('Asia/Jakarta');   
        }
        public function index()
        {
            return $this->List_KartuAbsensi();
        }
        public function List_KartuAbsensi()
        {
            $id_user = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->id_user;
            $nama= $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->nama;
            $tahun= $this->input->post('tahun') ? $this->input->post('tahun') : date('Y');
            $bulan= $this->input->post('bulan') ? $this->input->post('bulan') : date('m');
            $karyawan=$this->input->post('pegawai');
            

            If($bulan=="")  {  $bulan=date('m'); } 
            If ($tahun=="") {  $tahun=date('Y'); }

            $data['title']='KARTU ABSENSI';
            $data['karyawan']=$karyawan;
            
            $Nm_Karyawan="";
            $Nm_Bagian="";
            

            If(isset($karyawan))
            {
                $check=$this->crud->getDataQuery("Select * From sdm_pegawai Where id=".$karyawan);
                if ($check->num_rows()!=0) 
                {
                    foreach ($check->result() as $row)
                    { 
                        $Nm_Karyawan= $row->Nama;
                        $Nm_Bagian= $row->Nm_Bagian;
                    }
                }
            }


            $data['namakaryawan']=$Nm_Karyawan;
            $data['bagian']=$Nm_Bagian;    
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['breadcrumb']='';
            $data['all_bulan']=bulan();  
            $data['hari'] = hari_bulan($bulan,$tahun);

            $sql="";
            $sql.="Select * From sdm_pegawai Where Aktif='1' ";
            $sql.="Union Select sdm_pegawai.* From sdm_pegawai,sdm_absensi ";
            $sql.="Where sdm_pegawai.Kd_Bagian=sdm_absensi.Kd_Bagian ";
            $sql.="And sdm_pegawai.No_Urut=sdm_absensi.No_Urut AND ";
            $sql.="sdm_pegawai.Aktif='0' And ";
            $sql.="Month(sdm_absensi.TanggalAbsen)=".$bulan." And ";
            $sql.="Year(sdm_absensi.TanggalAbsen)=".$tahun." Order By Kd_Bagian,No_Urut";
            $data['All_karyawan'] = $this->crud->getDataQuery($sql)->result();
            $sql="";
            $sql.="Select * from sdm_absensi Where Month(TanggalAbsen)='".$bulan."' And ";
            $sql.="Year(TanggalAbsen)=".$tahun." And Nama='".$Nm_Karyawan."' And Nm_Bagian='".$Nm_Bagian."'";
            
            $data['absen'] = $this->crud->getDataQuery($sql)->result();
            
            $data['crud'] = $this->crud;
            $this->template->viewAdmin('View_KartuAbsensi',$data);


        }

    }

    