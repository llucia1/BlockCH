<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class CarpetasRepositorio
 * @package Repositories
 */
class CarpetasRepositorio extends EntityRepository
{

  /**
   * @var string
   */
  private $entity = "Entities\\Carpetas";

  /**
   * @return array
   */

    public function getPathFolders($parent)
    {

      $query = $this->_em->createQuery("SELECT u FROM $this->entity u WHERE u.id = $parent");

      $folder = $query->getSingleResult();

      $folders = '';

      $folders .= '<li>';
      $folders .= '<a href="'.site_url('archivador/?folder='.$folder->getId()).'">'.$folder->getNombre().'</a>';

      $folders .= '</li>';

      if($folder->getParent() > 0)
      {
          $folders .= $this->getPathFolders($folder->getParent());
      }

      return $folders;

    }

    public function getPathFolders__($parent)
    {

      $arrayFolders = explode(',', $this->getArrayFolders($parent));
      print_r($arrayFolders);
      //echo $this->getArrayFolders($parent);
      $folders = '';

      foreach ($arrayFolders as $key => $folder)
      {
        $folders .= '<li>';
        $folders .= $folder;
        $folders .= '<i class="fa fa-circle"></i>';
        $folders .= '</li>';
      }

      return $folders;

    }

    private function getArrayFolders($parent)
    {

      $query = $this->_em->createQuery("SELECT u FROM $this->entity u WHERE u.id = $parent");

      $folder = $query->getSingleResult();

      $data = '<a href="'.site_url('archivador/?folder='.$folder->getId()).'">'.$folder->getNombre().'</a>,';

      if($folder->getParent() > 0)
      {
          $data .= $this->getPathFolders($folder->getParent());
      }

      return trim($data, ';');
      
    }

}
