<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendario  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;
    private $today;
    private $usuarioid = 0;
    private $rol = 0;
    private $userList = TRUE;

	public function __construct()
	{
		parent::__construct();
        $this->nameClass = get_class($this);
        $this->icono = 'icon-calendar';
        $this->usuarioid = $this->session->userdata('usuarioid');
        $this->rol = $this->session->userdata('rol');
        //si el usuario rol es comercial == 3 entonces ocultamos el menu de selección de usuarios
        if($this->rol == 3)
            $this->userList = FALSE;

        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        //damos el valor de la fecha actual año y mes
        $this->today = date('Y-m');
        //si la url tiene parametros, entramos y sobrescribimos $today
        if($this->uri->segment(3) != "" AND $this->uri->segment(4) != "")
        {
            $this->today = $this->uri->segment(3)."-".$this->uri->segment(4);
        }
        //cargamos la libreria calendar de cd

        $prefs = array(

                'start_day'    => 'monday',
                'show_next_prev'  => TRUE,
                'next_prev_url'   => site_url('calendario/get_calendar'),

                'template' => array(
                        'table_open'           => '<table id="'.$this->today.'" class="calendar">',
                        'cal_cell_start'       => '<td class="day">',
                        'cal_cell_start_today' => '<td class="day today">',
                        'heading_row_start'    => '<tr class="heading_row_start">'

                )

        );

        $this->load->library('calendar',$prefs);
	}

	public function index()
	{

        // pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre() . " | Panel de control";
        $data['view'] = strtolower(__FUNCTION__."_".$this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['reference'] = strtoupper(__FUNCTION__."-".$this->nameClass);
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
        //muestra u oculta el menú de selección de usuarios
        $data['userList'] = $this->userList;
        //id usuario
        $data['usuarioid'] = $this->usuarioid;
        //roo usuario
        $data['rol'] = $this->rol;
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css_module','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js_module','',TRUE);
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass);
        //generamos el calendario
        $data['calendar'] = $this->calendar->generate();
        //comprobamos el rol del usuario, si este es = 7 director comercial entonces el listado
        //de susarios o comerciales del calendario, será sacados de la tabla equipo
        if($this->rol == 7)
        {
        	//obtenemos los usuarios
        	$data['users'] = $this->doctrine->em->getRepository("Entities\\Equipos")->findBy(["idmaster" => $this->usuarioid]);

        }else{

        	//obtenemos los usuarios
        	$data['users'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findBy(["idrol" => 3]);
        }
        

        if(isset($_POST['submit-reporte-calendario']))
        {

            //pasamos en un array los parametros necesarios
            $p = array(
                'tipo_reporte' => $this->input->post('tipo-reporte'),
                'text_reporte' => $this->input->post('text-reporte'),
                'id_calendario' => $this->input->post('id-calendario')
                );

            $this->set_reporte($p);
            //actualizamos el seguimiento del cliente
            $this->update_seguimiento($p);

        }    

        $this->load->view('templates/panel/layout',$data);

	}

    public function add_event()
    {
        //Obtenemos el usuario
        $user = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('usuario'));
        $reg = new Entities\Calendario;
        //Seteamos los datos
        $reg->setFecha(new \DateTime($this->input->post('fEvent').' '.$this->input->post('hEvent')));

        $reg->setComentario($this->input->post('commentEvent'));
        $reg->setIdusuario($user);
        $date = explode('-', $this->input->post('fEvent'));
        $reg->setYear($date[2]);
        $reg->setMonth($date[1]);
        $reg->setDay($date[0]);
        $hour = str_replace(':','',$this->input->post('hEvent'));
        $reg->setHour($hour/100);

        //guardamos la entidad en la tabla users
        $this->doctrine->em->persist($reg);
        $this->doctrine->em->flush();

        //redireccionamos al edit
        redirect(site_url('calendario'));

    }

    public function get_calendar()
    {
        if($this->input->is_ajax_request())
        {
            echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));

        }else{

            show_404();
        }
    }

    public function get_events()
    {
        if($this->input->is_ajax_request())
        {
            $users = $this->input->post('user_list');
            $date = $this->input->post('date');
            $data = $this->doctrine->em->getRepository("Entities\\Calendario")->getEvents($users,$date);
            //print_r($data);
            echo json_encode($data);

        }else{

            show_404();
        }
    }

    public function get_events_list()
    {
        if($this->input->is_ajax_request())
        {
            $user = $this->input->post('id');
            $date = $this->input->post('date');
            $day = $this->input->post('day');
            $this->eventList($user,$date,$day);

        }else{

            show_404();
        }
    }

    public function get_event_detail()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            //obtenemos todos los estados seguimiento
            $estadosSeguimiento = $this->doctrine->em->getRepository("Entities\\Estadosseguimiento")->findAll();
            //pasamos todos los option con los estados
            $estadosOptions = "";
            //obtenemos los datos del calendario
            $calendario = $this->doctrine->em->getRepository("Entities\\Calendario")->getEventDetail($id);
            $cSeguimiento = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findBy(["idcliente" => $calendario[0]['cl_id']]);

            foreach ($cSeguimiento as $key => $value) {
                
                if($value->getActual() == 1){

                    $cSeguimiento = $value->getTipo();
                }
            }
            
            foreach ($estadosSeguimiento as $key => $estado){
                
                $estadosOptions .= '<option value="'.$estado->getId().'">'.$estado->getNombre().'</option>';
            }

            $data = array(

                'calendar' => $calendario,
                'options' => $estadosOptions,
                'cSeguimiento' => $cSeguimiento

                );
            //print_r($calendario[0]['cl_id']);
            echo json_encode($data);

        }else{

            show_404();
        }
    }

    public function delete_event()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            $event = $this->doctrine->em->getRepository("Entities\\Calendario")->findOneBy(["id" => $id]);
            //borramos el dato
            $this->doctrine->em->remove($event);
            $this->doctrine->em->flush();

        }else{

            show_404();
        }
    }

    public function edit_event()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            $user = $this->input->post('user');
            $date = $this->input->post('date');
            $hour = $this->input->post('hour');
            $comment = $this->input->post('comment');
            $_date = $this->input->post('_date');
            $_day = $this->input->post('_day');

            $event = $this->doctrine->em->getRepository("Entities\\Calendario")->findOneBy(["id" => $id]);
            $user = $this->doctrine->em->find("Entities\\Usuarios", $user);
        
            $event->setFecha(new \DateTime($date.' '.$hour));
            $event->setComentario($comment);
            $event->setIdusuario($user);
            $date = explode('-', $date);
            $event->setYear($date[2]);
            $event->setMonth($date[1]);
            $event->setDay($date[0]);
            $hour = str_replace(':','',$hour);
            $event->setHour($hour/100);
            //editamos la entidad en la tabla users
            $this->doctrine->em->flush();

            //$this->eventList($user,"2017-06","23");

        }else{

            if(isset($_POST['submit']))
            {
                $id = $this->input->post('idEvent');
                $date = $this->input->post('fEvent');
                $hour = $this->input->post('hEvent');
                $userId = $this->input->post('idUsuario');

                $event = $this->doctrine->em->getRepository("Entities\\Calendario")->findOneBy(["id" => $id]);
                //si userId es > 0 obtenemos el obj usuario
                if($userId > 0)
                {
                    $user = $this->doctrine->em->find("Entities\\Usuarios", $userId);
                }

                $event->setFecha(new \DateTime($date.' '.$hour));
                $date = explode('-', $date);
                $event->setYear($date[2]);
                $event->setMonth($date[1]);
                $event->setDay($date[0]);
                $hour = str_replace(':','',$hour);
                $event->setHour($hour/100);
                //si userId > 0 editamos el usuario relacionado
                if($userId > 0)
                {
                    $event->setIdusuario($user);
                }
                //editamos la entidad en la tabla users
                $this->doctrine->em->flush();
                //redireccionamos al calendario
                redirect(site_url('calendario'));

            }else{

                show_404();
            }
        }
    }

    public function get_row()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            $event = $this->doctrine->em->getRepository("Entities\\Calendario")->findOneBy(["id" => $id]);
            
            $data['id'] = $event->getId();
            $data['date'] = $event->getFecha()->format('d-m-Y');
            $data['hour'] = $event->getFecha()->format('H:i');
            $data['comentario'] = $event->getComentario();
            $data['idUser'] = $event->getIdusuario()->getId();
            echo json_encode($data);

        }else{

            show_404();
        }
    }

    private function eventList($user,$date,$day)
    {
        $date = explode('-', $date);
        $data = $this->doctrine->em->getRepository("Entities\\Calendario")->getEventsList($user,$date[0],$date[1],$day);
        if($data)
        {
            echo json_encode($data);

        }else{

            echo '';
        }
        
    }

    private function set_reporte($param)
    {

        $calendario = $this->doctrine->em->getRepository("Entities\\Calendario")->find($param['id_calendario']);
        //obtenemos el objeto usuario
         $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->usuarioid);
         //obtenemos el objeto Estados seguimiento
         $tipoReporte = $this->doctrine->em->getRepository("Entities\\Estadosseguimiento")->findOneBy(["id" => $param['tipo_reporte']]);

        $reporte = new Entities\Reportes;
        //Actualizamos el evento dekl calendario
        $calendario->setEstado(1);
        $this->doctrine->em->flush();
        //creamos el reporte vinculado a la oportunidad vinculada al evento del calendario
        $reporte->setIdrow($calendario->getIdcliente()->getId());
        $reporte->setIdrows($calendario->getId());
        $reporte->setIdusuario($usuario);
        $reporte->setTabla('cuentas');
        $reporte->setTablas('calendario');
        $reporte->setComentario($param['text_reporte']);
        $reporte->setReporte($tipoReporte->getNombre());
        $this->doctrine->em->persist($reporte);
        $this->doctrine->em->flush();
    }

    private function update_seguimiento($param)
    {

        $calendario = $this->doctrine->em->getRepository("Entities\\Calendario")->find($param['id_calendario']);
        //obtenemos el objeto usuario
         $seguimiento = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcalendario" => $calendario->getId()]);
         //obtenemos el tipo de estado seguimiento
         $idEstado = $this->doctrine->em->getRepository("Entities\\Estadosseguimiento")->findOneBy(["id" => $param['tipo_reporte']]);
        //actualizamos el isEstado Cuentasseguimiento
        $seguimiento->setIdestado($idEstado);
        $this->doctrine->em->flush();

        $this->setTarea($calendario);
    }

    private function setTarea($obj)
    {
        //creamos una instancia de la entidad Tareas
        $tarea = new Entities\Tareas;
        //obtenemos el objeto cuentas
        $cliente = $obj->getIdcliente();
        //obtenemos el objeto usuarios para usuarioto
        $usuarioto = $cliente->getIdusuario();
        //obtenemos el objeto usuarios para usuariofrom
        $usuariotfrom = $this->doctrine->em->find("Entities\\Usuarios", $this->usuarioid);
        //establecemos las propiedades a través de los setters
        $tarea->setIdcliente($cliente);
        $tarea->setIdusuariofrom($usuariotfrom);
        $tarea->setIdusuarioto($cliente->getIdusuario());
        $tarea->setIdcalendario($obj);
     
        //guardamos la entidad en la tabla tareas
        $this->doctrine->em->persist($tarea);
        $this->doctrine->em->flush();
        //comprobamos si petición de cobertura es igual a 1, si es así entramos y creamos una nueva tarea
        //esta tarea se crea con tipo = 'cobertura' y se asigna a la coordinadora de cierre = 28
        if($this->input->post('peticion-cobertura') == 1)
        {
        	//obtenemos objeto usuario coordinador cierre = 28
        	$usuarioto = $this->doctrine->em->find("Entities\\Usuarios", 28);

        	$tarea = new Entities\Tareas;
        	$tarea->setIdcliente($cliente);
        	$tarea->setIdusuariofrom($usuariotfrom);
        	$tarea->setIdusuarioto($usuarioto);
        	$tarea->setTipo('cobertura');
        	$tarea->setIdcalendario($obj);
        	$tarea->setTexto($this->input->post('direcciones-coberturas'));
        	//guardamos la entidad en la tabla tareas
        	$this->doctrine->em->persist($tarea);
        	$this->doctrine->em->flush();
        }
    }

}
