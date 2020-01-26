<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Precontactos  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;
    private $usuarioid = 0;
    private $rol = 0;

	public function __construct()
	{
		parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'icon-book-open ';
        $this->usuarioid = $this->session->userdata('usuarioid');
        $this->rol = $this->session->userdata('rol');
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
        $data['h1'] = str_replace('_',' ',$this->nameClass);
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_',' ',$this->nameClass));
        //datos cabecera tabla // editado
        $data['thead'] = array('ID','Razón social','Teléfono','Alta');
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //pasamos el rol del usuario
        $data['rol'] = $this->rol;
        //obtenemos y mostramos todos los datos // EDITADO
        
        $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Precontactos")->findBy(["idusuario" => $this->usuarioid]);

        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
	}

    public function add()
    {
        // pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre()." | Panel de control";
        $data['view'] = strtolower(__FUNCTION__ . "_" . $this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
        $data['project'] = $this->proyecto;
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);

        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Crear '.substr(str_replace('_',' ',$this->nameClass), 0, -1);
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_',' ',$this->nameClass),'Crear '.substr(str_replace('_',' ',$this->nameClass), 0, -1));

        //comprobamos formulario submit
        if(isset($_POST['submit']))
        {
            //validamos los datos // EDITADO
            $this->form_validation->set_rules('nombre', 'Razón social', 'required');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required');
            $this->form_validation->set_rules('movil', 'Móvil');
            $this->form_validation->set_rules('poblacion', 'Poiblación', 'required');
            $this->form_validation->set_rules('cp', 'CP', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run())
            {
                $reg = new Entities\Precontactos;
                $this->seter_data($reg,__FUNCTION__);
                //redireccionamos al edit // EDITADO
                redirect(site_url($data['path'].'/edit/'.$reg->getId()));
            }
        }

        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
    }

    public function edit($id)
    {
        // pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre()." | Panel de control";
        $data['view'] = strtolower(__FUNCTION__."_".$this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['reference'] = strtoupper(__FUNCTION__."-".$this->nameClass);
        $data['project'] = $this->proyecto;
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);

        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Editar '.substr(str_replace('_',' ',$this->nameClass), 0, -1);
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_',' ',$this->nameClass),'Editar '.substr(str_replace('_',' ',$this->nameClass), 0, -1));

        //obtenemos los datos por su id
        $data['getRow'] = $this->doctrine->em->find("Entities\\Precontactos", $id);
        //comprobamos formulario submit
        if(isset($_POST['submit']))
        {

            //validamos los datos // EDITADO
            $this->form_validation->set_rules('nombre', 'Razón social', 'required');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required');
            $this->form_validation->set_rules('movil', 'Móvil');
            $this->form_validation->set_rules('poblacion', 'Poiblación', 'required');
            $this->form_validation->set_rules('cp', 'CP', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run())
            {
                $reg = $data['getRow'];
                $this->seter_data($reg,__FUNCTION__);
                
            }

        }
        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);

    }

    public function delete($id)
    {
        //obtenemos el dato mediante id
        $getRow = $this->doctrine->em->getRepository("Entities\\Precontactos")->findOneBy(["id" => $id]);
        //eliminamos el item
        $this->doctrine->em->remove($getRow);
        $this->doctrine->em->flush();
        //ruta para los botones y acciones
        $path = $this->uri->segment(1);
        //redireccionamos
        redirect(site_url($path));
    }

    public function truncate()
    {
        //obtenemos el dato mediante id
        $this->doctrine->em->getRepository("Entities\\Precontactos")->truncate();
        //ruta para los botones y acciones
        $path = $this->uri->segment(1);
        //redireccionamos
        redirect(site_url($path));
    }

    public function export($type)
    {
        $separador = ";";//separador para los datos del excel

        /*
            comprobamos el tipo de esportación 
            .1=exportar el listado de todos los precontactos a formato excel registros
            .2=exportamos un listado de comerciales y los precontactods realizados por fecha
        */
        if($type == 1)
        {
            
            //generamos las cabeceras para el archivo xls
            header("Cache-Control: public");
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename= registros.xls');
            echo utf8_decode("Empresa;Direccion;CP;Ciudad;Provincia;Telefono;Movil;Email;Web;Sector;N.Empleados;Administrador;P.contacto;CIF;Comentario;\n");
            //obtenemos los precontactos
            $precontactos = $this->doctrine->em->getRepository("Entities\\Precontactos")->findAll();
            //y recorremos el objeto, esto generará un excel
            foreach ($precontactos as $key => $precontacto) 
            {

                echo $precontacto->getNombre().$separador."".$separador.$precontacto->getCp().$separador.$precontacto->getPoblacion().$separador."".$separador.$precontacto->getTelefono().$separador.$precontacto->getMovil().$separador."\n";
            }

        }elseif($type == 2)
        {
            header("Cache-Control: public");
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename= PrecontratosPorComercial.xls');
            echo utf8_decode("Comercial;Fecha;\n");

            $ppc = $this->doctrine->em->getRepository("Entities\\Precontactos")->getPrecontactosPorComercial();

            foreach ($ppc as $key => $value) 
            {
                echo $value['a_nombre']." ".$value['a_apellidos'].$separador.$value['u_falta']->format('d/m/Y').$separador.$value['TOTALPPC'].$separador."\n";
            }
        }
        
    }

    private function seter_data($reg,$type,$param = array())
    {
        $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->usuarioid);

        $telefono = str_replace(' ', '', $this->input->post('telefono'));
        $movil = str_replace(' ', '', $this->input->post('movil'));

        //Seteamos los datos
        $reg->setNombre($this->input->post('nombre'));
        $reg->setTelefono($telefono); 
        $reg->setMovil($movil);
        $reg->setPoblacion($this->input->post('poblacion'));
        $reg->setCp($this->input->post('cp'));
        $reg->setIdusuario($usuario);
        //guardamos la entidad en la tabla users
        if($type == "add")
            $this->doctrine->em->persist($reg);

        $this->doctrine->em->flush();
    }

}
