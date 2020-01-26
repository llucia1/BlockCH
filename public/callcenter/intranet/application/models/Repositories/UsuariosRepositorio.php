<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class UsuariosRepositorio
 * @package Repositories
 */
class UsuariosRepositorio extends EntityRepository
{

  /**
   * @var string
   */
  private $entityUser = "Entities\\Usuarios";
  private $entityCallRegistry = "Entities\\Registrollamadas";
  private $entityUseractivity = "Entities\\Useractivity";
  private $entityCuentasseguimiento = "Entities\\Cuentasseguimiento";

  /**
   * @return array
   */

    public function getReport($rt,$user,$from,$to,$excel = false)
    {
      
       //convertimos la fecha a un int ejem: 20170921
        $from_ = explode('-', $from);
        $from_ = $from_[2].$from_[1].$from_[0];
        $from_ = (int)$from_ ;

        $to_ = explode('-', $to);
        $to_ = $to_[2].$to_[1].$to_[0];
        $to_ = (int)$to_;

      if( $rt == 'TODOS LOS ESTADOS') {

        if($user > 0)
        {
          $query = $this->_em->createQuery("SELECT c FROM $this->entityUseractivity c WHERE c.idusuario = $user AND c.codeactivity <= $to_ AND c.codeactivity >= $from_ AND c.entity = 'Registros'");
          
        }elseif( $user == 0 ){

          $query = $this->_em->createQuery("SELECT c,COUNT(c.id) AS TOTAL, u FROM $this->entityUseractivity c JOIN c.idusuario u WHERE c.codeactivity <= $to_ AND c.codeactivity >= $from_ AND c.entity = 'Registros' GROUP BY c.idusuario");
          
        }

      }else{

        if($user > 0)
        {
          $query = $this->_em->createQuery("SELECT c FROM $this->entityUseractivity c WHERE c.idusuario = $user AND c.codeactivity <= $to_ AND c.codeactivity >= $from_ AND c.entity = 'Registros' AND c.entityState = '$rt'");
          
        }elseif( $user == 0 ){

          $query = $this->_em->createQuery("SELECT c,COUNT(c.id) AS TOTAL, u FROM $this->entityUseractivity c JOIN c.idusuario u WHERE c.codeactivity <= $to_ AND c.codeactivity >= $from_ AND c.entity = 'Registros' AND c.entityState = '$rt' GROUP BY c.idusuario");
          
        }

      }

      $result = $query->getScalarResult();
      //comprobamos si el resutlado es distinto de null
      if( $result ) {

        $data = $this->drawReport($rt,$result,$user,$from,$to,$excel);

      }else{

        $data = null;
      }
      

      return $data;

    }

    private function drawReport($rt,$result,$user,$from,$to,$excel)
    {

      $total = 0;
      //horas minutos y segundos totales
      $h = 0; $m = 0; $s = 0;

      if( $excel ) {

        if( $user > 0 AND ($rt != 'POLIZA' AND $rt != 'PROYECTO') ) {

          $data['header'] = "Cliente; Estado; Comienza; Termina; Total; Fecha;\n";
          $data['body'] = "";
          $data['filename'] = $rt;

          foreach ($result as $key => $value)
          {
            //calculamos el tiempo pasado en la llamada
            $date1 = new \DateTime($value['c_timecnx']->format('Y-m-d H:i:s'));
            $date2 = new \DateTime($value['c_timeout']->format('Y-m-d H:i:s'));
            $diff = $date1->diff($date2);

            $s += $diff->s + ($diff->i*60) + ($diff->h*3600);

            $data['body'] .= $value['c_entityValue'].";";
            $data['body'] .= $value['c_entityState'].";";
            $data['body'] .= $value['c_timecnx']->format("H:i:s").";";
            $data['body'] .= $value['c_timeout']->format("H:i:s").";";
            $data['body'] .= $diff->h.':'.$diff->i.':'.$diff->s.";";
            $data['body'] .= $value['c_factivity']->format("d-m-Y").";";
            $data['body'] .= "\n";

          }

          $h = floor($s / 3600);
          $m = floor(($s - ($h * 3600)) / 60);
          $s = $s - ($h * 3600) - ($m * 60);

          $data['body'] .=";".$h.':'.$m.':'.$s.";";
          $data['body'] .=";".count($result).";";

        }elseif( $user == 0 AND ($rt != 'POLIZA' AND $rt != 'PROYECTO') ) {

          $data['header'] = "Teleoperador; ".$rt."\n";
          $data['body'] = "";
          $data['filename'] = $rt;

          foreach ($result as $key => $value)
          {
            
            $data['body'] .= $value['u_nombre'].";";
            $data['body'] .= $value['TOTAL'].";";
            $data['body'] .= "\n";

          }

        }elseif( $rt == 'POLIZA' OR $rt == 'PROYECTO') {
          
          $data['filename'] = $rt;
          //llamamos al método privado que nos devuelve la cabecera y el cuerpo
          $list = $this->_listRegistersWithAllData($rt,$from,$to);
          $data['header'] = $list['header'];
          $data['body'] = $list['body'];

        }

      }else{

        if( $user > 0 ) {

          $data['dateRange'] = $from.' · '.$to;
          $data['header'] = 'Cliente; Estado; Comienza; Termina; Total; Fecha';
          $data['trTd'] = '';
     
          foreach ($result as $key => $value)
          {
            //calculamos el tiempo pasado en la llamada
            $date1 = new \DateTime($value['c_timecnx']->format('Y-m-d H:i:s'));
            $date2 = new \DateTime($value['c_timeout']->format('Y-m-d H:i:s'));
            $diff = $date1->diff($date2);

            $s += $diff->s + ($diff->i*60) + ($diff->h*3600);

            $data['trTd'] .= '<tr>';

            $data['trTd'] .= '<td>'.$value['c_entityValue'].'</td>';
            $data['trTd'] .= '<td>'.$value['c_entityState'].'</td>';
            $data['trTd'] .= '<td>'.$value['c_timecnx']->format("H:i:s").'</td>';
            $data['trTd'] .= '<td>'.$value['c_timeout']->format("H:i:s").'</td>';
            $data['trTd'] .= '<td>'.$diff->h.':'.$diff->i.':'.$diff->s.'</td>';
            $data['trTd'] .= '<td>'.$value['c_factivity']->format("d-m-Y").'</td>';

            $data['trTd'] .= '</tr>';
          }

          $h = floor($s / 3600);
          $m = floor(($s - ($h * 3600)) / 60);
          $s = $s - ($h * 3600) - ($m * 60);

          $data['trTd'] .= '<tr>';

          $data['trTd'] .= '<td></td>';
          $data['trTd'] .= '<td></td>';
          $data['trTd'] .= '<td></td>';
          $data['trTd'] .= '<td></td>';
          $data['trTd'] .= '<td>Total T.: '.$h.':'.$m.':'.$s.'</td>';
          $data['trTd'] .= '<td>Total R.: '.count($result).'</td>';
          $data['trTd'] .= '<td></td>';

          $data['trTd'] .= '</tr>';

        }elseif( $user == 0 ){

          $data['dateRange'] = $from.' · '.$to;
          $data['header'] = 'Teleoperador; '.$rt;
          $data['trTd'] = '';

          foreach ($result as $key => $value)
          {
            
            $data['trTd'] .= '<tr>';

            $data['trTd'] .= '<td>'.$value['u_nombre'].' '.$value['u_apellidos'].'</td>';
            $data['trTd'] .= '<td>'.$value['TOTAL'].'</td>';

            $data['trTd'] .= '</tr>';

            $total += $value['TOTAL'];
          }

          $data['trTd'] .= '<tr>';

          $data['trTd'] .= '<td></td>';
          $data['trTd'] .= '<td>Total: '.$total.'</td>';

          $data['trTd'] .= '</tr>';

        }

      }

      return $data;

    }

    //este metodo realiza un csv que muestra un listado de los clientes y todos sus datos
    //es un csv que sólo se da cuando el tipo de informe es = POLIZA o PROYECTO
    private function _listRegistersWithAllData($rt,$from,$to){
        //Instanciamos de forma global para tener acceso a los recursos de codeigntier
        $CI =& get_instance();
        //cargamos la librería encryption
        $CI->load->library('encryption');
        //convertimos la fecha a un int ejem: 20170921
        $from_ = explode('-', $from);
        $from_ = $from_[2].$from_[1].$from_[0];
        $from_ = (int)$from_ ;

        $to_ = explode('-', $to);
        $to_ = $to_[2].$to_[1].$to_[0];
        $to_ = (int)$to_;
        //donde almacenamos los datos de la cabecera, esto se realiza aquí porque es puede tener cambios en el segundo formulario
        $data['header'] = "";
        //donde almacenamos los datos del cuerpo del csv
        $data['body'] = "";

        //realizamos al consulta
        $registers = $this->_em->createQuery("SELECT c,COUNT(c.id) AS TOTAL, u FROM $this->entityUseractivity c JOIN c.idusuario u WHERE c.codeactivity <= $to_ AND c.codeactivity >= $from_ AND c.entity = 'Registros' AND c.entityState = '$rt' GROUP BY c.entityId");
        //montamos la cabecera
        $data['header'] .= "DNI; Nombre; Apellido1; Apellido2; Modalidad; Periocidad; Nueva Periocidad; Venci/Renov; Cuenta Corriente; Prima; Capital; Telf.; Vía; Dirección; Población; Cod. Postal; Provincia; Sexo; Fecha Naci.; Edad Actiarial; Cob. Actual; Prima Opc1; Cob Opc1; Ahorro € Opc1; Ahorro % Opc1; Prima Opc2; Ahorro € Opc2; Ahorro % Opc2; Compañia; Selec. Riesgo; Otros Datos;\n";
        //recorremos el resultado
        foreach ($registers->getScalarResult() as $key => $value) {
            //mediante el campo entity_id, buscamos el registro
            $register = $this->_em->find("Entities\\Registros", $value['c_entityId']);

            $secondaryFormData = $this->_em->getRepository("Entities\\FormularioDatos")->findOneBy(["rowTable" => 'registros',"rowId" => $value['c_entityId']]);

            //montamos el cuerpo
            $data['body'] .= $register->getDocumentNumber().";";
            $data['body'] .= $register->getName().";";
            $data['body'] .= $register->getFirstName().";";
            $data['body'] .= $register->getLastName().";";
            $data['body'] .= $register->getModality().";";
            $data['body'] .= $register->getPeriodicity().";";
            $data['body'] .= $register->getNewPeriodicity().";";
            $data['body'] .= $register->getRenovation()->format('d/m/Y').";";
            $data['body'] .= $CI->encryption->decrypt($register->getCheckingAccount()).";";//desencriptamos los datos bancarios
            $data['body'] .= $register->getPrima().";";
            $data['body'] .= $register->getCapital().";";
            $data['body'] .= $register->getTelephone().";";
            $data['body'] .= $register->getWay().";";
            $data['body'] .= $register->getAddress().";";
            $data['body'] .= $register->getCity().";";
            $data['body'] .= $register->getZip().";";
            $data['body'] .= $register->getProvince().";";
            $data['body'] .= $register->getGender().";";
            $data['body'] .= $register->getBirdDate()->format('d/m/Y').";";
            $data['body'] .= $register->getAge().";";
            $data['body'] .= $register->getActualCob().";";
            $data['body'] .= $register->getPrimaOpc1().";";
            $data['body'] .= $register->getCobOpc1().";";
            $data['body'] .= $register->getAhorroeuOpc1().";";
            $data['body'] .= $register->getAhorropercentOpc1().";";
            $data['body'] .= $register->getPrimaOpc2().";";
            $data['body'] .= $register->getAhorroeuOpc2().";";
            $data['body'] .= $register->getAhorropercentOpc2().";";
            $data['body'] .= $register->getCampaign()->getName().";";
            $data['body'] .= $register->getSelecRies().";";
            //en caso de tener datos en el form secundario, realizamos el add
            if( $secondaryFormData ) {
              //convertimos en un primer vector donde obtendremos el id del campo y el dato separados por |
              $traza = explode(';', $secondaryFormData->getTraza());
              //lo recorremos y realiza un segundo explode para separar el id del campo del dato
              foreach ( $traza  as $key => $otherData) {

                $otherData = explode('|', $otherData);
                //comprobamos si existe dato
                if( $otherData[1] != '' ) {
                    //en caso de tener datos, montamos como mostrarlo, de forma que quedaría así Nombre campo: Dato
                    $fieldName = $this->_em->find("Entities\\FormularioCampos", $otherData[0]);
                    $data['body'] .= $fieldName->getName().':'.$otherData[1].";";

                }

              }
              
            }

            $data['body'] .= "\n";
            //if( $secondaryFormData )
              //$data['body'] .= "sdasdasd;";
              //$data['body'] .= $secondaryFormData->getTraza().";";

            //para terminar de montar el excel, necesitamos extraer y ontar los datos de los formularios secundarios,
            //que pueden ser distintos dependiendo de la campaña o compañía.
            
            //1.Obtenemos los campos del formulario para añadirlos a la cabecera del ducumento, según campaña
            //$formulario = $this->doctrine->em->getRepository("Entities\\Formularios")->findOneBy(['campaign' => $campaign]);

        }

        return $data;
    }
}
