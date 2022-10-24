<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LaporanF extends CI_Controller {
    public function __construct(){
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Absensi_model', 'absensi');
        $this->load->model('Karyawan_model', 'karyawan');
        $this->load->model('Jam_model', 'jam');
        $this->load->helper('Tanggal');
       // $this->load->library('Pdf_fpdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
    }
   
    public function index()
    {
       
        return $this->Kartu_Absensi();
    }   
       
    
   
    public function Kartu_Absensi()
    {
        //error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $data = $this->detail_data_absen();
        $filename = 'Absensi ' . $data['Karyawan']->Nama . ' - ' . bulan($data['bulan']) . ' ' . $data['tahun'] . '.pdf';
        $this->load->library('Pdf_fpdf');
        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        
        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(0,7,'Absen Bulan '.bulan($data['bulan']).' '.$data['tahun'],0,1,'C');

        $this->pdf->SetFont('Arial','B',12);
         
        $x=$this->pdf->GetX()+10;
        $y=$this->pdf->GetY()+2;
        $this->pdf->SetY($y);
        $this->pdf->Cell(20,6,'Nama',0,0, 'L');
        $this->pdf->Cell(175,6,': '.$data['Karyawan']->Nama,0,0, 'L');
        $y=$y+6;
        $this->pdf->SetY($y);
        $this->pdf->Cell(20,6,'Divisi',0,0, 'L');
        $this->pdf->Cell(175,6,': '.$data['Karyawan']->Bagian.'-'. $data['Karyawan']->SubBagian,0,0, 'L');
        $this->pdf->SetFont('Arial','B',10);
        $x=$this->pdf->GetX();
        $y=$this->pdf->GetY();
        $y=$y+10;
        // ---- Hender Table ----
        $this->pdf->SetY($y);
        $this->pdf->Cell(10,10,'No',1,0, 'C');
        $this->pdf->Cell(50,10,'Tanggal',1,0, 'C');
        $this->pdf->Cell(35,10,'Jam Masuk',1,0, 'C');
        $this->pdf->Cell(35,10,'Jam Keluar',1,0, 'C');
        $this->pdf->Cell(60,10,'Keterangan',1,0, 'C');
        $y=$y+10;
        // ---- Detail ----
        foreach($data['hari'] as $i => $h)
        {
            If($h['tgl']!='')
            {
                $absen_harian =$this->crud->getDataWhere('absensiharian',array('TglAbsensi_Karyawan' => date('Y-m-d',strtotime($h['tgl'])),'id_Karyawan'=>$data['Karyawan']->id_Karyawan))->result();   
                
                $hari_libur=$this->crud->getDataWhere('hari_libur',array('Date'=>date('Y-m-d',strtotime($h['tgl']))))->result();
                $this->pdf->SetFillColor(255, 255, 255);
                $Tmp_masuk='';
                foreach($absen_harian as $a)  
                {    $Tmp_masuk=$a->JamMasuk_Karyawan;   } 
                $Tmp_Keluar='';                
                foreach($absen_harian as $a)  
                {    $Tmp_Keluar=$a->JamKeluar_Karyawan;   } 
                $Tmp_Ket='';
                foreach($absen_harian as $a)  
                {   $Tmp_Ket=$a->Keterangan;    } 
                foreach($hari_libur as $hl)  {
                    if($hl->Nama_hari_libur!='')
                    {
                        if ($Tmp_Ket!='') {$Tmp_Ket=$Tmp_Ket.",";}
                        $Tmp_Ket=$Tmp_Ket.$hl->Nama_hari_libur;
                    }
                    $this->pdf->SetFillColor(255, 0, 0);
                }
                if($h['hari']=='Minggu')
                {
                    $this->pdf->SetFillColor(255, 0, 0);
                }

                $this->pdf->SetY($y);
                $this->pdf->Cell(10,6,($i+1),1,0, 'R',true);

                $this->pdf->Cell(50,6,$h['hari'] . ', ' . $h['tgl'],1,0, 'L',true);
                
                $this->pdf->Cell(35,6,$Tmp_masuk,1,0, 'L',true);
            
                $this->pdf->Cell(35,6,$Tmp_Keluar,1,0, 'L',true);
                

                $this->pdf->Cell(60,6,$Tmp_Ket,1,0, 'L',true);
                $y=$y+6;
            }
        }
        $this->pdf->SetFont('Arial','',6);
        $this->pdf->SetY($y);
        $this->pdf->Cell(190,6,'Design By Dody Wiharto(@2021)',0,0, 'R');
        $this->pdf->Output($filename,'I');
    }
    private function detail_data_absen()
    {
        // $data['jam_kerja'] = (array) $this->jam->get_all();
        $id_user = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->id_user;
        $nama = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->nama;
        $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');
        $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');

        // $data['all_bulan'] = bulan();
        $data['all_bulan']=bulan();    
        $data['breadcrumb']='';
        // $data['karyawan'] = $this->karyawan->find($id_user);
        $data['Karyawan'] = $this->crud->getDataQuery("SELECT * From karyawan,karyawanjobdesctable,detailkaryawan Where karyawan.id_Karyawan=karyawanjobdesctable.id_Karyawan AND karyawanjobdesctable.PersonUniqueID=detailkaryawan.PersonUniqueID And karyawan.id_Karyawan='".$id_user."'")->row();

        // $data['jam_kerja'] = (array) $this->jam->get_all();

        if(isset($bulan) && isset($tahun)){
            // $data['bulan'] = $bulan;
            $data['bulan'] = $bulan;
            // $data['tahun'] = $tahun;
            $data['tahun'] = $tahun;
            // $data['absen'] = $this->absensi->get_absen($id_user, $bulan, $tahun);
            $data['absen'] = $this->crud->getDataQuery("Select * from absensiharian Where id_Karyawan='".$id_user."' And MONTH(TglAbsensi_Karyawan)=".$bulan." And YEAR(TglAbsensi_Karyawan)=".$tahun)->result();
            // $data['hari'] = hari_bulan($bulan, $tahun);
            $data['hari'] = hari_bulan($bulan,$tahun);
            $data['libur']=$this->crud->getDataQuery("Select * From hari_libur WHERE MONTH(Date)=".$bulan." And YEAR(Date)=".$tahun)->result();
        }else{
            // $data['bulan'] = $bulan;
            $data['bulan'] = date('m');
            // $data['tahun'] = $tahun;
            $data['tahun'] = date('Y');
            // $data['absen'] = $this->absensi->get_absen($id_user, $bulan, $tahun);
            $data['absen'] = $this->crud->getDataQuery("Select * from absensiharian Where id_Karyawan='".$id_user."' And MONTH(TglAbsensi_Karyawan)=".date('m')." And YEAR(TglAbsensi_Karyawan)=".date('Y'))->result();
            // $data['hari'] = hari_bulan($bulan, $tahun);
            $data['hari'] = hari_bulan(date('m'),date('Y'));
            $data['libur']=$this->crud->getDataQuery("Select * From hari_libur WHERE MONTH(Date)=".date('m')." And YEAR(Date)=".date('Y'))->result();
        }

        $data['crud'] = $this->crud;


        return $data;
    }
}