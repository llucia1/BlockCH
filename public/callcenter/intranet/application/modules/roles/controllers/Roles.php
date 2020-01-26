<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;

	public function __construct()
	{
		parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'icon-ghost';
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
        $data['thead'] = array('ID','Rol');
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1).'/'.$this->uri->segment(2);

        //obtenemos y mostramos todos los datos
        $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Roles")->findAll();

        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
	}

    public function add()
    {
        // pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = "| Admin Dashboard";
        $data['view'] = strtolower(__FUNCTION__ . "_" . $this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1) . '/' . $this->uri->segment(2);

        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Crear '.substr($this->nameClass, 0, -2);
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass,'Crear '.substr($this->nameClass, 0, -2));

        //comprobamos formulario submit
        if(isset($_POST['submit']))
        {
            //validamos los datos
            $this->form_validation->set_rules('rol', 'Rol', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run())
            {
                //instanciamos la entidad
                $rol = new Entities\Roles;
                //seteamos los datos
                $rol->setRol($this->input->post('rol'));
                $rol->setPermisos(0);
                //guardamos
                $this->doctrine->em->persist($rol);
                $this->doctrine->em->flush();

                //redireccionamos al edit
                redirect(site_url($data['path'].'/edit/'.$rol->getId()));
            }
        }

        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
    }

    public function edit($id)
    {
        // pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = "| Admin Dashboard";
        $data['view'] = strtolower(__FUNCTION__."_".$this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['reference'] = strtoupper(__FUNCTION__."-".$this->nameClass);
        $data['project'] = $this->proyecto;
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Editar '.substr($this->nameClass, 0, -2);
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass,'Editar '.substr($this->nameClass, 0, -2));
        //obtenemos los datos por su id
        $data['getRow'] = $this->doctrine->em->find("Entities\\Roles", $id);
        //obtenemos los módules desde la tabla menuPanel
        $data['getModules'] = $this->doctrine->em->getRepository("Entities\\Menupanel")->findAll();
        //pasamos a la vista los permisos en forma de vectos
        $data['permissions'] =  explode(',',$data['getRow']->getPermisos());
        //var_dump($data['permissions']);
        //comprobamos formulario submit
        if(isset($_POST['submit']))
        {
            //validamos los datos
            $this->form_validation->set_rules('rol', 'Rol', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run())
            {
                //seteamos su nombre y lo actualizamos
                $data['getRow']->setRol($this->input->post('rol'));
                $this->doctrine->em->flush();
            }

        }
        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);

    }

    public function delete($id)
    {
        //obtenemos el dato mediante id
        $getRow = $this->doctrine->em->getRepository("Entities\\Roles")->findOneBy(["id" => $id]);
        //eliminamos el item
        $this->doctrine->em->remove($getRow);
        $this->doctrine->em->flush();
        //ruta para los botones y acciones
        $path = $this->uri->segment(1).'/'.$this->uri->segment(2);
        //redireccionamos
        redirect(site_url($path));
    }
    /**
     * Metodo que guarda y actualiza los módulos 
     * a los que tiene acceso el usuario.
     */
    public function setPermissions($id)
    {
        //comprobamos si se envio el formulario
        if(isset($_POST['submit-permissions']))
        {
            //convertimos el vector en un string separado por coma
            $permissions = implode(',',$_POST['module']);
            //instanciamos el rol
            $rol = $this->doctrine->em->find("Entities\\Roles", $id);
            $rol->setPermisos($permissions);
            $this->doctrine->em->flush();
 
        }
        //redireccionamos al edit
        redirect(site_url('configuracion/roles/edit/'.$id));
    }

}
