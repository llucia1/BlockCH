<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class CalendarioRepositorio
 * @package Repositories
 */
class CalendarioRepositorio extends EntityRepository
{

  /**
   * @var string
   */
  private $entity = "Entities\\Calendario";

  /**
   * @return array
   */
    //devuelve un listado de los eventos que tiene asignado el usuario para el mes seleccionado
    public function getEvents($user,$date)
    {

      $date = explode('-', $date);
      $query = $this->_em->createQuery("SELECT c, u, o FROM $this->entity c JOIN c.idusuario u JOIN c.idcliente o WHERE c.year = $date[0] AND c.month = $date[1] AND c.idusuario IN($user) ORDER BY c.hour ASC");

      return $query->getArrayResult();

    }

    public function getEventsList($user,$y,$m,$d)
    {

      $query = $this->_em->createQuery("SELECT c, u FROM $this->entity c JOIN c.idusuario u WHERE c.year = $y AND c.month = $m AND c.day = $d AND c.idusuario = $user");

      return $query->getArrayResult();

    }

    public function getEventDetail($id)
    {

      $query = $this->_em->createQuery("SELECT c, u, cl, op FROM $this->entity c JOIN c.idusuario u JOIN c.idcliente cl JOIN cl.idoperador op WHERE c.id = $id");

      return $query->getScalarResult();

    }

    public function getEventByDate($idUsuario,$year,$month,$day)
    {


      $query = $this->_em->createQuery("SELECT u FROM $this->entity u WHERE u.year = $year AND u.month = $month AND u.day = $day AND u.idusuario = $idUsuario AND u.estado = 0");
      return $query->getResult();

    }

}
