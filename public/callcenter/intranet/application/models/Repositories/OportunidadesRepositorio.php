<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class OportunidadesRepositorio
 * @package Repositories
 */
class OportunidadesRepositorio extends EntityRepository
{

  /**
   * @var string
   */
  private $entity = "Entities\\Oportunidades";

  /**
   * @return array
   */

    public function getOportunidadesLimit($max,$start=0,$q=null,$p=null)
    {
      if($q != null)
      {
        $query = $this->_em->createQuery("SELECT u FROM $this->entity u WHERE u.$p = '$q'")
                ->setFirstResult($start)
                ->setMaxResults($max);
      }else{

        $query = $this->_em->createQuery("SELECT u FROM $this->entity u")
                ->setFirstResult($start)
                ->setMaxResults($max);

      }

      

      return $query->getResult();

    }

}
