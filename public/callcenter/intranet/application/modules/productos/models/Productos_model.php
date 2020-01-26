<?php
class Productos_model extends CI_Model{

	private $result = "";

	public function __construct()
	{

    	parent::__construct();

  	}

   public function get_result($table,$lang,$start=0,$limit=0,$param = null)
   {
		$id_lang = 1;

		$this->db->select($table.'.id, '.$table.'.referencia,'.$table.'.name,'.$table.'.outstanding,'.$table.'.state, YEAR(discharge_date) AS year, MONTH(discharge_date) AS month, DAY(discharge_date) AS day,'.$table.'.is_join,marcas.name AS nameMarca');
		$this->db->join('marcas', 'marcas.id = '.$table.'.id_marca');

		$this->db->order_by("productos.id", "DESC");
		if($limit > 0)
			$this->db->limit($limit,$start);
		//si @param es distinto de null, lo recorremos
		if($param != null)
		{
			foreach ($param as $key => $value)
			{
				if(($value != null OR $value != 0) AND $key != 'per_page')
				{
					if($key == 'name')
					{

						$this->db->like($table.'.'.$key, $value);

					}else
					{
						$this->db->where($table.'.'.$key, $value);
					}

				}

			}
		}
		
		$query = $this->db->get_where($table,array($table.'.id_language' => $id_lang));
		
		if($query->num_rows() == 0)
		{
			$this->db->select($table.'.id, '.$table.'.referencia,'.$table.'.name,'.$table.'.outstanding,'.$table.'.state, YEAR(discharge_date) AS year, MONTH(discharge_date) AS month, DAY(discharge_date) AS day,'.$table.'.is_join');

			$this->db->order_by("productos.id", "DESC");
			if($limit > 0)
				$this->db->limit($limit,$start);
			//si @param es distinto de null, lo recorremos
			if($param != null)
			{
				foreach ($param as $key => $value)
				{
					if(($value != null OR $value != 0) AND $key != 'per_page')
					{
						if($key == 'name')
						{
	
							$this->db->like($table.'.'.$key, $value);
	
						}else
						{
							$this->db->where($table.'.'.$key, $value);
						}
	
					}
	
				}
			}
			
			$query = $this->db->get_where($table,array($table.'.id_language' => $id_lang));
		}


		return ($query->num_rows() > 0) ? $query->result() : FALSE;
		$this->db->close();

   }

	 public function get_products($table,$lang)
   {
		 //$id_lang = $this->get_id_lang($lang);
		 $id_lang = 1;
		 $this->db->select('name,is_join');
		 $this->db->order_by("name", "ASC");
		 $query = $this->db->get_where($table,array('id_language' => $id_lang));
		 return ($query->num_rows() > 0) ? $query->result() : FALSE;
		 $this->db->close();

	 }

	 public function get_total_rows($table,$param = null)
   {

		 //si @param es distinto de null, lo recorremos
 		if($param != null)
 		{
 			foreach ($param as $key => $value)
 			{
 				if(($value != null OR $value != 0) AND $key != 'per_page')
 				{
 					if($key == 'name')
 					{

 						$this->db->like($table.'.'.$key, $value);

 					}else
 					{
 						$this->db->where($table.'.'.$key, $value);
 					}

 				}

 			}
 		}

 		$this->db->select('id');
 		$query = $this->db->get_where($table,array('id_language' => 1));
 		return ($query->num_rows() > 0) ? $query->num_rows() : FALSE;
 		$this->db->close();

   }

   public function get_row($id,$table,$lang)
   {
		//$id_lang = $this->get_id_lang($lang);
		$id_lang = 1;
		$this->db->select($table.'.name,title,description,key_m,body,'.$table.'.state,main_image,id_marca,referencia,
		id_category,price,'.$table.'.discount,outstanding,composicion,color_caja,taman,cristal,esfera,garantia,'.$table.'.discount_type');
		$query = $this->db->get_where($table,array($table.'.is_join' => $id,$table.'.id_language' => $id_lang));

		return ($query->num_rows() > 0) ? $query->row_array() : FALSE;
		$this->db->close();

   }

   public function get_category($lang)
   {

		$id_lang = $this->get_id_lang($lang);
		$this->db->select('id, name,is_join');
		$query = $this->db->get_where('categorias',array('id_language' => $id_lang));

		return ($query->num_rows() > 0) ? $query->result() : FALSE;
		$this->db->close();

   }

	 public function get_brands()
   {

		$this->db->select('id, name');
		$query = $this->db->get('marcas');

		return ($query->num_rows() > 0) ? $query->result() : FALSE;
		$this->db->close();

   }

   public function get_attributes($lang)
   {

		$id_lang = $this->get_id_lang($lang);
		$this->db->select('atributos.id, atributos.name,atributos.is_join');
		$this->db->join('atributos_valores', 'atributos_valores.id_attribute = atributos.is_join');
		$this->db->group_by('atributos.is_join');
		$query = $this->db->get_where('atributos',array('atributos.id_language' => $id_lang,'state' => 1));

		return ($query->num_rows() > 0) ? $query->result() : FALSE;
		$this->db->close();

   }

   public function get_attribute_values($id,$lang)
   {

		$id_lang = $this->get_id_lang($lang);
		$this->db->select('id,value,is_join,id_attribute');
		$this->db->order_by("value", "ASC");
		$query = $this->db->get_where('atributos_valores',array('id_language' => $id_lang,'id_attribute' => $id));

		return ($query->num_rows() > 0) ? $query->result() : FALSE;
		$this->db->close();

   }

   public function exist_product_attribute($id_product,$id_attribute,$id_attribute_value)
   {

		$this->db->select('id, impact,state');
		$query = $this->db->get_where('product_attributes',array('id_product' => $id_product,'id_attribute' => $id_attribute,'id_attribute_value' => $id_attribute_value));

		return ($query->num_rows() > 0) ? $query->row() : FALSE;
		$this->db->close();

   }

   public function get_attachments($table,$id,$id_attr = 0,$id_attr_val = 0)
   {

		$this->db->select('attached,id');
		$query = $this->db->get_where('attachments',array('idRow' => $id,'tableRow' => $table));

		return ($query->num_rows() > 0) ? $query->result() : FALSE;
		$this->db->close();

   }

   public function set_data($table,$lang)
   {
		//$id_lang = $this->get_id_lang($lang);
		$id_lang = 1;
		$data = array('id_language' => $id_lang,'name' => 'Nombre del producto');

		$this->db->insert($table, $data);
		$return_id = $this->db->insert_id();

		/*foreach ($this->Main_model->get_languages() as $key => $value)
		{
			if($key > 0)
			{
				$data = array('is_join' => $return_id,'id_language' => $value->id,'name' => 'Nombre del producto');
				$this->db->insert($table, $data);
			}
		}*/

		$data = array('is_join' => $return_id);
		$this->update_data($table,$return_id,$lang,$data,TRUE);

		return $return_id;
		$this->db->close();

   }

   public function update_data($table,$id,$lang,$data,$add = FALSE)
   {
		$id_lang = 1;

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

   public function update_product_attribute($id_product,$id_attribute,$id_attribute_value,$data)
   {

		$this->db->where('id_product', $id_product);
		$this->db->where('id_attribute', $id_attribute);
		$this->db->where('id_attribute_value', $id_attribute_value);
		$this->db->update('product_attributes', $data);
		$this->db->close();

   }
   
   public function delete_product_attribute($id_product,$id_attribute,$id_attribute_value)
   {

		$this->db->where('id_product', $id_product);
		$this->db->where('id_attribute', $id_attribute);
		$this->db->where('id_attribute_value', $id_attribute_value);
		$this->db->delete('product_attributes');
		$this->db->close();

   }

   public function add_image($table,$id,$data)
   {

		$this->db->where('is_join', $id);
		$this->db->update($table, $data);

   }

   public function delete_data($table,$id)
   {
   		$this->db->delete($table, array('is_join' => $id));
		$this->db->close();

   }

   public function delete_attachment($id_attachment)
   {
   		$this->db->delete('attachments', array('id' => $id_attachment));
		$this->db->close();

   }

   public function copy_data($table,$id)
   {

	   	foreach ($this->Main_model->get_languages() as $key => $value)
		{
			$id_lang = $this->get_id_lang($value->iso_language);
			$this->db->select('name,title,id_marca,description,key_m,body,state,id_language');
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

		$this->db->select('attached');
		$query = $this->db->get_where('attachments',array('table_n' => $table,'id_row' => $id));
		if($query->num_rows() > 0)
		{
			$data = array('table_n'=>$table,'id_row'=>$return_id,'attached'=>$query->row()->attached);
			$this->db->insert('attachments', $data);
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

   public function set_attachment($data)
   {

		$this->db->insert('attachments', $data);

   }

   public function set_product_attribute($data)
   {

		$this->db->insert('product_attributes', $data);
		$this->db->close();
   }

   private function get_id_lang($iso)
   {

		$query = $this->db->get_where('languages',array('iso_language' => $iso));
		return $query->row()->id;
		$this->db->close();

   }

   	public function get_related($id)
	{
		$this->db->select('related_products.id,is_join,name');
		$this->db->join('productos', 'productos.is_join = related_products.id_related');
		$query = $this->db->get_where('related_products',array('id_product' => $id));
		return ($query->num_rows() > 0) ? $query->result() : FALSE;
		$this->db->close();

	}

	public function set_related($data)
	{

			$this->db->insert('related_products', $data);
			$this->db->close();

	}

	public function delete_related($id)
	{
		$this->db->delete('related_products', array('id' => $id));
		$this->db->close();
	}

	public function product_categories($idPro,$idCat,$checked)
	{
		 if($checked == 1)
		 {

			$data = array('id_producto' => $idPro,'id_categoria' => $idCat);
			$this->db->insert('productosCategoria', $data);

		 }elseif($checked == 0)
		 {
			 $this->db->delete('productosCategoria', array('id_producto' => $idPro,'id_categoria' => $idCat));
		 }
	}

	public function get_my_categories($id)
	{

		$this->db->select('categorias.name,categorias.is_join');
		$this->db->join('categorias', 'categorias.id = productosCategoria.id_categoria');
		$query = $this->db->get_where('productosCategoria',array('id_producto' => $id));
		if($query->num_rows() > 0)
		{

			$list_ = $query->result_array();
			//convertimos el array multidimensional en una cadena de texto separada por ;
			$list_ = implode(';', array_map(function ($entry) {
				return $entry['name'];
			}, $list_));
			//convertimos esto en un array unidimensional
			$list_ = explode(';',$list_);
			//devolvemos el array
			return $list_;

		}
		else
		{
			return FALSE;
		}
		$this->db->close();
	}
	
	public function get_my_categories_by_id($id)
	{

		$this->db->select('categorias.is_join');
		$this->db->join('categorias', 'categorias.id = productosCategoria.id_categoria');
		$query = $this->db->get_where('productosCategoria',array('id_producto' => $id));
		if($query->num_rows() > 0)
		{

			$list_ = $query->result_array();
			//convertimos el array multidimensional en una cadena de texto separada por ;
			$list_ = implode(';', array_map(function ($entry) {
				return $entry['is_join'];
			}, $list_));
			//convertimos esto en un array unidimensional
			$list_ = explode(';',$list_);
			//devolvemos el array
			return $list_;

		}
		else
		{
			return FALSE;
		}
		$this->db->close();
	}

}
