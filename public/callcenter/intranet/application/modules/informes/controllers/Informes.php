<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informes  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;

	public function __construct()
	{
		parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'icon-bar-chart';
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

        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js','',TRUE);

        //obtenemos todos los roles
        $data['getRoles'] = $this->doctrine->em->getRepository("Entities\\Roles")->findAll();
        //obtenemos todos los estados registrois
        $data['getEstadosRegistros'] = $this->doctrine->em->getRepository("Entities\\Estadosregistros")->findAll();
        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
	}

    public function getUser()
    {
        if($this->input->is_ajax_request())
        {

            $rol = $this->input->post('rol');
            //obtenemos los usuarios mediante el rol
            $getUsers = $this->doctrine->em->getRepository("Entities\\Usuarios")->findBy(['idrol' => $rol]);
            $option = '<option value="0">Todos</option>';
            //recorremos getUsers y dibujamos los option
            foreach ($getUsers as $key => $user) 
            {
               
               $option .= '<option value="'.$user->getId().'">'.$user->getNombre().' '.$user->getApellidos().'</option>';
            }

            echo $option;

        }else{

            show_404();
        }

    }

    public function createReport()
    {

        if($this->input->is_ajax_request())
        {
            $user = $this->input->post('user');
            $rt = $this->input->post('reportType');
            $rol = $this->input->post('rol');
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            //variable donde alamcenamos la consulta report
            $rData['report'] = null;
            //realizamos la consutla
            $rData['report'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->getReport($rt,$user,$from,$to);
            //pasamos el informe al generador excel
            echo $this->load->view('include/table',$rData,TRUE);
            
        }else{

            show_404();
        }

    }

    public function createExcel(){

        if(isset($_POST['submitReport']))
        {

            $reportFrom = $this->input->post('reportFrom');
            $reportTo = $this->input->post('reportFrom');
            $reportTipo = $this->input->post('reportTipo');
            $reportRol = $this->input->post('reportRol');
            $reportUser = $this->input->post('reportUser');

            $report = $this->doctrine->em->getRepository("Entities\\Usuarios")->getReport($reportTipo,$reportUser,$reportFrom,$reportTo,TRUE);
            //generamos el informe en formato csv
            
            //generamos las cabeceras para el archivo csv
            header("Cache-Control: public");
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename='.$report['filename'].'.csv');
            echo utf8_decode("Periodo del ".$reportFrom." al ".$reportTo.";\n");
            echo $report['header'];
            echo $report['body'];

        }else{

            show_404();
        }
 
    }

}
