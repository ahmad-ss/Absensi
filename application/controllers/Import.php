<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import extends CI_Controller {
// construct
public function __construct() {
parent::__construct();
// load model
$this->load->model('Import_model', 'import');
$this->load->helper(array('url','html','form'));
}    
public function index() {
$this->load->view('import');
}
public function importFile(){
if ($this->input->post('submit')) {
$path = 'uploads/';
require_once APPPATH . "/third_party/PHPExcel.php";
$config['upload_path'] = $path;
$config['allowed_types'] = 'xlsx|xls|csv';
$config['remove_spaces'] = TRUE;
$this->load->library('upload', $config);
$this->upload->initialize($config);            
if (!$this->upload->do_upload('uploadFile')) {
$error = array('error' => $this->upload->display_errors());
} else {
$data = array('upload_data' => $this->upload->data());
}
if(empty($error)){
if (!empty($data['upload_data']['file_name'])) {
$import_xls_file = $data['upload_data']['file_name'];
} else {
$import_xls_file = 0;
}
$inputFileName = $path . $import_xls_file;
try {
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($inputFileName);
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
$flag = true;
$i=0;
foreach ($allDataInSheet as $value) {
if($flag){
$flag =false;
continue;
}
$inserdata[$i]['first_name'] = $value['A'];
$inserdata[$i]['last_name'] = $value['B'];
$inserdata[$i]['email'] = $value['C'];
$inserdata[$i]['contact_no'] = $value['D'];
$i++;
}               
$result = $this->import->insert($inserdata);   
if($result){
echo "Imported successfully";
}else{
echo "ERROR !";
}             
} catch (Exception $e) {
die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
. '": ' .$e->getMessage());
}
}else{
echo $error['error'];
}
}
$this->load->view('import');
}
}
?>