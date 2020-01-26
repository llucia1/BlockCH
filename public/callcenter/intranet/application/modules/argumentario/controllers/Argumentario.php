<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Argumentario  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;

	public function __construct()
	{
		parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'fa fa-bullhorn';
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
        $data['thead'] = array('ID','Título','Alta');
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1).'/'.$this->uri->segment(2);

        //obtenemos y mostramos todos los datos
        $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Argumentarios")->findAll();

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
        $data['project'] = $this->proyecto;
        $data['reference'] = strtoupper(__FUNCTION__ . "-" . $this->nameClass);
        //ruta para los botones y acciones
        $data['path'] = $this->uri->segment(1) . '/' . $this->uri->segment(2);
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js','',TRUE);

        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Crear '.substr($this->nameClass, 0, -2);
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass,'Crear '.substr($this->nameClass, 0, -2));
        //campañas
        $data['campaigns'] = $this->doctrine->em->getRepository("Entities\\Campaigns")->findAll();

        //comprobamos formulario submit
        if(isset($_POST['submit']))
        {
            //validamos los datos
            $this->form_validation->set_rules('titulo', 'Título', 'required');
            $this->form_validation->set_rules('argumentario', 'Argumentario', 'required');
            $this->form_validation->set_rules('campaign', 'Campaña', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run())
            {
                //objeto camapañas
                $campaign = $this->doctrine->em->find("Entities\\Campaigns", $this->input->post('campaign'));
                //instanciamos la entidad
                $agrg = new Entities\Argumentarios;
                //seteamos los datos
                $agrg->setTitle($this->input->post('titulo'));
                $agrg->setArgumentario($this->input->post('argumentario'));
                $agrg->setCampaign($campaign);
                //guardamos
                $this->doctrine->em->persist($agrg);
                $this->doctrine->em->flush();

                //redireccionamos al edit
                redirect(site_url($data['path'].'/edit/'.$agrg->getId()));
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
        $data['path'] = $this->uri->segment(1).'/'.$this->uri->segment(2);
        //pasamos css para esta página
        $data['css'] = $this->load->view('css_module/css','',TRUE);
        //pasamos js para esta página
        $data['js'] = $this->load->view('js_module/js','',TRUE);
        
        $data['id'] = $id;
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = 'Editar '.substr($this->nameClass, 0, -2);
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass,'Editar '.substr($this->nameClass, 0, -2));

        //obtenemos los datos por su id
        $data['getRow'] = $this->doctrine->em->find("Entities\\Argumentarios", $id);
        //obtenemos y mostramos todos los datos
        $data['getResult'] = $this->doctrine->em->getRepository("Entities\\Argumentarios")->findAll();
        //lista de acciones, preguntas argumentario
        $data['acciones'] = $this->doctrine->em->getRepository("Entities\\ArgumentarioRespuestas")->findBy(["argumentario" => $id]);
        //campañas
        $data['campaigns'] = $this->doctrine->em->getRepository("Entities\\Campaigns")->findAll();
        //comprobamos formulario submit
        if(isset($_POST['submit']))
        {
            //validamos los datos
            $this->form_validation->set_rules('titulo', 'Título', 'required');
            $this->form_validation->set_rules('argumentario', 'Argumentario', 'required');
            $this->form_validation->set_rules('campaign', 'Campaña', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

            if ($this->form_validation->run())
            {
                //objeto camapañas
                $campaign = $this->doctrine->em->find("Entities\\Campaigns", $this->input->post('campaign'));
                //seteamos su nombre y lo actualizamos
                $data['getRow']->setTitle($this->input->post('titulo'));
                $data['getRow']->setArgumentario($this->input->post('argumentario'));
                $data['getRow']->setCampaign($campaign);
                $this->doctrine->em->flush();
            }

        }
        //cargamos la vista
        $this->load->view('templates/panel/layout',$data);

    }

    public function delete($id)
    {
        //obtenemos el dato mediante id
        $getRow = $this->doctrine->em->getRepository("Entities\\Argumentarios")->findOneBy(["id" => $id]);
        //eliminamos el item
        $this->doctrine->em->remove($getRow);
        $this->doctrine->em->flush();
        $path = $this->uri->segment(1).'/'.$this->uri->segment(2);
        //redireccionamos
        redirect(site_url($path));
    }

    public function setAction($id)
    {
        //comprobamos formulario submit
        if(isset($_POST['submit']))
        {
            $argumentario = $this->doctrine->em->find("Entities\\Argumentarios", $id);
            //instanciamos la entidad
            $agrgR = new Entities\ArgumentarioRespuestas;
            //seteamos los datos
            $agrgR->setArgumentario($argumentario);
            $agrgR->setParentId($this->input->post('parentId'));
            $agrgR->setRespuesta($this->input->post('titulo'));
            //guardamos
            $this->doctrine->em->persist($agrgR);
            $this->doctrine->em->flush();
            //redireccionamos al edit
            redirect(site_url('configuracion/argumentario/edit/'.$id));
        }

    }

    public function deleteAction($id,$idAction)
    {
        //obtenemos el dato mediante id
        $getRow = $this->doctrine->em->getRepository("Entities\\ArgumentarioRespuestas")->findOneBy(["id" => $idAction]);
        //eliminamos el item
        $this->doctrine->em->remove($getRow);
        $this->doctrine->em->flush();
        //redireccionamos
        redirect(site_url('configuracion/argumentario/edit/'.$id));
    }

    public function getArgumentario()
    {
        $this->load->database();

        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            $campaign = $this->input->post('campaign');

            if( $id > 0 ) {

                $argumentario = $this->doctrine->em->find("Entities\\Argumentarios", $id);

            }else{

                $argumentario = $this->doctrine->em->getRepository("Entities\\Argumentarios")->getFirst($campaign);
            }

            $argumentarioRe = $this->doctrine->em->getRepository("Entities\\ArgumentarioRespuestas")->findBy(["argumentario" => $argumentario->getId()]);             

            $body = '<p>';
            $body .= $argumentario->getArgumentario();
            $body .= '</p>';

            foreach ($argumentarioRe as $row)
            {
                    $body .= '<button id="'.$row->getParentid().'" style="width: 100%;margin-bottom: 10px;" type="button" class="btn blue-hoki argumentario">'.$row->getRespuesta().'</button>';
            }

            $json = [

                'title' => $argumentario->getTitle(),
                'body' => $body
            ];

            echo json_encode($json);

        }else{

            show_404();
        }
    }

    private function encodeChar($string)
    {
        /*$string = str_replace(
            array('Ã','Á‰','Í','Ã“','Ú'),
            array('Á','É','Í','Ó','Ú'),
            $string
        );*/

        $string = str_replace(
            array('Ã¡','e','Ã','Ã³','u'),
            array('á','é','í','ó','ú'),
            $string
        );

        return $string;
    }

}
