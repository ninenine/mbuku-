<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function index(){
		if(!$this->session->userdata('user_id')){
			redirect('auth');
			exit;
		}
		$data=array(
			'userinfo'=> 'test',
			'title' => 'Welcome',
			'content'=>  $this->load->view('dashboard','',True)
			);
		$this->parser->parse('layout1',$data);
	}
	
};
