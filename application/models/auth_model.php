<?php

class Auth_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function checklogin($uname,$pass){
		$this->db->where(array('uname' => $uname,'pass'=> $pass));
		$q = $this->db->get('user');
		if ($q->num_rows() > 0 && $this->check_membership($uname)){
			$this->db->where('uname', $uname);
			$this->db->update('user', array('lastlogin'=>time(),'isonline'=>'1')); 
			return TRUE;
		}else{
			return FALSE;
		}
	}
	function getUserData($uname){
		$this->db->select('id, uname, role');
		$this->db->where('uname',$uname);
		$q = $this->db->get('user');
		return $q->row_array();
	}
	
	function check_username($uname){
		$this->db->select('uname');
		$this->db->where('uname',$uname);
		$q = $this->db->get('user');
		if ($q->num_rows() > 0)
			return TRUE;
			return FALSE;		
	}
	
	function check_email($email){
		$this->db->select('value');
		$this->db->where('value',$email);
		$q = $this->db->get('user_profile');
		if ($q->num_rows() > 0)
			return TRUE;
			return FALSE;		
	}
	function check_membership($uname){
		$this->db->select('status');
		$this->db->where(array('uname'=>$uname,'status'=> '1'));
		$q = $this->db->get('user');
		if ($q->num_rows() > 0)
			return TRUE;
			return FALSE;		
	}
	function check_if_online($uname){
		$this->db->select('isonline');
		$this->db->where(array('uname'=>$uname,'isonline'=> '0'));
		$q = $this->db->get('user');
		if ($q->num_rows() > 0)
			return TRUE;
			return FALSE;
	}
	function toggle_status($id,$state){
		$this->db->where('id',$id);
		$this->db->update('user',array('isonline'=>$state));		
	}
	
	function regTeacher($uname,$pass,$fname,$lname,$email,$tel,$gdate,$subcom,$bio){
		$date=time();
		$this->db->set(array('uname'=>$uname,'pass'=>$pass,'role'=>'4','status'=>'0','datecreated'=>$date));
		$this->db->insert('user');
		$userid= $this->getUserId($uname);
		$data= array(
			array(
				'userid'=>$userid,
				'field'=>'Firstname',
				'value'=>$fname,
			),
			array(
				'userid'=>$userid,
				'field'=>'Lastname',
				'value'=>$lname,
			),
			array(
				'userid'=>$userid,
				'field'=>'E-mail',
				'value'=>$email,
			),
			array(
				'userid'=>$userid,
				'field'=>'Telephone',
				'value'=>$tel,
			),
			array(
				'userid'=>$userid,
				'field'=>'Graduation Date',
				'value'=>$gdate,
			),
			array(
				'userid'=>$userid,
				'field'=>'Subject Combination',
				'value'=>$subcom,
			),
			array(
				'userid'=>$userid,
				'field'=>'Bio',
				'value'=>$bio,
			)
		);
		$this->db->insert_batch('user_profile', $data); 
		
	}
	
	function regSchool($uname,$pass,$schname,$email,$tel){
		$date=time();
		$this->db->set(array('uname'=>$uname,'pass'=>$pass,'role'=>'5','status'=>'0','datecreated'=>$date));
		$this->db->insert('user');
		$userid= $this->getUserId($uname);
		$data= array(
			array(
				'userid'=>$userid,
				'field'=>'Schoolname',
				'value'=>$schname,
			),
			array(
				'userid'=>$userid,
				'field'=>'E-mail',
				'value'=>$email,
			),
			array(
				'userid'=>$userid,
				'field'=>'Telephone',
				'value'=>$tel,
			)
		);
		$this->db->insert_batch('user_profile', $data); 
		
	}
	
	function getUserId($uname){
		$this->db->select('id');
		$this->db->where('uname',$uname);
		$q = $this->db->get('user');
		if ($q->num_rows() > 0){
			foreach($q->row_array() as $row){
				return $row['id'];
			}
		}		
	}
	function getUserId_email($email){
		$this->db->select('userid');
		$this->db->where('value',$email);
		$q = $this->db->get('user_profile');
		if ($q->num_rows() > 0){
			foreach($q->row_array() as $row){
				return $row['id'];
			}
		}
		
	}
	function reset_password($email,$pass){
		$userid=$this->getUserId_email($email);
		$this->db->where('id',$userid);
		$this->db->update('user',array('pass'=>md5($pass)));
	}
	
};
