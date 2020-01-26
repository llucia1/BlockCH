<?php
class Marcas_model extends CI_Model{

	private $result = "";

	public function __construct()
	{

    	parent::__construct();
			$this->result = FALSE;

  	}

   public function get_result($table)
   {

		$this->db->select('id,name');
		$query = $this->db->get($table);

		if($query->num_rows() > 0)
			$this->result = $query->result();

		return $this->result;
		$this->db->close();

   }

   public function get_row($table,$id)
   {
		 //si es necesario unir otras tablas, si no es necesario su uso borrar
		//$this->db->join('otraTabla', 'otraTabla.id = '.$table.'.id');
		$query = $this->db->get_where($table, array($table.'.id' => $id));

		if($query->num_rows() > 0)
			$this->result = $query->row_array();

		return $this->result;
		$this->db->close();

   }

   public function set_data($table)
   {

		$data = array('id_language' => 1);

		$this->db->insert($table, $data);
		$this->result = $this->db->insert_id();

		return $this->result;
		$this->db->close();

   }

	 public function update_data($table,$id,$data)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		$this->db->close();
	}

   public function delete_data($table,$id)
   {
   		$this->db->delete($table, array('id' => $id));
			$this->db->close();

   }

}
