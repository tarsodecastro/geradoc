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
	
	
	function foldersize($path) {
		$total_size = 0;
		$files = scandir($path);
		$cleanPath = rtrim($path, '/'). '/';
	
		foreach($files as $t) {
			if ($t<>"." && $t<>"..") {
				$currentFile = $cleanPath . $t;
				if (is_dir($currentFile)) {
					$size = foldersize($currentFile);
					$total_size += $size;
				}
				else {
					$size = filesize($currentFile);
					$total_size += $size;
				}
			}
		}
	
		return $total_size;
	}
	
	
	function format_size($size) {
		$units = explode(' ', 'B KB MB GB TB PB');
	
		$mod = 1024;
	
		for ($i = 0; $size > $mod; $i++) {
			$size /= $mod;
		}
	
		$endIndex = strpos($size, ".")+3;
	
		return substr( $size, 0, $endIndex).' '.$units[$i];
	}
	

	function index(){
			
		$this->js[] = 'repositorio';
		$data['titulo']     = 'Repositório';
		$data['link_add']   = $this->Campo_model->make_link($this->area, 'add');
		
		$setor = $this->session->userdata('setor');
		
		$data['repositorio'] = './files/'.$setor;
		
		if (!file_exists($data['repositorio'])) {
			mkdir($data['repositorio'], 0700);
			copy('./files/index.html', $data['repositorio'].'/index.html');
		}
		
		//tamanho do repositorio
// 		$f = $data['repositorio'];
// 		$io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
// 		$size = fgets ( $io, 4096);
// 		$size = substr ( $size, 0, strpos ( $size, "\t" ) );
// 		pclose ( $io );
		//echo 'Directory: ' . $f . ' => Size: ' . $size;
		
		//$units = explode(' ', 'B KB MB GB TB PB'); // em bytes
		//$SIZE_LIMIT = 5368709120; // 5 GB // em bytes
		//$SIZE_LIMIT = 1073741824; // 1 GB // em bytes
		//$SIZE_LIMIT = 104857600; // 100 MB // em bytes
		//$SIZE_LIMIT = 10485760; // 10 MB
		$SIZE_LIMIT = 10485760; // 10 MB
		
		$disk_used = $this->foldersize($data['repositorio']);
		$disk_remaining = $SIZE_LIMIT - $disk_used;

		$data['porcentagem_ocupada'] = (($disk_used / $SIZE_LIMIT) * 100);
		$data['porcentagem_ocupada'] = round($data['porcentagem_ocupada'], 2);
		// fim
	
		$data['cota'] = $this->format_size($SIZE_LIMIT);
		$data['cota_usada'] = $this->format_size($disk_used);
		$data['cota_restante'] = $this->format_size($disk_remaining);
		
		$data['erro'] = '';
		
		$config['upload_path'] = $data['repositorio'];
		$config['allowed_types'] = 'gif|jpg|jpeg|png|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|txt';
		$config['remove_spaces']	= TRUE;
		//$config['max_size']	= '5120'; // 5 MB em Kb
		//$config['max_size']	= '1024'; // 1 MB em Kb
		$config['max_size']	= '5120';
		if($disk_used >= $SIZE_LIMIT){
			$data['erro'] = array('erro' => 'Você atingiu o limite de sua cota! Não é possível adicionar arquivos.');
			$config['max_size']	= '1';
		}
		
		if(!empty($_FILES)){

			// Get the original file name from $_FILES
			$file_name= $_FILES['userfile']['name'];
				
			// Remove any characters you dont want
			// The below code will remove anything that is not a-z or 0-9
			$file_name = preg_replace("/[^a-zA-Z0-9.]/", "", $file_name);
			
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
		$this->table->set_heading('Nome', 'Tamanho', 'Ações');
		
		if($map != FALSE){
			
			$map = array_diff($map, array('index.html')); // esconde o arquivo index.html para que o usuario nao delete.
			
			foreach ($map as $map_item){
				
				$repositorio = str_replace("./", "", $data['repositorio']);
				
				$caminho_completo = base_url().$repositorio.'/'.$map_item;
				
				$file_size = filesize($data['repositorio'].'/'.$map_item);
				
				$array_map_item = explode('.', $map_item);
				
				$extensao = strtolower(end($array_map_item));

				$link = '<i class="cus-page"></i> <a href="'.$caminho_completo.'" target="_blank">'.$map_item.'</a>';
				
				if($extensao == 'png' || $extensao == 'jpg' || $extensao == 'gif'){
					$link = '<i class="cus-picture"></i> <a href="#" id="pop" data-toggle="modal" data-img-url="'.$caminho_completo.'">'.$map_item.'</a>';
				}
				
				if($extensao == 'pdf'){
					$link = '<i class="cus-page_white_acrobat"></i> <a href="'.$caminho_completo.'" target="_blank">'.$map_item.'</a>';
				}
				
				if($extensao == 'doc' || $extensao == 'docx'){
					$link = '<i class="cus-page_word"></i> <a href="'.$caminho_completo.'">'.$map_item.'</a>';
				}
				
				if($extensao == 'xls' || $extensao == 'xlsx'){
					$link = '<i class="cus-page_excel"></i> <a href="'.$caminho_completo.'">'.$map_item.'</a>';
				}
				
				if($extensao == 'ppt' || $extensao == 'pptx'){
					$link = '<i class="cus-picture"></i> <a href="'.$caminho_completo.'">'.$map_item.'</a>';
				}
				
				if($extensao == 'zip' || $extensao == 'rar'){
					$link = '<i class="cus-compress"></i> <a href="'.$caminho_completo.'">'.$map_item.'</a>';
				}
				
				$this->table->add_row(
						
						$link,
						
						$this->format_size($file_size),
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