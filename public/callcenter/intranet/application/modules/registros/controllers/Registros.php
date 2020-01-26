<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registros  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;
    private $rol = 0;
    private $usuarioid = 0;
    private $totalRecord = 0;
    private $start = 0;
    private $start2 = 0;
    private $limit = 0;

    public function __construct()
    {
        parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'icon-notebook';
        $this->load->library('encryption');
        //helper uploads
        $this->load->helper('upload_helper');
        $this->rol = $this->session->userdata('rol');
        $this->usuarioid = $this->session->userdata('usuarioid');
        //formate la fecha para pasarla a doctrine
        $this->load->helper('format_date_doctrine_helper');
        //lo utilizamos para comprar fechas
        $this->load->helper('my_playing_dates_helper');
        //comprobamos el rol del usuario y realizamos en count segun rol
        if($this->rol == 4)
        {

            $this->totalRecord = count($this->doctrine->em->getRepository("Entities\\Registros")->findBy(["idusuario" => $this->usuarioid]));

        }else{

            //$this->totalRecord = count($this->doctrine->em->getRepository("Entities\\Registros")->findAll());
        }

        $this->limit = 20;
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
        $data['thead'] = array('ID','Nombre','Teléfono','DNI','TP');
        //lista de parametros de busqueda del select del buscador
        $data['searcher'] = array('Nombre' => 'name' ,'Apellido' => 'firstName','Teléfono' => 'telephone','DNI' => 'documentNumber');
        //cadena add url paginación
        $data['searcher_param'] = "";
        //parametros que pasaremos a la consulta
        $f = null;
        $q = null;

        //paginación
        //comprobamos si el parametro 1 y 2 es != null, en caso afirmativo igualamos $this->start y $this->start2 a su valor
        //$this->start == al valor con el que inicializa,
        if($this->uri->segment(2) != null)
            $this->start = $this->uri->segment(2);

        if($this->uri->segment(3) != null)
            $this->start2 = $this->uri->segment(3);
        

        //pasamos a la vista los datos de start y limit
        $data['start'] = $this->start;
        $data['start2'] = $this->start2;
        $data['limit'] = $this->limit;
        //y el previous,next
        $data['previous'] = $this->start - $this->limit;
        $data['next'] = $this->start + $this->limit;
        //pasamos el totalRecord
        $data['totalRecord'] = $this->totalRecord;

        /*
        comprobamos si los parametros de busqueda f y q existen,
        en caso afirmativo creamos una cadena que pasaremos a la url
        de paginación y los parametros para la consulta
        */
        if(isset($_GET['f']) AND isset($_GET['q']))
        {
            $data['searcher_param'] = '/f='.$_GET['f'].'&q='.$_GET['q'];
            $f = $_GET['f'];
            $q = $_GET['q'];
        }


        //si el usuario tiene rol == 4 alteramos el array borrando
        //  el campo asignado

        if($this->rol == 4){
            
            unset($data['thead'][4]);
        }

        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //pasamos el rol del usuario
        $data['rol'] = $this->rol;
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css_module','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js_module','',TRUE);

        //si el usuario es teleoperador = 4
        //mostramos sólo los registros asociados a el
        if($this->rol == 4)
        {

            //$data['getResult'] = $this->doctrine->em->getRepository("Entities\\Registros")->getRegistros($this->start,$this->limit,$f,$q,$this->usuarioid);
            //$data['getResult'] = $this->doctrine->em->getRepository("Entities\\Registros")->findBy(["idusuario" => $this->usuarioid]);
            $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Registros")->getRegistrosByUser($this->start,$this->limit,$f,$q,$this->usuarioid);

        }else{

            //obtenemos y mostramos todos los datos
            //$data['getResultFirst'] = $this->doctrine->em->getRepository("Entities\\Registros")->findFirstDate($this->start,$this->limit,$f,$q);
            //$data['getResult'] = $this->doctrine->em->getRepository("Entities\\Registros")->findAll();
            $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Registros")->getRegistros($this->start,$this->limit,$f,$q);
            //Comprobamos si los resultados de getResultFirst son iguales a 100, si es asi getResult = false, en caso contrario realizamos una resta y mostraremos como limit el resultado

            /*if(count($data['getResultFirst']) == $this->limit)
            {
                $data['getResult'] = null;

            }else{

                //sobrescrimimos el limit para la consulta
                $this->limit =  $this->limit - count($data['getResultFirst']).'<br/>';

                $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Registros")->findByStateDate($data['start2'],$this->limit,$f,$q);
                //cambiamos el valor de start2
                $data['start2'] += $this->limit;
            }*/
            
        }
        //obtenemos todos los uausrios con rol teleoperador/a = 4
        $data['getUsuarios'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findBy(["idrol" => 4,"estado" => 0]);
        //obtenemos la lista de estados de registros
        $data['getEstadosregistros'] = $this->doctrine->em->getRepository("Entities\\Estadosregistros")->findAll();


        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);
        //si existe la variable la eliminamos
        if($this->session->userdata('endJob'))
            $this->session->unset_userdata('endJob');

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
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_', ' ', $this->nameClass), 'Crear ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1));
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //pasamos el rol del usuario
        $data['rol'] = $this->rol;
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css_module','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js_module','',TRUE);

        //obtenemos todos los uausrios con rol teleoperador/a = 4
        $data['getUsuarios'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findBy(["idrol" => 4,"estado" => 0]);

        //comprobamos formulario submit
        if (isset($_POST['submit'])){

            //validamos los datos
            $this->form_validation->set_rules('empresa', 'Empresa', 'required');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if($this->form_validation->run()){

                if($this->rol != 4)
                {
                    //obtenemos el usuario seleccionado
                    $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('usuario'));

                }else{

                    //obtenemos el usuario seleccionado
                    $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->usuarioid);
                }
                
                //obtenemos el estado, en este caso siempre estado 4 al crear
                $estado = $this->doctrine->em->find("Entities\\Estadosregistros", 4);

                $reg = new Entities\Registros;
                //Seteamos los datos
                $reg->setEmpresa($this->input->post('empresa'));
                $reg->setNumempleados($this->input->post('numEmpleados'));
                $reg->setTelefono(str_replace(' ', '', $this->input->post('telefono')));
                $reg->setAdministrador($this->input->post('administrador'));
                $reg->setPercontacto($this->input->post('perContacto'));
                $reg->setCif($this->input->post('cif'));
                $reg->setDireccion($this->input->post('direccion'));
                $reg->setSector($this->input->post('sector'));
                $reg->setProvincia($this->input->post('provincia'));
                $reg->setPoblacion($this->input->post('poblacion'));
                $reg->setEmail($this->input->post('email'));
                $reg->setCp($this->input->post('cp'));
                $reg->setWeb($this->input->post('web'));
                $reg->setDireccioncentro($this->input->post('direccionCentro'));
                $reg->setConvenio($this->input->post('convenio'));
                $reg->setCnae($this->input->post('cnae'));
                $reg->setNueva($this->input->post('nueva'));
                //Creamos una condicion para que solamente guarde la fecha si en el campo fCrea no esta vacio
                if(!empty($this->input->post('fCrea'))){
                     $reg->setFcrea(new \DateTime(formatDateDoct($this->input->post('fCrea'))));
                }
                //$reg->setFcrea(new \DateTime(formatDateDoct($this->input->post('fCrea'))));

                $reg->setPyme($this->input->post('pyme'));
                $reg->setCuentacotizacion($this->input->post('cuentaCotizacion'));
                $reg->setComentario($this->input->post('comentario'));
                $reg->setFregistro(new \DateTime(formatDateDoct($this->input->post('fRegistro'))));
                $reg->setIdestado($estado);
                $reg->setIdusuario($usuario);

                //guardamos la entidad en la tabla users
                $this->doctrine->em->persist($reg);
                $this->doctrine->em->flush();

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
        //icono del módulo
        $data['icono'] = $this->icono;
        //titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_', ' ', $this->nameClass), 'Editar ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1));
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //pasamos el rol del usuario
        $data['rol'] = $this->rol;
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css_module','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js_module','',TRUE);
        $data['id'] = $id;

        //obtenemos los datos del registro
        $data['getRegistro'] = $this->doctrine->em->find("Entities\\Registros", $id);
        //obtenemos todos los uausrios con rol teleoperador/a = 4
        $data['getUsuarios'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findBy(["idrol" => 4,"estado" => 0]);
        //obtenemos el listado de registro de llamadas del registro en el que estamos
        $data['getRegistroLlamadas'] = $this->doctrine->em->getRepository("Entities\\Registrollamadas")->findBy(["idresgistro" => $id]);
        //formulario secundario
        $data['secondForm'] = $this->_getFormByData($data['getRegistro']->getCampaign()->getId(),$id);

        //comprobamos formulario submit
        if (isset($_POST['submit']))
        {
            //validamos los datos
            $this->form_validation->set_rules('empresa', 'Empresa', 'required');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            //obtenemos el usuario seleccionado
            $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('usuario'));

            if($this->form_validation->run()){

                //Seteamos los datos

                $data['getRegistro']->setEmpresa($this->input->post('empresa'));
                $data['getRegistro']->setNumempleados($this->input->post('numEmpleados'));
                $data['getRegistro']->setTelefono(str_replace(' ', '', $this->input->post('telefono')));
                $data['getRegistro']->setAdministrador($this->input->post('administrador'));
                $data['getRegistro']->setPercontacto($this->input->post('perContacto'));
                $data['getRegistro']->setCif($this->input->post('cif'));
                $data['getRegistro']->setDireccion($this->input->post('direccion'));
                $data['getRegistro']->setEmail($this->input->post('email'));
                $data['getRegistro']->setSector($this->input->post('sector'));
                $data['getRegistro']->setProvincia($this->input->post('provincia'));
                $data['getRegistro']->setPoblacion($this->input->post('poblacion'));
                $data['getRegistro']->setCp($this->input->post('cp'));
                $data['getRegistro']->setWeb($this->input->post('web'));
                $data['getRegistro']->setComentario($this->input->post('comentario'));
                $data['getRegistro']->setFregistro(new \DateTime(formatDateDoct($this->input->post('fRegistro'))));
                $data['getRegistro']->setIdusuario($usuario);
                //actualizamos
                $this->doctrine->em->flush();

            }
        }

        //cargamos la vista
        $this->load->view('templates/panel/layout', $data);
    }

    public function view($id)
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
        //titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_', ' ', $this->nameClass), 'Ver ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1));
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //pasamos el rol del usuario
        $data['rol'] = $this->rol;
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js_module','',TRUE);
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css_module','',TRUE);
        //listado de provincias
        $data['provincias'] = $this->doctrine->em->getRepository("Entities\\Provincias")->findAll();
        //obtenemos los datos del usuario
        $data['getRegistro'] = $this->doctrine->em->find("Entities\\Registros", $id);
        //obtenemos una lista de los estados registros
        $data['getEstadosregistros'] = $this->doctrine->em->getRepository("Entities\\Estadosregistros")->findAll();
        //obtenemos el listado de registro de llamadas del registro en el que estamos
        $data['getRegistroLlamadas'] = $this->doctrine->em->getRepository("Entities\\Registrollamadas")->findBy(["idresgistro" => $id]);
        //formulario secundario
        $data['secondForm'] = $this->_getFormByData($data['getRegistro']->getCampaign()->getId(),$id);
        //listado de motivos para los no interesa
        $data['getReasons'] = $this->doctrine->em->getRepository("Entities\\Reasons")->findAll();
        //obtenemos la coleccón de templates
        $data['getTemplates'] = $this->doctrine->em->getRepository("Entities\\Templates")->findAll();
        
        $data['id'] = $id;

        //fecha actual más 1
        $data['getNewDate'] = strtotime(date("d-m-Y")."+ 1 days");
        //hora actual más 1
        $data['getNewHour'] = strtotime(date("G:i")."+ 1 hours");

        /*
        	Ampliamos la funcionalidad para que en caso que los clientes que tengan más de una ficha o servicios,
        	puedan ser visibles de cara al teleoperador.
        	1.Primero comprobamos por el Documento de Identidad si existe más de un registro
        	2.En caso afirmativo, pasamos la colección de estos a la vista
        	3.En la vista dibujaremos con un aviso, la lista de estos registros con el id y un linkpara llevarlos 
        	al registros, este link será de tipo target="_blank"
        	Nota: si el resultado no es mayor de uno, en la vista no mostraremos el aviso
        */
        $data['getRegsitersDuplicates'] = $this->doctrine->em->getRepository("Entities\\Registros")->findBy(["documentNumber" => $data['getRegistro']->getDocumentNumber()]);

        //cargamos la vista
        $this->load->view('templates/panel/layout', $data);
    }

    public function delete($id)
    {
        //obtenemos el dato mediante id
        $getRow = $this->doctrine->em->getRepository("Entities\\Registros")->findOneBy(["id" => $id]);
        //eliminamos el item
        $this->doctrine->em->remove($getRow);
        $this->doctrine->em->flush();
        //ruta para los botones y acciones
        $path = $this->uri->segment(1);
        //redireccionamos
        redirect($path);
      
    }

    public function upload_registers()
    {
    	if (isset($_POST['submit'])) {
	    	//obtenemos los datos del csv
	    	//$csv = file('assets/uploads/registros.csv');
	    	$upload_image = upload('file', 'uploads', 0, 0, '2048');
            //array donde almacenamos los datos de los registros con teléfonos repetidos
            $telRep = array();
            //si obtenemos un error
            if (!$upload_image['upload']) {

                $data['lang'] = "es";
                $data['title'] = $this->proyecto->getNombre() . " | Panel de control";
                $data['view'] = 'errors/html/error_app';
                $data['robots'] = 'noindex, nofollow';
                $data['project'] = $this->proyecto;
                $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
                //icono del módulo
                $data['icono'] = $this->icono;
                // titulo del módulo
                $data['h1'] = $this->nameClass;
                //lista migas pan
                $data['breadcrumb'] = array($this->nameClass);
                //ruta para los botones y acciones
                $data['path'] = $this->uri->segment(1);

                $data['error'] = $upload_image['res'];
                $this->load->view('templates/panel/layout', $data);

            }else {
            	//obtenemos el documento
            	$csv = file('assets/uploads/' . $upload_image['res']);
            	//lo recorremos
	    		foreach ($csv as $key => $value) {
	    		//obviamos las cabeceras
		    		if($key > 0)
		            {
		            	//hacemos un explode y convertimos la línea del csv en un vector
		            	$registro = explode(";", $value);
		            	//lo primero, obtenemos la campaña y el teleoperador y el estao 4 = sin estado
		            	$campaign = $this->doctrine->em->find("Entities\\Campaigns", $registro[28]);
		            	$user = $this->doctrine->em->find("Entities\\Usuarios", $registro[29]);
		            	$estado = $this->doctrine->em->find("Entities\\Estadosregistros", 4);
		            	//instanciamos registro
		            	$newReg = new Entities\Registros;
		            	//seteamos los datos
		            	$newReg->setCampaign($campaign);
		            	$newReg->setIdusuario($user);
		            	$newReg->setIdestado($estado);

		            	$newReg->setDocumentNumber($registro[0]);
		            	$newReg->setName($registro[1]);
		            	$newReg->setFirstName($registro[2]);
		            	$newReg->setLastName($registro[3]);
		            	$newReg->setModality($registro[4]);
		            	$newReg->setPeriodicity($registro[5]);
		            	$newReg->setNewPeriodicity($registro[6]);
		            	$newReg->setRenovation(new \DateTime($registro[7]));
		            	$newReg->setCheckingAccount($this->encryption->encrypt($registro[8]));
		            	$newReg->setPrima($registro[9]);
		            	$newReg->setCapital($registro[10]);
		            	$newReg->setTelephone($registro[11]);
		            	$newReg->setWay($registro[12]);
		            	$newReg->setAddress($registro[13]);
		            	$newReg->setCity($registro[14]);
		            	$newReg->setZip($registro[15]);
		            	$newReg->setProvince($registro[16]);
		            	$newReg->setGender($registro[17]);
		            	$newReg->setBirdDate(new \DateTime($registro[18]));
		            	$newReg->setAge($registro[19]);
		            	$newReg->setActualCob($registro[20]);
		            	$newReg->setPrimaOpc1($registro[21]);
		            	$newReg->setCobOpc1($registro[22]);
		            	$newReg->setAhorroeuOpc1($registro[23]);
		            	$newReg->setAhorropercentOpc1($registro[24]);
		            	$newReg->setPrimaOpc2($registro[25]);
		            	$newReg->setAhorroeuOpc2($registro[26]);
		            	$newReg->setAhorropercentOpc2($registro[27]);
		            	//guardamos la entidad en la tabla registros
		                $this->doctrine->em->persist($newReg);
		                $this->doctrine->em->flush();
		                //redi al listado
		                redirect($this->uri->segment(1));
		            	
		            }
	    		}

            }
	    	

    	}
    }

    public function __upload_registers()
    {
    	$csv = file('assets/uploads/registros.csv');

        if (isset($_POST['submit'])) {

            $upload_image = upload('file', 'uploads', 0, 0, '2048');
            //array donde almacenamos los datos de los registros con teléfonos repetidos
            $telRep = array();

            if (!$upload_image['upload']) {

                $data['lang'] = "es";
                $data['title'] = $this->proyecto->getNombre() . " | Panel de control";
                $data['view'] = 'errors/html/error_app';
                $data['robots'] = 'noindex, nofollow';
                $data['project'] = $this->proyecto;
                $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
                //icono del módulo
                $data['icono'] = $this->icono;
                // titulo del módulo
                $data['h1'] = $this->nameClass;
                //lista migas pan
                $data['breadcrumb'] = array($this->nameClass);
                //ruta para los botones y acciones
                $data['path'] = $this->uri->segment(1);

                $data['error'] = $upload_image['res'];
                $this->load->view('templates/panel/layout', $data);

            } else {

                //obtenemos el usuario seleccionado
                $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('usuario'));
                //obtenemos el estado, en este caso siempre estado 4
                $estado = $this->doctrine->em->find("Entities\\Estadosregistros", 4);

                $csv = file('assets/uploads/' . $upload_image['res']);

                foreach ($csv as $key => $value) {

                    $reg = new Entities\Registros;
                    //convertimos el valor en array solo si key es > 0

                    if($key > 0)
                    {


                        $registro = explode(";", $value);

                        //Comprobamos si existen estos campo, si no es así el registro
                        //no se créa
                        if(isset($registro[0]) AND isset($registro[5]))
                        {
                            //damos formato al los telefonos
                            $telefono = str_replace(' ', '', $registro[5]);
                            $telefono = str_replace('.', '', $telefono);
                            //si el campo es mayor de 9 caracteres, eliminamos los tres primeros
                            if(strlen($telefono) > 9)
                            {
                                $telefono = substr($telefono, strlen($telefono) - 9);
                            }
                            
                            $reg->setTelefono($telefono);


                            //si el campo referente a móvil no existe no lo registramos
                            if(isset($registro[6]))
                            {
                                $movil = str_replace(' ', '', $registro[6]);
                                $movil = str_replace('.', '', $movil);
                                //si el campo es mayor de 9 caracteres, eliminamos los tres primeros
                                if(strlen($movil) > 9)
                                {
                                    $movil = substr($movil, strlen($telefono) - 9); 
                                }

                                $reg->setMovil($movil);
                            }
                            //De esta forma comprobamos si no existen algunos campos, y en caso afirmativo
                            //Este se crea como vacío
                            for ($i=0; $i <= 14 ; $i++)
                            { 
                                
                                if(!isset($registro[$key]))
                                {
                                    $registro[$key] = "";
                                }
                            }
                            //Seteamos los datos
                            $reg->setEmpresa($registro[0]);
                            $reg->setDireccion($registro[1]);
                            $reg->setCp($registro[2]);
                            $reg->setPoblacion($registro[3]);
                            $reg->setProvincia($registro[4]);
                            $reg->setEmail($registro[7]);
                            $reg->setWeb($registro[8]);
                            $reg->setSector($registro[9]);
                            $reg->setNumempleados($registro[10]);
                            $reg->setAdministrador($registro[11]);
                            $reg->setPercontacto($registro[12]);
                            $reg->setCif($registro[13]);
                            $reg->setComentario($registro[14]);

                            $reg->setIdestado($estado);
                            $reg->setIdusuario($usuario);
                            $reg->setFregistro(new \DateTime(formatDateDoct($this->input->post('fRegistro'))));

                            //consultamos si existe un usuario con el mismo teléfono, si es así
                            //no lo guardamos y almacenamos los datos en un array
                            $existReg = $this->doctrine->em->getRepository("Entities\\Registros")->findOneBy(["telefono" => $telefono]);
                            if(!$existReg)
                            {
                                //guardamos la entidad en la tabla registros
                                $this->doctrine->em->persist($reg);
                                $this->doctrine->em->flush();

                            }else{

                                $telRep[] = array(

                                    'Empresa' => $registro[0],
                                    'Direccion' => $registro[1],
                                    'CP' => $registro[2],
                                    'Ciudad' => $registro[3],
                                    'Provincia' => $registro[4],
                                    'Telefono' => $telefono,
                                    'Movil' => $movil,
                                    'Email' => $registro[7],
                                    'Web' => $registro[8],
                                    'Sector' => $registro[9],
                                    'Nempleados' => $registro[10],
                                    'Administrador' => $registro[11],
                                    'Pcontacto' => $registro[12],
                                    'CIF' => $registro[13],
                                    'Comentario' => $registro[14],
                                );

                            }
                            
                            
                        }
                        
                    }
                    
                }
                //comprobamos si el array telRep es mayor de 0
                if(count($telRep) > 0)
                {
                    $data['lang'] = "es";
                    $data['title'] = $this->proyecto->getNombre() . " | Panel de control";
                    $data['view'] = 'errors/html/error_app';
                    $data['robots'] = 'noindex, nofollow';
                    $data['project'] = $this->proyecto;
                    $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
                    //icono del módulo
                    $data['icono'] = $this->icono;
                    // titulo del módulo
                    $data['h1'] = $this->nameClass;
                    //lista migas pan
                    $data['breadcrumb'] = array($this->nameClass);
                    //ruta para los botones y acciones
                    $data['path'] = $this->uri->segment(1);

                    $data['error'] = 'Hay '.count($telRep).' registro/s duplicados.<br/>';
                    $data['error'] .= 'Puedes descargar el listado haciendo <a href="'.site_url('registros/createExcel?'.http_build_query(array('aParam' => $telRep))).'">click aquí</a>';
                    $this->load->view('templates/panel/layout', $data);
                    //echo json_encode($telRep);

                }else{

                    //redireccionamos al index
                    redirect($this->uri->segment(1));
                }
                
            }

        }else{

            show_404();
        }

    }

    public function edit_record($id1,$id2)
    {
        if (isset($_POST['submit'])){

            //obtenemos el usuario
            $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->usuarioid);
            //obtenemos el usuario
            $recordCall = $this->doctrine->em->getRepository("Entities\\Registrollamadas")->find($id2);
            $record = $this->doctrine->em->getRepository("Entities\\Registros")->find($id1);
            $estado = $this->doctrine->em->getRepository("Entities\\Estadosregistros")->find($this->input->post('estados'));
            //almacenamos los estados que ocultan el registro de cara al operador
            $estados_oculta = array(7,8,27);

            //obtenemos todos los registros = date actual
            $nextRecord = $this->doctrine->em->getRepository("Entities\\Registros")->getNextRecord($this->usuarioid,$id1);

            //seteamos los datos
            $recordCall->setIdestado($estado);
            $recordCall->setEnd(new \DateTime("now"));
            $recordCall->setComentario($this->input->post('comentario'));
            //actualizamos
            $this->doctrine->em->flush();

            //seteamos los datos
            $record->setIdestado($estado);
            $record->setReason($this->input->post('reason'));
            //si el estado es igual a 5 -> No contesta, entramos y posponemos
            if( $estado->getId() == 5 ) {
                //almacenamos la fecha actual y add un día
                $date = date('d-m-Y');
                $date = add_days(1,$date);
                //almacenamos la hora.
                $hour = date('G');
                $hour = (int) $hour;
                echo $hour;
                /*
                    luego $hour, add 2 horas, y le pasamos la siguiente regla:
                    si el resultado es mayor de 14, las dos de la tarde, este sera 14.
                    Nota, esto tendrémos que tocarlo cuando tengán horario de tarde, o mejhor ampliar 
                    la app para que se pueda configurar el horario de trabajo de la empresa.
                */
                if( $hour + 2 > 14) {

                    $hour = 14.00;
                }else{

                    $hour += 2;
                    $hour = $hour.'.'.date('i');

                }
                //seteamos los datos fcha y hora
                $record->setFregistro(new \DateTime(formatDateDoct($date)));
                $record->setTregistro($hour);

            }elseif( $estado->getId() == 28 ){
            	/*
            		esta regla es para los contactar por la tade
            		Aquí hacemos dos cosas, programamos la hora para por la tarde, a las 16:00
            		y por otro lado dejamos al registro sin asignar para que no le salte de nuevo.
            	*/
            	//obtenemos el usuario 5 = sin asignar
            	$usuario = $this->doctrine->em->find("Entities\\Usuarios", 5);
            	$record->setTregistro('16.00');
            	$record->setIdusuario($usuario);

            }else{

                $record->setFregistro(new \DateTime(formatDateDoct($this->input->post('date'))));
                $record->setTregistro(str_replace(':', '.', $this->input->post('hour')));
            }
            //si el estado coincide con algún valor del array este oculta el registro al operador
            if(in_array($estado->getId(), $estados_oculta))
            	$record->setOculto(1);
            
            //consultamos si los registros llamadas con estado = 5
            //si el count es >= 2 seteamos oculto = 1
            $recordCallEstado = $this->doctrine->em->getRepository("Entities\\Registrollamadas")->findBy(["idresgistro" => $id1,"idestado" => 5]);
            if(count($recordCallEstado) >= 2)
            {

                $record->setOculto(1);
 
            }
            //actualizamos
            $this->doctrine->em->flush();
            //codificamos la acción/ esto guarda la acción codificada
            //en useractivity.
            $newActivity = new Entities\Useractivity;
            //Seteamos los datos
            $newActivity->setIdusuario($usuario);
            $newActivity->setEntityId($id1);
            $newActivity->setEntity('Registros');
            $newActivity->setEntityValue($record->getName().' '.$record->getFirstName().' '.$record->getLastName());
            $newActivity->setEntityState($estado->getNombre());
            $newActivity->setTimecnx($recordCall->getStart());
            $newActivity->setTimeout($recordCall->getEnd());
            
            //guardamos
            $this->doctrine->em->persist($newActivity);
            $this->doctrine->em->flush();

            if($nextRecord){

                //redireccionamos al siguiente
                //habilitar nuevamente
                redirect($this->uri->segment(1).'/view/'.$nextRecord->getId());

            }else{

                //redireccionamos index indicando que en este caso ya no quedan llamadas
                $session_data['endJob'] = TRUE;
                $this->session->set_userdata($session_data);
                redirect($this->uri->segment(1));
            }


        }

    }

    public function reasign_registers()
    {
        if (isset($_POST['submit'])) {

            $usuarioReg = $this->input->post('usuarioReg');
            $limit = $this->input->post('limit');
            $reasignar =  $this->input->post('reasignar');
            $provincia = $this->input->post('provincia');
            $poblacion = $this->input->post('poblacion');
            $cp = $this->input->post('cp');
            $estado = $this->input->post('estadoReg');
            $typeCon = $this->input->post('type');
            $date = $this->input->post('date');
           //obteenoms el usuario para reasignar
           $usuario = $this->doctrine->em->find("Entities\\Usuarios", $reasignar);

            $param = array(

                        'provincia' => $provincia,
                        'poblacion' => $poblacion,
                        'poblacion' => $poblacion,
                        'cp' => $cp,
                        'idestado' => $estado
                    );
           
           //obtenemos todos los registros asignados al usuario @usuarioReg
            $registros = $this->doctrine->em->getRepository("Entities\\Registros")->findByMultiple($param,$usuarioReg,$typeCon);

           //recorremos los usuarios, restando uno al final de la consutla a @limit
           //una vez limit es cero paramos de reasignar registros
           foreach($registros as $registro){

               if($limit > 0)
               {

                   $registro = $this->doctrine->em->getRepository("Entities\\Registros")->find($registro->getId());
                   //actualizamos el registro reasignando el usuario
                   $registro->setIdusuario($usuario);
                   //$registro->setFregistro(new \DateTime("now"));
                   $registro->setFregistro(new \DateTime($date));
                   $this->doctrine->em->flush();
                   $limit --;

               }else{

                   //redireccionamos al index
                   //redirect($this->uri->segment(1));
               }


           }
            //redireccionamos al index
            redirect($this->uri->segment(1));

        }else{

            show_404();
        }
    }

    public function add_record()
    {
        if($this->input->is_ajax_request())
        {
            $user = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('user'));
            $record = $this->doctrine->em->find("Entities\\Registros", $this->input->post('record'));
            $estado = $this->doctrine->em->getRepository("Entities\\Estadosregistros")->find(1);

            $regLlamada = new Entities\Registrollamadas;
            //seteamos
            $regLlamada->setIdregistro($record);
            $regLlamada->setIdestado($estado);
            $regLlamada->setIdusuario($user);
            //guardamos
            $this->doctrine->em->persist($regLlamada);
            $this->doctrine->em->flush();
            //enviamos el id del registroLlamada
            $json = $arrayName = array('id' => $regLlamada->getId());
            echo json_encode($json);

        }else{
            show_404();
        }
    }

    public function get_num_records()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            $provincia = $this->input->post('provincia');
            $poblacion = $this->input->post('poblacion');
            $cp = $this->input->post('cp');
            $estado = $this->input->post('estado');
            $typeCon = $this->input->post('typeCon');

            $param = array(

                        'provincia' => $provincia,
                        'poblacion' => $poblacion,
                        'poblacion' => $poblacion,
                        'cp' => $cp,
                        'idestado' => $estado
                    );

            $registros = $this->doctrine->em->getRepository("Entities\\Registros")->findByMultiple($param,$id,$typeCon);
            $registros = count($registros);
            $json = $arrayName = array('numRegistros' => $registros);
            echo json_encode($json);

        }else{
            show_404();
        }
    }

    public function createExcel()
    {

        $separador = ";";
        //generamos las cabeceras para el archivo xls
        header("Cache-Control: public");
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=registros_duplicados.xls');
        echo utf8_decode("Empresa;Dirección;CP;Ciudad;Provincia;Teléfono;Móvil;Email;Web;Sector;N. Empleados;Administrador;P.Contacto;CIF;Comentario;\n");
        
        //imprimimos los datos
        foreach ($_GET['aParam'] as $key => $value)
        {
            echo $value['Empresa'].$separador.$value['Direccion'].$separador.$value['CP'].$separador.$value['Ciudad'].$separador.$value['Provincia'].$separador.$value['Telefono'].$separador.$value['Movil'].$separador.$value['Email'].$separador.$value['Web'].$separador.$value['Sector'].$separador.$value['Nempleados'].$separador.$value['Administrador'].$separador.$value['Pcontacto'].$separador.$value['CIF'].$separador.$value['Comentario']."\n";
        }
        
    }

    private function generateEvento($obj)
    {
        //Obtenemos el usuario
        $user = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('usuario'));
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
        $this->generateSeguimiento($evento);

    }

    private function generateSeguimiento($obj)
    {
        //obtenemos el último seguimiento actual = 1 y lo cerramos = 0
        $thisSeguimeinto = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcliente" => $obj->getIdcliente()->getId(),"actual" => 1]);
        if($thisSeguimeinto )
        {
            $thisSeguimeinto->setActual(0);
            $this->doctrine->em->flush();
        }
        //obtenemos los objetos usuario y faseventa y teleoperador
        $usuario = $this->doctrine->em->find("Entities\\Usuarios", $obj->getIdcliente()->getId());
        $estado = $this->doctrine->em->getRepository("Entities\\Estadosseguimiento")->findOneBy(["id" =>0]);

        $reg = new Entities\Cuentasseguimiento;
        $reg->setIdestado($estado);
        $reg->setIdusuario($obj->getIdusuario());
        $reg->setIdteleoperador($obj->getIdcliente()->getIdusuario()); 
        $reg->setIdcliente($obj->getIdcliente());
        $reg->setIdcalendario($obj);
        $reg->setTipo('Nuevo 1');
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

    public function export_estados(){

        $csv = file('assets/csv/Oportunidades_cierre.csv');

        foreach ($csv as $key => $value)
        {

            if($key > 0)
            {
                $registro = explode(";", $value);
                echo '<input name="fEvent" type="text" value="'.$registro[6].'"/>';
                echo '<input name="comentario" type="text" value="Sin comentario"/>';
                echo '<input name="hEvent" type="text" value="9:00"/>';
                echo '<input name="usuario" type="text" value="'.$registro[1].'"/>';

                $param = array(
                    'fEvent' => $registro[6], 
                    'comentario' => 'Sin comentario',
                    'usuario' => $registro[1],
                    'hEvent' => '9:00'
                    );

                $cliente = $this->doctrine->em->getRepository("Entities\\Cuentas")->findOneBy(["cif" => $registro[2]]);

                if($cliente)
                {
                    $this->generateEvento_($cliente,$param);

                }else{

                    echo 'no cliente';
                }
                

            }

        }

    }
    //esta función realiza una busqueda dadon como resultado la primera llamada en función de día actual, hora actual e importancia
    //del estado del registro y redirecciona al circuito de llamadas al teleoperador
    public function startCalls()
    {

        //realizamos la consulta, pasando como parametro el id del usuario logeado
        $getCall = $this->doctrine->em->getRepository("Entities\\Registros")->getNextRecord($this->usuarioid);
        //redireccionamos al siguiente
        redirect($this->uri->segment(1).'/view/'.$getCall->getId());
    }

    ///////////////ESTO ES PARA ELIMINAR EN UN FUTURO
    private function generateEvento_($obj,$param)
    {
        //Obtenemos el usuario
        $user = $this->doctrine->em->find("Entities\\Usuarios",$param['usuario']);
        $reg = new Entities\Calendario;
        //Seteamos los datos
        $reg->setFecha(new \DateTime($param['fEvent'].' '.$param['hEvent']));

        $reg->setComentario($param['comentario']);
        $reg->setIdusuario($user);
        $date = explode('-', $param['fEvent']);
        $reg->setYear($date[0]);
        $reg->setMonth($date[1]);
        $reg->setDay($date[2]);
        $hour = str_replace(':','',$param['hEvent']);
        $reg->setHour($hour/100);
        $reg->setIdcliente($obj);

        //guardamos la entidad en la tabla users
        $this->doctrine->em->persist($reg);
        $this->doctrine->em->flush();
        //ahora generamos nuevo uno en seguimiento.
        $evento = $this->doctrine->em->find("Entities\\Calendario", $reg->getId());
        $this->generateSeguimiento_($evento,$param);

    }

    private function generateSeguimiento_($obj,$param)
    {
        //obtenemos los objetos usuario y faseventa
        $usuario = $this->doctrine->em->find("Entities\\Usuarios", $obj->getIdcliente()->getId());
        $estado = $this->doctrine->em->getRepository("Entities\\Estadosseguimiento")->findOneBy(["id" =>0]);

        $reg = new Entities\Cuentasseguimiento;
        $reg->setIdestado($estado);
        $reg->setIdusuario($obj->getIdusuario()); 
        $reg->setIdcliente($obj->getIdcliente());
        $reg->setIdcalendario($obj);
        $reg->setTipo('Oferta 1');
        $reg->setFseguimiento(new \DateTime(formatDateDoct($obj->getFecha()->format("d-m-Y"))));

        //guardamos el seguimiento
        $this->doctrine->em->persist($reg);
        $this->doctrine->em->flush();

        $this->generateReport_($reg,$param);

    }

    private function generateReport_($obj,$param)
    {
        $usuario = $this->doctrine->em->find("Entities\\Usuarios", $this->usuarioid);
        $reg = new Entities\Reportes;
        $reg->setIdusuario($usuario);
        $reg->setComentario($param['comentario']);
        $reg->setIdrow($obj->getIdcliente()->getId());
        $reg->setIdrows($obj->getIdcalendario()->getId());
        $reg->setTabla('cuentas');
        $reg->setTablas('calendario');
        //guardamos el seguimiento
        $this->doctrine->em->persist($reg);
        $this->doctrine->em->flush();
    }

    public function setDataSecondaryForm($id)
    {
        if( isset($_POST['submit']) ) {

            $traza = '';

            foreach ($_POST as $key => $value) {

                $key = explode('_',$key);

                if( $key[0] != 'submit' AND $key[0] != '0') {
                    
                    if( $key[0] == 'id'){

                        $traza .= $value.'|;';
    
                    }else{
                        $traza = trim($traza, ';');
                        $traza .= $value.';';
                    } 
                }
                
            }

            $data = $this->doctrine->em->getRepository("Entities\\FormularioDatos")->findOneBy(["rowTable" => 'registros',"rowId" => $id]);
            
            if( $data == null ){

                $data = new Entities\FormularioDatos;

                $data->setRowId($id);
                $data->setRowTable('registros');

                $this->doctrine->em->persist($data);
            }
       
            $data->setTraza(trim($traza, ';'));
            $this->doctrine->em->flush();
            //redireccionamos al edit
            redirect(site_url('registros/view/' . $id));
            //echo trim($traza, ';');
        }
    }

    private function _getFormByData($campaign,$id)
    {
        //campos del formulario secundario
        $data['Formulario'] = $this->doctrine->em->getRepository("Entities\\Formularios")->findOneBy(['campaign' => $campaign]);
        //$data['FormularioCampos'] = $this->doctrine->em->getRepository("Entities\\FormularioCampos")->findOneBy(['formulario' => $data['Formulario']->getId()]);
        $data['FormularioCampos'] =  $this->doctrine->em->getRepository("Entities\\FormularioCampos")->getFieldsByOrderer($data['Formulario']->getId());
        //datos datos campos formulario secundario
        $FormularioDatos = $this->doctrine->em->getRepository("Entities\\FormularioDatos")->findOneBy(["rowTable" => 'registros',"rowId" => $id]);
        //formulario
        $form = '';
        //trama
        $trama = '';

        if( $FormularioDatos ) {

            $traza = explode( ';',$FormularioDatos->getTraza() );

            foreach ($traza as $key => $tr) {
                
                $tr = explode('|',$tr);

                if( isset( $tr[1] ) ) {

                    $form .= $this->_getField($tr[0],$tr[1]);

                }else{

                    $form .= $this->_getField($tr[0]);
                }
                 
            }

        }else{

            $form .= $this->_formNoData($data['Formulario']->getId());
        }

        return $form;
    }

    public function soft_delete()
    {
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre() . " | Panel de control";
        $data['view'] = strtolower(__FUNCTION__."_".$this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
        //icono del módulosoft
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass,'Limpiar registros');
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //realizamos la consutla y obtenemos los registros que vamos a realizar el sort delete
        $registros = $this->doctrine->em->getRepository("Entities\\Registros")->findBy(['idusuario' => 5]);
        //procedemos a la edición de de cada uno de los registros
        $this->doctrine->em->getRepository("Entities\\Registros")->softDelete(5);
         //cargamos la vista
        $this->load->view('templates/panel/layout', $data);
    }

    private function _getField($id,$value = '')
    {

        $data = $this->doctrine->em->find("Entities\\FormularioCampos", $id);
        $field = '';

        if( $data ) {

            if( $data->getType() == 'header' ){

                $field .= '<input value="'.$data->getId().'" type="hidden" name="'.$data->getName().'">';
            
            }else{
    
                $field .= '<input value="'.$data->getId().'" type="hidden" name="id_'.$data->getName().'">';
    
            }
                
    
            switch ($data->getType()) {
    
                case 'header':
                    $field .= '<div class="form-group col-md-12">';
                    $field .= '<h4><strong>'.$data->getName().'</strong></h4>';
                    $field .= '<hr/>';
                    $field .= '</div>';
                    break;
    
                case 'text':
                    $field .= '<div class="form-group col-md-12">';
                    $field .= '<label>'.$data->getName().'</label>';
                    $field .= '<div class="input-group col-md-12">';
                    $field .= '<input name="'.$data->getName().'" value="'.$value.'" class="form-control" type="text">';
                    $field .= '</div>';
                    $field .= '</div>';
                    break;
    
                case 'textarea':
                    $field .= '<div class="form-group col-md-12">';
                    $field .= '<label>'.$data->getName().'</label>';
                    $field .= '<div class="input-group col-md-12">';
                    $field .= '<textarea class="form-control" rows="3" name="'.$data->getName().'" class="form-control">'.$value.'</textarea>';
                    $field .= '</div>';
                    $field .= '</div>';
                    break;
    
                case 'boolean':
                    $field .= '<div class="form-group col-md-12">';
                    $field .= '<label>'.$data->getName().'</label>';
                    $field .= '<div class="mt-radio-list">';
    
                    $field .= '<label class="mt-radio"> Si';
                    $field .= '<input';
    
                    if( $value == 1 )
                        $field .=' checked';
    
                    $field .= ' name="'.$data->getName().'" id="'.$data->getName().'" value="1" type="radio">';
                    $field .= '<span></span>';
                    $field .= '</label>';
    
                    $field .= '<label class="mt-radio"> No';
                    $field .= '<input';
    
                    if( $value == 0 AND $value != '' )
                        $field .=' checked';
    
                    $field .= ' name="'.$data->getName().'" id="'.$data->getName().'" value="0" type="radio">';
                    $field .= '<span></span>';
                    $field .= '</label>';
    
                    $field .= '</div>';
                    $field .= '</div>';
                    break;
                
                default:
                    
                    break;
            }

        }
        
        return $field;
    }

    private function _formNodata($id)
    {
        //$data_ = $this->doctrine->em->getRepository("Entities\\FormularioCampos")->findBy(['formulario' => $id]);
        $data_ = $this->doctrine->em->getRepository("Entities\\FormularioCampos")->getFieldsByOrderer($id);
        $form = "";

        if( $data_ ) {

            foreach ($data_ as $key => $data) {
                
                if( $data->getType() == 'header' ){

                    $form .= '<input value="'.$data->getId().'" type="hidden" name="'.$data->getName().'">';
                
                }else{
        
                    $form .= '<input value="'.$data->getId().'" type="hidden" name="id_'.$data->getName().'">';
        
                }

                switch ($data->getType()) {

                    case 'header':
                        $form .= '<div class="form-group col-md-12">';
                        $form .= '<h4><strong>'.$data->getName().'</strong></h4>';
                        $form .= '<hr/>';
                        $form .= '</div>';
                        break;

                    case 'text':
                        $form .= '<div class="form-group col-md-12">';
                        $form .= '<label>'.$data->getName().'</label>';
                        $form .= '<div class="input-group col-md-12">';
                        $form .= '<input name="'.$data->getName().'" value="" class="form-control" type="text">';
                        $form .= '</div>';
                        $form .= '</div>';
                        break;

                    case 'textarea':
                        $form .= '<div class="form-group col-md-12">';
                        $form .= '<label>'.$data->getName().'</label>';
                        $form .= '<div class="input-group col-md-12">';
                        $form .= '<textarea class="form-control" rows="3" name="'.$data->getName().'" class="form-control"></textarea>';
                        $form .= '</div>';
                        $form .= '</div>';
                        break;

                    case 'boolean':
                        $form .= '<div class="form-group col-md-12">';
                        $form .= '<label>'.$data->getName().'</label>';
                        $form .= '<div class="mt-radio-list">';
        
                        $form .= '<label class="mt-radio"> Si';
                        $form .= '<input';
        
                        $form .= ' name="'.$data->getName().'" id="'.$data->getName().'" value="1" type="radio">';
                        $form .= '<span></span>';
                        $form .= '</label>';
        
                        $form .= '<label class="mt-radio"> No';
                        $form .= '<input';
        
                        $form .= ' name="'.$data->getName().'" id="'.$data->getName().'" value="0" type="radio">';
                        $form .= '<span></span>';
                        $form .= '</label>';
        
                        $form .= '</div>';
                        $form .= '</div>';
                        break;

                }

            }

        }

        return $form;
    }
    
}

?>