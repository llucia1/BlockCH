<?php
namespace Repositories;
use Doctrine\ORM\EntityRepository;

/**
 * Class MenupanelRepositorio
 * @package Repositories
 */
class MenupanelRepositorio extends EntityRepository
{

  /**
   * @var string
   */
  private $entity = "Entities\\Menupanel";
  private $CI;

  /**
   * @return array
   */
  public function getMenuPanel($segment,$lang,$parent = 0)
  {

    $this->CI =& get_instance();
    $this->CI->load->library('session');
    $permisos = $this->CI->session->userdata('permisos');

    $uri = explode('/',$_SERVER["REQUEST_URI"]);
    $query = $this->_em->createQuery("SELECT u FROM $this->entity u WHERE u.id IN($permisos) AND u.visible = 1 AND u.parent = $parent ORDER BY u.peso ASC");
    $datas = $query->getResult();
    $menu = '';

    if($datas != null)
    {
      foreach ($datas as $key => $data)
      {


        if($this->getMenuPanel($segment,$lang,$data->getId()) != null)
        {

            if ($uri[3] == url_title(utf8_encode($data->getNombre())))
            {
                $menu .='<li class="nav-item start active open">';

            }else{

                $menu.= '<li data-id="'.$data->getId().'" class="nav-item start lisub">';

            }

          $menu.= '<a class="nav-link nav-toggle" href="javascript:;">';
          $menu.= '<i class="'.$data->getIcono().'"></i> <span class="title">'.utf8_encode($data->getNombre()).'</span>';
          if ($uri[3] == url_title(utf8_encode($data->getNombre())))
          {
              $menu.= '<span class="arrow arrow'.$data->getId().' open"></span>';

          }else{

              $menu.= '<span class="arrow arrow'.$data->getId().'"></span>';

          }

          $menu.= '</a>';
          //Si el dato de la uri y el nombre coincide, mantenemos abierto el submenú

          if($uri[3] == url_title(utf8_encode($data->getNombre())))
          {
              $menu.= '<ul class="sub-menu sub-menu'.$data->getId().'" style="display:block;">';

          }else{

              $menu.= '<ul class="sub-menu sub-menu'.$data->getId().'" style="display:none;">';
          }

          $menu.= $this->getMenuPanel($segment,$lang,$data->getId());

        }else
        {

        if (isset($uri[4]))
        {
          if($uri[4] == url_title(utf8_encode($data->getNombre())))
          {
            $menu .='<li class="nav-item start active">';
            
          }else{
            
            $menu.= '<li class="nav-item start">';
          }

        }else{

              if($uri[3] == url_title(utf8_encode($data->getNombre())))
          {
            $menu .='<li class="nav-item start active open">';
            
          }else{
            
            $menu.= '<li class="nav-item start">';
          }

          }

          $idParent = $data->getParent();
          $query = $this->_em->createQuery("SELECT u FROM $this->entity u WHERE u.visible = 1 AND u.id = $idParent");
          $parent = $query->getResult();

          if($parent == null)
          {

            $menu.= '<a class="nav-link" href="'.site_url(url_title($data->getNombre())).'">';

          }else{

            $menu.= '<a class="nav-link" href="'.site_url(url_title(utf8_encode($parent[0]->getNombre())).'/'.url_title($data->getNombre())).'">';
          }

          $menu.= '<i class="'.$data->getIcono().'"></i> ';
          $menu.= '<span class="title">'.$data->getNombre().'</span>';
          $menu.= '</a>';
          $menu.= '</li>';

        }

        if($this->getMenuPanel($segment,$lang,$data->getId()) != null)
        {
          $menu.= '</ul>';
          $menu.= '</li>';
        }

      }

    }

    return $menu;
  }


}
