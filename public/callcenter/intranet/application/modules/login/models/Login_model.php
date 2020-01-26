<?php

class Login_model extends CI_Model
{

	private $result = "";

	public function __construct()
	{

    	parent::__construct();
		  $this->result = FALSE;

  	}

   public function get_row($email)
   {

		$this->db->select('id,pass');
		$query = $this->db->get_where('usuarios', array('email' => $email,'level' => 1));

		if($query->num_rows() > 0)
			$this->result = $query->row();

		return $this->result;
		$this->db->close();

   }

   public function exist_email($email)
   {

		$this->db->select('id_user');
		$query = $this->db->get_where('datos_usuarios', array('email' => $email));

		if($query->num_rows() > 0)
			$this->result = $query->row()->id_user;

		return $this->result;
		$this->db->close();

   }

   public function update_pass($id_user,$pass)
   {

		$data = array('insurance_code' => $pass);
		$this->db->where('id', $id_user);
		$this->db->update('usuarios', $data);
		$this->db->close();

   }

}
