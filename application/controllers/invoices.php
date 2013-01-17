<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices extends CI_Controller {
	
	public function index(){
		if(!$this->session->userdata('user_id')){
			redirect('auth');
			exit;
		}
		$data=array(
			'title' => 'Manage Invoices',
			'content'=>  $this->load->view('invoices/list','',True)
			);
		$this->parser->parse('layout1',$data);
	}
	
};
