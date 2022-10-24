<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class LaporanHarianExcel extends CI_Controller {
		function __construct(){
			parent::__construct();
			date_default_timezone_set('Asia/Jakarta');
		}
		function index(){
			echo "Coba saja";
			// parent::__construct();
        	//require_once APPPATH.'third_party/PHPExcel.php';
        	//$excel = new PHPExcel(); 

			// $pci = $this->crud->selectAll('plciinvoice')->result();
			// foreach($pci as $pci){
			// 	if($pci->id_customer == 2){
			// 		echo '<option value="'.$pci->id_PLCIINVOICE.'">'.$pci->no_CI.'</option>';
			// 	}else{
			// 		echo '<option value="'.$pci->id_PLCIINVOICE.'">'.$pci->no_PL.'</option>';
			// 	}
			// }
			$this->Laporan_Harian();
		}
		function Laporan_Harian()
    	{
    		# LOAD PHP EXCEL
       		include APPPATH.'third_party/PHPExcel.php';

       		# Declare class PHPEXCEL
       		$excel = new PHPExcel();

       		# Settingan awal excel
       		// $excel->getProperties()->setLastModifiedBy('ERP SYSTEM')->setTitle('PL '.$pci['no_PL'].' INV '.$pci['no_INV'])->setSubject('PL '.$pci['no_PL'].' INV '.$pci['no_INV'])->setDescription('PL '.$pci['no_PL'].' INV '.$pci['no_INV'])->setKeywords('PL '.$pci['no_PL'].' INV '.$pci['no_INV']);
       		# ------------------------------- SHEET PL----------------------------------------------
       		// Dapatkan sheet 1
       		$excel->setActiveSheetIndex(0);
       		# Judul PL
			$excel->getActiveSheet()->mergeCells('F5:I5');
			$excel->getActiveSheet()->setCellValue('F5','PACKING LIST');
			$excel->getActiveSheet()->getStyle('F5')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('F5')->getFont()->setSize(15);
			$excel->getActiveSheet()->getStyle('F5:I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        	# Proses file excel
        	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        	header('Content-Disposition: attachment; filename="IPL.xlsx"');

        	$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        	ob_end_clean();
        	$write->save('php://output');

       		//$data = $this->detail_data_absen();

       		//$filename = 'Absensi Harian_'.$data['bagian'].date('Ymd', strtotime($data['Tanggal'])).'.Xls;';

    	}

	}
