<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home  extends MX_Controller
{
    private $nameClass;
    private $icono;
    private $proyecto;
    private $usuarioid = 0;

	public function __construct()
	{
		parent::__construct();
        $this->nameClass = get_class($this);
        $this->proyecto = $this->doctrine->em->find("Entities\\Proyecto", 1);
        $this->icono = 'icon-home';
        $this->usuarioid = $this->session->userdata('usuarioid');
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
        //icono del módulo
        $data['icono'] = $this->icono;
        // titulo del módulo
        $data['h1'] = $this->nameClass;
        //lista migas pan
        $data['breadcrumb'] = array($this->nameClass);
        //obtenemos las tareas pendientes
        $data['tareas'] = $this->doctrine->em->getRepository("Entities\\Tareas")->getTareasByState($this->usuarioid,0);
        //obtenemos los eventos pendientes
        $data['eventos'] = $this->doctrine->em->getRepository("Entities\\Calendario")->getEventByDate($this->usuarioid,date('Y'),date('m'),date('d'));

        /*$csv = file('assets/csv/Cuentas3.csv');
        
        foreach ($csv as $key => $value){
            
            
            $reg = new Entities\Cuentas;
            $registro = explode(";", $value);
            print_r($registro);
            $usuario = $this->doctrine->em->find("Entities\\Usuarios", 1);
            $operador = $this->doctrine->em->find("Entities\\Operadores", 0);
                
                ///echo $usuario->getNombre();

                if($key > 0)
                {
                    if($registro[1] != "")
                    {
                        for ($i=0; $i <= 11 ; $i++) 
                        { 
                            if(!isset($registro[$i]))
                            {
                                $registro[$i] = "";
                            }

                        }

                        if(!is_numeric($registro[2]))
                        {
                            $registro[2] = 000000000;
                        }

                        if(!is_numeric($registro[3]))
                        {
                            $registro[3] = 000000000;
                        }

                        $reg->setNombre($registro[0]);
                        $reg->setNumcuenta($registro[1]);
                        $reg->setTelefono($registro[2]);
                        $reg->setTelefonoalt($registro[3]);
                        $reg->setEmail($registro[4]);
                        $reg->setCif($registro[5]);
                        $reg->setPersonacnt($registro[6]);
                        $reg->setDireccion($registro[7]);
                        $reg->setPoblacion($registro[8]);
                        $reg->setProvincia($registro[9]);
                        $reg->setCp($registro[10]);
                        $reg->setDescripcion($registro[11]);

                        $reg->setModificado($usuario);
                        $reg->setIdusuario($usuario);
                        $reg->setIdoperador($operador);
                        
                        
                        

                        $this->doctrine->em->persist($reg);
                        $this->doctrine->em->flush();

                    }

                }
                
       }     

    /*echo $key."-".$registro[20]."<br/>";
                if(isset($registro[18])){

                   $reg->setNombre($registro[18]); 
                }

                if(isset($registro[16])){

                   $reg->setCif($registro[16]); 
                }

                if(isset($registro[26])){

                   $reg->setCp($registro[26]); 
                }

                if(isset($registro[27])){

                   $reg->setPoblacion($registro[27]); 
                }

                if(isset($registro[28])){

                   $reg->setOperadora($registro[28]); 
                }

                if(isset($registro[29])){

                   $reg->setLineasmoviles($registro[29]); 
                }

                if(isset($registro[30])){

                   $reg->setLineasdatos($registro[30]); 
                }

                if(isset($registro[31])){

                   $reg->setAdsl($registro[31]); 
                }

                if(isset($registro[32])){

                   $reg->setConectapyme($registro[32]); 
                }

                if(isset($registro[33])){

                   $reg->setHistorial($registro[33]); 
                }

                if(isset($registro[34])){

                   $reg->setTeleoperadora($registro[34]); 
                }
                
                if(isset($registro[0])){

                   $reg->setFacturacrm($registro[0]);

                }else{

                    $reg->setFacturacrm(0);

                }

                if(isset($registro[1])){

                   $reg->setFecfactura(new \DateTime($registro[1])); 

                }else{

                    $reg->setFecfactura(new \DateTime("now"));
                }

                if(isset($registro[2])){

                   $reg->setPresupuestocrm(new \DateTime($registro[2])); 

                }else{

                    $reg->setPresupuestocrm(new \DateTime("now"));
                }

                if(isset($registro[3])){

                   $reg->setCoberturacrm(new \DateTime($registro[3])); 

                }else{

                    $reg->setCoberturacrm(new \DateTime("now"));
                }

                if(isset($registro[4])){

                    if($registro[4] == 'si')
                    {
                        $reg->setPreentrcliente(1);
                    }else{

                        $reg->setPreentrcliente(0);

                    }
                    

                }else{

                    $reg->setPreentrcliente(0);
                }

                if(isset($registro[5])){

                   $reg->setCitaentrpresupuesto(new \DateTime($registro[5])); 

                }else{

                    $reg->setCitaentrpresupuesto(new \DateTime("now"));
                }

                if(isset($registro[6])){

                   $reg->setFecproxllamada(new \DateTime($registro[6])); 

                }else{

                    $reg->setFecproxllamada(new \DateTime("now"));
                }

                if(isset($registro[7])){

                   $reg->setFechacita(new \DateTime($registro[7])); 

                }else{

                    $reg->setFechacita(new \DateTime("now"));
                }

                if(isset($registro[8])){

                   $reg->setTarea($registro[8]); 

                }
                
                if(isset($registro[9])){

                   $reg->setN2(new \DateTime($registro[9])); 

                }else{

                    $reg->setN2(new \DateTime("now"));
                }
                
                if(isset($registro[10])){

                   $reg->setN3(new \DateTime($registro[10])); 

                }else{

                    $reg->setN3(new \DateTime("now"));
                }

                if(isset($registro[11])){

                   $reg->setOferta2(new \DateTime($registro[11])); 

                }else{

                    $reg->setOferta2(new \DateTime("now"));
                }

                if(isset($registro[12])){

                   $reg->setOferta3(new \DateTime($registro[12])); 

                }else{

                    $reg->setOferta3(new \DateTime("now"));
                }

                if(isset($registro[13])){

                   $reg->setCierra(new \DateTime($registro[13])); 

                }else{

                    $reg->setCierra(new \DateTime("now"));
                }

                if(isset($registro[14])){

                   $reg->setFechako(new \DateTime($registro[14])); 

                }else{

                    $reg->setFechako(new \DateTime("now"));
                }

                $reg->setConverg(0);
                
                
               

                $this->doctrine->em->persist($reg);
                $this->doctrine->em->flush();


        }*/

         //generamos el informe en formato excel
            /*$separador = ";";
            //generamos las cabeceras para el archivo xls
            header("Cache-Control: public");
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename= rg.xls');
            echo utf8_decode("Empresa;Direccion;CP;Ciudad;Provincia;Telefono;Movil;Email;Web;Sector;N.Empleados;Administrador;P.contacto;CIF;Comentario;\n");

            $reg = $this->doctrine->em->getRepository("Entities\\Cuentas")->findAll();

            foreach ($reg as $key => $value) 
            {
                echo $value->getNombre().$separador.$value->getDireccion().$separador.$value->getCp().$separador.$value->getPoblacion().$separador.$value->getProvincia().$separador.$value->getTelefono().$separador.$value->getTelefonoalt().$separador.$value->getEmail().$separador."".$separador."".$separador."".$separador."".$separador.$value->getPersonacnt().$separador.$value->getCif().$separador."".$separador."\n";
            }*/

        //cargamos la vista, en este caso es la de login
        $this->load->view('templates/panel/layout',$data);

	}

    /*public function import_data()
    {
        $csv = file('assets/csv/Oportunidades_companias.csv');

        foreach ($csv as $key => $value)
        {
            if($key > 0)
            {
               $registro = explode(";", $value);
                //print_r($registro); 
               $item = $this->doctrine->em->getRepository("Entities\\Cuentas")->findOneBy(["cif" => $registro[0]]);
               $operador = $this->doctrine->em->find("Entities\\Operadores", $registro[1]);

                if($item)
                {
                    //echo $registro[1].'<br/>';//Operador
                   // echo $registro[2].'<br/>';//lineas MO
                    //echo $registro[3].'<br/>';//lineas Datos
                    //echo $registro[4].'<br/>';//Historial

                    //$item->setLineasmovil($registro[2]);
                    //$item->setHistorial($registro[4]);
                    $item->setIdoperador($operador);
                    $this->doctrine->em->flush();

                }

            }
            
        }
    }*/

    /*public function setTareasCierre()
    {
    	$item = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findBy(["tipo" => 'cierre']);

    	$userTo = $this->doctrine->em->find("Entities\\Usuarios",28);

    	foreach ($item as $key => $value)
    	{
    		$tarea = $this->doctrine->em->getRepository("Entities\\Tareas")->findOneBy(["idcliente" => $value->getIdcliente()]);

    		if($tarea)
    		{
    			echo $tarea->getId().'<br/>';

    		}else{

    			$newTarea = new Entities\Tareas;
    
			    $newTarea->setIdcliente($value->getIdcliente());
			    $newTarea->setIdusuariofrom($value->getIdusuario());
			    $newTarea->setIdusuarioto($userTo);
			    $newTarea->setIdcalendario($value->getIdcalendario());

			    $this->doctrine->em->persist($newTarea);
			    $this->doctrine->em->flush();
    		}

    	}
    }*/

    /*public function asg_co(){

        $this->db->group_by("idCliente"); 
        $query = $this->db->get('calendario');

        foreach ($query->result() as $key => $value){

            echo $value->idUsuario.'<br/>';

            $data = array(
               'idComercial' => $value->idUsuario
            );

            $this->db->where('id', $value->idCliente);
            $this->db->update('cuentas', $data);

            
        }
    }*/

    public function joinCuS()
    {
        $cS = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findAll();

        foreach ($cS as $key => $c) 
        {
            
            echo $c->getIdcliente()->getIdusuario()->getId();
            $update = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcliente" => $c->getIdcliente()->getId()]);

            $update->setIdteleoperador($c->getIdcliente()->getIdusuario());
            $this->doctrine->em->flush();


        }
    }

    public function updateRegisters()
    {
        $csv = file('assets/csv/registros_aegon1_2.csv');
        //$usuario = $this->doctrine->em->find("Entities\\Usuarios", 38);
        $camp = $this->doctrine->em->find("Entities\\Campaigns", 1);
        foreach ($csv as $key => $value)
        {
            $registro = explode(";", $value);
//echo trim($registro[0]);
            $item = $this->doctrine->em->getRepository("Entities\\Registros")->findOneBy(["documentNumber" => trim($registro[0])]);
            if( $item ) {

                echo $item->getId();
                //$item->setIdusuario($usuario);
                $item->setCampaign($camp);
                $this->doctrine->em->flush();
            }
            
        }
    }

}
