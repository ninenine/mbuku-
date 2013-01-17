<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	
	public function index(){
		if(!$this->session->userdata('user_id')){
			redirect('auth');
			exit;
		}
		$data=array(
			'title' => 'Manage Reports',
			'content'=>  $this->load->view('reports/list','',True)
			);
		$this->parser->parse('layout1',$data);
	}
	
};
