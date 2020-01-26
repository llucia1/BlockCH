<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maincontroller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('format_date_doctrine_helper');
        $this->load->helper('my_playing_dates_helper');
    }

    public function ko($id)
    {
        $cif = "";
        //almacenamos la fecha actual, mas tarde dependiendo del tipo de seguimiento
        //esta fecha dentra una suma de meses que pueden ser 3 para nuevo o 6 para oferta
        $fecha = date('d-m-Y');
        //obtenemos los datos de la tarea
        $tarea = $this->doctrine->em->find("Entities\\Tareas", $id);
        //comprobamos si tarea es null, si es así entendemos que es un agendar desde cliente
        //entonces obtenemos el objeto desde el id de cliente y su estado.
        if($tarea == null)
        {

            $cl = $this->doctrine->em->find("Entities\\Cuentas", $id);
            $cif = $cl->getCif();

        }else
        {

            $cif = $tarea->getIdcliente()->getCif();
        }
        //y con el DNI/CIF Obtenemos el registro y el cliente
        $registro = $this->doctrine->em->getRepository("Entities\\Registros")->findOneBy(["cif" => $cif]);
        $cliente = $this->doctrine->em->getRepository("Entities\\Cuentas")->findOneBy(["cif" => $cif]);

        if ($this->input->is_ajax_request())
        {

            $ko = $this->input->post('ko');

            switch ($ko)
            {

                case 'No interesa':
                    
                    $fecha = add_days(180,$fecha);

                    break;

                case 'Cobertura':
                    
                    $fecha = add_days(180,$fecha);
                    
                    break;

                case 'Oferta':
                    
                    $fecha = add_days(180,$fecha);
                    
                    break;

                case 'Permanencia':
                    
                    $fecha = add_days(180,$fecha);
                    
                    break;

                case 'Penalización':
                    
                    $fecha = add_days(180,$fecha);
                    
                    break;

                default:

                    $select = $this->input->post('select');
                    $radio = $this->input->post('radio');

                    if($radio == 'Permanencia' OR $radio == 'Penalización' OR $radio == 'Permanencia')
                    {
                        if($select > 1)
                        {
                            $select = $select - 30;
                        }
                    }
                    
                    $fecha = add_days($select,$fecha);

                    break;
                
            }

        }else{

            //obtenemos los datos de seguimiento
            $seguimiento = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcalendario" => $tarea->getIdcalendario()]);

            if($seguimiento->getTipo() == 'Nuevo 1' OR $seguimiento->getTipo() == 'Nuevo 2' OR $seguimiento->getTipo() == 'Nuevo 3')
            {

                $fecha = add_days(90,$fecha);

            }

        }
        
        //obtenemos estado 0 = sin estado para que el registro quede con dicho estado
        $estado = $this->doctrine->em->find("Entities\\Estadosregistros", 4);
        //si registro es igual null, entonces creamos el registro
        if(!$registro)
        {
            $registro_ = new Entities\Registros;

        }else{

            $registro_ = $registro;
        }

        //Seteamos los datos
        $registro_->setEmpresa($cliente->getNombre());
        $registro_->setTelefono(str_replace(' ', '', $cliente->getTelefono()));
        $registro_->setAdministrador($cliente->getPersonacnt());
        $registro_->setPercontacto($cliente->getPersonacnt());
        $registro_->setCif($cliente->getCif());
        $registro_->setDireccion($cliente->getDireccion());
        $registro_->setProvincia($cliente->getProvincia());
        $registro_->setPoblacion($cliente->getPoblacion());
        $registro_->setEmail($cliente->getEmail());
        $registro_->setCp($cliente->getCp());
        $registro_->setFregistro(new \DateTime(formatDateDoct($fecha)));
        $registro_->setOculto(0);
        $registro_->setIdestado($estado);
        $registro_->setIdusuario($cliente->getIdusuario());
        $registro_->setIdoperador($cliente->getIdoperador());

        if(!$registro)
            $this->doctrine->em->persist($registro_);
               
        $this->doctrine->em->flush();

        //cerramos tarea
        if($tarea)
            $tarea->setEstado(1);

        $this->doctrine->em->flush();
        //cerramos el estado seguimiento cerrado y creamos el KO, comprobando si tarea no es null
        if($tarea)
        {
            $seguimiento = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcliente" => $tarea->getIdcliente()->getId(),"actual" => 1]);
        }else{

            $seguimiento = $this->doctrine->em->getRepository("Entities\\Cuentasseguimiento")->findOneBy(["idcliente" => $id,"actual" => 1]);
        }
        
        $seguimiento->setActual(0);
        $this->doctrine->em->flush();
        //Cerramos en caso afirmativo el evento, comprobando si tarea no es null
        if($tarea)
        {
            $evento = $this->doctrine->em->getRepository("Entities\\Calendario")->findOneBy(["idcliente" => $tarea->getIdcliente()->getId(),"estado" => 0]);
        }else{

            $evento = $this->doctrine->em->getRepository("Entities\\Calendario")->findOneBy(["idcliente" => $id,"estado" => 0]);
        }

        if($evento)
        {

            $evento->setEstado(1);
            $this->doctrine->em->flush();

        }

        $newSeguimiento = new Entities\Cuentasseguimiento;
        $newSeguimiento->setIdusuario($seguimiento->getIdusuario());
        $newSeguimiento->setIdteleoperador($seguimiento->getIdteleoperador());
        $newSeguimiento->setIdcliente($seguimiento->getIdcliente());
        $newSeguimiento->setIdcalendario($seguimiento->getIdcalendario());
        $newSeguimiento->setTipo('Ko');
        $newSeguimiento->setIdestado($seguimiento->getIdestado());
        $newSeguimiento->setFseguimiento(new \DateTime("now"));

        $this->doctrine->em->persist($newSeguimiento);
        $this->doctrine->em->flush();

        //redireccionamos
        //redirect('tareas/edit/'.$id);

    }

}


















