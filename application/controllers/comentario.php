<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comentario extends CI_Controller {
	
	/*
	 * Atributos opcionais para as views
	* public $layout;  define o layout default
	* public $title; define o titulo default da view
	* public $css = array('css1','css2'); define os arquivos css default
	* public $js = array('js1','js2'); define os arquivos javascript default
	* public $images = 'dir_images'; define a diretório default das imagens
	*
	*/
	
	public $layout = 'default';
	public $css = array('style','jquery-ui-1.8.11.custom');
	public $js = array('jquery-1.11.1.min','jquery.dataTables.min','jquery.blockUI','about');
	public $js_custom;
	
    private $area = "comentario";
        
	public function __construct (){
		parent::__construct();	
		$this->load->library(array('restrict_page','table','form_validation','session'));
		$this->load->helper('url');
		$this->load->model('Comentario_model','',TRUE);
        $this->load->model('Grid_model','',TRUE);
        $this->load->model('Campo_model','',TRUE);
        $this->modal = $this->load->view('about_modal', '', TRUE);
        session_start();
	}
	
	public function add($id_doc) {
	
		$this->load->library(array('form_validation'));

		$data['mensagem'] = '';

	
		if ($this->form_validation->run($this->area."/add") == FALSE) {
			
			$_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
			
			redirect('documento/view/' . $id_doc);
			
			
		} else {
			
			//cria o objeto com os dados passados via post
			$objeto_do_form = array(
					
					'id_documento' => $id_doc,
					'id_usuario' => $this->session->userdata('id_usuario'),
					'data' => date("Y-m-d H:i:s"),
					'texto' => $this->input->post('campoComentario'),
			);
	
		
			// Salva o registro
			$this->Comentario_model->save($objeto_do_form);
			
			redirect('documento/view/' . $id_doc);
			
	
		}
	
	}
	

	function delete($id){
		// delete comentario
		$this->Comentario_model->delete($id);
		
		// redirect to comentario list page
		redirect('documento/view/' . $id_doc);
	}


	
}
?>