<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class Absensi_Security extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Absensi_model', 'absensi');
        $this->load->model('Karyawan_model', 'karyawan');
        $this->load->model('Jam_model', 'jam');
        $this->load->helper('Tanggal');
    }

    public function index()
    {
        return $this->List_Security();
    }
	
	public function List_Security()
	{
		$data['title']='Absensi Pegawai Security';
		$check=$this->crud->getDataQuery("Select TanggalAbsen From sdm_absensi Order By TanggalAbsen Desc Limit 1");
		if ($check->num_rows()!=0) 
        {
			foreach ($check->result() as $row)
	        {
	        	$tanggal=$row->TanggalAbsen;
	        }
    	} else {
    		$tanggal=date('Y-m-d');
    	}

		$data['Tgl']=$tanggal;
        $data['breadcrumb']='';
		$data['divisi'] = $this->crud->getDataQuery("Select * From Sdm_Absensi Where Kd_Bagian='03' And TanggalAbsen='".$tanggal."' Order By No_Urut")->result();
		$data['Karyawan']= $this->crud->getDataQuery("Select * From Sdm_Pegawai Where Kd_Bagian='03' And Aktif='1' Order By No_Urut")->result();
		$data['Status']=$this->crud->getDataQuery("Select * From Sdm_Status Order By id")->result();
		$this->template->viewAdmin('View_Security',$data);
	}	
	public function SaveAbsensi_Security()
	{
		$Pegawai = $this->input->post('Pegawai');
		$tanggal = $this->input->post('date_out');
		$Jam_Masuk = $this->input->post('JamMasuk');
		$Jam_Keluar = $this->input->post('JamPulang');
		$Keterangan = $this->input->post('keterangan');
		$Kd_Status = $this->input->post('status');
		$check = $this->crud->getDataQuery("Select Status From sdm_status Where Kd_Status='".$Kd_Status."'");
		foreach ($check->result() as $row)
        {
        	$Status=$row->Status;
        }

		$qty="";
		$qty.="Insert Into sdm_absensi(Kd_Bagian,Nm_Bagian,No_Urut,Nama,TanggalAbsen,";
		$qty.="JamMasuk,JamPulang,Keterangan,Kd_Status,Status) ";
		$qty.="Select Kd_Bagian,Nm_Bagian,No_Urut,Nama,'".$tanggal."','".$Jam_Masuk."',";
		$qty.="'".$Jam_Keluar."','".$Keterangan."','".$Kd_Status."','".$Status."' From  ";
		$qty.="sdm_pegawai Where id=".$Pegawai;
		$this->crud->getDataQuery($qty);

		redirect(Absensi_Security,List_Security);

	}
	public function SaveAbsensi_Staff_Khsus()
	{
		$Pegawai = $this->input->post('Pegawai');
		$tanggal = $this->input->post('date_out');
		$Keterangan = $this->input->post('keterangan');
		$Kd_Status = $this->input->post('status');
		$check = $this->crud->getDataQuery("Select Status From sdm_status Where Kd_Status='".$Kd_Status."'");
		foreach ($check->result() as $row)
        {
        	$Status=$row->Status;
        }
        If ($Kd_Status!="")
        {
			$qty="";
			$qty.="Insert Into sdm_absensi(Kd_Bagian,Nm_Bagian,No_Urut,Nama,TanggalAbsen,";
			$qty.="Keterangan,Kd_Status,Status) ";
			$qty.="Select Kd_Bagian,Nm_Bagian,No_Urut,Nama,'".$tanggal."','";
			$qty.=$Keterangan."','";
			$qty.=$Kd_Status."','";
			$qty.=$Status."' From  ";
		} else {
			$qty="";
			$qty.="Insert Into sdm_absensi(Kd_Bagian,Nm_Bagian,No_Urut,Nama,TanggalAbsen,";
			$qty.="Keterangan) ";
			$qty.="Select Kd_Bagian,Nm_Bagian,No_Urut,Nama,'".$tanggal."','";
			$qty.=$Keterangan."' From  ";
		}
		$qty.="sdm_pegawai Where id=".$Pegawai;

		$this->crud->getDataQuery($qty);
		redirect(Absensi_Security,List_Security);		
	}
	public function destroy()
	{
		echo $this->uri->segment(3);
		$id_Absensi = $this->uri->segment(3);

		$Pegawai = $this->input->post('Pegawai');
		$qty="";
		$qty.="Delete From Sdm_Absensi Where id=".$id_Absensi;
		$this->crud->getDataQuery($qty);
		redirect(Absensi_Security,List_Security);
	}
}