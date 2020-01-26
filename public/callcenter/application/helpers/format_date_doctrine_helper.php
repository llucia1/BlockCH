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
 * date format for doctrine
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Benjamín García
 */

// ------------------------------------------------------------------------

if ( !function_exists('formatDateDoct'))
{
	/**
	 *This function return the date format for doctrine
	 * @param	$str -> string
	 * @param	$pass -> password
	 * @param	$size -> size of pass
	 * @return	the generated password
	 */
	function formatDateDoct($date,$isTime=FALSE)
	{
        $dateFormat = str_replace('/','-',$date);
        if($isTime)
        {
            $dateFormat = DateTime::createFromFormat('d-m-Y H:i:s', $dateFormat);
            $dateFormat = $dateFormat->format('Y-m-d H:i:s');

        }else{

            $dateFormat = DateTime::createFromFormat('d-m-Y', $dateFormat);
            $dateFormat = $dateFormat->format('Y-m-d');
        }

		
		return $dateFormat;
		
	}
}

?>