<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repositorio extends CI_Controller {
	
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
	public $css = array('style');
	public $js = array('jquery-1.11.1.min','jquery.dataTables.min','jquery.blockUI','about');
	public $js_custom;
	
    private $area = "repositorio";
        
	public function __construct (){
		parent::__construct();	
		$this->load->library(array('restrict_page','table','form_validation','session'));
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('directory');
        $this->load->model('Grid_model','',TRUE);
        $this->load->model('Campo_model','',TRUE);
        $this->modal = $this->load->view('about_modal', '', TRUE);
        session_start();
	}

	/*
	public function index($offset = 0){
		
		$this->js[] = 'repositorio';
		$data['titulo']     = 'Repositório';
		$data['link_add']   = $this->Campo_model->make_link($this->area, 'add');
		
		$setor = $this->session->userdata('setor');
		
		$data['repositorio'] = './files/'.$setor;

		$map = directory_map($data['repositorio'], 1);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Nome', 'Ações');
		
		if($map != FALSE){
			foreach ($map as $map_item){
	            $this->table->add_row($map_item,
	            	'<div class="btn-group">'.
	                $this->Campo_model->make_link($this->area, 'visualizar', $map_item).
	               	$this->Campo_model->make_link($this->area, 'alterar_sm', $map_item).
	              	'</div>'
	            );
	        }
		}
		
		$tmpl = $this->Grid_model->monta_tabela_list();
		
		$this->table->set_template($tmpl);
		
		$data['table'] = $this->table->generate();
		
		$data['erro'] = '';
		
        $this->load->view($this->area.'/'.$this->area.'_list', $data);

	}
	*/

	function index(){
			
		$this->js[] = 'repositorio';
		$data['titulo']     = 'Repositório';
		$data['link_add']   = $this->Campo_model->make_link($this->area, 'add');
		
		$setor = $this->session->userdata('setor');
		
		$data['repositorio'] = './files/'.$setor;
		
		if (!file_exists($data['repositorio'])) {
			mkdir($data['repositorio'], 0700);
		}
		
		
	
		$data['erro'] = '';

		
		if(!empty($_FILES)){
			
			$config['upload_path'] = $data['repositorio'];
			$config['allowed_types'] = 'gif|jpg|jpeg|png|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|txt';
			$config['max_size']	= '1024';
			$config['remove_spaces']	= TRUE;
			
			
			// Get the original file name from $_FILES
			$file_name= $_FILES['userfile']['name'];
				
			// Remove any characters you dont want
			// The below code will remove anything that is not a-z or 0-9
			$file_name = preg_replace("/[^a-zA-Z0-9.]/", "", $file_name);
			
		//	$_FILES['userfile']['name'] = $file_name;
			
			$config['file_name'] = $file_name;
			//$config['overwrite'] = false;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			

			if ( ! $this->upload->do_upload()){
	
				$data['erro'] = array('erro' => $this->upload->display_errors());
		
			}else{
				
				
				$data['upload'] = array('upload_data' => $this->upload->data());
	
				
			}
		}
		
		$map = directory_map($data['repositorio'], 1);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Nome', 'Ações');
		
		
		
		if($map != FALSE){
			foreach ($map as $map_item){
				
				$data['repositorio'] = str_replace("./", "", $data['repositorio']);
				$caminho = base_url().$data['repositorio'].'/'.$map_item;
				
				$this->table->add_row(
						'<a href="#" id="pop" data-toggle="modal" data-img-url="'.$caminho.'">'.$map_item.'</a>',
						'<div class="btn-group">
							'. anchor($this->area.'/delete/'.$map_item,'<i class="cus-cancel"></i> Deletar', array('class'=>'btn btn-default btn-sm')) .'
						</div>'
				);
			}
		}
		
		$tmpl = $this->Grid_model->monta_tabela_list();
		
		$this->table->set_template($tmpl);
		
		$data['table'] = $this->table->generate();
		
		
		$this->load->view($this->area.'/'.$this->area.'_list', $data);
	}
	
	function delete($arquivo){
		
		$setor = $this->session->userdata('setor');
		
		$data['repositorio'] = './files/'.$setor;
		
		unlink($data['repositorio'] . '/' . $arquivo);

		redirect($this->area);
	}
	
	
}
?>