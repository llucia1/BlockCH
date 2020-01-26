<?php
class Ajax_action_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function update_data($table,$data,$id,$lang)
    {
        $no_isjoin = array('usuarios','publicaciones','publicidad','registros','cuentas','attachments','cuentasSeguimiento','calendario');

        if(in_array($table, $no_isjoin))
        {
            $this->db->where('id', $id);

        }else
        {
            $id_lang = $this->get_id_lang($lang);
            $this->db->where('is_join', $id);
            $this->db->where('id_language', $id_lang);
        }

        $this->db->update($table, $data);
        $this->db->close();
    }

    private function get_id_lang($iso)
    {

		$query = $this->db->get_where('languages',array('iso_language' => $iso));
		return $query->row()->id;
		$this->db->close();

    }

    public function updateDataDoctrine($entity,$field,$vl,$id)
    {
        $entity = $this->doctrine->em->getRepository("Entities\\".$entity)->find($id);
        $entity->{'set'.$field}($vl);
        $this->doctrine->em->flush();
    }

}
