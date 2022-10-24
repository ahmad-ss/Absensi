<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH."/third_party/PHPExcel.php";
// require_once APPPATH."/third_party/PHPExcel/IOFactory.php";

class LaporanHarian extends CI_Controller {
	public function __construct(){
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        // $this->load->model('Absensi_model', 'absensi');
        // $this->load->model('Karyawan_model', 'karyawan');
        // $this->load->model('Jam_model', 'jam');
        // $this->load->helper('Tanggal');
       // $this->load->library('Pdf_fpdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
    }
    public function index()
    {
        If ($this->input->get('Format')=="_PDF")
        {
    	   $this->Laporan_Harian();
        }
        If ($this->input->get('Format')=="_XLS")
        {
            $this->Laporan_Harian_Excel();
        }
    }
    public function Laporan_Harian_Header($bagian,$Tgl,$namahari)
    {
        
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(0,7,'ABSENSI HARIAN '.$bagian,0,1,'C');
        $this->pdf->SetFont('Arial','B',12);
        $x=$this->pdf->GetX()+10;
        $y=$this->pdf->GetY()+2;
        $this->pdf->SetY($y);
        $this->pdf->Cell(20,6,'Hari',0,0, 'L');
        $this->pdf->Cell(175,6,': '.$namahari,0,0, 'L');
        $y=$y+6;
        $this->pdf->SetY($y);
        $this->pdf->Cell(20,6,'Tanggal',0,0, 'L');
        $this->pdf->Cell(175,6,': '.$Tgl,0,0, 'L');
        $this->pdf->SetFont('Arial','B',10);
        $x=$this->pdf->GetX();
        $y=$this->pdf->GetY();
        $y=$y+6;
        // ---- Hender Table ----
        $this->pdf->SetY($y);
        $this->pdf->Cell(10,10,'No',1,0, 'C');
        $this->pdf->Cell(65,10,'Nama',1,0, 'C');
        $this->pdf->Cell(15,10,'In',1,0, 'C');
        $this->pdf->Cell(15,10,'Out',1,0, 'C');
        $this->pdf->Cell(85,10,'Keterangan',1,0, 'C');
        $y=$y+10;
        $this->pdf->SetFont('Arial','',9);
        return $y;
    }
    public function Laporan_Harian()
    {
        //error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL

        $data = $this->detail_data_absen();
       
        $filename = 'Absensi Harian_'.$data['bagian'].date('Ymd', strtotime($data['Tanggal'])).'.pdf';

        $this->load->library('Pdf_fpdf');
        $this->pdf = new FPDF();
       
        // $y=$this->Laporan_Harian_Header($data['bagian'],$data['Tgl_Ind'],$data['NamaHari']);
        $Jdl="<>";
        foreach($data['Karyawan']  as $i => $k)
        {
            If($k->Nm_Bagian!=$Jdl) {
                if($Jdl!="<>"){
                    $this->pdf->SetFont('Arial','',6);
                    $this->pdf->SetY($y);
                    $this->pdf->Cell(190,6,'Design By Dody Wiharto(@2021)',0,0, 'R');
                }
                $y=$this->Laporan_Harian_Header(strtoupper($k->Nm_Bagian),$data['Tgl_Ind'],$data['NamaHari']);
                $Jdl=$k->Nm_Bagian;
            }
            $this->pdf->SetFillColor(255, 255, 255);
            $this->pdf->SetY($y);
            $this->pdf->Cell(10,5,($i+1),1,0,'R',true);
            $this->pdf->Cell(65,5,$k->Nama,1,0, 'L',true);
            $Ketemu="0";
            foreach($data['absen']  as $j => $a)
            {
                If ($k->Nama==$a->Nama And $k->No_Urut==$a->No_Urut)
                {
                    $Ketemu="1";
                    $this->pdf->Cell(15,5,$a->JamMasuk,1,0, 'L',true); 
                    $this->pdf->Cell(15,5,$a->JamPulang,1,0, 'L',true); 
                    $this->pdf->Cell(85,5,$a->Keterangan,1,0, 'L',true); 
                }
            }
            if($Ketemu=="0")
            {
                $this->pdf->Cell(15,5,"",1,0, 'L',true); 
                $this->pdf->Cell(15,5,"",1,0, 'L',true); 
                $this->pdf->Cell(85,5,"",1,0, 'L',true); 
            }
            $y=$y+5;
            
            if($y>275)
            {
                $y=$this->Laporan_Harian_Header($data['bagian'],$data['Tgl_Ind'],$data['NamaHari']);
            }
        }

        $this->pdf->SetFont('Arial','',6);
        $this->pdf->SetY($y);
        $this->pdf->Cell(190,6,'Design By Dody Wiharto(@2021)',0,0, 'R');
        $this->pdf->Output($filename,'I');   
    }
    public function Laporan_Harian_Old()
    {
    	//error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $data = $this->detail_data_absen();
       
        $filename = 'Absensi Harian_'.$data['bagian'].date('Ymd', strtotime($data['Tanggal'])).'.pdf';

        $this->load->library('Pdf_fpdf');
        $this->pdf = new FPDF();
       
        $y=$this->Laporan_Harian_Header($data['bagian'],$data['Tgl_Ind'],$data['NamaHari']);
        foreach($data['Karyawan']  as $i => $k)
        {
            $this->pdf->SetFillColor(255, 255, 255);
            $this->pdf->SetY($y);
            $this->pdf->Cell(10,5,($i+1),1,0,'R',true);
            $this->pdf->Cell(65,5,$k->Nama,1,0, 'L',true);
            $Ketemu="0";
            foreach($data['absen']  as $j => $a)
            {
                If ($k->Nama==$a->Nama And $k->No_Urut==$a->No_Urut)
                {
                    $Ketemu="1";
                    $this->pdf->Cell(15,5,$a->JamMasuk,1,0, 'L',true); 
                    $this->pdf->Cell(15,5,$a->JamPulang,1,0, 'L',true); 
                    $this->pdf->Cell(85,5,$a->Keterangan,1,0, 'L',true); 
                }
            }
            if($Ketemu=="0")
            {
                $this->pdf->Cell(15,5,"",1,0, 'L',true); 
                $this->pdf->Cell(15,5,"",1,0, 'L',true); 
                $this->pdf->Cell(85,5,"",1,0, 'L',true); 
            }
         	$y=$y+5;
            
            if($y>275)
            {
                $y=$this->Laporan_Harian_Header($data['bagian'],$data['Tgl_Ind'],$data['NamaHari']);
            }
        }

        $this->pdf->SetFont('Arial','',6);
        $this->pdf->SetY($y);
        $this->pdf->Cell(190,6,'Design By Dody Wiharto(@2021)',0,0, 'R');
        $this->pdf->Output($filename,'I');

    }
    public function Laporan_Harian_Excel()
    {       
        #Load Data
        $data = $this->detail_data_absen();

        # LOAD PHP EXCEL
        include APPPATH.'third_party/PHPExcel.php';

        # Declare class PHPEXCEL
        $excel = new PHPExcel();
        
        # Settingan awal excel
        $excel->getProperties()->setLastModifiedBy('Mini Absensi SYSTEM')->setTitle('Absensi Harian Tanggal : '.$data['NamaHari'].','.$data['Tgl_Ind'])->setSubject('Absensi Harian Tanggal : '.$data['NamaHari'].','.$data['Tgl_Ind'])->setDescription('Absensi Harian Tanggal : '.$data['NamaHari'].','.$data['Tgl_Ind'])->setKeywords('Absensi Harian Tanggal : '.$data['NamaHari'].','.$data['Tgl_Ind']);
        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ]
        ];

        $style_row = [
            'alignment' => [
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ]
        ];

        $style_row_libur = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => '343A40']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ]
        ];

        $style_row_tidak_masuk = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'DC3545']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ]
        ];

        $style_telat = [
            'font' => [
                'color' => ['rgb' => 'DC3545']
            ]
        ];

        $style_lembur = [
            'font' => [
                'color' => ['rgb' => '28A745']
            ]
        ];

        $Jdl="<>";
        $r =0;
        // Set border all
        $styleBorder = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        foreach($data['Karyawan']  as $i => $k) {
            If($k->Nm_Bagian!=$Jdl) { 
                If($r!=0) { $excel->createSheet(); }
                $excel->setActiveSheetIndex($r);

                $excel->getSheet($r)->setTitle($k->Nm_Bagian);
                $excel->getActiveSheet()->mergeCells('A1:E1');        
                $excel->getActiveSheet()->setCellValue('A1',"ABSENSI HARIAN ".strtoupper($k->Nm_Bagian));
                $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
                $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
                $excel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                # Sub Judul 
                $excel->getActiveSheet()->mergeCells('A3:E3');
                $excel->getActiveSheet()->setCellValue('A3',"Hari  :".$data['NamaHari']);
                $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
                $excel->getActiveSheet()->getStyle('A3:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $excel->getActiveSheet()->mergeCells('A4:E4');
                $excel->getActiveSheet()->setCellValue('A4',"Bagian  :".$data['Tgl_Ind']);
                $excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
                $excel->getActiveSheet()->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                # Judul Table
                // Border top
                $excel->getActiveSheet()->mergeCells('A6:A7');
                $excel->getActiveSheet()->setCellValue('A6',"No");
                $excel->getActiveSheet()->getStyle('A6')->getFont()->setSize(12);
                $excel->getActiveSheet()->getStyle('A6:E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $excel->getActiveSheet()->getStyle('A6:E6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $excel->getActiveSheet()->getStyle('A6:A7')->applyFromArray($styleBorder); //Membuat Kotak
                
                $excel->getActiveSheet()->mergeCells('B6:B7');
                $excel->getActiveSheet()->setCellValue('B6',"Nama");
                $excel->getActiveSheet()->getStyle('B6')->getFont()->setSize(12);
                $excel->getActiveSheet()->getStyle('B6:B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $excel->getActiveSheet()->getStyle('B6:B6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $excel->getActiveSheet()->getStyle('B6:B7')->applyFromArray($styleBorder);

                $excel->getActiveSheet()->mergeCells('C6:C7');
                $excel->getActiveSheet()->setCellValue('C6',"In");
                $excel->getActiveSheet()->getStyle('C6')->getFont()->setSize(12);
                $excel->getActiveSheet()->getStyle('C6:C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $excel->getActiveSheet()->getStyle('C6:C6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $excel->getActiveSheet()->getStyle('C6:C7')->applyFromArray($styleBorder); //Membuat Kotak

                $excel->getActiveSheet()->mergeCells('D6:D7');
                $excel->getActiveSheet()->setCellValue('D6',"Out");
                $excel->getActiveSheet()->getStyle('D6')->getFont()->setSize(12);
                $excel->getActiveSheet()->getStyle('D6:D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $excel->getActiveSheet()->getStyle('D6:D6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $excel->getActiveSheet()->getStyle('D6:D7')->applyFromArray($styleBorder); //Membuat Kotak

                $excel->getActiveSheet()->mergeCells('E6:E7');
                $excel->getActiveSheet()->setCellValue('E6',"Keterangan");
                $excel->getActiveSheet()->getStyle('E6')->getFont()->setSize(12);
                $excel->getActiveSheet()->getStyle('E6:E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $excel->getActiveSheet()->getStyle('E6:E6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $excel->getActiveSheet()->getStyle('E6:E7')->applyFromArray($styleBorder); //Membuat Kotak

                $excel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
                $excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
                $excel->getActiveSheet()->getColumnDimension('C')->setWidth(9);
                $excel->getActiveSheet()->getColumnDimension('D')->setWidth(9);
                $excel->getActiveSheet()->getColumnDimension('E')->setWidth(45);
                $Jdl=$k->Nm_Bagian;
                $r++;
                $row = 8; // Deteksi baris
            }
            
            # isi detail data
            $excel->getActiveSheet()->setCellValue('A'.$row,$row-7);
            $excel->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(12);
            $excel->getActiveSheet()->getStyle('A'.$row.':A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $excel->getActiveSheet()->getStyle('A'.$row.':A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $excel->getActiveSheet()->getStyle('A'.$row.':A'.$row)->applyFromArray($styleBorder); //Membuat Kotak
            $excel->getActiveSheet()->setCellValue('B'.$row,$k->Nama);
            $excel->getActiveSheet()->getStyle('B'.$row)->getFont()->setSize(12);
            $excel->getActiveSheet()->getStyle('B'.$row.':B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $excel->getActiveSheet()->getStyle('B'.$row.':B'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $excel->getActiveSheet()->getStyle('B'.$row.':B'.$row)->applyFromArray($styleBorder); //Membuat Kotak
            $excel->getActiveSheet()->setCellValue('B'.$row,$k->Nama);
            $excel->getActiveSheet()->getStyle('B'.$row)->getFont()->setSize(12);
            $excel->getActiveSheet()->getStyle('B'.$row.':B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $excel->getActiveSheet()->getStyle('B'.$row.':B'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $excel->getActiveSheet()->getStyle('B'.$row.':B'.$row)->applyFromArray($styleBorder); //Membuat Kotak
            $Ketemu="0";
            foreach($data['absen']  as $j => $a)
            {
                If ($k->Nama==$a->Nama And $k->No_Urut==$a->No_Urut)
                {
                    $Ketemu="1";
                    
                    $excel->getActiveSheet()->setCellValue('C'.$row,$a->JamMasuk);
                    $excel->getActiveSheet()->getStyle('C'.$row)->getFont()->setSize(12);
                    $excel->getActiveSheet()->getStyle('C'.$row.':C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $excel->getActiveSheet()->getStyle('C'.$row.':C'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);    
                    $excel->getActiveSheet()->setCellValue('D'.$row,$a->JamPulang);
                    $excel->getActiveSheet()->getStyle('D'.$row)->getFont()->setSize(12);
                    $excel->getActiveSheet()->getStyle('D'.$row.':D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $excel->getActiveSheet()->getStyle('D'.$row.':D'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    $excel->getActiveSheet()->setCellValue('E'.$row,$a->Keterangan);
                    $excel->getActiveSheet()->getStyle('E'.$row)->getFont()->setSize(12);
                    $excel->getActiveSheet()->getStyle('E'.$row.':E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                    $excel->getActiveSheet()->getStyle('E'.$row.':E'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    
                }

                $excel->getActiveSheet()->getStyle('C'.$row.':C'.$row)->applyFromArray($styleBorder); //Membuat Kotak
                $excel->getActiveSheet()->getStyle('D'.$row.':D'.$row)->applyFromArray($styleBorder); //Membuat Kotak
                $excel->getActiveSheet()->getStyle('E'.$row.':E'.$row)->applyFromArray($styleBorder); //Membuat Kotak
            }

            $row++;
        }
      

        # Proses file excel ---------------------------------
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $filename="Absensi Harian_";
        If ($data['bagian']!="")
        {
            $filename.=$data['bagian'];
        }
        $filename.=date('Ymd', strtotime($data['Tanggal'])).'.Xls';
        header("Content-Disposition: attachment; filename=".$filename);

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        ob_end_clean();
        $write->save('php://output');
        # --------------------------------------
    }

    
    private function detail_data_absen()
    {
        
        $id_user = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->id_user;
        $nama = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->nama;

        $bagian = $this->input->get('Bagian');
        $tgl = $this->input->get('Tanggal');
        $data['bagian'] = $bagian;
        $data['Tanggal'] = $tgl;
        $data['Tgl_Ind'] = $this->crud->tgl_indo($tgl);
        $data['NamaHari'] = $this->crud->getHari($tgl); //$this->crud->getHari($tgl);

        $data['breadcrumb'] = '';

        if(isset($bagian) And $bagian!='')
        {
            $qry="";
            $qry.="Select * From sdm_pegawai Where Aktif='1' And Nm_Bagian='".$bagian."' ";
            $qry.="Union ";
            $qry.="Select sdm_pegawai.* From sdm_pegawai,sdm_absensi Where ";
            $qry.="sdm_pegawai.Kd_Bagian=sdm_absensi.Kd_Bagian And ";
            $qry.="sdm_pegawai.No_Urut=sdm_absensi.No_Urut And sdm_pegawai.Aktif='0' And ";
            $qry.="sdm_pegawai.Nm_Bagian='".$bagian."' And ";
            $qry.="sdm_absensi.TanggalAbsen='".$tgl."' Order By Kd_Bagian,No_Urut";
            $data['Karyawan'] = $this->crud->getDataQuery($qry)->result();
            $qry="";
            $qry.="Select * from sdm_absensi Where TanggalAbsen='".$tgl."' And ";
            $qry.="Nm_Bagian='".$bagian."'";
            $data['absen'] = $this->crud->getDataQuery($qry)->result();

        } else {
            $qry="";
            $qry.="Select * From sdm_pegawai Where Aktif='1' ";
            $qry.="Union ";
            $qry.="Select sdm_pegawai.* FROM sdm_pegawai,sdm_absensi Where ";
            $qry.="sdm_pegawai.Kd_Bagian=sdm_absensi.Kd_Bagian And ";
            $qry.="sdm_pegawai.No_Urut=sdm_absensi.No_Urut And sdm_pegawai.Aktif='0' And ";
            $qry.="sdm_absensi.TanggalAbsen='".$tgl."' Order By Kd_Bagian,No_Urut";

            $data['Karyawan'] = $this->crud->getDataQuery($qry)->result();
            $qry="";
            $qry.="Select * from sdm_absensi Where TanggalAbsen='".$tgl."' Order By No_Urut";
            $data['absen'] = $this->crud->getDataQuery($qry)->result();
        }
        $data['crud'] = $this->crud;
        return $data;
    }
}