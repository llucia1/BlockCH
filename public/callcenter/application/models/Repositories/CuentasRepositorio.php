<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class CuentasRepositorio
 * @package Repositories
 */
class CuentasRepositorio extends EntityRepository
{

  /**
   * @var string
   */
  private $entity = "Entities\\Cuentas";

  /**
   * @return array
   */

    public function getCuentasLimit($max,$start=0,$f,$q)
    {

      //montamos el wehre para los parametros de búsqueda
      $where = "";

      if($f AND $q)
      {
        if($f == 'cp' OR $f == 'telefono')
        {

          $where = "WHERE u.".$f." = ".$q;

        }else{

            $where = "WHERE u.".$f." LIKE '%".$q."%'";
        }
      }

      $query = $this->_em->createQuery("SELECT u FROM $this->entity u $where")
      ->setFirstResult($start)
      ->setMaxResults($max);

      return $query->getResult();

    }

    public function getCuentasByEstado($estado)
    {
      switch ($estado) 
      {

        case 'nuevo':
          
           $query = $this->_em->createQuery("SELECT c, cl FROM Entities\\Cuentasseguimiento c JOIN c.idcliente cl WHERE c.actual = 1 AND c.tipo IN('Nuevo 1','Nuevo 2','Nuevo 3','Citar E.O.')");

          break;

        case 'oferta':
          
           $query = $this->_em->createQuery("SELECT c, cl FROM Entities\\Cuentasseguimiento c JOIN c.idcliente cl WHERE c.actual = 1 AND c.tipo IN('Oferta 1','Oferta 2','Oferta 3')");

          break;

        case 'cierre':
          
           $query = $this->_em->createQuery("SELECT c, cl FROM Entities\\Cuentasseguimiento c JOIN c.idcliente cl WHERE c.actual = 1 AND c.tipo IN('Cierre','E.O.Modi')");

          break;

      }
     

      return $query->getResult();
    }

}
