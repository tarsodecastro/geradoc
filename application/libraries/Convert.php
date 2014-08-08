<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
	class Convert {	
		
		public function __construct(){

		}
		
		public function cpfToNum ($string_cpf){
			$cpf[0] = substr($string_cpf,0,1);
			$cpf[1] = substr($string_cpf,1,1);
			$cpf[2] = substr($string_cpf,2,1);
			$cpf[3] = substr($string_cpf,4,1);
			$cpf[4] = substr($string_cpf,5,1);
			$cpf[5] = substr($string_cpf,6,1);
			$cpf[6] = substr($string_cpf,8,1);
			$cpf[7] = substr($string_cpf,9,1);
			$cpf[8] = substr($string_cpf,10,1);
			$cpf[9] = substr($string_cpf,12,1);
			$cpf[10] = substr($string_cpf,13,1);			
			$cpf = "$cpf[0]"."$cpf[1]"."$cpf[2]"."$cpf[3]"."$cpf[4]"."$cpf[5]"."$cpf[6]"."$cpf[7]"."$cpf[8]"."$cpf[9]"."$cpf[10]";
			
			return $cpf;
		}
		
		
		public function arrayToObject($array){	
		  $object = new stdClass();
		  if (is_array($array) && count($array) > 0){	 
		  	foreach ($array as $name=>$value){	    
		      $name = strtolower(trim($name));
		      if (!empty($name)){	      
		        $object->$name = $value;
		      }
		    }
		  }
		  return $object;
		}
	
		public function objectToArray($object){	
		  $array = array();
		  if (is_object($object)){	  
		    $array = get_object_vars($object);
		  }
		  return $array;
		}
		
		
		
	}
?>