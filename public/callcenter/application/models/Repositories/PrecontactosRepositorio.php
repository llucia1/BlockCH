<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class PrecontactosRepositorio
 * @package Repositories
 */
class PrecontactosRepositorio extends EntityRepository
{

  /**
   * @var string
   */
  private $entity = "Entities\\Precontactos";

  /**
   * @return array
   */

    public function truncate()
    {

      $reg = $this->_em->getRepository($this->entity)->findAll();

      foreach ($reg as $key => $value)
      {
        
        $delete = $this->_em->getRepository($this->entity)->findOneBy(["id" => $value->getId()]);

        $this->_em->remove($delete);
        $this->_em->flush();

      }

    }

    public function getPrecontactosPorComercial()
    {

      $query = $this->_em->createQuery("SELECT u,COUNT(u.id) AS TOTALPPC,a FROM $this->entity u JOIN u.idusuario a GROUP BY u.falta");

      return $query->getScalarResult();

    }

}
