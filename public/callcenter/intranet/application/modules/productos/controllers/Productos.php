<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos  extends MX_Controller {

	private $lang = "";
	private $proyecto = "";
	private $nameClass;
	private $fields = array();
	private $limit_page = 0;
	private $start = 0;

	public function __construct()
	{

    parent::__construct();
		//$this->lang = $this->uri->segment(1);
		$this->lang = 'es';
		$this->nameClass = get_class($this);
		$this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
		$this->limit_page = 50;
		$this->start = 0;
		$this->fields = array('ID','Nombre','Referencia','Marca','fecha','Destacar','Publicar');
		define("ICONO","fa fa-opencart");
		define("TABLE","Productos");
		$this->load->model(TABLE.'_model');

  }

	public function index()
	{

		$data = $this->base(__FUNCTION__);
		$data['fields'] = $this->fields;
		//Nombre del modelo
		$model = TABLE.'_model';
		// titulo del módulo
		$data['h1'] = str_replace('_',' ',$this->nameClass);
		//lista migas pan
    $data['breadcrumb'] = array(str_replace('_',' ',$this->nameClass));
		//listado de marcas
		$data['marcas'] = $this->$model->get_brands();
		//paginación
		$this->load->library('pagination');

		$config['base_url'] = site_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).$data['$urlGet']);
		$config['total_rows'] = $data['total_rows'];
		$config['cur_tag_open'] = '<li class="page-number active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="pagination">';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="pagination">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="pagination">';
		$config['prev_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="pagination pg">';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="pagination pg">';
		$config['first_tag_close'] = '</li>';
		$config['page_query_string'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['per_page'] = $this->limit_page;

		$this->pagination->initialize($config);
		$data['pages_links'] = $this->pagination->create_links();

		$this->load->view('templates/panel/layout', $data);
 	}

	public function add()
	{

		$data = $this->base(__FUNCTION__);
		redirect('/productos/'.strtolower(TABLE).'/edit/'.$data['last_id']);
	}

	public function edit($id)
	{
		$data = $this->base(__FUNCTION__);
		// titulo del módulo
		$data['h1'] = str_replace('_',' ',$this->nameClass);
		//lista migas pan
		$data['breadcrumb'] = array(str_replace('_', ' ', $this->nameClass), 'Editar ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1));
		
		$data['id'] = $id;
		//$data['id_category'] = $data['get_row']['id_category'];
		$model = TABLE.'_model';//Nombre del modelo
		$data['attachments'] = $this->$model->get_attachments(strtolower(TABLE),$id);
		//$data['relacionados'] = $this->$model->get_related($id);
		//$data['attributes'] = $this->$model->get_attributes($this->lang);
		$data['marcas'] = $this->$model->get_brands();

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

			if($_FILES['fileinput']['name'] != "")
			{
				$upload_image = $this->up_load('fileinput','productos');

				if($upload_image['upload'])
				{
					$image['main_image'] = "".$upload_image['res']."";
					$this->$model->add_image(strtolower(TABLE),$id,$image);
				}

			}

			$this->$model->update_data(strtolower(TABLE),$id,$this->lang,$update);
			redirect('/productos/'.strtolower (TABLE).'/edit/'.$id);
		}

		$this->load->view('templates/panel/layout', $data);
	}

	public function delete($id)
	{
		$data = $this->base(__FUNCTION__,$id);
 	}

	public function copy($id)
	{
		$data = $this->base(__FUNCTION__,$id);
 	}

	public function upload_attachment($id,$id_attr = 0,$id_attr_val = 0)
	{

		if($_FILES['attachments'.$id]['name'] != "" OR $_FILES['attachments_attr'.$id_attr_val]['name'] != "")
		{
			
			$data = $this->base(__FUNCTION__);
			$model = TABLE.'_model';

			if($_FILES['attachments'.$id]['name'] != "")
			{ 
				$upload_image = $this->up_load('attachments'.$id,'attachments');
			}
			elseif($_FILES['attachments_attr'.$id_attr_val]['name'] != "")
			{
				$upload_image = $this->up_load('attachments_attr'.$id_attr_val,'attachments');
			}

			if(isset($upload_image[0]))
			{

				foreach ($upload_image as $key => $value) 
				{
					//echo $value['res'];
					
					if($value['upload'])
					{
						$data_['idRow'] = $id;
						//$data_['id_attribute'] = $id_attr;
						//$data_['id_attribute_value'] = $id_attr_val;
						$data_['tableRow'] = strtolower(TABLE);
						$data_['attached'] = $value['res'];

						$this->$model->set_attachment($data_);

					}else
					{

					}

				}

				redirect('productos/'.strtolower(TABLE).'/edit/'.$id);

			}else{


				if($upload_image['upload'])
				{
					$data_['id_row'] = $id;
					$data_['id_attribute'] = $id_attr;
					$data_['id_attribute_value'] = $id_attr_val;
					$data_['table_n'] = strtolower(TABLE);
					$data_['attached'] = $upload_image['res'];

					$this->$data['model_name']->set_attachment($data_);
					redirect($this->lang.'/productos/'.strtolower(TABLE).'/edit/'.$id);

				}else
				{

				}

			}
			
			
			//print_r($_FILES['attachments'.$id]);
			/*foreach ($_FILES['attachments'.$id]['name'] as $key => $value) {
				echo $value.'<br/>';
			}*/
			

		}else
		{
			show_404();
		}
	}

	public function delete_attachment($id,$id_attachment)
	{

		$data = $this->base(__FUNCTION__);
		$model = TABLE.'_model';
		$this->$model->delete_attachment($id_attachment);
		redirect('productos/'.strtolower(TABLE).'/edit/'.$id);
 	}

	public function add_related($id)
	{
		$data = $this->base(__FUNCTION__);
		$id_related = $this->input->post('related');
		$data_ = array('id_product' => $id,'id_related' => $id_related,);

		$this->$data['model_name']->set_related($data_);
		redirect($this->lang.'/productos/'.strtolower(TABLE).'/edit/'.$id);
 	}

	public function delete_related($id,$id_related)
	{

		$data = $this->base(__FUNCTION__);
		$this->$data['model_name']->delete_related($id_related);
		redirect($this->lang.'/productos/'.strtolower(TABLE).'/edit/'.$id);
 	}

	public function update_product_attribute()
	{

		if($this->input->is_ajax_request())
		{

			$data = $this->base(__FUNCTION__);

			$model = TABLE.'_model';//Nombre del modelo

			$id_product = $this->input->post('id_product');
			$id_attribute = $this->input->post('id_attribute');
			$id_attribute_value = $this->input->post('id_attribute_value');
			$impact = $this->input->post('impact');
			$state = null;

			if(isset($_POST['state']))
			{
				$state = $this->input->post('state');
			}

			$pro_attr = $this->$model->exist_product_attribute($id_product,$id_attribute,$id_attribute_value);

			if($pro_attr)
			{
				
				if($state != null)
				{

					if($state == 0)
					{
						$this->$model->delete_product_attribute($id_product,$id_attribute,$id_attribute_value);

					}

				}else{

					$data_ = array('impact' => $impact);
					$this->$model->update_product_attribute($id_product,$id_attribute,$id_attribute_value,$data_);

				}
				
				

			}else
			{
				if($state != null)
				{
				
					$data_ = array('impact' => $impact,'id_product' => $id_product,'id_attribute' => $id_attribute,'id_attribute_value' => $id_attribute_value,'state' => 1);
					$this->$model->set_product_attribute($data_);
				}
			}

		}else
		{
			show_404();
		}
 	}
	//crea y elimina categorias asociadas al producto de forma dinámica
	public function product_categories()
	{

		if($this->input->is_ajax_request())
		{

			$data = $this->base(__FUNCTION__);
			//Nombre del modelo
			$model = TABLE.'_model';
			$idPro = $this->input->post('id_product');
			$idCat = $this->input->post('id_category');
			$checked = $this->input->post('checked');
			//realizamos la consulta
			$this->$model->product_categories($idPro,$idCat,$checked);



		}else
		{
			show_404();
		}
 	}

	//Base para los metodos.
	private function base($action = null,$id = 0)
	{

		$model = TABLE.'_model';//Nombre del modelo

		$base = array(
						'title' => $this->proyecto->getNombre()." | Panel de control",
						'reference' => strtoupper(TABLE.'-'.$action),
						'view' => strtolower (TABLE).'_'.$action,
						'page' => TABLE,
						'icono' => ICONO,
						'robots' => 'noindex, nofollow',
						'languages' => 1,
						'js' => $this->load->view('js_module/js_module','',TRUE),
						'css' => $this->load->view('css_module/css_module',TRUE),
						'lang' => $this->lang,
						'main_lang' => $this->config->item('language'),
						'model_name' => $model,
						'project' => $this->proyecto
						
					);


		switch ($action)
		{

			case 'index':

				$param = null;
				$urlGet = null;
				//si existe get, igualamos $param
				if (isset($_GET))
				{
					$param = $_GET;
					$urlGet ='?';
					foreach ($param as $key => $value)
					{
						if($key != 'per_page')
							$urlGet .= $key.'='.$value.'&';
					}
					//eliminamos el último &
					$urlGet = trim($urlGet, '&');
				}

				//si existe $_GET['per_page'] entonces sobreesceribimos $this->start
				if(isset($_GET['per_page']))
					$this->start = $_GET['per_page'];

				$base['get_result'] = $this->$model->get_result(strtolower (TABLE),$this->lang,$this->start,$this->limit_page,$param);
				$base['total_rows'] = $this->$model-> get_total_rows(strtolower(TABLE),$param);
				$base['tooltip'] = strtolower (substr(TABLE, 0, -1));
				$base['$urlGet'] = $urlGet;
				$base['param'] = 'productos/'.strtolower (TABLE);

				break;

			case 'add':

				$base['last_id'] = $this->$model->set_data(strtolower (TABLE),$this->lang);

				break;

			case 'edit':

				$base['subpage'] = 'Editar '.substr(TABLE, 0, -1);
				$base['param'] = 'productos/'.strtolower (TABLE);
				//$base['get_result'] = $this->$model->get_products(strtolower (TABLE),$this->lang);
				//comprobamos si la consulta tiene resultados, en caso contrario pasamo un array vacío.
				if($this->$model->get_my_categories($this->uri->segment(5)))
				{
					$base['get_my_categories'] = $this->$model->get_my_categories($this->uri->segment(5));
					$base['get_my_categories_by_id'] = $this->$model->get_my_categories_by_id($this->uri->segment(5));

				}else
				{
					$base['get_my_categories'] = array();
					$base['get_my_categories_by_id'] = array();
				}

				$base['get_row'] = $this->$model->get_row($this->uri->segment(4),strtolower (TABLE),$this->lang);

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
	//función para subir archivos
	private function up_load($name,$folder)
	{
		$config['upload_path'] = 'assets/'.$folder;
		$config['allowed_types'] = '*';
		$config['max_size']     = '2048';
		$config['quality']     = '60%';
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		$config['overwrite'] = FALSE;

		$this->load->library('upload');
		$this->upload->initialize($config);

		$nfu = count($_FILES[$name]['name']);

		if($nfu >= 1)
		{
			for ($i = 0; $i < $nfu; $i++)
			{
				$_FILES['userfile']['name']     = $_FILES[$name]['name'][$i];
				$_FILES['userfile']['type']     = $_FILES[$name]['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES[$name]['tmp_name'][$i];
				$_FILES['userfile']['error']    = $_FILES[$name]['error'][$i];
				$_FILES['userfile']['size']     = $_FILES[$name]['size'][$i];

				if($this->upload->do_upload())
				{

					$data_image = $this->upload->data();
					$upload_data[$i] = array(

							'upload' => TRUE,
				           	'res' => $data_image['file_name'],
				        );

					$this->create_thumbnail($folder,$data_image['file_name']);

				}else
				{

					$upload_data[$i] = array(

							'upload' => FALSE,
				           	'res' => $this->upload->display_errors('<div class="alert alert-danger" role="alert">', '</div>'),
				        );
				}
			}

			return $upload_data;

		}else
		{
			if(is_array($_FILES[$name]['name']))
			{

				$_FILES['userfile']['name']     = $_FILES[$name]['name'][0];
				$_FILES['userfile']['type']     = $_FILES[$name]['type'][0];
				$_FILES['userfile']['tmp_name'] = $_FILES[$name]['tmp_name'][0];
				$_FILES['userfile']['error']    = $_FILES[$name]['error'][0];
				$_FILES['userfile']['size']     = $_FILES[$name]['size'][0];
				$name = "userfile";
			}
			
			if($this->upload->do_upload($name))
			{
				
				$data_image = $this->upload->data();
				$upload_data = array(

						'upload' => TRUE,
			           	'res' => $data_image['file_name'],
			        );

				$this->create_thumbnail($folder,$data_image['file_name']);

			}else
			{

				$upload_data = array(

						'upload' => FALSE,
			           	'res' => $this->upload->display_errors('<div class="alert alert-danger" role="alert">', '</div>'),
			        );
			}

			return $upload_data;
		}

		
	}
	//función para miniaturas
	private function create_thumbnail($folder,$filename)
	{

      $config['image_library'] = 'gd2';
      //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
      $config['source_image'] = 'assets/'.$folder.'/'.$filename;
      $config['create_thumb'] = TRUE;
      $config['maintain_ratio'] = TRUE;
      //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
      $config['new_image']='assets/'.$folder.'/thumbnail';
      $config['width'] = 150;
      $config['height'] = 150;
      $this->load->library('image_lib', $config);
      $this->image_lib->resize();
  }
}
