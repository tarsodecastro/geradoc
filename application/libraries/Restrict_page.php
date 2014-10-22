<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
	class Restrict_page {		
			
		public function __construct(){			
			$CI =& get_instance();			
			$CI->load->library('session');
			
		    if ( !($CI->session->userdata('login')) && !($CI->session->userdata('id_usuario')) ){
		   		redirect('login_mail/');
		    }
		}	
	}
?>