<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias  extends MX_Controller {

	private $lang = "";
	private $fields = array();

	public function __construct()
	{

    parent::__construct();
		$this->lang = $this->uri->segment(1);
		$this->fields = array('ID','Nombre');
		define("ICONO","fa fa-opencart");
		define("TABLE","Categorias");
		$this->load->model(TABLE.'_model');

    }

	public function index()
	{

		$data = $this->base(__FUNCTION__);
		$data['fields'] = $this->fields;
		$this->load->view('layout', $data);
 	}

	public function add()
	{

		$data = $this->base(__FUNCTION__);
		redirect($this->lang.'/productos/'.strtolower (TABLE).'/edit/'.$data['last_id']);
	}

	public function edit($id)
	{
		$data = $this->base(__FUNCTION__);
		$data['id'] = $id;
		$model = TABLE.'_model';//Nombre del modelo
		$data['get_result'] = $this->$model->get_result(strtolower(TABLE),$this->lang);
		$data['tree_categories_this'] = $this->tree_categories_this($this->lang,$id);

		if (isset( $_POST['submit_form'] ))
		{

			foreach ($data['get_row'] as $key => $value)
			{
				$data['get_row'][$key] = set_value($key);
				$this->form_validation->set_rules($key, $key,'');
				if($this->input->post($key))
					$update[$key] = $this->input->post($key);
			}

			$update['is_edit'] = 1;

			$this->$model->update_data(strtolower(TABLE),$id,$this->lang,$update);

			$file = fopen("./assets/categories/categories.php","w+");
			$file_ = fopen("./assets/categories/categories_private.php","w+");

			if($file == false)
			{
			  die("No se ha podido crear el archivo.");
			}
			else
			{
				$tree = $this->tree_categories();
				fwrite($file, $tree . PHP_EOL);
				fclose($file);
			}

			if($file_ == false)
			{
			  die("No se ha podido crear el archivo.");
			}
			else
			{

				$tree_private = $this->tree_categories_private();
				fwrite($file_, $tree_private . PHP_EOL);
				fclose($file_);
			}

			redirect($this->lang.'/productos/'.strtolower (TABLE).'/edit/'.$id);
		}


		$this->load->view('layout', $data);
	}

	public function delete($id)
	{

		$data = $this->base(__FUNCTION__,$id);
 	}

	public function copy($id)
	{

		$data = $this->base(__FUNCTION__,$id);
 	}

	//Base para los metodos.
	private function base($action = null,$id = 0)
	{

		$model = TABLE.'_model';//Nombre del modelo

		$base = array(
						'lang' => $this->lang,
						'title' => "Panel de control | ".$this->Main_model->get_project_data()->name,
						'reference' => strtoupper(TABLE.'-'.$action),
						'view' => strtolower (TABLE).'_'.$action,
						'page' => TABLE,
						'icono' => ICONO,
						'robots' => 'noindex, nofollow',
						'languages' => $this->Main_model->get_languages(),
						'js' => $this->load->view('js_module/js_module','',TRUE),
						'css' => $this->load->view('css_module/css_module',TRUE),
						'lang' => $this->lang,
						'main_lang' => $this->config->item('language'),
						'model_name' => $model

					);


		switch ($action)
		{

			case 'index':

				$base['get_result'] = $this->$model->get_result(strtolower (TABLE),$this->lang);
				$base['tooltip'] = strtolower (substr(TABLE, 0, -1));
				$base['param'] = 'productos/'.strtolower (TABLE);

				break;

			case 'add':

				$base['last_id'] = $this->$model->set_data(strtolower (TABLE),$this->lang);

				break;

			case 'edit':

				$base['subpage'] = 'Editar '.substr(TABLE, 0, -1);
				$base['param'] = 'productos/'.strtolower (TABLE);
				$base['get_row'] = $this->$model->get_row($this->uri->segment(5),strtolower (TABLE),$this->lang);

				break;

			case 'delete':

				$this->$model->delete_data(strtolower (TABLE),$id);
				redirect($this->lang.'/productos/'.strtolower (TABLE));

				break;

			case 'copy':

				$last_id = $this->$model->copy_data(strtolower (TABLE),$id);
				redirect($this->lang.'/productos/'.strtolower(TABLE).'/edit/'.$last_id);

				break;

		}

		return $base;

	}

	private function tree_categories($parent = 0)
	{

		$this->db->select('is_join,name');
		$query = $this->db->get_where('categorias', array('id_language' => 1,'parent' => $parent,'state' => 1));

		$menu = "";

		foreach ($query->result() as $key => $value)
		{

			$menu .= '<li>';
			//comprobamos si el padre tiene hijos
			if(!$this->tree_categories($value->is_join))
			{
				$menu .= '<a href="'.base_url('index.php/productos/'.$value->is_join.'/'.url_title($value->name)).'">'.$value->name.'</a>';
			}
			else
			{
				$menu .= '<a href="#">'.$value->name.'</a>';
				$menu .= '<div class="toggle"></div>';
				$menu .= '<ul>';
				$menu .= $this->tree_categories($value->is_join);
				$menu .= '</ul>';
			}
			$menu .= '</li>';
		}

		return $menu;

	}

	private function tree_categories_private($parent = 0)
	{

		$this->db->select('is_join,name');
		$query = $this->db->get_where('categorias', array('id_language' => 1,'parent' => $parent));

		$menu = "";

		foreach ($query->result() as $key => $value)
		{

			$menu .= '<li>';
			//comprobamos si el padre tiene hijos
			if(!$this->tree_categories_private($value->is_join))
			{
				
				$menu .= '<a style="color:red;" href="#">'.$value->name.'<input <?php if(in_array("'.$value->is_join.'", $get_my_categories_by_id))echo "checked" ?> value="'.$value->is_join.'" class="selectCategories" id="<?= $id ?>" type="checkbox"></a>';
			}
			else
			{
				$menu .= '<a href="#">'.$value->name.'</a>';
				$menu .= '<div class="toggle"></div>';
				$menu .= '<ul>';
				$menu .= $this->tree_categories_private($value->is_join);
				$menu .= '</ul>';
			}
			$menu .= '</li>';
		}
	
		return $menu;

	}

	private function tree_categories_this($lang,$parent = 0)
	{

		$this->db->select('is_join,name,state,orden');
		$query = $this->db->get_where('categorias', array('id_language' => 1,'parent' => $parent));

		$menu = "";

		foreach ($query->result() as $key => $value)
		{

			$menu .= '<li>';
			//comprobamos si el padre tiene hijos
			if(!$this->tree_categories_this($lang,$value->is_join))
			{
				$menu .= '<a data-toggle="modal" data-target="#editModal'.$value->is_join.'" href="#">'.$value->name.'</a>';
				$dataModal['id'] = $value->is_join;
				$dataModal['category'] = $value->name;
				$dataModal['lang'] = $lang;
				$dataModal['state'] = $value->state;
				$dataModal['orden'] = $value->orden;
				//$menu .= $this->load->view('include/modal/edit_modal',$dataModal);
			}
			else
			{
				$menu .= '<a href="#">'.$value->name.'</a>';
				$menu .= '<div class="toggle"></div>';
				$menu .= '<ul>';
				$menu .= $this->tree_categories_this($lang,$value->is_join);
				$menu .= '</ul>';
			}
			$menu .= '</li>';
		}

		return $menu;

	}

}
