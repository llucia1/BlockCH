<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biblioteca  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;
    private $rol = 0;

	public function __construct()
	{
		parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'fa fa-archive';
        $this->rol = $this->session->userdata('rol');
        //helper uploads
        $this->load->helper('upload_helper');
        $this->load->helper('my_alt_helper');
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
        //rol usuario
        $data['rol'] = $this->rol;
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
        //obtenemos todas las carpetas de primer nivel si get['folder'] no existe.
        if(isset($_GET['folder']))
        {

            $data['getFolders'] = $this->doctrine->em->getRepository("Entities\\Carpetas")->findBy(['parent' => $_GET['folder']]);
            $data['parent'] = $_GET['folder'];
            //obtenemos los archivos vinculados la carpta correspondiente
            $data['getAttachments'] = $this->doctrine->em->getRepository("Entities\\Attachments")->findBy(['idrow' => $_GET['folder'],'tablerow' => 'carpetas']);
            //obtenemos las migas de pan
            $data['breadCrumbs'] = $this->getBreadcrumbs($_GET['folder']);

        }else{

             $data['getFolders'] = $this->doctrine->em->getRepository("Entities\\Carpetas")->findBy(['parent' => 0]);
             $data['parent'] = 0;
             //obtenemos las migas de pan
             $data['breadCrumbs'] = $this->getBreadcrumbs(0);
             $data['getAttachments'] = null;

        }
        //comprobamos formulario submit-attach en modal
        if (isset($_POST['submit-attach']))
        {

            $upload_image = upload('file','attachments_archivador',0,0,35000);

            if($upload_image['upload'])
            {
                //instanciamos la entidad
                $reg = new Entities\Attachments;
                //seteamos los datos
                $reg->setIdrow($_GET['folder']);
                $reg->setTablerow('carpetas');
                $reg->setAttached($upload_image['res']);
                //guardamos
                $this->doctrine->em->persist($reg);
                $this->doctrine->em->flush();
                //refrescamos la página
                redirect('archivador/?folder='.$_GET['folder'], 'refresh');

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
        $this->load->view('templates/panel/layout',$data);
	}

    public function newFolder()
    {
        if($this->input->is_ajax_request())
        {
            $parent = $this->input->post('parent');
            //creamos una instancia de la entidad
            $folder = new Entities\Carpetas;
            //establecemos las propiedades a través de los setters
            $folder->setNombre("Nueva carpeta");
            $folder->setParent($parent);
            //guardamos la entidad en la tabla users
            $this->doctrine->em->persist($folder);
            $this->doctrine->em->flush();
            //dibujamos las carpetas
            $data['getFolders'] = $this->doctrine->em->getRepository("Entities\\Carpetas")->findBy(['parent' => $parent]);

            echo $this->load->view('include/folders',$data,TRUE);

        }else
        {
            show_404();
        }
    }

    public function deleteFolder()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            //obtenemos la carpeta que queremos borrar
            $folder = $this->doctrine->em->find("Entities\\Carpetas", $id);
            /*
                Una vez obtenida la carpeta, tenemos que eliminar todo lo que esta contiene, para esto vamos a realizar las siguientes acciones.
                1.obtener una lista de las carpetas donde parent sea igual al id de la carpeta eliminada
                1.recorremos esta lista
                2.obtenemos una lista de los archivos asociados a la carpeta donde apuntemos idtow = id y tablerow = carpeta en la tabla attachments
                3.recorremos el listado de los archivos si los hay y eliminamos los archivos de las arpeta del servidos y de la tabla attachments
                4.finalmente eliminamos la carpeta.
                5.Una vez recorrido el listado de carpetas y eliminado todo, eliminamos la carpeta principal que es donde hicimos click.
            */
             $folders = $this->doctrine->em->getRepository("Entities\\Carpetas")->findBy(['parent' => $folder->getId()]);

             foreach ($folders as $key => $fold)
             {
                
                $files = $this->doctrine->em->getRepository("Entities\\Attachments")->findBy(['idrow' => $fold->getId(),'tablerow' => 'carpetas']);

                foreach ($files as $key => $fl)
                {
                    
                    $file = $this->doctrine->em->find("Entities\\Attachments", $fl->getId());
                    $attached = $file->getAttached();
                    //eliminamos el archivo
                    $this->doctrine->em->remove($file);
                    $this->doctrine->em->flush();

                    unlink('./assets/attachments_archivador/'.$attached);
                }
                //eliminamos la carpeta
                $folder_ = $this->doctrine->em->find("Entities\\Carpetas", $fold->getId());
                $this->doctrine->em->remove($folder_);
                $this->doctrine->em->flush();
             }
             //eliminamos los archivos principales
             $files = $this->doctrine->em->getRepository("Entities\\Attachments")->findBy(['idrow' => $id,'tablerow' => 'carpetas']);

             foreach ($files as $key => $fl)
             {
                $file = $this->doctrine->em->find("Entities\\Attachments", $fl->getId());
                $attached = $file->getAttached();
                //eliminamos el archivo
                $this->doctrine->em->remove($file);
                $this->doctrine->em->flush();

                unlink('./assets/attachments_archivador/'.$attached);
             }
            //eliminamos la carpeta principal
            $this->doctrine->em->remove($folder);
            $this->doctrine->em->flush();


        }else
        {
            show_404();
        }
    }

    public function deleteFile()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            //obtenemos el archivo que queremos borrar
            $file = $this->doctrine->em->find("Entities\\Attachments", $id);
            $attached = $file->getAttached();
            //eliminamos el archivo
            $this->doctrine->em->remove($file);
            $this->doctrine->em->flush();

            unlink('./assets/attachments_archivador/'.$attached);
            

        }else
        {
            show_404();
        }
    }

    private function getBreadcrumbs($parent)
    {
        $breadcrumb = '<ul style="float:left;" class="page-breadcrumb breadcrumb folder">';
        $breadcrumb .= '<li>';
        $breadcrumb .= '<a href="'.site_url('biblioteca').'">Biblioteca</a>';
        $breadcrumb .= '</li>';
        $breadcrumb .= '</ul>';

        if($parent > 0)
        {

            //$parent = $this->doctrine->em->getRepository("Entities\\Carpetas")->find($id);

            $breadcrumb .= '<ol style="float:left;display: flex;flex-flow: row-reverse  wrap-reverse;" class="page-breadcrumb breadcrumb folder">';
            $breadcrumb .= $this->doctrine->em->getRepository("Entities\\Carpetas")->getPathFolders($parent);
            $breadcrumb .= '</ol>';
            
        }


        return $breadcrumb;
    }

}
