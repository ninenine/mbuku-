<?php

class Product_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function getAllProducts(){
		$this->db->select('*');
		$q=$this->db->get('product');
		if ($q->num_rows() > 0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}else{
			return false;		
		}
	}
	function addProduct($data){
		$this->db->insert('product',$data);
		if ($this->db->affected_rows() > 0 )
			return true;
			return false;
	}
	function getProduct($id){
		$this->db->select('*');
		$this->db->where(array('id'=>$id));
		$q=$this->db->get('product');
		if ($q->num_rows() > 0){
			return $q->row();
		}else{
			return false;		
		}	
	}
		
	function getTypes(){
		$q = $this->db->get('prod_type');
		if ($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}		
	}
	
	function getProductType($r){
		$this->db->select('type');
		$this->db->where('id',$r);
		$q = $this->db->get('prod_type');
		if ($q->num_rows() > 0)
			return $q->row()->type;
			return false;
	}
	
	function updateProduct($id,$data){
		$this->db->where('id',$id);
		$this->db->update('product',$data);
		if ($this->db->affected_rows() > 0 )
			return true;
			return false;
	}
	
	function deleteProduct($id){
		$this->db->where('id',$id);
		$this->db->delete('product');
	}

};
