<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class FormularioCamposRepositorio
 * @package Repositories
 */
class FormularioCamposRepositorio extends EntityRepository
{

	private $entity = "Entities\\FormularioCampos";

	/**
   * @return array
   */

    public function getFieldsByOrderer($form)
    {
    	$query = $this->_em->createQuery("SELECT f FROM $this->entity f WHERE f.formulario = $form ORDER BY f.orderer ASC");
    	return $query->getResult();
    }

}