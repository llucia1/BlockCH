<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;
    private $rol = 0;
    private $usuarioid = 0;

    public function __construct()
    {
        parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'icon-users';
        //obtenemos el rol del usuario
        $this->rol = $this->session->userdata('rol');
        $this->usuarioid = $this->session->userdata('usuarioid');
        //cargamos el helper para generación del pass
        $this->load->helper('generate_pass_helper');
        $this->load->helper('MY_encrypt_helper');
        //formate la fecha para pasarla a doctrine
        $this->load->helper('format_date_doctrine_helper');
        //helper uploads
        $this->load->helper('upload_helper');
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
        $data['thead'] = array('ID', 'Nombre', 'Apellidos', 'Email');
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);

        //obtenemos y mostramos todos los datos
        $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findBy(["estado" => 0]);

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
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css_module','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js_module','',TRUE);

        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Crear ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1);
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_', ' ', $this->nameClass), 'Crear ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1));

        //almacenamos todos los roles
        $data['roles'] = $this->doctrine->em->getRepository("Entities\\Roles")->findAll();

        //comprobamos formulario submit
        if (isset($_POST['submit'])){
            //validamos los datos
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $this->form_validation->set_rules('fnacimiento', 'Fnacimiento');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('rol', 'Rol', 'required');
            $this->form_validation->set_rules('pass', 'Pass', 'required');
            $this->form_validation->set_rules('color','Color','required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run()) {

                //instanciamos la entidad
                $reg = new Entities\Usuarios;
                //obtenemos el ROL
                $rol = $this->doctrine->em->find("Entities\\Roles", $this->input->post('rol'));

                //seteamos los datos
                $reg->setNombre($this->input->post('nombre'));
                $reg->setApellidos($this->input->post('apellidos'));
                $reg->setEmail($this->input->post('email'));
                $reg->setColor($this->input->post('color'));
                $reg->setIdrol($rol);
                $reg->setPass(encode_string($this->input->post('pass')));
                //introducimos fecha si es distinto de vacío
                if ($this->input->post('fnacimiento') != "") {
                    $reg->setFnacimiento(new \DateTime(formatDateDoct($this->input->post('fnacimiento'))));
                }
                //si img
                if ($_FILES['image']['name'] != "") {
                    $upload_image = upload('image', 'pages/media/users', 200, 200, '200');

                    if ($upload_image['upload']) {
                        $reg->setImg($upload_image['res']);
                    }

                }

                //guardamos
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
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1);
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css_module','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js_module','',TRUE);

        $data['id'] = $id;

        //almacenamos todos los roles
        $data['roles'] = $this->doctrine->em->getRepository("Entities\\Roles")->findAll();
        //obtenemos usuario
        $data['getRow'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findOneBy(["id" => $id]);
        //almacenamos todos los roles
        $data['getUsuarios'] = $this->doctrine->em->getRepository("Entities\\Usuarios")->findBy(["idrol" => 3]);

        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Editar ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1);
        //lista migas pan
        $data['breadcrumb'] = array(str_replace('_', ' ', $this->nameClass), 'Crear ' . substr(str_replace('_', ' ', $this->nameClass), 0, -1));

        //comprobamos formulario submit
        if (isset($_POST['submit'])) {
            //validamos los datos
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('rol', 'Rol', 'required');
            $this->form_validation->set_rules('color','Color','required');

            //solo si pass no es vacío
            if ($this->input->post('pass') != "") {
                $this->form_validation->set_rules('pass', 'Pass');
            }

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run()) {

                //obtenemos el ROL
                $rol = $this->doctrine->em->find("Entities\\Roles", $this->input->post('rol'));
                //seteamos los datos
                $data['getRow']->setNombre($this->input->post('nombre'));
                $data['getRow']->setApellidos($this->input->post('apellidos'));
                $data['getRow']->setEmail($this->input->post('email'));
                $data['getRow']->setColor($this->input->post('color'));

                //actualizamos sólo si fecha es distinto de vacío
                if ($this->input->post('fnacimiento') != "") {
                    $data['getRow']->setFnacimiento(new \DateTime(formatDateDoct($this->input->post('fnacimiento'))));
                }
                $data['getRow']->setIdrol($rol);
                //si img
                if ($_FILES['image']['name'] != "") {
                    $upload_image = upload('image', 'pages/media/users', 200, 200, '200');

                    if ($upload_image['upload']) {
                        $data['getRow']->setImg($upload_image['res']);
                    }

                }
                //si pass
                if ($this->input->post('pass') != "") {
                    $data['getRow']->setPass(encode_string($this->input->post('pass')));
                }

                //actualizamos
                $this->doctrine->em->flush();


            }
        }

        //cargamos la vista
        $this->load->view('templates/panel/layout', $data);
    }

    public function delete($id)
    {

        //obtenemos el dato mediante id
        $getRow = $this->doctrine->em->getRepository("Entities\\Usuarios")->findOneBy(["id" => $id]);
        //si el resultado de la consulta obtiene reusltado, accedemos y comprobamos si tiene registros adjutnos
        if( $getRow ) {

            $getRegs = $this->doctrine->em->getRepository("Entities\\Registros")->findBy(["idusuario" => $getRow->getId()]);
            //si el resultado de la consutla tiene resultados, lo recorremos y editamos cada uno de los registros
            //para que el idusuario apunte a usuario sin asignar.
            if( $getRegs ) {
                //obtenemos el objeto usuario sin asignar
                $sinAsignar = $this->doctrine->em->getRepository("Entities\\Usuarios")->findOneBy(["id" => 5]);
                //recorremos los registros
                foreach ($getRegs as $key => $reg) {
                    //seteamos este con el nuevo usuario
                    $reg->setIdusuario($sinAsignar);
                    $this->doctrine->em->flush();
                }
            }
            //despues realizamos un softDelete del usuario
            $getRow->setEstado(1);
            $this->doctrine->em->flush();
        }
        //ruta para los botones y acciones
        $path = $this->uri->segment(1);

        //redireccionamos
        redirect(site_url($path));

    }

    //metodo que genera el pass auto
    public function generate_pass()
    {
        if ($this->input->is_ajax_request()) {
            $json = generate_password();
            echo json_encode($json);
        } else {
            show_404();
        }
    }

    public function addTeam($id)
    {
        if (isset($_POST['submit'])){

            //ruta para los botones y acciones
            $path = $this->uri->segment(1);
            //consultamos si el usuario ya existe, y si es así no lo add al equipo
            $isUser = $this->doctrine->em->getRepository("Entities\\Equipos")->findOneBy(["idusuario" => $this->input->post('usuarios')]);
            
            if($isUser == null)
            {
                //obtenemos los objetos usuario = master y usuario = user
                $master = $this->doctrine->em->find("Entities\\Usuarios", $id);
                $user = $this->doctrine->em->find("Entities\\Usuarios", $this->input->post('usuarios'));

                $reg = new Entities\Equipos;

                $reg->setIdmaster($master);
                $reg->setIdusuario($user);
                //guardamos
                $this->doctrine->em->persist($reg);
                $this->doctrine->em->flush();
                //redireccionamos al edit
                redirect(site_url($path . '/edit/' .$id));

            }else{

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
                $data['path'] = $this->uri->segment(1). '/edit/' .$id;

                $data['error'] = 'Parece que el usuario ya esta asociado.';
                $this->load->view('templates/panel/layout', $data);
            }

            
            
        }else{

            show_404();
        }

    }

    public function deleteTeam($m = 0,$u = 0)
    {
        //ruta para los botones y acciones
        $path = $this->uri->segment(1);

        if($m > 0 AND $u > 0)
        {

            $equipo = $this->doctrine->em->find("Entities\\Equipos", $u);
            if ($equipo === null)
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
                $data['path'] = $this->uri->segment(1). '/edit/' .$id;

                $data['error'] = 'No existe el usuario.';
                $this->load->view('templates/panel/layout', $data);

            }else{

                //eliminamos
                $this->doctrine->em->remove($equipo);
                $this->doctrine->em->flush();
                //redireccionamos
                redirect(site_url($path . '/edit/' .$m));
            }
            


        }else{

            show_404();

        }
    }
}

?>