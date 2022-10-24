<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//include APPPATH.'third_party/excel_reader2.php';

class GeneralUploadData extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Crud','crud');
	}

	public function uploadKtp(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'KTP.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('filektp')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_KTP'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
	public function uploadKK(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'KK.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('filekk')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_KK'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
	public function uploadAKTE(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'AKTE.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('fileakte')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_Akte'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
	public function uploadKONTRAK(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'KONTRAK.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('filekontrak')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_Kontrak'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
	public function uploadLAMARAN(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'LAMARAN.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('filelamaran')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_Lamaran'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
	public function uploadCV(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir,0755,true);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'CV.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('fileCV')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_CV'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
	public function uploadIjazah(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'Ijazah.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('fileIjazah')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_Ijazah'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
	public function uploadSKCK(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'SKCK.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('fileSKCK')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_SKCK'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
	public function uploadSertifikat(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'Sertifikat.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('fileSertifikat')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_Sertifikat'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
	public function uploadSIM(){
		$personid = $this->input->get('personid');
		$dir = './Softcopy_Data_Karyawan/'.$personid;

		if(!is_dir($dir)){
			mkdir($dir);
		}

		$config['upload_path'] = $dir.'/';
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = 'SIM.pdf';
        $config['overwrite'] = true;
        $config['max_size'] = 9000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        $respon = array();
        if($this->upload->do_upload('fileSIM')){
        	$data = $this->upload->data();

        	$w = array('PersonUniqueID'=>$personid);
        	$d = array('Link_SIM'=>'/Softcopy_Data_Karyawan/'.$personid.'/'.$data['file_name']);

        	$respon = $this->crud->updateData('detailkaryawan',$w,$d);
        }else{
        	$respon = array(
        		'code'=>1,
        		'message'=>$this->upload->display_errors('<label class="text-danger">','</label>')
        	);
        }

        echo json_encode($respon);

		// echo $personid;
		// echo '<br>';
		// print_r($ktp);
	}
}