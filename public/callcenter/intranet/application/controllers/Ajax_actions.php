<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_actions extends CI_Controller {

	/**
	 Todas las funciones para que las acciones principales de ajax interactuen con la base de datos
	 */

	public function __construct()
	{

    	parent::__construct();
        $this->load->model('Ajax_action_model');

    }

	public function update_ajax()
	{
		if($this->input->is_ajax_request())
		{
			$field = $this->input->post('field');
			$table = $this->input->post('table');
			$vl = $this->input->post('vl');
			$id = $this->input->post('id');
			$lang = $this->input->post('lang');


			$data = array($field => $vl);
			if(isset($_POST['nodoctrine']))
			{
				$this->Ajax_action_model->update_data($table,$data,$id,$lang);

			}else{

				$field = ucfirst($this->input->post('field'));
				$table = ucfirst($this->input->post('table'));

				$this->Ajax_action_model->updateDataDoctrine($table,$field,$vl,$id);
			}
			
		}
		else
		{
			show_404();
		}
	}

    public function boolean_ajax()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            $vl = $this->input->post('vl');
            $entity = $this->input->post('entity');
            $field = $this->input->post('field');

            $ent = $this->doctrine->em->getRepository("Entities\\".$entity)->findOneBy(["id" => $id]);
            $ent->{'set'.$field}($vl);
            $this->doctrine->em->flush();
        }
        else
        {
            show_404();
        }
    }
}
