<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formulario  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;

	public function __construct()
	{
		parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'fa fa-list';
	}

    public function index()
    {
        //pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre()." | Panel de control";
        $data['view'] = strtolower(__FUNCTION__."_".$this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__."-".$this->nameClass);
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass);
        //datos cabecera tabla
        $data['thead'] = array('ID','Formulario');
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
        //obtenemos y mostramos todos los datos
        $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Formularios")->findAll();
        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
    }

    public function create()
    {
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre()." | Panel de control";
        $data['view'] = strtolower(__FUNCTION__."_".$this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__."-".$this->nameClass);
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1).'/'.$this->uri->segment(2);

        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass);
        //campañas. Toddas las campañas listado.
        $data['campaigns'] = $this->doctrine->em->getRepository("Entities\\Campaigns")->findAll();
        //comprobamos formulario submit
        if(isset($_POST['submit']))
        {
            //validamos los datos
            $this->form_validation->set_rules('name', 'Título', 'required');
            $this->form_validation->set_rules('campaign', 'Campaña', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run())
            {
                //objeto camapañas
                $campaign = $this->doctrine->em->find("Entities\\Campaigns", $this->input->post('campaign'));
                //instanciamos la entidad
                $form = new Entities\Formularios;
                //seteamos los datos
                $form->setName($this->input->post('name'));
                $form->setCampaign($campaign);
                //guardamos
                $this->doctrine->em->persist($form);
                $this->doctrine->em->flush();

                //redireccionamos al edit // EDITADO
                redirect(site_url($data['path'].'/edit/'.$form->getId()));
            }
        }
        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
    }

    public function edit($id)
    {
        
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre()." | Panel de control";
        $data['view'] = strtolower(__FUNCTION__."_".$this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__."-".$this->nameClass);
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass,'Editar '.$this->nameClass);
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1).'/'.$this->uri->segment(2);

        $data['id'] = $id;

        //obtenemos los datos por su id
        $data['getRow'] = $this->doctrine->em->find("Entities\\Formularios", $id);
        //campañas. Toddas las campañas listado.
        $data['campaigns'] = $this->doctrine->em->getRepository("Entities\\Campaigns")->findAll();
        //obtenemos los campos relacionados con el formulario
        //$data['getFields'] = $this->doctrine->em->getRepository("Entities\\FormularioCampos")->findBy(["formulario" => $id]);
        $data['getFields'] = $this->doctrine->em->getRepository("Entities\\FormularioCampos")->getFieldsByOrderer($id);
        //comprobamos formulario submit
        if(isset($_POST['submit']))
        {
            //validamos los datos
            $this->form_validation->set_rules('name', 'Título', 'required');
            $this->form_validation->set_rules('campaign', 'Campaña', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run())
            {
                //objeto camapañas
                $campaign = $this->doctrine->em->find("Entities\\Campaigns", $this->input->post('campaign'));
                //seteamos los datos
                $data['getRow']->setName($this->input->post('name'));
                $data['getRow']->setCampaign($campaign);
                //guardamos
                $this->doctrine->em->flush();
            }
        }
        //si hacemos submit add field
        if(isset($_POST['submitAddField']))
        {
            $this->_fieldAdd($id);
            redirect($data['path'].'/edit/'.$id, 'refresh');
        }
        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
    }

	public function _index()
	{
        //pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre()." | Panel de control";
        $data['view'] = strtolower(__FUNCTION__."_".$this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__."-".$this->nameClass);
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass);
        //datos cabecera tabla
        $data['thead'] = array('ID','Rol');
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1).'/'.$this->uri->segment(2);

        //obtenemos y mostramos todos los datos
        $data['getResult'] = $this->doctrine->em->getRepository("Entities\\FormularioCampos")->findAll();
        //si hacemos submit
        if(isset($_POST['submit']))
        {
            $this->_add();
            redirect($data['path'], 'refresh');
        }

        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
	}

    private function _fieldAdd($id)
    {
        //validamos los datos
        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $this->form_validation->set_rules('type', 'Tipo de campo', 'required');

        if( $this->input->post('type') == 'select' )
            $this->form_validation->set_rules('select', 'Opciones', 'required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

        if ($this->form_validation->run())
        {
            //objeto formulario
            $form = $this->doctrine->em->find("Entities\\Formularios", $id);
            //instanciamos la entidad
            $formField = new Entities\FormularioCampos;
            //seteamos los datos
            $formField->setFormulario($form);
            $formField->setName($this->input->post('name'));
            $formField->setType($this->input->post('type'));
            $formField->setOptions($this->input->post('select'));
            //guardamos
            $this->doctrine->em->persist($formField);
            $this->doctrine->em->flush();
        }
        
    }


    public function delete($id)
    {
        //obtenemos el dato mediante id
        $getRow = $this->doctrine->em->getRepository("Entities\\Formularios")->findOneBy(["id" => $id]);
        //eliminamos el item
        $this->doctrine->em->remove($getRow);
        $this->doctrine->em->flush();
        //ruta para los botones y acciones
        $path = $this->uri->segment(1).'/'.$this->uri->segment(2);
        //redireccionamos
        redirect(site_url($path));
    }

}
