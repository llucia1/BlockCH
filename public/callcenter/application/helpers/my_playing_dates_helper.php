<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**
 * date1	start date
 * date2	finish date
 * return	number of days between the two dates
 */
if ( ! function_exists('between_dates'))
{
	function between_dates($date1,$date2)
	{
		$days = 0;
		$days = (strtotime($date1)-strtotime($date2))/86400;
		//$days = abs($days); $days = floor($days);
		$days = $days = floor($days);
		return $days;
	}
}

/**
 * $days	num add days
 * date	    date add days
 * $format  date format , E: European, A: American or Q = MYSQL
 * return	new date
 */

if ( ! function_exists('add_days'))
{
	function add_days($days,$date,$format = 'E')
	{
		$date = strtotime( '+'.$days.' day',strtotime( $date ));

		switch ($format) {

			case 'E':

				$date = date("d-m-Y", $date);

				break;

			case 'A':

				$date = date("m-d-Y", $date);

				break;

			case 'Q':

				$date = date("Y-m-d", $date);

				break;

		}

		return $date;
	}
}

/**
 * $days	num subtract days
 * $date	    date subtract days
 * $format  date format , E: European, A: American or Q = MYSQL
 * return	new date
 */

if ( ! function_exists('subtract_days'))
{
	function subtract_days($days,$date,$format = 'E')
	{
		$date = strtotime( '-'.$days.' day',strtotime( $date ));

		switch ($format) {

			case 'E':

				$date = date("d-m-Y", $date);

				break;

			case 'A':

				$date = date("m-d-Y", $date);

				break;

			case 'Q':

				$date = date("Y-m-d", $date);

				break;

		}

		return $date;
	}
}

/**
 * $date	    date
 * $format  date format , European, American or Q = sql
 * return	new date
 */
if ( ! function_exists('format_date'))
{
	function format_date($date,$format = 'E')
	{


		switch ($format) {

			case 'E':

				$date = date("d-m-Y",strtotime($date));

				break;

			case 'A':

				$date = date("m-d-Y",strtotime($date));

				break;

			case 'Q':

				$date = date("Y-m-d",strtotime($date));

				break;

		}

		return $date;
	}
}

/**
 * $date1	    date
 * $date2	    date
 * $month	    $month
 * $year	    $year
 * $format  date format , European or American
 * return	0 if value equal. 1 if value higher, 2 if value less
 */
if ( ! function_exists('compare_dates'))
{
	function compare_dates($date1,$date2)
	{
		if(get_unix($date1) == get_unix($date2))
		{
			return 0;
		}

		if(get_unix($date1) > get_unix($date2))
		{
			return 1;
		}

		if(get_unix($date1) < get_unix($date2))
		{
			return 2;
		}
	}
}

/**
 * date	    date
 * $day	    date
 * $month	    $month
 * $year	    $year
 * $format  date format , European or American
 * return	value unix
 */
if ( ! function_exists('get_unix'))
{
	function get_unix($date)
	{
		$date = strtotime(date($date,time()));
		return $date;
	}
}

/* End of file my_playing_date_helper.php */
/* Location: helpers/my_playing_date_helper.php */
