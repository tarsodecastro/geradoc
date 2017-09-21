<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

	class Utilities {	

		public function __construct(){
	
		}


    	public function get_icone_comentario ($id_doc){
    	
    		$CI =& get_instance();
    		$CI->load->model('Comentario_model', '', TRUE);
    		$CI->load->library('session');
    	
    		$comentarios = $CI->Comentario_model->lista_comentarios_por_documento($id_doc)->result();
    			
    		$icone = '';
    			
    		if(count($comentarios) > 0){
    				
    			$checa = $CI->Comentario_model->checa_comentario_visto($comentarios[0]->id, $CI->session->userdata('id_usuario'))->result();
    	
    			if(count($checa) > 0){
    					
    				$icone = '<a href='.site_url('/documento/view/' . $id_doc).'><i class=\'fa fa-comments-o fa-lg\' style=\'color: #b3cccc;\'></i></a>';
    					
    			}else{
    					
    				$icone = '<a href='.site_url('/documento/view/' . $id_doc).'><i class=\'fa fa-comments-o fa-lg\' style=\'color: #3399ff;\'></i></a>';
    			}
    	
    		}
    	
    		return $icone;
    	
    	}

	}
?>