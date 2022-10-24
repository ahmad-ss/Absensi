<?php
defined('BASEPATH') OR die('No direct script access allowed!');
    class LaporanKartuAbsen extends CI_Controller{
    function __construct(){
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        If ($this->input->get('Format')=="_PDF")
        {
           $this->Laporan_KartuAbsensi_PDF();
        }
        If ($this->input->get('Format')=="_XLS")
        {
            $this->Laporan_KartuAbsensi_Excel();
        }
    }
    function Laporan_KartuAbsensi_PDF_Hender($nama,$bagian,$Bulan,$tahun)
    {
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial','B',16);
        $this->pdf->Cell(0,7,'KARTU ABSENSI '.strtoupper($bagian),0,1,'C');
        $this->pdf->SetFont('Arial','B',12);
        $x=$this->pdf->GetX()+10;
        $y=$this->pdf->GetY()+2;
        $this->pdf->SetY($y);
        $this->pdf->Cell(35,6,'Nama Pegawai',0,0, 'L');
        $this->pdf->Cell(175,6,': '.$nama.'('.$bagian.')',0,0, 'L');
        $y=$y+6;
        $this->pdf->SetY($y);
        $this->pdf->Cell(35,6,'Bulan',0,0, 'L');
        $this->pdf->Cell(175,6,': '.$Bulan.' '.$tahun,0,0, 'L');
        $this->pdf->SetFont('Arial','B',10);
        $x=$this->pdf->GetX();
        $y=$this->pdf->GetY();
        $y=$y+6;
        // ---- Hender Table ----
        $this->pdf->SetY($y);
        $this->pdf->Cell(10,10,'No',1,0, 'C');
        $this->pdf->Cell(65,10,'Tanggal',1,0, 'C');
        $this->pdf->Cell(15,10,'In',1,0, 'C');
        $this->pdf->Cell(15,10,'Out',1,0, 'C');
        $this->pdf->Cell(85,10,'Keterangan',1,0, 'C');
        $y=$y+10;
        $this->pdf->SetFont('Arial','',9);
        return $y;
    }
    public function Laporan_KartuAbsensi_PDF()
    {
        //error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $data = $this->detail_data_absen();
        $filename = 'Kartu Absensi_'.$data['Pegawai'].'_'.$data['bagian'].'_'.$data['bulan'].'_'.$data['tahun'].'.pdf';
        $this->load->library('Pdf_fpdf');
        $this->pdf = new FPDF();
        $y=$this->Laporan_KartuAbsensi_PDF_Hender($data['Pegawai'],$data['bagian'],$data['bulan'],$data['tahun']);
        foreach($data['hari'] as $i => $h)
        {
            $this->pdf->SetY($y);
            If($this->crud->CekHariLibur($h['tgl'])==true)
            {
                $this->pdf->SetFillColor(255, 0, 0); // Back Ground Merah
            } else {
                $this->pdf->SetFillColor(255, 255, 255);    //Back Ground Putih   
            }

            $this->pdf->Cell(10,5,($i+1),1,0,'R',true);
            $this->pdf->Cell(65,5,$h['hari'] . ', ' . $h['tgl'],1,0, 'L',true);
            $ada=false;
            foreach($data['absen']  as $r => $a)
            {
                If (date('Y-m-d', strtotime($a->TanggalAbsen))==date('Y-m-d', strtotime($h['tgl'])))
                {
                    $this->pdf->Cell(15,5,$a->JamMasuk,1,0, 'L',true);
                    $this->pdf->Cell(15,5,$a->JamPulang,1,0, 'L',true);
                    $this->pdf->Cell(85,5,$a->Keterangan,1,0, 'C',true);
                    $ada=true;                                
                }
            }
            If ($ada==False)
            {
                $this->pdf->Cell(15,5,'',1,0, 'L',true);
                $this->pdf->Cell(15,5,'',1,0, 'L',true);
                $this->pdf->Cell(85,5,'',1,0, 'C',true);
            }
            $y=$y+5; 
        }
        $this->pdf->SetFont('Arial','',6);
        $this->pdf->SetY($y);
        $this->pdf->Cell(190,6,'Design By Dody Wiharto(@2021)',0,0, 'R');
        $this->pdf->Output($filename,'I');
    }
    public function Laporan_KartuAbsensi_Excel()
    {
        $data = $this->detail_data_absen();
        # LOAD PHP EXCEL
        include APPPATH.'third_party/PHPExcel.php';

        # Declare class PHPEXCEL
        $excel = new PHPExcel();
        
        # Settingan awal excel
        $excel->getProperties()->setLastModifiedBy('Mini Absensi SYSTEM')->setTitle('Kartu Absensi : '.$data['Pegawai'])->setSubject('Periode : '.$data['bulan'].'_'.$data['tahun'])->setDescription('Kartu Absensi : '.$data['bulan'].','.$data['tahun'])->setKeywords('Kartu Absensi  : '.$data['Pegawai'].','.$data['bagian']);
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

        $r =0;
        // Set border all
        $styleBorder = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $excel->setActiveSheetIndex(0);
        $excel->getSheet(0)->setTitle("KARTU ABSENSI");
        $excel->getActiveSheet()->mergeCells('A1:E1');        
        $excel->getActiveSheet()->setCellValue('A1',"KARTU ABSENSI");
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        # Sub Judul 
        $excel->getActiveSheet()->mergeCells('A3:E3');
        $excel->getActiveSheet()->setCellValue('A3',"Nama Pegawai : ".$data['Pegawai'].'('.$data['bagian'].")");
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A3:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $excel->getActiveSheet()->mergeCells('A4:E4');
        $excel->getActiveSheet()->setCellValue('A4',"Absensi Bulan  :".$data['bulan']." ".$data['tahun']);
        $excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A4:E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        // # Judul Table
        // Border top
        $excel->getActiveSheet()->mergeCells('A6:A7');
        $excel->getActiveSheet()->setCellValue('A6',"No");
        $excel->getActiveSheet()->getStyle('A6')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A6:E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A6:E6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $excel->getActiveSheet()->getStyle('A6:A7')->applyFromArray($styleBorder); //Membuat Kotak
                
        $excel->getActiveSheet()->mergeCells('B6:B7');
        $excel->getActiveSheet()->setCellValue('B6',"Tanggal");
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
        $row = 8; // Deteksi baris
        $Col=Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        foreach($data['hari'] as $i => $h)
        {
            //$excel->getActiveSheet()->mergeCells($Col[$r+2].$row.$Col[$r+2].$row);
            If($this->crud->CekHariLibur($h['tgl'])==true)
            {
                $excel->getActiveSheet()->getStyle('A'.$row.':E'.$row)->applyFromArray($style_row_tidak_masuk); 
            } else {
                $excel->getActiveSheet()->getStyle('A'.$row.':E'.$row)->applyFromArray($style_col);  
            }
            
            $excel->getActiveSheet()->setCellValue('A'.$row,$row-7);
            $excel->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(12);
            $excel->getActiveSheet()->getStyle('A'.$row.':A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $excel->getActiveSheet()->getStyle('A'.$row.':A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $excel->getActiveSheet()->getStyle('A'.$row.':A'.$row)->applyFromArray($styleBorder); //Membuat Kotak

            $excel->getActiveSheet()->setCellValue('B'.$row,$h['hari'] . ', ' . $h['tgl']);
            $excel->getActiveSheet()->getStyle('B'.$row)->getFont()->setSize(12);
            $excel->getActiveSheet()->getStyle('B'.$row.':B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $excel->getActiveSheet()->getStyle('B'.$row.':B'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $excel->getActiveSheet()->getStyle('B'.$row.':B'.$row)->applyFromArray($styleBorder); //Membuat Kotak
            $Ketemu="0";
            foreach($data['absen']  as $j => $a)
            {
                If (date('Y-m-d', strtotime($a->TanggalAbsen))==date('Y-m-d', strtotime($h['tgl'])))
                {
                    
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
            }
            $excel->getActiveSheet()->getStyle('C'.$row.':C'.$row)->applyFromArray($styleBorder); //Membuat Kotak
            $excel->getActiveSheet()->getStyle('D'.$row.':D'.$row)->applyFromArray($styleBorder); //Membuat Kotak
            $excel->getActiveSheet()->getStyle('E'.$row.':E'.$row)->applyFromArray($styleBorder); //Membuat Kotak
            $row++;
        }
        # Proses file excel ---------------------------------
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $filename="Kartu Absensi_";
        If ($data['Pegawai']!="")
        {  $filename.=$data['Pegawai'];  }
        $filename.=strtotime($data['bulan']).' '.$data['tahun'].'.Xls';
        header("Content-Disposition: attachment; filename=".$filename);
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        ob_end_clean();
        $write->save('php://output');
        # --------------------------------------

    }
    function detail_data_absen()
    {
        $id_user = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->id_user;
        $nama = $this->uri->segment(3) ? $this->uri->segment(3) : $this->session->nama;

        $bulan=$this->input->get('bulan');
        $tahun=$this->input->get('tahun');
        $id_Pegawai=$this->input->get('id_Pegawai');
        $Bagian=$this->input->get('Bagian');
        $Nm_Pegawai=$this->input->get('Nm_Pegawai');

        
        $data['bulan']=$this->crud->getBulan($bulan);
        $data['tahun']=$tahun;
        $data['bagian']=$Bagian;
        $data['Pegawai']=$Nm_Pegawai;
        $data['hari'] = hari_bulan($bulan,$tahun);
        $sql="";
        $sql.="Select * from sdm_absensi Where Month(TanggalAbsen)='".$bulan."' And ";
        $sql.="Year(TanggalAbsen)=".$tahun." And Nama='".$Nm_Pegawai."' And Nm_Bagian='".$Bagian."'";    
        $data['absen'] = $this->crud->getDataQuery($sql)->result();
        $data['crud'] = $this->crud;
        return $data;
    }
}