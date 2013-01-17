<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('product_model','product');
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
		$d['products']= $this->product->getAllProducts();
		$data=array(
			'title' => 'Manage Products',
			'content'=>  $this->load->view('products/list',$d,True)
			);
		$this->parser->parse('layout1',$data);
	}
	function add(){//add a new user
		$this->form_validation->set_rules('prodname', 'Product Name', 'trim|required|min_length[5]|max_length[30]|xss_clean');
		$this->form_validation->set_rules('prodtype', 'Product Type', 'trim|required');
		$this->form_validation->set_rules('price', 'Product Price', 'trim|required|numeric');
		$this->form_validation->set_rules('description', 'Product Description', 'trim|max_length[255]|xss_clean');
		if (!$this->form_validation->run()){
			$data=array(
				'title' => 'Add New Product',
				'content'=>  $this->load->view('products/add','',True)
			);
			$this->parser->parse('layout1',$data);
		}else{
			$d=array(
				'name'=> $this->input->post('prodname'),
				'type'=> $this->input->post('prodtype'),
				'price'=> $this->input->post('price'),
				'datecreated'=>time(),
				'description'=>$this->input->post('description')				
			);
			if($this->product->addProduct($d))
				redirect('products');
		}		
	}
	function edit(){//edit user
		$id = $this->uri->segment(3,0);
		$d['account'] = $this->product->getAccount($id);
		$data=array(
			'title' => 'Edit Account',
			'content'=>  $this->load->view('products/edit',$d,True)
			);
		$this->parser->parse('layout1',$data);	
	}
	function update(){
		$this->form_validation->set_rules('accname', 'Account Name', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('acctype', 'Account Type', 'trim|required');
		$this->form_validation->set_rules('status', 'Account Status', 'trim|required');
		if (!$this->form_validation->run()){
			$d['account'] = $this->product->getAccount($this->input->post('accid'));
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
			if($this->product->updateAccount($this->input->post('accid'),$d))
				redirect('products');
		}
	}
	
	function delete(){//delete user
		$id = $this->uri->segment(3,0);
		$this->product->deleteProduct($id);
		redirect('products');				
	}	
};
