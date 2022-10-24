<?php
class Template{
	protected $ci;

	function __construct(){
		$this->ci=&get_instance();
	}

	function isAjax(){
		$input=$this->ci->input;
		return ($input->server('HTTP_X_REQUESTED_WITH')&&($input->server('HTTP_X_REQUESTED_WITH')=='XMLHttpRequest'));
	}

	function viewAdmin($template,$data=null){
		$load=$this->ci->load;
		if(!$this->isAjax()){
			$data['head']=$load->view('templateAdmin/head',$data,true);
			$data['nav']=$load->view('templateAdmin/nav',$data,true);
			//$data['header']=$load->view('templateAdmin/header',$data,true);
			$data['sidebar']=$load->view('templateAdmin/aside',$data,true);
			$data['title_content']=$load->view('templateAdmin/title_content',$data,true);
			$data['content']=$load->view($template,$data,true);
			$data['footer']=$load->view('templateAdmin/footer',$data,true);
			$data['js']=$load->view('templateAdmin/js',$data,true);
			$load->view('templateAdmin/main',$data);
		}else{
			$load->view($template,$data);
		}
	}
}
?>