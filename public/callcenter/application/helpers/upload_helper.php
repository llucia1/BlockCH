<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Benjamín García
 *
 * @package	CodeIgniter
 * @author	Benjamín García
 * @copyright	Benjamín García
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link
 * @since	Version 1.0.0


/**
 * it simplify the upload
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Benjamín García
 */

// ------------------------------------------------------------------------

if ( !function_exists('upload'))
{
	/**
	 *This simplify the upload
	 * @param	$str -> string
	 * @param	$pass -> password
	 * @param	$size -> size of pass
	 * @return	the generated password
	 */
	function upload($name,$folder,$w,$h,$s)
	{
        $CI =& get_instance();

        $config['upload_path'] = 'assets/'.$folder;
        $config['allowed_types'] = '*';
        $config['max_size']     = $s;
        $config['max_width'] = $w;
        $config['max_height'] = $h;
        $config['overwrite'] = FALSE;
        //cargamos la libreria
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if($CI->upload->do_upload($name)) {

            $data_image = $CI->upload->data();
            $upload_data = array(
                'upload' => TRUE,
                'res' => $data_image['file_name'],
            );

        }else {

            $upload_data = array(
                'upload' => FALSE,
                'res' => $CI->upload->display_errors(),
            );
        }

        return $upload_data;
		
	}
}

?>