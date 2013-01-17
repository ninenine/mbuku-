<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model','user');
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
		$d['users']= $this->user->getAllUsers();
		$data=array(
			'title' => 'Manage Users',
			'content'=>  $this->load->view('users/list',$d,True)
			);
		$this->parser->parse('layout1',$data);
	}
	function add(){//add a new user
		redirect('auth/register');		
	}
	function edit(){//edit user
		$userid = $this->uri->segment(3, $this->session->userdata('user_id'));
		$d['user'] = $this->user->getUser($userid);
		$data=array(
			'title' => 'Edit User',
			'content'=>  $this->load->view('users/edit',$d,True)
			);
		$this->parser->parse('layout1',$data);	
	}
	function update(){
		if ($this->session->userdata('user_role')>2){
			$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|md5|callback__password_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|md5');
			$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required');
		}else{
			$this->form_validation->set_rules('role', 'User Role', 'trim|required|xss_clean');
			$this->form_validation->set_rules('status', 'User Status', 'trim|required|xss_clean');
		}
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[12]|xss_clean|callback__username_check');
		if ($this->input->post('password')){
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|md5');
			$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required');
		}
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[4]|max_length[50]|xss_clean');
		if (!$this->form_validation->run()){
			$d['user'] = $this->user->getUser($this->input->post('userid'));
			$data=array(
				'title' => 'Edit User',
				'content'=>  $this->load->view('users/edit',$d,True)
				);
			$this->parser->parse('layout1',$data);
		}else{
			$d=array(
				'uname'=> $this->input->post('username'),
				'fullname'=> $this->input->post('fullname')
			);
			if ($this->input->post('password')){
				$d = array('pass'=> $this->input->post('password'));
			}
			if ($this->session->userdata('user_role')<=2){
				$d = array(				
				'status'=> $this->input->post('status'),
				'role'=> $this->input->post('role')
				);
			}
			if($this->user->updateUser($this->input->post('userid'),$d)){
				echo "<script>alert('User Updated');</script>";
				redirect('users');
			}else{
				echo "<script>alert('error');</script>";
				redirect('users');
			}
		}
	}
	function _password_check($pass){
		if(!$this->user->passwordCheck($this->input->post('userid'),$pass)){
			$this->form_validation->set_message('_password_check', 'Invalid Password. Please enter your <b>old</b> password');
			return false;
		}else{
			return true;
		}		
	}
	
	function _username_check($uname){
		if($this->user->usernameCheck($this->input->post('userid'),$uname)){
			$this->form_validation->set_message('_username_check', 'That <b>Username</b> is already in use. Please try another');
			return false;
		}else{
			return true;
		}
	}
	
	function delete(){//delete user
		$userid = $this->uri->segment(3,0);
		$this->user->deleteUser($userid);
		redirect('users');				
	}
	function test(){
		$this->load->helper('date');
		//echo time();
		echo unix_to_human(1);
		echo 'sema';
	}
	
};
