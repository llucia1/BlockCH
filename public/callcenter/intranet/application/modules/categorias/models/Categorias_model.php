<?php
class Categorias_model extends CI_Model{

	private $result = "";

	public function __construct()
	{

    	parent::__construct();

  	}

   public function get_result($table,$lang)
   {

		$id_lang = $this->get_id_lang($lang);
		$this->db->select('id, name,is_join,parent');
		$query = $this->db->get_where($table,array('id_language' => $id_lang));

		return ($query->num_rows() > 0) ? $query->result() : FALSE;
		$this->db->close();

   }

   public function get_row($id,$table,$lang)
   {
   		$id_lang = $this->get_id_lang($lang);
		$this->db->select('id,name,parent,discount,discount_type,state,orden');
		$query = $this->db->get_where($table,array('is_join' => $id,'id_language' => $id_lang));

		return ($query->num_rows() > 0) ? $query->row_array() : FALSE;
		$this->db->close();

   }

	 public function get_parent($table,$id)
   {
			$parent = "";
			$this->db->select('id,name,parent');
			$query = $this->db->get_where($table,array('id' => $id));

			if($query->num_rows() > 0)
			{
				if($this->get_parent($table,$query->row()->parent) != null)
				{
					$parent .= $this->get_parent($table,$query->row()->parent);
				}
				$parent .= $query->row()->name;
				$parent .= '<i class="fa fa-arrows-h" aria-hidden="true"></i>';

			}else{

				return null;
			}

			return $parent;
   }

   public function set_data($table,$lang)
   {
   		$id_lang = $this->get_id_lang($lang);
		$data = array('id_language' => $id_lang,'name' => 'Nombre de la categoría');

		$this->db->insert($table, $data);
		$return_id = $this->db->insert_id();

		foreach ($this->Main_model->get_languages() as $key => $value)
		{
			if($key > 0)
			{
				$data = array('is_join' => $return_id,'id_language' => $value->id,'name' => 'Nombre de la categoría');
				$this->db->insert($table, $data);
			}
		}

		$data = array('is_join' => $return_id);
		$this->update_data($table,$return_id,$lang,$data,TRUE);

		return $return_id;
		$this->db->close();

   }

   public function update_data($table,$id,$lang,$data,$add = FALSE)
   {
   		$id_lang = $this->get_id_lang($lang);

		if($add)
		{
			$this->db->where('id', $id);

		}else
		{
			$this->db->where('is_join', $id);
		}

		$this->db->where('id_language', $id_lang);
		$this->db->update($table, $data);
		$this->db->close();

   }

   public function delete_data($table,$id)
   {
   		$this->db->delete($table, array('is_join' => $id));
		$this->db->close();

   }

   public function copy_data($table,$id)
   {

	   	foreach ($this->Main_model->get_languages() as $key => $value)
		{
			$id_lang = $this->get_id_lang($value->iso_language);
			$this->db->select('id_language,name,parent');
			$query = $this->db->get_where($table,array('is_join' => $id,'id_language' => $id_lang));
			$data = $query->row_array();
			$this->db->insert($table, $data);
			$last_id = $this->db->insert_id();

			if($key == 0)
				$return_id = $this->db->insert_id();

			$data_update['is_join'] = $return_id;
			$this->db->where('id', $last_id);
			$this->db->where('id_language', $id_lang);
			$this->db->update($table, $data_update);
		}

		return $return_id;
		$this->db->close();
   }

   public function have_lang($table,$id,$lang)
   {
   		$id_lang = $this->get_id_lang($lang);
		$this->db->select('id');
		$query = $this->db->get_where($table,array('is_join' => $id,'is_edit' => 1,'id_language' => $id_lang));

		return ($query->num_rows() > 0) ? TRUE : FALSE;
		$this->db->close();

   }

   private function get_id_lang($iso)
   {

		$query = $this->db->get_where('languages',array('iso_language' => $iso));
		return $query->row()->id;
		$this->db->close();

   }


}
