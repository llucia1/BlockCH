<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class RegistrosRepositorio
 * @package Repositories
 */
class ArgumentarioRepositorio extends EntityRepository
{
	/**
   * @var string
   */
 	private $entity = "Entities\\Argumentarios";

 	public function getFirst($campaign)
	{ 
		$query = $this->_em->createQuery("SELECT u FROM $this->entity u WHERE u.campaign = $campaign ORDER BY u.id ASC")->setMaxResults(1);
		return $query->getOneOrNullResult();
	}
}