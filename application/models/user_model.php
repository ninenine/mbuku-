<?php

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function getAllUsers(){
		$this->db->select('id,uname,fullname,status,role,isonline,lastlogin,datecreated');
		$q=$this->db->get('user');
		if ($q->num_rows() > 0){
			foreach($q->result() as $row){
				$data[]=$row;
			}
			return $data;
		}else{
			return false;		
		}
	}
	function addUser($data){
		$this->db->insert('user',$data);
		if ($this->db->affected_rows() > 0 )
			return true;
			return false;
	}
	function getUser($id){
		$this->db->select('id,uname,pass,fullname,status,role');
		$this->db->where(array('id'=>$id));
		$q=$this->db->get('user');
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
			
	function getRoles(){
		$q = $this->db->get('user_role');
		if ($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}		
	}
	
	function getUserRole($r){
		$this->db->select('type');
		$this->db->where('id',$r);
		$q = $this->db->get('user_role');
		if ($q->num_rows() > 0)
			return $q->row()->type;
			return false;
	}
	
	function updateUser($id,$data){
		$this->db->where('id',$id);
		$this->db->update('user',$data);
		if ($this->db->affected_rows() > 0 )
			return true;
			return false;
	}
	
	function updateUserProfile($id,$data){
		$this->db->where('userid',$id);
		$this->db->update('user_profile',$data);
	}
	
	function deleteUser($id){
		$this->db->where('id',$id);
		$this->db->delete('user');
	}

};
