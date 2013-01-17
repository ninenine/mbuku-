<?php

class Acc_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function getAllAcc(){
		$this->db->select('*');
		$q=$this->db->get('account');
		if ($q->num_rows() > 0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}else{
			return false;		
		}
	}
	function addAccount($data){
		$this->db->insert('account',$data);
		if ($this->db->affected_rows() > 0 )
			return true;
			return false;
	}
	function getAccount($id){
		$this->db->select('*');
		$this->db->where(array('id'=>$id));
		$q=$this->db->get('account');
		if ($q->num_rows() > 0){
			return $q->row();
		}else{
			return false;		
		}	
	}
	
	function getUserName($id){
		$this->db->select('uname');
		$this->db->where('id',$id);
		$q = $this->db->get('user');
		if ($q->num_rows() > 0)
			return $q->row_array();
			return false;		
	}
	
	function getUserProfile($id){
		$this->db->select('field,value');
		$this->db->where('userid',$id);
		$q = $this->db->get('user_profile');
		if ($q->num_rows() > 0){
			foreach ($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}else{
			return false;
		}
	}
	function usernameCheck($id,$uname){
		$this->db->where(array('id !='=>$id,'uname'=>$uname));
		$q = $this->db->get('user');
		if ($q->num_rows() > 0)
			return TRUE;
			return FALSE;		
	}
	function passwordCheck($id,$pass){
		$this->db->where(array('id ='=>$id,'pass'=>$pass));
		$q = $this->db->get('user');
		if ($q->num_rows() > 0)
			return true;
			return false;
	}
			
	function getTypes(){
		$q = $this->db->get('acc_type');
		if ($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}		
	}
	
	function getAccType($r){
		$this->db->select('type');
		$this->db->where('id',$r);
		$q = $this->db->get('acc_type');
		if ($q->num_rows() > 0)
			return $q->row()->type;
			return false;
	}
	
	function updateAccount($id,$data){
		$this->db->where('id',$id);
		$this->db->update('account',$data);
		if ($this->db->affected_rows() > 0 )
			return true;
			return false;
	}
	
	function updateUserProfile($id,$data){
		$this->db->where('userid',$id);
		$this->db->update('user_profile',$data);
	}
	
	function deleteAccount($id){
		$this->db->where('id',$id);
		$this->db->delete('account');
	}

};
