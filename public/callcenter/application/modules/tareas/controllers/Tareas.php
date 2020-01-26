<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tareas extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;
    private $rol = 0;
    private $usuarioid = 0;
    private $start = 0;
    private $limit = 0;
    private $totalRecord = 0;

    public function __construct()
    {
        parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'fa fa-thumb-tack';
        $this->usuarioid = $this->session->userdata('usuarioid');
        $this->rol = $this->session->userdata('rol');
        //cargamos el helper para generación del pass
        $this->load->helper('generate_pass_helper');
        $this->load->helper('MY_encrypt_helper');
        //formate la fecha para pasarla a doctrine
        $this->load->helper('format_date_doctrine_helper');
        //helper uploads
        $this->load->helper('upload_helper');
        $this->load->helper('my_playing_dates_helper');
        $this->limit = 25;
        $this->totalRecord = count($this->doctrine->em->getRepository("Entities\\Tareas")->findAll());
    }


    public function index()
    {
        //pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre() . " | Panel de control";
        $data['view'] = strtolower(__FUNCTION__ . "_" . $this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass);
        //datos cabecera tabla
        $data['thead'] = array('ID', 'Cliente','Comercial','Fecha');
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);

        $data['rol'] = $this->rol;
        //comprobamos si el rol es == 8 coordinadora de cierre, si este es así entramos y obtenemos su
        //también las tareas de cobertura
        if($this->rol == 8)
        {
            $data['getCoberturas'] = $this->doctrine->em->getRepository("Entities\\Tareas")->findBy(["idusuarioto" => $this->usuarioid,'estado' => 0,'tipo' => 'cobertura']);
        }
        //pasamos la lista de tareas pendientes, que son las que estado = 0
        $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Tareas")->findBy(["idusuarioto" => $this->usuarioid,'estado' => 0]);

        //cargamos la vista
        $this->load->view('templates/panel/layout', $data);
    }

    public function edit($id)
    {
        //pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre() . " | Panel de control";
        $data['view'] = strtolower(__FUNCTION__ . "_" . $this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
        //datos cabecera tabla
        $data['thead'] = array('ID','Nombre', 'Documento','Fecha','Estado');
        $data['id'] = $id;
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css_module','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js_module','',TRUE);
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Vista de ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1);
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_', ' ', $this->nameClass), 'Vista de ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1));
        //obtenemos los datos de la tarea
        $data['getRow'] = $this->doctrine->em->find("Entities\\Tareas", $id);
        //pasamos la ruta al modal
        $data['pathModal'] = 'tareas/edit/'.$id;
        //obtenemos los datos del reporte, mediante el id del cliente y el del calendario
        $data['getReporte'] = $this->doctrine->em->getRepository("Entities\\Reportes")->findOneBy(["idrow" => $data['getRow']->getIdcliente()->getId(),"idrowS" => $data['getRow']->getIdcalendario()->getId()]);
        //obtenemos los datos del seguimiento mediante el id del cliente y el del calendario
        $data['getCuSegui'] = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcliente" => $data['getRow']->getIdcliente()->getId(),"idcalendario" => $data['getRow']->getIdcalendario()->getId(), 'actual' => 1]);
        //todos los adjuntos del usuario
        $data['attachments'] = $this->doctrine->em->getRepository("Entities\\Attachments")->findBy(["idrow" => $data['getRow']->getIdcliente()->getId()]);
        //repostes asociados al calendario
        $data['getReports'] = $this->doctrine->em->getRepository("Entities\\Reportes")->findBy(["idrowS" => $data['getRow']->getIdcalendario()->getId()]);
        //obtenemos el listado de Tipos de documentos
        $data['getTiposDocumentos'] = $this->doctrine->em->getRepository("Entities\\Tiposdocumentos")->findAll();

        $data['showSiNo'] = array('Nuevo 1','Nuevo 2','Nuevo 3','Oferta 1','Oferta 2','Oferta 3');
        $data['showNuevo'] = array('Nuevo 1','Nuevo 2','Nuevo 3');
        $data['showOferta'] = array('Oferta 1','Oferta 2','Oferta 3','Citar E.O.');

        if(isset($_POST['submit-AddSeEsModal']))
        {
            $c = $data['getRow']->getIdcliente();
            $u = $data['getRow']->getIdusuariofrom();
            $idCa = $data['getRow']->getIdcalendario()->getId();

            $this->generateEvento($c,$u,$idCa);
            //cerramos la tarea
            $this->close_tarea($id);
        }

        //comprobamos formulario submit-attach en modal
        if (isset($_POST['submit-attach'])){

            $upload_image = $this->up_load('file','attachments_cuentas');
            //comprobamos si la subida ok, si no es así mostramos el error
            if($upload_image['upload'])
            {

                //instanciamos la entidad
                $reg = new Entities\Attachments;
                //seteamos los datos
                $reg->setIdrow($data['getRow']->getIdcliente()->getId());
                $reg->setTablerow('cuentas');
                $reg->setTipodocumento($this->input->post('tipo-documento'));
                $reg->setNombredocumento($this->input->post('nombreDocumento'));
                $reg->setAttached($upload_image['res']);
                //guardamos
                $this->doctrine->em->persist($reg);
                $this->doctrine->em->flush();

                redirect($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$id);

            }else{

                $data['lang'] = "es";
                $data['title'] = $this->proyecto->getNombre() . " | Panel de control";
                $data['view'] = 'errors/html/error_app';
                $data['robots'] = 'noindex, nofollow';
                $data['project'] = $this->proyecto;
                $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
                //ruta para los botones y acciones
                $data['path'] = $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$id;

                $data['error'] = $upload_image['res'];

            }

            //redireccionamos
            redirect('tareas/edit/'.$idTarea);
            

        }

        //cargamos la vista
        $this->load->view('templates/panel/layout', $data);
    }

    private function generateEvento($c,$u,$idCa)
    {
        
        $reg = new Entities\Calendario;
        //Seteamos los datos
        $reg->setFecha(new \DateTime($this->input->post('fEvent').' '.$this->input->post('hEvent')));

        $reg->setComentario($this->input->post('comentario'));
        $reg->setIdusuario($u);
        $date = explode('-', $this->input->post('fEvent'));
        $reg->setYear($date[2]);
        $reg->setMonth($date[1]);
        $reg->setDay($date[0]);
        $hour = str_replace(':','',$this->input->post('hEvent'));
        $reg->setHour($hour/100);
        $reg->setIdcliente($c);

        //guardamos la entidad en la tabla users
        $this->doctrine->em->persist($reg);
        $this->doctrine->em->flush();
        //ahora generamos nuevo uno en seguimiento.
        $e = $this->doctrine->em->find("Entities\\Calendario", $reg->getId());
        $this->generateSeguimiento($e,$idCa);

    }

    private function generateSeguimiento($obj,$idCa)
    {
        //obtenemos los objetos usuario y faseventa
        $usuario = $this->doctrine->em->find("Entities\\Usuarios", $obj->getIdcliente()->getId());
        $estado = $this->doctrine->em->getRepository("Entities\\Estadosseguimiento")->findOneBy(["id" =>0]);

        $reg = new Entities\Cuentasseguimiento;
        $reg->setIdestado($estado);
        $reg->setIdusuario($obj->getIdusuario());
        $reg->setIdteleoperador($obj->getIdcliente()->getIdusuario());
        $reg->setIdcliente($obj->getIdcliente());
        $reg->setIdcalendario($obj);
        $reg->setTipo($this->input->post('tipo-seguimiento'));
        $reg->setFseguimiento(new \DateTime(formatDateDoct($obj->getFecha()->format("d-m-Y"))));

        //guardamos el seguimiento
        $this->doctrine->em->persist($reg);
        $this->doctrine->em->flush();

        //obtenemos el seguimiento anterior a través de su idcalendario
        $seguimientoAnt =$this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcalendario" => $idCa, "actual" => 1]);
        //y modificamos su estado actual = 0
        /*if($seguimientoAnt === null)
        {
            echo "No existe el usuario.\n";
            exit();
        }*/
        $seguimientoAnt->setActual(0);
        $this->doctrine->em->flush();

        $this->generateReport($reg);

    }

    private function generateReport($obj)
    {
        $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->usuarioid);
        $reg = new Entities\Reportes;
        $reg->setIdusuario($usuario);
        $reg->setComentario($this->input->post('comentario'));
        $reg->setIdrow($obj->getIdcliente()->getId());
        $reg->setIdrows($obj->getIdcalendario()->getId());
        $reg->setTabla('cuentas');
        $reg->setTablas('calendario');
        //guardamos el seguimiento
        $this->doctrine->em->persist($reg);
        $this->doctrine->em->flush();
    }

    public function close_tarea($id)
    {

        $tarea = $this->doctrine->em->find("Entities\\Tareas", $id);
        //si la tarea que estamos cerrando es documentación, creamos la tarea 
        //para el operador para que este pueda asignar una cita oferta 1
        if(isset($_POST['documentacion']) AND $this->rol == 1)
        {
            //obtenemos los datos del seguimiento mediante el id del cliente y el del calendario
            $seguimientoAnt = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcliente" => $tarea->getIdcliente()->getId(),"idcalendario" => $tarea->getIdcalendario()->getId(), 'actual' => 1]);

            //editamos el seguimiento actual
            $seguimientoAnt->setActual(0);
            $this->doctrine->em->flush();

            $newTarea = new Entities\Tareas;
            $newTarea->setIdcliente($tarea->getIdcliente());
            $newTarea->setIdusuariofrom($tarea->getIdusuariofrom());
            $newTarea->setIdusuarioto($tarea->getIdcliente()->getIdusuario());
            $newTarea->setIdcalendario($tarea->getIdcalendario());
            //guardamos la nueva tarea
            $this->doctrine->em->persist($newTarea);
            $this->doctrine->em->flush();
            //creamos un nuevo seguimiento
            $estado = $this->doctrine->em->find("Entities\\Estadosseguimiento", 0);
            
            $newSeguimiento = new Entities\Cuentasseguimiento;
            $newSeguimiento->setIdcliente($tarea->getIdcliente());
            $newSeguimiento->setIdcalendario($tarea->getIdcalendario());
            $newSeguimiento->setIdUsuario($seguimientoAnt->getIdusuario());
            $newSeguimiento->setIdteleoperador($tarea->getIdcliente()->getIdusuario());
            $newSeguimiento->setIdestado($estado);
            $newSeguimiento->setTipo('Citar E.O.');
            $newSeguimiento->setFseguimiento(new \DateTime("now"));
            //guardamos el nuevo seguimiento
            $this->doctrine->em->persist($newSeguimiento);
            $this->doctrine->em->flush();
        }
        //actualizamos la tarea actual
        $tarea->setEstado(1);
        $this->doctrine->em->flush();
        redirect('tareas');
    }

    

    public function verifica_tarea()
    {

        if ($this->input->is_ajax_request())
        {
            //obtenemos los datos id tarea e id seguimiento
            $tareaId = $this->input->post('tarea');
            $seguimientoId = $this->input->post('seguimiento');
            //obtenemos los datos de tarea
            $tarea = $this->doctrine->em->find("Entities\\Tareas", $tareaId);
            //obtenemos los datos de seguimiento
            $seguimiento = $this->doctrine->em->find("Entities\\Cuentasseguimiento", $seguimientoId);

            if($seguimiento->getTipo() == 'Oferta 1' OR $seguimiento->getTipo() == 'Oferta 2' OR $seguimiento->getTipo() == 'Oferta 3')
            {
                //obtenemos usuario coordinador cierre = 28
                $usuarioTo = $this->doctrine->em->find("Entities\\usuarios", 28);
                //en caso de que oferta sea positivo, creamos una tarea para coordinadora cierre, este rol es el 8 y en este caso, el usuario es 28
                $newTarea = $user = new Entities\Tareas; 
                //seteamos los datos para coordinadora
                $newTarea->setIdcliente($tarea->getIdcliente());
                $newTarea->setIdusuariofrom($tarea->getIdusuariofrom());
                $newTarea->setIdusuarioto($usuarioTo);
                $newTarea->setIdcalendario($tarea->getIdcalendario());
                //guardamos
                $this->doctrine->em->persist($newTarea);
                $this->doctrine->em->flush();
                //obtenemos los datos del seguimiento mediante el id del cliente y el del calendario
                $seguimientoAnt = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcliente" => $tarea->getIdcliente()->getId(),"idcalendario" => $tarea->getIdcalendario()->getId(), 'actual' => 1]);
                //creamos un nuevo seguimiento
                $estado = $this->doctrine->em->find("Entities\\Estadosseguimiento", 0);
                
                $newSeguimiento = new Entities\Cuentasseguimiento;
                $newSeguimiento->setIdcliente($tarea->getIdcliente());
                $newSeguimiento->setIdcalendario($tarea->getIdcalendario());
                $newSeguimiento->setIdUsuario($seguimientoAnt->getIdusuario());
                $newSeguimiento->setIdteleoperador($seguimientoAnt->getIdteleoperador());
                $newSeguimiento->setIdestado($estado);
                $newSeguimiento->setTipo('Cierre');
                $newSeguimiento->setFseguimiento(new \DateTime("now"));
                //guardamos el nuevo seguimiento
                $this->doctrine->em->persist($newSeguimiento);
                $this->doctrine->em->flush();
                //y modificamos su estado actual = 0
                $seguimientoAnt->setActual(0);
                $this->doctrine->em->flush();



            }else{

                //obtenemos usuario coordinador = 21
                $usuarioTo = $this->doctrine->em->find("Entities\\usuarios", 21);
                //instanciamos Tareas para crear dos nuevas tareas, estas tareas apuntarán
                //a la coordinadora, que en este caso es superadmin y tiene el ID 21 y al comercial
                //que que continua la traza, para que pueda subir la documentación
                $newTarea = $user = new Entities\Tareas; 
                //seteamos los datos para coordinadora
                $newTarea->setIdcliente($tarea->getIdcliente());
                $newTarea->setIdusuariofrom($tarea->getIdusuariofrom());
                $newTarea->setIdusuarioto($usuarioTo);
                $newTarea->setIdcalendario($tarea->getIdcalendario());
                //guardamos
                $this->doctrine->em->persist($newTarea);
                $this->doctrine->em->flush();

                //instanciamos Tareas para crear dos nuevas tareas, estas tareas apuntarán
                //a la coordinadora, que en este caso es superadmin y tiene el ID 21 y al comercial
                //que que continua la traza, para que pueda subir la documentación
                $newTarea = $user = new Entities\Tareas; 
                //seteamos los datos para coordinadora
                $newTarea->setIdcliente($tarea->getIdcliente());
                $newTarea->setIdusuariofrom($tarea->getIdusuariofrom());
                $newTarea->setIdusuarioto($tarea->getIdusuariofrom());
                $newTarea->setIdcalendario($tarea->getIdcalendario());
                //guardamos
                $this->doctrine->em->persist($newTarea);
                $this->doctrine->em->flush();
            }

            $tarea->setEstado(1);
            $this->doctrine->em->flush();

        }else{

            show_404();
        }
    }

    public function volverLlamar($id)
    {
        if(isset($_POST['submit-data'])){

            //obtenemos los datos de tarea
            $tarea = $this->doctrine->em->find("Entities\\Tareas", $id);

            echo $date = $this->input->post('date');
            echo $hour = $this->input->post('hour');
            echo $comment = $this->input->post('comentario');
            //lo que hacemos en este metodo es crear unja nueva tarea con fecha y hora
            //para una nueva llamada, esta tiene que volver a quedar registrada 
            //apuntando a los mismos usuarios
            $newTarea = new Entities\Tareas;
            //seteamos los datos para coordinadora
            $newTarea->setIdcliente($tarea->getIdcliente());
            $newTarea->setIdusuariofrom($tarea->getIdusuariofrom());
            $newTarea->setIdusuarioto($tarea->getIdusuarioto());
            $newTarea->setIdcalendario($tarea->getIdcalendario());
            $newTarea->setFalta(new \DateTime($date.' '.$hour));
            //guardamos
            $this->doctrine->em->persist($newTarea);
            $this->doctrine->em->flush();
            //la actual tarea la actualizamos quedando cerrada
            $tarea->setEstado(1);
            $this->doctrine->em->flush();
            //ahora comprovamos que comment es distinto de null
            //si es así creamos un reporte nuevo al cliente
            if($comment != null)
            {
                $this->generateReport($tarea);
            }

            //redireccionamos a tareas vista de su tabla
            redirect('tareas');

        }else{

            show_404();
        }
        
    }

    //subir archivos
    private function up_load($name,$folder)
    {

        $config['upload_path'] = 'assets/'.$folder;
        $config['allowed_types'] = '*';
        $config['max_size']     = '30720';
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['overwrite'] = FALSE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if($this->upload->do_upload($name))
        {

            $data_image = $this->upload->data();
            $upload_data = array(

                'upload' => TRUE,
                'res' => $data_image['file_name'],
            );

        }else
        {

            $upload_data = array(

                'upload' => FALSE,
                'res' => $this->upload->display_errors('<div class="alert alert-danger" role="alert">', '</div>'),
            );
        }

        return $upload_data;
    }

    public function gestionaCierre($id)
    {
        
        if(isset($_POST['submit-AddSeEsModal']))
        {
            //obtenemos los datos de tarea
            $tarea = $this->doctrine->em->find("Entities\\Tareas", $id);

            $c = $tarea->getIdcliente();
            $u = $tarea->getIdusuariofrom();
            $idCa = $tarea->getIdcalendario()->getId();

            if($this->input->post('tipo-seguimiento') == 'Cierre')
            {
                $newTarea = new Entities\Tareas;
                $newTarea->setIdcliente($tarea->getIdcliente());
                $newTarea->setIdusuariofrom($tarea->getIdusuariofrom());
                $newTarea->setIdusuarioto($tarea->getIdusuariofrom());
                $newTarea->setIdcalendario($tarea->getIdcalendario());
                //guardamos la nueva tarea
                $this->doctrine->em->persist($newTarea);
                $this->doctrine->em->flush();
            }

            $this->generateEvento($c,$u,$idCa);
            //cerramos la tarea
            $this->close_tarea($id);
        }
        
    }

}

?>