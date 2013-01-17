<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('auth_model','auth');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');           
    }
    
	function index(){
		if ($this->session->userdata('user_id')){
			redirect('/');
		}else{
			$data = array(
				'title' => 'User Login',
				'content' => $this->load->view('auth/login','',true),
				);
			$this->parser->parse('layout2', $data);
		}
				
	}
	
	function login(){
	$this->form_validation->set_rules('usrname', 'Username', 'trim|required|min_length[3]|max_length[20]|xss_clean');
	$this->form_validation->set_rules('pword', 'Password', 'trim|required|md5|callback__checklogin');
		if (!$this->form_validation->run()){
			$this->index();
		}else{
			$uname = $_POST['usrname'];
			$data= $this->auth->getUserData($uname);
			foreach ($data as $row){				
				$userdata= array(
					'user_id'=> $row['id'],
					'user_name'=> $uname,
					'user_role'=> $row['role']
				);
			}
			$this->session->set_userdata($userdata);
			redirect('');
		}		
	}
	
	function _checklogin($pass){
		$uname = $_POST['usrname'];
		if (!$this->auth->checklogin($uname,$pass)){
			$this->form_validation->set_message('_checklogin', 'Incorrect Username/Password <br /> Please Try Again');
			return FALSE;
		}else{
			return TRUE;
		}		
	}
	
	function register(){
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean|callback__username_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|md5');
		$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|min_length[5]|max_length[50]|xss_clean');
		if (!$this->form_validation->run()){
			$data=array(
				'title' => 'New Member Registration',
				'content'=>  $this->load->view('auth/register','',True)
			);
			$this->parser->parse('layout1',$data);
		}else{
			$this->load->model('user_model','user');
			$d=array(
				'uname'=> $this->input->post('username'),
				'pass'=> $this->input->post('password'),
				'fullname'=> $this->input->post('fullname'),
				'status'=> '0',
				'isonline'=>'0',
				'role'=> '3',
				'datecreated'=>time()
			);
			$this->user->addUser($d);
			if($this->session->userdata('user_id')){
				redirect('users');
				exit;
			}
			$data=array(
				'title' => 'New Member Registration',
				'content'=>  $this->load->view('auth/thanks','',True)
			);
			$this->parser->parse('layout1',$data);
		}
		
	}
	
	function _username_check($uname){
		if($this->auth->check_username($uname)){
			$this->form_validation->set_message('_username_check', 'That <b>Username</b> is already in use. Please try another');
			return false;
		}else{
			return true;
		}
	}
	
	function _email_check($email){
		if($this->auth->check_email($email)){
			$this->form_validation->set_message('_email_check', 'That <b>Email</b> is already in use. Please try another');
			return false;
		}else{
			return true;
		}
	}
	
	function forget(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__email_forget');
		if (!$this->form_validation->run()){
			$data=array(
				'userinfo'=> $this->load->view('auth/login','',True),
				'title' => 'Password Recovery',
				'content'=>  $this->load->view('auth/forget','',True)
			);
			$this->parser->parse('trs_template',$data);
		}else{
			$data=array(
				'userinfo'=> $this->load->view('auth/login','',True),
				'title' => 'Password Recovery',
				'content'=>  '<h2>Password Recovery</h2><br/><p>Your password has been reset please check your <b>E-mail</b>.<br/> For Further assistance please contact the site administrator</p>'
			);
			$this->parser->parse('trs_template',$data);
		}
				
	}
	function _email_forget($email){
		if(!$this->auth->check_email($email)){
			$this->form_validation->set_message('_email_forget', 'That is <b>NOT</b> a valid E-mail. Please try another');
			return false;
		}else{
			$this->load->helper('string');
			$pass= random_string('alnum', 6);
			$user=$this->auth->reset_password($email,$pass);
			$this->load->library('email');
			$this->email->from('administrator@trs.co.ke', 'TRS');
			$this->email->to($email);
			$this->email->subject('User Password');
			$this->email->message('hi \n You have requested a password change. \n Your new password is <b>'.$pass.'</b>.');
			$this->email->send();

			echo $this->email->print_debugger();
			return true;
			
		}
	}
	function logout(){
		$this->auth->toggle_status($this->session->userdata('user_id'),'0');
		$this->session->sess_destroy();
		redirect('');
	}
};
