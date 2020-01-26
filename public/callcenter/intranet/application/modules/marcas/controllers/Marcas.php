<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcas  extends MX_Controller {

	//almacenamos el lenguaje que utiliza la aplicación
	private $lang = "";
	//array con los campos que mostraremos en la tabla
	private $fields = array();
	private $proyecto = "";
	private $nameClass;

	public function __construct()
	{

    	parent::__construct();
		$this->lang = 'es';
		$this->fields = array('id','name');
		$this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
		$this->nameClass = get_class($this);
		//Constante que alamcena el icono que identificara el módulo
		define("ICONO","fa fa-industry");
		//Constante que alamcena el nombre de la tabla, siempre que sea posible mismo nombre que la tabla principal que atacaremos con este módulo
		define("TABLE","Marcas");
		//Constante que alamcena el alias, este alias se utiliza por si en un momento dado la tabla tiene un alias delante o detras del nombre principal de la tabla
		//si no la necesita, dejar ""
		define("ALIAS","");
		//cargamos el modelo
		$this->load->model(TABLE.'_model');

    }

	public function index()
	{
		//cargamos la base del metodo
		$data = $this->base(__FUNCTION__);
		//cargamos los campos para la tabla
		$data['fields'] = $this->fields;
		// titulo del módulo
		$data['h1'] = str_replace('_',' ',$this->nameClass);
		//lista migas pan
		$data['breadcrumb'] = array(str_replace('_',' ',$this->nameClass));
		//cargamos la vista
		$this->load->view('templates/panel/layout', $data);

 	}

	public function add()
	{
		//cargamos la base del metodo
		$data = $this->base(__FUNCTION__);
		redirect('productos/'.strtolower(TABLE).'/edit/'.$data['last_id']);
	}

	public function edit($id)
	{
		//cargamos la base del metodo
		$data = $this->base(__FUNCTION__);
		// titulo del módulo
		$data['h1'] = str_replace('_',' ',$this->nameClass);
		//lista migas pan
		$data['breadcrumb'] = array(str_replace('_', ' ', $this->nameClass), 'Editar ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1));
		$data['id'] = $id;
		//Nombre del modelo
		$model = TABLE.'_model';

		//si pasamos datos desde el formulario
		if (isset( $_POST['submit_form'] ))
		{
			foreach ($data['get_row'] as $key => $value)
			{
				$data['get_row'][$key] = set_value($key);
				$this->form_validation->set_rules($key, $key,'');
				if($this->input->post($key))
					echo $update[$key] = $this->input->post($key);
			}

			$update['is_edit'] = 1;

			$this->$model->update_data(strtolower(TABLE),$id,$update);
			redirect('productos/'.strtolower(TABLE).'/edit/'.$id);
		}
		//cargamos la vista
		$this->load->view('templates/panel/layout', $data);
	}
	//Borramos dato seleccionado
	public function delete($id)
	{
		$data = $this->base(__FUNCTION__,$id);
 	}

	//Base para los metodos.
	//Todos los metodos necesitan pasar una serie de datos para las vistas que se repiten, con esta base evitamos repetir constantemente este paso
	private function base($action = null)
	{
		//Nombre del modelo
		$model = TABLE.'_model';

		$base = array(

						'lang' => $this->lang,
						'title' => $this->proyecto->getNombre()." | Panel de control",
						'reference' => strtoupper(TABLE.'-'.$action),
						'view' => strtolower(TABLE).'_'.$action,
						'page' => TABLE,
						'icono' => ICONO,
						'robots' => 'noindex, nofollow',
						'languages' => 1,
						'js' => $this->load->view('js_module/js_module','',TRUE),
						'css' => $this->load->view('css_module/css_module',TRUE),
						'lang' => $this->lang,
						'main_lang' => $this->config->item('language'),
						'project' => $this->proyecto

					);


		switch ($action)
		{

			case 'index':

				$base['get_result'] = $this->$model->get_result(ALIAS.strtolower(TABLE));
				$base['tooltip'] = strtolower (substr(TABLE, 0, -1));
				$base['param'] = 'productos/'.strtolower (TABLE);

				break;

			case 'add':

				$base['last_id'] = $this->$model->set_data(ALIAS.strtolower(TABLE));

				break;

			case 'edit':

				$base['subpage'] = 'Editar '.substr(TABLE, 0, -1);
				$base['param'] = strtolower (TABLE);
				$base['get_row'] = $this->$model->get_row(ALIAS.strtolower(TABLE),$this->uri->segment(4));

				break;

			case 'delete':

				$this->$model->delete_data(ALIAS.strtolower(TABLE),$this->uri->segment(4));
				redirect($this->lang.'/productos/'.strtolower (TABLE));

				break;
		}

		return $base;

	}
}
