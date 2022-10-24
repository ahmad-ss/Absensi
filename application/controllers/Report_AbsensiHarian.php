<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class Report_AbsensiHarian extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        // $this->load->model('Absensi_model', 'absensi');
        // $this->load->model('Karyawan_model', 'karyawan');
        // $this->load->model('Jam_model', 'jam');
        // $this->load->helper('Tanggal');
    }
    public function index()
    {
        return $this->List_AbsensiHarian();
    }
    public function List_AbsensiHarian()
    {
    	$id_user = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->id_user;
        $nama = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->nama;

    
        $bagian=$this->input->post('bagian');
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
        $tgl=$this->input->post('date_out');
        
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

        $data['title']='DAFTAR ABSENSI HARIAN ';
        $data['Bagian']=$bagian;
        $data['Nama_Bagian']=$Nm_Bagian;
        $data['breadcrumb']='';
        $data['all_bagian']=$this->crud->getDataQuery("Select * From sdm_bagian Order By Kd_Bagian")->result();
        if(isset($bagian))
        {
            $data['Karyawan'] = $this->crud->getDataQuery("Select * From sdm_pegawai Where Aktif='1' And Kd_Bagian='".$bagian."' Union SELECT sdm_pegawai.* FROM sdm_pegawai,sdm_absensi 
                WHERE sdm_pegawai.Kd_Bagian=sdm_absensi.Kd_Bagian 
                AND sdm_pegawai.No_Urut=sdm_absensi.No_Urut AND sdm_pegawai.Aktif='0'
                AND sdm_pegawai.Kd_Bagian='".$bagian."' 
                AND sdm_absensi.TanggalAbsen='".$tgl."' 
                Order By Kd_Bagian,No_Urut")->result();
            $data['absen'] = $this->crud->getDataQuery("Select * from sdm_absensi Where TanggalAbsen='".$tgl."' And Kd_Bagian='".$bagian."'")->result();
        } else {
            $data['Karyawan'] = $this->crud->getDataQuery("Select * From sdm_pegawai Where Aktif='1'  
                Union SELECT sdm_pegawai.* FROM sdm_pegawai,sdm_absensi 
                WHERE sdm_pegawai.Kd_Bagian=sdm_absensi.Kd_Bagian 
                AND sdm_pegawai.No_Urut=sdm_absensi.No_Urut AND sdm_pegawai.Aktif='0'
                AND sdm_absensi.TanggalAbsen='".$tgl."' Order By Kd_Bagian,No_Urut")->result();
            $data['absen'] = $this->crud->getDataQuery("Select * from sdm_absensi Where TanggalAbsen='".$tgl."' Order By No_Urut")->result();
        }
        $data['Tanggal'] = $tgl;

        
       // $data['libur']=$this->crud->getDataQuery("Select * From hrd_harilibur WHERE MONTH(Tanggal)=".$bulan." And YEAR(Tanggal)=".$tahun)->result();
        $data['crud'] = $this->crud;
        $this->template->viewAdmin('View_AbsensiHarian',$data);
    }


}