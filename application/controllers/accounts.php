<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('acc_model','acc');
		$this->load->helper('form');
		$this->load->library('form_validation');           
    }
	
	public function index(){
		if(!$this->session->userdata('user_id')){
			redirect('auth');
			exit;
		}
		$this->manage();
	}
	
	function manage(){//manage Users
		$this->load->helper('date');
		$d['accounts']= $this->acc->getAllAcc();
		$data=array(
			'title' => 'Manage Accounts',
			'content'=>  $this->load->view('accounts/list',$d,True)
			);
		$this->parser->parse('layout1',$data);
	}
	function add(){//add a new user
		$this->form_validation->set_rules('accname', 'Account Name', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('acctype', 'Account Type', 'trim|required');
		$this->form_validation->set_rules('status', 'Account Status', 'trim|required');
		if (!$this->form_validation->run()){
			$data=array(
				'title' => 'Add New Account',
				'content'=>  $this->load->view('accounts/add','',True)
			);
			$this->parser->parse('layout1',$data);
		}else{
			$d=array(
				'name'=> $this->input->post('accname'),
				'acc_type'=> $this->input->post('acctype'),
				'status'=> $this->input->post('status'),
				'datecreated'=>time()
			);
			if($this->acc->addAccount($d))
				redirect('accounts');
		}		
	}
	function edit(){//edit user
		$accid = $this->uri->segment(3, $this->session->userdata('user_id'));
		$d['account'] = $this->acc->getAccount($accid);
		$data=array(
			'title' => 'Edit Account',
			'content'=>  $this->load->view('accounts/edit',$d,True)
			);
		$this->parser->parse('layout1',$data);	
	}
	function update(){
		$this->form_validation->set_rules('accname', 'Account Name', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('acctype', 'Account Type', 'trim|required');
		$this->form_validation->set_rules('status', 'Account Status', 'trim|required');
		if (!$this->form_validation->run()){
			$d['account'] = $this->acc->getAccount($this->input->post('accid'));
			$data=array(
				'title' => 'Edit User',
				'content'=>  $this->load->view('users/edit',$d,True)
				);
			$this->parser->parse('layout1',$data);
		}else{
			$d=array(
				'name'=> $this->input->post('accname'),
				'acc_type'=> $this->input->post('acctype'),
				'status'=> $this->input->post('status'),
			);
			if($this->acc->updateAccount($this->input->post('accid'),$d))
				redirect('accounts');
		}
	}
	
	function delete(){//delete user
		$accid = $this->uri->segment(3,0);
		$this->acc->deleteAccount($accid);
		redirect('accounts');				
	}

	
};
