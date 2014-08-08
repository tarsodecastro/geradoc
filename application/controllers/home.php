<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public $css = array('style','demo_page','demo_table_jui','jquery-ui-1.8.11.custom');
	public $js = array('jquery-1.7.1.min','jquery.dataTables.min','home','jquery.blockUI','about');
	
		
	public function __construct (){
		parent::__construct();	
		$this->load->helper('url');		
		$this->load->library('session');
		$this->load->library('restrict_page');	
		$this->modal = $this->load->view('about_modal', '', TRUE);
	}
					
	public function index() {

		$this->load->view('home');			
	}
	
	
	
}

