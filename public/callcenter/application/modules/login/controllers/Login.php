<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login  extends MX_Controller
{
    private $nameClass = "";
    private $proyecto = null;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('MY_encrypt_helper');
        $this->load->model('Login_model');
        $this->load->library('encryption');
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->nameClass = get_class($this);
	}

	public function index()
	{
        // pasamos los datos básicos del template
        $data['lang'] = "es";
        $data['title'] = $this->proyecto->getNombre()." | Panel de control";
        $data['view'] = strtolower(__FUNCTION__."_".$this->nameClass);
        $data['robots'] = 'noindex, nofollow';
        $data['reference'] = strtoupper(__FUNCTION__."-".$this->nameClass);
        $data['project'] = $this->proyecto;
        $data['errorUsuario'] = FALSE;
        //echo $token = $this->encryption->encrypt('info@intraneteicbi.com_secret');
        //c9ed6c63f040f060e6733dbdb0bbdd99750e33472f6da4b2b9145843e4af80d0dfe9707b4739efab3fd9b4f5c919684cf1486cbe93c5cb42c3a8650ebd92baddyyAUocYuY0uUb8IhzdCf0QQN7lbFbfNQzQILhU3Lc1d3lCcshSQZKceX98wOKaNn
        //echo '<br/>';
        //echo $this->encryption->decrypt($_GET['token']);
        //comprobamos si se envió formulario
        if(isset($_POST['submit-login']) OR isset($_GET['token']))
        {
            //llamamos a getLoginAndPass para obtenemos los datos
            if( isset($_GET['token']) ) {

                $tokenDecrypt = $this->_getLoginAndPass($_GET['token']);
                $email = $tokenDecrypt['email'];
                $pass = $tokenDecrypt['pass'];
                //consultamos si existe el susario
                $usuario = $this->doctrine->em->getRepository("Entities\\Usuarios")->findOneBy(["email" => $email]);
                //si la consulta devuelve algo creamos sessión con el valor email
                if( $usuario ) {

                    $this->_getSession($usuario);
                    //comprobamos la contraseña
                    if(password_verify($pass, $usuario->getPass()))
                    {
                        $this->_letEnter($usuario);

                    }else{

                        $data['errorUsuario'] = '<div style="text-align: center; background-color: #fff; color: #e73d4a; opacity: 0.7;" class="alert alert-danger" role="alert">La contraseña con la que intentas acceder <br/>al panel de control no es correcta.</div>';

                    }

                }else{

                    $data['errorUsuario'] = '<div style="text-align: center; background-color: #fff; color: #e73d4a; opacity: 0.7;" class="alert alert-danger" role="alert">Lo sentimos, pero no existe ningún usuario con este email<br/> en nuestra base de datos.</div>';
                }
            }
            
            //comprobamos si existe variable sesesion email
            if(isset($this->session->userdata['email']))
            {
                //validamos el campo email
                $this->form_validation->set_rules('pass', 'Contraseña', 'required');
                $this->form_validation->set_error_delimiters('<div style="background-color: #fff; color: #e73d4a; opacity: 0.7;" class="alert alert-danger" role="alert">', '</div>');

                if($this->form_validation->run())
                {

                    $usuario = $this->doctrine->em->getRepository("Entities\\Usuarios")->findOneBy(["email" => $this->session->userdata['email']]);
                    //comprobamos la contraseña
                    if(password_verify($this->input->post('pass'), $usuario->getPass()))
                    {
                        $this->_letEnter($usuario);

                    }else{

                        $data['errorUsuario'] = '<div style="text-align: center; background-color: #fff; color: #e73d4a; opacity: 0.7;" class="alert alert-danger" role="alert">La contraseña con la que intentas acceder <br/>al panel de control no es correcta.</div>';

                    }

                }

            }else{

                //validamos el campo email
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_error_delimiters('<div style="background-color: #fff; color: #e73d4a; opacity: 0.7;" class="alert alert-danger" role="alert">', '</div>');

                if($this->form_validation->run())
                {
                    //si entramos comprobamos si existe un usuario con ese email
                    $usuario = $this->doctrine->em->getRepository("Entities\\Usuarios")->findOneBy(["email" => $this->input->post('email')]);
                    //si la consulta devuelve algo creamos sessión con el valor email
                    if($usuario)
                    {
                        $this->_getSession($usuario);

                    }else{

                        $data['errorUsuario'] = '<div style="text-align: center; background-color: #fff; color: #e73d4a; opacity: 0.7;" class="alert alert-danger" role="alert">Lo sentimos, pero no existe ningún usuario con este email<br/> en nuestra base de datos.</div>';
                    }

                }

            }
        }
        //cargamos la vista, en este caso es la de login
        $this->load->view('templates/login/layout',$data);

    }
    //método que retorna el token decodificato en formato email y pass
    private function _getLoginAndPass($token)
    {
        //vector que almacena los datos a devolver
        $data = [];
        //decodificamos la cadena
        $token = $this->encryption->decrypt($token);
        //la convertimos en un vector
        $token = explode('_',$token);
        //alamceanmos en el vector data elos datos con el formato key=>value
        isset( $token[0] ) ? $data['email'] = $token[0] : $data['email'] = '';
        isset( $token[1] ) ? $data['pass'] = $token[1] : $data['pass'] = '';
        //devolvemos los datos
        return $data;
    }

    private function _getSession($usuario)
    {
        //consultamos las tareas que tiene el usuario y almacenamos en el array 
        //el número de estas.
        $tareas = $this->doctrine->em->getRepository("Entities\\Tareas")->findBy(["idusuarioto" => $usuario->getId(),'estado' => 0]);

        $session_data['email'] = $usuario->getEmail();
        $session_data['image'] = $usuario->getImg();
        $session_data['nombre'] = $usuario->getNombre().' '.$usuario->getApellidos();
        $session_data['rol'] = $usuario->getIdrol()->getId();
        $session_data['permisos'] = $usuario->getIdrol()->getPermisos();
        $session_data['usuarioid'] = $usuario->getId();
        $session_data['tareas'] = count($tareas);
        //creamos login pero con el valor a false, ya que aún no se a terminado el logeo
        $session_data['login'] = FALSE;
        //creamos la sesión
        $this->session->set_userdata($session_data);
    }

    private function _letEnter($usuario)
    {
        $session_data['login'] = TRUE;
        $this->session->set_userdata($session_data);
        //creamos una entrada de actividad
        //$activity = new Entities\Useractivity;
        //seteamos los datos
        //$activity->setIdusuario($usuario);
        //guardamos
        //$this->doctrine->em->persist($activity);
        //$this->doctrine->em->flush();
        //almacenamos el id userActivity
        //$session_data['idUserActivity'] = $activity->getId();
        $session_data['idUserActivity'] = 1;
        $this->session->set_userdata($session_data);
        //redireccionamos al index
        redirect('/');
    }

    public function timeout()
    {
        //obtenemos datos userActivity
        $activity = $this->doctrine->em->getRepository("Entities\\Useractivity")->findOneBy(["id" => $this->session->userdata('idUserActivity')]);
        //seteamos los datos
        $activity->setTimeout();
        //guardamos
        $this->doctrine->em->flush();
        //cambiamos el valor de login
        $session_data['login'] = FALSE;
        $this->session->set_userdata($session_data);
        redirect('login');
    }

	public function logout()
    {
        //obtenemos datos userActivity
        $activity = $this->doctrine->em->getRepository("Entities\\Useractivity")->findOneBy(["id" => $this->session->userdata('idUserActivity')]);
        //seteamos los datos
        //$activity->setTimeout();
        //guardamos
        $this->doctrine->em->flush();
        //desmontamos las variables de sesión
        $this->session->unset_userdata('logged_in');
        //destruimos la sesión
        $this->session->sess_destroy();
        //redireccionamos a login
        redirect('login');
    }

}
