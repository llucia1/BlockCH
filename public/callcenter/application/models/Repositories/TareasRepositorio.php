<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class TareasRepositorio
 * @package Repositories
 */
class TareasRepositorio extends EntityRepository
{

  /**
   * @var string
   */
  private $entity = "Entities\\Tareas";

  /**
   * @return array
   */

    public function getTareasByDate($idUsuario)
    {


      $query = $this->_em->createQuery("SELECT u FROM $this->entity u WHERE u.falta = CURRENT_DATE() AND u.idusuarioto = $idUsuario AND u.estado = 0");
      return $query->getResult();

    }

    public function getTareasByState($idUsuario,$state)
    {


      $query = $this->_em->createQuery("SELECT u FROM $this->entity u WHERE u.idusuarioto = $idUsuario AND u.estado = $state");
      return $query->getResult();

    }

}
