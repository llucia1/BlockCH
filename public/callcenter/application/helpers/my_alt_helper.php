<?php
function alt($str)
{
	$str= strtolower($str); 
	$str = explode('.', $str);
	$str = $str[0];
	$alt = "";
	
	if(strpos($str, '-')){
		
		$str = explode('-', $str);
		
		foreach ($str as $key => $value) {
			
			$alt .= $value." ";
		}
		$alt = ucfirst($alt);
		
	}elseif(strpos($str, '_')){
		
		$str = explode('_', $str);
		
		foreach ($str as $key => $value) {
			
			$alt .= $value." ";
		}
		$alt = ucfirst($alt);
		
	}else{
		
		$alt = ucfirst($str);
	}
	
	$alt = trim($alt, ' ');
  	return $alt;
}
?>