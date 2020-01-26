<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;
    private $usuarioid = 0;
    private $rol = 0;
    private $start = 0;
    private $limit = 0;
    private $totalRecord = 0;

    public function __construct()
    {
        parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'icon-folder';
        $this->usuarioid = $this->session->userdata('usuarioid');
        $this->rol = $this->session->userdata('rol');
        //cargamos el helper para generación del pass
        $this->load->helper('generate_pass_helper');
        $this->load->helper('MY_encrypt_helper');
        //formate la fecha para pasarla a doctrine
        $this->load->helper('format_date_doctrine_helper');
        //helper uploads
        $this->load->helper('upload_helper');
        $this->limit = 25;
        $this->totalRecord = count($this->doctrine->em->getRepository("Entities\\Cuentas")->findAll());
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
        $data['rol'] = $this->rol;
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass);
        //datos cabecera tabla
        $data['thead'] = array('ID', 'Nombre','Población','Tel','Seguimiento');
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //lista de parametros de busqueda del select del buscador
        $data['searcher'] = array('Razón social' => 'nombre' ,'Provincia' => 'provincia','Población' => 'poblacion','CP' => 'cp','Teléfono ' => 'telefono','Email' => 'email','Id' => 'id');
        //parametros que pasaremos a la consulta
        $f = null;
        $q = null;

        //obtenemos y mostramos todos los datos pasando el limit y satart para su paginación
        //si el parametro $this->uri->segment(2) es null mantenemos el valor por defecto
        // de $this->start, si no es así $this->start = $this->uri->segment(2)
        if($this->uri->segment(2) != null)
            $this->start = $this->uri->segment(2);

        //pasamos a la vista los datos de start y limit
        $data['start'] = $this->start;
        $data['limit'] = $this->limit;
        //y el previous,next
        $data['previous'] = $this->start - $this->limit;
        $data['next'] = $this->start + $this->limit;
        //pasamos el totalRecord
        $data['totalRecord'] = $this->totalRecord;
        /*
        comprobamos si los parametros de busqueda f y q existen,
        en caso afirmativo creamos una cadena que pasaremos a la url
        de paginación y los parametros para la consulta, si no es así
        searcher_param = empty
        */
        if(isset($_GET['f']) AND isset($_GET['q']))
        {
            $data['searcher_param'] = '/f='.$_GET['f'].'&q='.$_GET['q'];
            $f = $_GET['f'];
            $q = $_GET['q'];

        }else{

            $data['searcher_param'] = "";
        }


        $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Cuentas")->getCuentasLimit($this->limit,$this->start,$f,$q);
        //si el usuario tiene rol de comercial = 3, mostramos una vista de sólo 
        //los clientes o cuentas asignados a el
        if($this->rol == 3)
        {
        	$data['getResult'] = $this->doctrine->em->getRepository("Entities\\Cuentas")->findBy(["idcomercial" => $this->usuarioid]);
        }

        //cargamos la vista
        $this->load->view('templates/panel/layout', $data);
    }


    public function add()
    {
        // pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre() . " | Panel de control";
        $data['view'] = strtolower(__FUNCTION__ . "_" . $this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);

        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Crear ' . $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass, 'Crear ' . $this->nameClass);

        //obtenemos y mostramos todos los usuarios
        $data['getUsuarios'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findAll();
        //obtenemos el listado de operadores
        $data['getOpearadores'] = $this->doctrine->em->getRepository("Entities\\Operadores")->findAll();

        //comprobamos formulario submit
        if (isset($_POST['submit'])){
            //validamos los datos
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono');
            $this->form_validation->set_rules('telefonoAlt', 'Teléfono alternativo');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('cif','CIF','required');
            $this->form_validation->set_rules('idUsuario','Asignado a','required');
            $this->form_validation->set_rules('personaCnt','Persona de Contacto');
            $this->form_validation->set_rules('notiPro','Notificar Propietario');
            $this->form_validation->set_rules('direccion', 'Direccion');
            $this->form_validation->set_rules('poblacion', 'Poblacion');
            $this->form_validation->set_rules('provincia', 'Provincia');
            $this->form_validation->set_rules('cp', 'Cp');
            $this->form_validation->set_rules('descripcion', 'Descripcion');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run()) {

                //instanciamos la entidad
                $reg = new Entities\Cuentas;
                //utilizamos el metodo privado seter data para setear los datos y le pasamos 
                //el tipo de accion que en este caso tiene que ser add
                $this->seter_data($reg,__FUNCTION__);

                //redireccionamos al edit
                redirect(site_url($data['path'] . '/edit/' . $reg->getId()));
            }
        }

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
        $data['thead'] = array('ID','Nombre','Tipo','Documento','Fecha','Estado');
        $data['id'] = $id;
        //pasamos la ruta al modal
        $data['pathModal'] = 'clientes/edit/'.$id;
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css_module','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js_module','',TRUE);

        $data['rol'] = $this->rol;

        //todos los adjuntos del usuario
        $data['attachments'] = $this->doctrine->em->getRepository("Entities\\Attachments")->findBy(["idrow" => $id]);
        //almacenamos todos los roles ****Nota: revisar si procedea a eliminar después de modificaciones
        $data['usuarios'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findAll();
        //obtenemos los teleoperadores = rol 4
        $data['getToperadores'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findBy(["idrol" => 4]);
        //obtenemos los comarciales = rol 3
        $data['getComerciales'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findBy(["idrol" => 3]);
        //obtenemos cliente
        $data['getRow'] = $this->doctrine->em->getRepository("Entities\\Cuentas")->findOneBy(["id" => $id]);
        //obtenemos de forma ordenada todos los seguimientos de esta cuenta
        //$data['getCuentasSeguimiento'] = $this->getCuentasSeguimiento($data['getRow']);
        $data['getCuentasSeguimiento'] = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findBy(["idcliente" => $id]);
        //obtenemos todos los estados seguimiento
        $data['getEstadosSeguimiento'] = $this->doctrine->em->getRepository("Entities\\Estadosseguimiento")->findAll();
        //obtenemos si es que hay, el listado de reportes
        $data['getReports'] =$this->doctrine->em->getRepository("Entities\\Reportes")->findBy(["idrow" => $id,"tabla" => "cuentas"]);

        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Editar ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1);
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_', ' ', $this->nameClass), 'Crear ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1));
        //obtenemos el listado de operadores
        $data['getOpearadores'] = $this->doctrine->em->getRepository("Entities\\Operadores")->findAll();
        //obtenemos el listado de Tipos de documentos
        $data['getTiposDocumentos'] = $this->doctrine->em->getRepository("Entities\\Tiposdocumentos")->findAll();

        //comprobamos formulario submit
        if (isset($_POST['submit'])) {

            //validamos los datos
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono');
            $this->form_validation->set_rules('telefonoAlt', 'Teléfono alternativo');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('cif','CIF','required');
            $this->form_validation->set_rules('idUsuario','Teleoperador','required');
            $this->form_validation->set_rules('idComercial','Comercial','required');
            $this->form_validation->set_rules('personaCnt','Persona de Contacto');
            $this->form_validation->set_rules('notiPro','Notificar Propietario');
            $this->form_validation->set_rules('direccion', 'Direccion');
            $this->form_validation->set_rules('poblacion', 'Poblacion');
            $this->form_validation->set_rules('provincia', 'Provincia');
            $this->form_validation->set_rules('cp', 'Cp');
            $this->form_validation->set_rules('descripcion', 'Descripcion');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run()) 
            {

                //instanciamos la entidad
                $reg = $data['getRow'];
                //utilizamos el metodo privado seter data para setear los datos y le pasamos 
                //el tipo de accion que en este caso tiene que ser add
                $this->seter_data($reg,__FUNCTION__);

            }
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
                $reg->setIdrow($id);
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
            

        }

        //cargamos la vista
        $this->load->view('templates/panel/layout', $data);
    }

    public function delete($id)
    {

        //obtenemos el dato mediante id
        $getRow = $this->doctrine->em->getRepository("Entities\\Cuentas")->findOneBy(["id" => $id]);
        //eliminamos el item
        $this->doctrine->em->remove($getRow);
        $this->doctrine->em->flush();
        //ruta para los botones y acciones
        $path = $this->uri->segment(1);
        //redireccionamos
        redirect(site_url($path));

    }

    public function delete_att($id,$id2)
    {

         //obtenemos el dato mediante id
        $getRow = $this->doctrine->em->getRepository("Entities\\Attachments")->findOneBy(["id" => $id]);
        //eliminamos el item
        $this->doctrine->em->remove($getRow);
        $this->doctrine->em->flush();
        //borramos el archivo
        unlink('./assets/attachments_cuentas/'.$getRow->getAttached());
        //ruta para los botones y acciones
        $path = $this->uri->segment(1).'/edit/'.$id2;
        //redireccionamos
        redirect(site_url($path));

    }

    private function seter_data($reg,$type,$param = array())
    {

        //seteamos los datos
        $reg->setNombre($this->input->post('nombre'));
        $reg->setTelefono(str_replace(' ', '', $this->input->post('telefono')));
        $reg->setTelefonoalt(str_replace(' ', '', $this->input->post('telefonoAlt')));
        $reg->setEmail($this->input->post('email'));
        $reg->setCif($this->input->post('cif'));
        $reg->setPersonacnt($this->input->post('personaCnt'));
        //$reg->setNotipro($this->input->post('notiPro'));
        //$reg->setConvertidopre($this->input->post('convertidoPre'));
        //obtenemos el objeto usuario modi.o crea
        $modificado = $this->doctrine->em->find("Entities\\Usuarios", $this->usuarioid);
        $reg->setModificado($modificado);

        $reg->setDireccion($this->input->post('direccion'));
        $reg->setPoblacion($this->input->post('poblacion'));
        $reg->setProvincia($this->input->post('provincia'));
        //obtenemos el objeto del usuario, este es a quien se le asigno el cliente
        $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('idUsuario'));
        $reg->setIdusuario($usuario);
        $reg->setidComercial($this->input->post('idComercial'));
        $reg->setCp($this->input->post('cp'));
        $reg->setDescripcion($this->input->post('descripcion'));

        //$reg->setIdoperador($this->input->post('operador'));
        //$reg->setLineasmovil($this->input->post('lineasMovil'));
        //$reg->setLineasfijo($this->input->post('lineasFijo'));
        //$reg->setCentralita($this->input->post('centralita'));
        //$reg->setCentralitas($this->input->post('centralitas'));
        //$reg->setPermanencia($this->input->post('permanencia'));
        //$reg->setTpermanencia($this->input->post('tPermanencia'));

        //guardamos la entidad en la tabla users
        if($type == "add")
            $this->doctrine->em->persist($reg);

        $this->doctrine->em->flush();

    }

    public function set_reporte($id)
    {

        if(isset($_POST['submit-reporte']))
        {

            //obtenemos el objeto usuario
            $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->usuarioid);
            //obtenemos el tipo estado seguimiento
            $getEstadosSeguimiento = $this->doctrine->em->getRepository("Entities\\Estadosseguimiento")->findOneBy(["id" => $this->input->post('tipo-reporte')]);
            //creamos el reporte vinculado al cliente y al usuario que reporta
            $reporte = new Entities\Reportes;
            $reporte->setIdUsuario($usuario);
            $reporte->setIdrow($id);
            $reporte->setTabla('cuentas');
            $reporte->setComentario($this->input->post('text-reporte'));
            $reporte->setReporte($getEstadosSeguimiento->getNombre());
            $this->doctrine->em->persist($reporte);
            $this->doctrine->em->flush();
            //redireccionamos al edit
            redirect(site_url($this->uri->segment(1) . '/edit/' . $id));

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

    private function getCuentasSeguimiento($obj)
    {
        //almacenamos todos los datos del seguimiento de forma ordenada para cada
        //parte del seguimiento de estado de la cuenta
        $cSeg = array();

        foreach ($obj->getCuentasseguimiento() as $key => $value)
        {
            if($value->getEstado() == 1)
            {
                $cSeg[$value->getTipo()] = array(

                    'id' => $value->getId(),
                    'tipo' => $value->getTipo(),
                    'idEstado' => $value->getIdEstado()->getId(),
                    'Fseguimiento' => $value->getFseguimiento()->format("d-m-Y"),
                    'realizado' => $value->getRealizado()
                );
            }
           
        }
                                 
        return $cSeg;

    }

    public function exportData()
    {
        if($this->input->is_ajax_request())
        {
            $path = $this->input->post('path');
            //dibujamos el html que pasaremos al body del modal
            $html = '<div class="form-group">';
            $html .= '<label>Selecciona un estado</label>';
            $html .= '<select name="estado" class="form-control">';
            $html .= '<option value="nuevo">Nuevo</option>';
            $html .= '<option value="oferta">Oferta</option>';
            $html .= '<option value="cierre">Cierre</option>';
            $html .= '</select>';
            $html .= '</div>';
            
            echo $html;

        }else{

            if(isset($_POST['submitModal']))
            {
                $estado = $this->input->post('estado');

                $result = $this->doctrine->em->getRepository("Entities\\Cuentas")->getCuentasByEstado($estado);

                $separador = ";";
                //generamos las cabeceras para el archivo xls
                header("Cache-Control: public");
                header('Content-Type: text/xls; charset=utf-8');
                header('Content-Disposition: attachment; filename=clientes_estado_'.$estado.'.xls');
                echo utf8_decode("CLIENTES ESTADO $estado;\n");
                echo utf8_decode("Teleoperadora;Asignado A;CIF;Cliente;Lineas Moviles;Lineas datos;Fecha cita;\n");

                foreach ($result as $key => $re) 
                {
                    echo $re->getIdcliente()->getIdusuario()->getNombre().$separador;
                    echo $re->getIdusuario()->getNombre().$separador;
                    echo $re->getIdcliente()->getCif().$separador;
                    echo $re->getIdcliente()->getNombre().$separador;
                    echo $re->getIdcliente()->getLineasmovil().$separador;
                    echo $re->getIdcliente()->getLineasdatos().$separador;
                    echo $re->getIdcalendario()->getFecha()->format("d/m/Y").$separador;
                    echo "\n";
                }
                

            }else{

                show_404();
            }

            
        }
    }

    public function setAgendar($id)
    {
        if(isset($_POST['submit']))
        {
            $seguimiento = explode(' ', $this->input->post('estado'));
            $fecha = $this->input->post('fEvent');
            $hora = $this->input->post('hEvent');
            $tOperador = $this->input->post('toperador');
            $comercial = $this->input->post('comercial');
            $agendarSiNo = $this->input->post('agendarSiNo');
            $agendarTipo = $this->input->post('agendarTipo');
            
            //obtenemos el objeto cliente
            $cliente = $this->doctrine->em->find("Entities\\Cuentas", $id);
            //comprobamos si el cliente tiene ya asignado algún seguimiento
            //con actual = 1, si es así, lo pasamos a 0. Se realiza un
            //findBy en lugar del findOneBy ya que es posible que en la carga
            //realizada desde el Vtiguer tengamos duplicidades, de esta forma nos aseguramos de ir limpiando.
            $Cseguimiento = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findBy(["idcliente" => $id,"actual" => 1]);

            if($Cseguimiento)
            {
                foreach ($Cseguimiento as $key => $seg)
                {
                    $seg_ = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["id" => $seg->getId()]);

                    $seg_->setActual(0);
                    $this->doctrine->em->flush();
                }
            }
            //Ahora comprobamos si hay eventos abiertos en el calendario y al igual que con cuentasseguimiento
            //en caso afirmativo, cerramos los eventos. En este caso pasamos estado de 0 a 1
            $eventos = $this->doctrine->em->getRepository("Entities\\Calendario")->findBy(["idcliente" => $id,"estado" => 0]);

            if($eventos)
            {
                foreach ($eventos as $key => $evento)
                {
                    $evento_ = $this->doctrine->em->getRepository("Entities\\Calendario")->findOneBy(["id" => $evento->getId()]);

                    $evento_->setEstado(1);
                    $this->doctrine->em->flush();
                }
            }
            //Finalmente y como se ha realizado con eventos, cerramos todas las tareas que esten asociadas
            //al cliente.
            $tareas = $this->doctrine->em->getRepository("Entities\\Tareas")->findBy(["idcliente" => $id,"estado" => 0]);

            if($tareas)
            {
                foreach ($tareas as $key => $tarea)
                {
                    $tarea_ = $this->doctrine->em->getRepository("Entities\\Tareas")->findOneBy(["id" => $tarea->getId()]);

                    $tarea_->setEstado(1);
                    $this->doctrine->em->flush();
                }
            }

            //ahora solo queda crear la traza del seguimiento según el tipo de seguimiento
            if($seguimiento[0] == 'Nuevo' OR $seguimiento[0] == 'Oferta')
            {

                $this->generateEvento($cliente);
                //comprobamos si el teleoperador y el comercial son distintos de lso actuales, si es así
                //los actualizamos en la ficha del cliente
                if($cliente->getidusuario()->getId() != $tOperador)
                {
                    $usuario = $this->doctrine->em->find("Entities\\Usuarios", $tOperador);
                    $cliente->setidusuario($usuario);
                    $this->doctrine->em->flush();
                }

                if($cliente->getidcomercial() != $comercial)
                {
                    $usuario = $this->doctrine->em->find("Entities\\Usuarios", $comercial);
                    $cliente->setidcomercial($usuario->getId());
                    $this->doctrine->em->flush();
                }


            }elseif($seguimiento[0] == 'Cierre'){

                if($agendarSiNo == 1)
                {
                    $event = $this->generateEvento($cliente,$agendarTipo);

                }else{

                    $event = $this->doctrine->em->getRepository("Entities\\Calendario")->findOneBy(["idcliente" => $cliente->getId()]);

                    $this->generateSeguimiento($event);
                }
                
                $usuariofrom = $this->doctrine->em->find("Entities\\Usuarios", $cliente->getIdcomercial());
                $usuarioto = $this->doctrine->em->find("Entities\\Usuarios", 28);
                //obtenemos el objento del evento recien creado
                //creamos una tarea de tipo cierre.
                $newTarea = new Entities\Tareas;
                $newTarea->setIdcliente($cliente);
                $newTarea->setIdusuariofrom($usuariofrom);
                $newTarea->setIdusuarioto($usuarioto);
                $newTarea->setIdcalendario($event);
                //guardamos la entidad en la tabla users
                $this->doctrine->em->persist($newTarea);
                $this->doctrine->em->flush();
                //actualizamos el evento recien creado a cerrado
                //$event->setEstado(1);
                //$this->doctrine->em->flush();
                

            }
            
            //redireccionamos al edit
            redirect(site_url($this->uri->segment(1) . '/edit/' . $id));


        }else{

            show_404();
        }
    }

    private function generateEvento($obj,$agendarTipo = false)
    {
        //Obtenemos el usuario
        $user = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('comercial'));
        $reg = new Entities\Calendario;
        //Seteamos los datos
        $reg->setFecha(new \DateTime($this->input->post('fEvent').' '.$this->input->post('hEvent')));

        $reg->setComentario($this->input->post('comentario'));
        $reg->setIdusuario($user);
        $date = explode('-', $this->input->post('fEvent'));

        $reg->setYear($date[2]);
        $reg->setMonth($date[1]);
        $reg->setDay($date[0]);
        $hour = str_replace(':','',$this->input->post('hEvent'));
        $reg->setHour($hour/100);
        $reg->setIdcliente($obj);

        //guardamos la entidad en la tabla users
        $this->doctrine->em->persist($reg);
        $this->doctrine->em->flush();
        //ahora generamos nuevo uno en seguimiento.
        $evento = $this->doctrine->em->find("Entities\\Calendario", $reg->getId());

        $this->generateSeguimiento($evento,$agendarTipo);
        return $evento;

    }

    private function generateSeguimiento($obj,$agendarTipo)
    {
        //obtenemos los objetos usuario y faseventa
        $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('comercial'));
        $estado = $this->doctrine->em->getRepository("Entities\\Estadosseguimiento")->findOneBy(["id" =>0]);

        $reg = new Entities\Cuentasseguimiento;
        $reg->setIdestado($estado);
        $reg->setIdusuario($usuario);
        $reg->setIdteleoperador($obj->getIdcliente()->getIdusuario());
        $reg->setIdcliente($obj->getIdcliente());
        $reg->setIdcalendario($obj);

        if($agendarTipo)
        {
            $reg->setTipo($agendarTipo);

        }else{

            $reg->setTipo($this->input->post('estado'));
        }
        
        $reg->setFseguimiento(new \DateTime(formatDateDoct($obj->getFecha()->format("d-m-Y"))));

        //guardamos el seguimiento
        $this->doctrine->em->persist($reg);
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

}

?>