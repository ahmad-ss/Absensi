<?php
defined('BASEPATH') or die('No direct script access allowed!');

class InputAbsen extends CI_Controller
{
	var $filename;
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function InputAbsensiMassalHarian()
	{
		if (isset($_POST['preview'])) {
			$upload = $this->MassAbsen->upload_file($this->filename);
			//echo $this->filename . '<br>';
			//print_r($_FILES['file']['name']);
			//Load plugin PHPExcel nya
			//include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
			include_once(APPPATH . 'third_party/PHPExcel/PHPExcel.php');
			//$excel = new PHPExcel();
			$inputFileName = $_FILES['file']['name'];
			//PHPExcel_IOFactory::createReader($inputFileType);
			try {
				//$inputFileType  =   PHPExcel_IOFactory::identify($inputFileName);
				$excelreader =	 new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/' . $inputFileName);
			} catch (Exception $e) {
				//die('Error loading file "' . pathinfo('excel/' . $inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
				echo "<script type=\"text/javascript\">alert('ERROR : " . pathinfo($inputFileName, PATHINFO_BASENAME) . " : " . $e->getMessage() . " ---- PILIH FILE YANG BENAR (Tidak Boleh Copy-an)" . "');</script>";
				redirect(base_url() . 'dashboard/MenuInputAbsensiMassalLayout', 'refresh');
			}
			//$excelreader = new PHPExcel_Reader_Excel2007();
			//$loadexcel = $excelreader->load('excel/' . $_FILES['file']['name']); // Load file yang tadi diupload ke folder excel
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

			$ses2 = array('tempfilename' => $_FILES['file']['name']);
			$this->session->set_userdata($ses2);

			// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
			// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
			$data['sheet'] = $sheet;
		} else {
			$data['sheet'] = '';
			redirect(base_url() . 'dashboard/MenuInputAbsensiMassalLayout', 'refresh');
		}
		$data['title'] = 'Preview ';
		$data['breadcrumb'] = '';
		$data['km'] = $this->Karyawan_model;
		$data['tm'] = $this->Karyawan_model;
		$data['lm'] = $this->Karyawan_model;
		$this->template->viewAdmin('import_excel', $data);








		//      	if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
		// 	// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
		// 	$upload = $this->MassAbsen->upload_file($_FILES['file']);
		// 	//echo $_FILES['file']['name'];
		// 	if($upload['result'] == "success"){ // Jika proses upload sukses
		// 		// Load plugin PHPExcel nya
		// 		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		// 		//$excel = new PHPExcel();
		// 		$excelreader = new PHPExcel_Reader_Excel2007();
		// 		$loadexcel = $excelreader->load('excel/'.$_FILES['file']['name']); // Load file yang tadi diupload ke folder excel
		// 		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		// 		$ses2=array('tempfilename'=>$_FILES['file']['name']);
		// 		$this->session->set_userdata($ses2);

		// 		// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
		// 		// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
		// 		$data['sheet'] = $sheet; 
		// 	}else{ // Jika proses upload gagal
		// 		$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
		// 	}
		// }
	}
	function savedata()
	{
		$id = $this->input->post('idkrj');
		$detail = $this->db->get_where('hrd_joinbagian', array('ID_Krj' => $id))->result_array();
		$tipe = $this->input->post('tipe');
		$bagian1 = $this->input->post('bagian1');
		$pembuat = $this->input->post('pembuat');
		$pembayar = $this->input->post('pembayar');
		$penyetuju = $this->input->post('penyetuju');
		$tglawl = $this->input->post('tglawal');
		$tglak = $this->input->post('tglakhir');
		$divisi = $this->input->post('div');
		$cabang = $this->input->post('cbg');

		//NTAHLAHHHHH BELOM JELAS FUNGSINYA
		$gradetot = $this->input->post('subtotal') + $this->input->post('nom_lainlain');
		$gradetot = $gradetot - $this->input->post('potbpjs');
		$data = array(
			'NIK' => $detail[0]['NIK'],
			'NIP' => $detail[0]['NIP'],
			'NamaLengkap' => $detail[0]['NamaLengkap'],
			'periode1' => $tglawl,
			'periode2' => $tglak,
			'Kd_Jabatan' => $detail[0]['Kd_Jabatan'],
			'Jabatan' => $detail[0]['Jabatan'],
			'keterangan' => $this->input->post('ket_lainlain'),
			'Sub_Total' => $this->input->post('subtotal'),
			'Pot_BPJS' => $this->input->post('potbpjs'),
			'BiayaLain' => $this->input->post('nom_lainlain'),
			'Grade_Total' => $gradetot,
			'Tanggal_Insert' => date("Y-m-d")
		);

		$this->db->insert('hrd_absensi', $data);

		//$abs = $this->db->get_where('hrd_absensi', array('NamaLengkap' => $detail['0']['NamaLengkap'], 'periode1' => $tglawl, 'periode2' => $tglak))->result_array();
		/*$this->db->set('id_Absensi', $abs['0']['id_Absensi']);
		$this->db->where('ID_Krj', $id);
		$this->db->where('Tanggal_Masuk >=', $tglawl);
		$this->db->where('Tanggal_Masuk <=', $tglak);
		$this->db->update('hrd_detail_absensi');*/
		//if($respon['code'] == 0){
		if ($tipe == 'Harian') {
			redirect(base_url() . 'dashboard/ShowSlipGajiHarian/' . $tipe . '/' . $tglawl . '/' . $tglak . '/' . $bagian1 . '/' . $divisi . '/' . $cabang . '/' . $pembuat . '/' . $pembayar . '/' . $penyetuju);
		} else {
			//echo base_url() . 'dashboard/SingleShowSlipGaji/' . $id . '/' . $tipe . '/' . $bagian1 . '/' . $tglawl . '/' . $tglak .  '/' . $pembuat . '/' . $pembayar . '/' . $penyetuju;
			redirect(base_url() . 'dashboard/SingleShowSlipGaji/' . $id . '/' . $tipe . '/' . $bagian1 . '/' . $tglawl . '/' . $tglak .  '/' . $pembuat . '/' . $pembayar . '/' . $penyetuju);
		}
		//}
	}
	// public function updatesave($mulai, $akhir)
	// {
	// 	$datainp = $this->input->post();
	// 	$idabsensi = $datainp['id_biayalain'];
	// 	$idkrj = $datainp['idkrj'];
	// 	$jabatan = $datainp['bagian1'];
	// 	$pembuat = $datainp['pembuat'];
	// 	$pembayar = $datainp['pembayar'];
	// 	$penyetuju = $datainp['penyetuju'];
	// 	$ket = $datainp['ket_lainlain'];
	// 	$nom = $datainp['nom_lainlain'];
	// 	$tipe = $datainp['tipe'];
	// 	$divisi = $datainp['div'];
	// 	$cabang = $datainp['cbg'];

	// 	$this->db->set(array('Keterangan' => $ket, 'BiayaLain' => $nom));
	// 	$this->db->where('id_Absensi', $idabsensi);
	// 	$this->db->update('hrd_absensi');
	// 	if ($tipe == 'Harian') {
	// 		redirect(base_url() . 'dashboard/ShowSlipGajiHarian/' . $tipe . '/' . $mulai . '/' . $akhir . '/' . $jabatan . '/' . $divisi . '/' . $cabang . '/' . $pembuat . '/' . $pembayar . '/' . $penyetuju);
	// 	} else {
	// 		redirect(base_url() . 'dashboard/SingleShowSlipGaji/' . $idkrj . '/' . $tipe . '/' . $jabatan . '/' . $mulai . '/' . $akhir .  '/' . $pembuat . '/' . $pembayar . '/' . $penyetuju);
	// 	}
	// }
	public function updatesave($mulai, $akhir)
	{
		$datainp = $this->input->post();
		$idabsensi = $datainp['id_biayalain'];
		$idkrj = $datainp['idkrj'];
		$jabatan = $datainp['bagian1'];
		$pembuat = $datainp['pembuat'];
		$pembayar = $datainp['pembayar'];
		$penyetuju = $datainp['penyetuju'];
		$ket = $datainp['ket_lainlain'];
		$nom = $datainp['nom_lainlain'];
		$tipe = $datainp['tipe'];
		$divisi = $datainp['div'];
		$cabang = $datainp['cbg'];
		$sts_hapus = $datainp['sts_hapus'];

		if($sts_hapus==1){
			$arr = array(
				'tipe'=>$tipe,
				'mulai'=>$mulai,
				'akhir'=>$akhir,
				'jabatan'=>$jabatan,
				'divisi'=>$divisi,
				'cabang'=>$cabang,
				'pembuat'=>$pembuat,
				'pembayar'=>$pembayar,
				'penyetuju'=>$penyetuju,
				'idkrj'=>$idkrj
			);
			$this->hapustemp($idabsensi,$arr);
		}else{
			$this->db->set(array('Keterangan' => $ket, 'BiayaLain' => $nom));
			$this->db->where('id_Absensi', $idabsensi);
			$this->db->update('hrd_absensi');
			if ($tipe == 'Harian') {
				redirect(base_url() . 'dashboard/ShowSlipGajiHarian/' . $tipe . '/' . $mulai . '/' . $akhir . '/' . $jabatan . '/' . $divisi . '/' . $cabang . '/' . $pembuat . '/' . $pembayar . '/' . $penyetuju);
			} else {
				redirect(base_url() . 'dashboard/SingleShowSlipGaji/' . $idkrj . '/' . $tipe . '/' . $jabatan . '/' . $mulai . '/' . $akhir .  '/' . $pembuat . '/' . $pembayar . '/' . $penyetuju);
			}
		}
	}
	public function hapustemp($id,$arr){
		$w = array('id_Absensi'=> $id);
		$this->db->where($w);
        $this->db->delete('hrd_absensi');
        redirect(base_url() . 'dashboard/ShowSlipGajiHarian/' . $arr['tipe'] . '/' . $arr['mulai'] . '/' . $arr['akhir'] . '/' . $arr['jabatan'] . '/' . $arr['divisi'] . '/' . $arr['cabang'] . '/' . $arr['pembuat'] . '/' . $arr['pembayar'] . '/' . $arr['penyetuju']);
	}
}
