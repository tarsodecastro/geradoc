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
	
	//$SIZE_LIMIT = 5368709120; // 5 GB // em bytes
	//$SIZE_LIMIT = 1073741824; // 1 GB // em bytes
	//$SIZE_LIMIT = 104857600; // 100 MB // em bytes
	//$SIZE_LIMIT = 10485760; // 10 MB
	
	
	//$config['max_size']	= '5120'; // 5 MB em Kb
	//$config['max_size']	= '1024'; // 1 MB em Kb
	
	public $size_limit = 10485760; // sem aspas e em bytes
	public $upload_limit = '5120'; // com aspas e em KB
	
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
		$this->load->model('Repositorio_model','',TRUE);
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
					$size = $this->foldersize($currentFile);
					$total_size += $size;
				}else {
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
	
	public function getUsuario ($id_usuario){
	
		$this->load->model('Usuario_model', '', TRUE);
		
		$usuario =  $this->Usuario_model->get_by_id($id_usuario)->row();
	
		return $usuario;
	}
	

	function index($id_pasta = 0){
		
		$folder = null;
		
		if($id_pasta != 0){
			$pasta = $this->Repositorio_model->get_by_id($id_pasta)->row();
			if($pasta){
				$folder = $pasta->arquivo;
			}
		}
		
			
		$this->js[] = 'repositorio';
		$data['titulo']     = 'Repositório';
		$data['link_add']   = $this->Campo_model->make_link($this->area, 'add');
		
		//constroe os campos que serao mostrados no formulario
		$this->load->model('Campo_model','',TRUE);
		$data['campoNome'] = $this->Campo_model->repositorio('campoNome');
		$data['campoDescricao'] = $this->Campo_model->repositorio('campoDescricao');

		$setor = $this->session->userdata('setor');		
		
		$raiz_do_setor =  './files/'.$setor;

		if (!file_exists($raiz_do_setor)) {
			mkdir($raiz_do_setor, 0700);
			copy('./files/index.html', $raiz_do_setor.'/index.html');
		}
		
		$data['repositorio'] = ($folder ==  null) ? $raiz_do_setor : $folder;
		
		//---------------------------------------------------------------------//
		//--- DEFINICAO DOS PARAMETROS
		//---------------------------------------------------------------------//
		
		$SIZE_LIMIT = $this->size_limit; // 10 MB
		$disk_used = $this->foldersize($raiz_do_setor);
		$disk_remaining = $SIZE_LIMIT - $disk_used;
	
		$data['porcentagem_ocupada'] = (($disk_used / $SIZE_LIMIT) * 100);
		$data['porcentagem_ocupada'] = round($data['porcentagem_ocupada'], 2);
		$data['cota'] = $this->format_size($SIZE_LIMIT);
		$data['cota_usada'] = $this->format_size($disk_used);
		$data['cota_restante'] = $this->format_size($disk_remaining);
		
		$data['erro'] = '';
		
		$config['upload_path'] = $data['repositorio'];
		
		$config['allowed_types'] = 'gif|jpg|jpeg|png|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|txt';
		$config['remove_spaces']	= TRUE;
		$config['max_size']	= $this->upload_limit;
		if($disk_used >= $SIZE_LIMIT){
			$data['erro'] = array('erro' => 'Você atingiu o limite de sua cota! Não é possível adicionar arquivos.');
			$config['max_size']	= '1';
		}

		
		//---------------------------------------------------------------------//
		//--- UPLOAD DOS ARQUIVOS
		//---------------------------------------------------------------------//
		
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
				
				//print_r($data['upload']);
				
				//echo $data['upload']['upload_data']['file_name'];
				
				//cria o objeto com os dados passados via post
				
				$objeto_do_form = array(
						'id_setor' => $setor,
						'id_usuario' => $this->session->userdata('id_usuario'),
						'id_pasta' => $id_pasta,
						'arquivo' => $data['repositorio'].'/'.$data['upload']['upload_data']['file_name'],
						'nome' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
						'descricao' => mb_convert_case($this->input->post('campoDescricao'), MB_CASE_UPPER, "UTF-8"),
						'data_criacao' =>  date('Y-m-d H:i:s'),
				);
				
				//print_r($objeto_do_form);
				// Salva o registro
				$this->Repositorio_model->save($objeto_do_form);
				
			}
		}
		
		
		//---------------------------------------------------------------------//
		//--- LISTAGEM DOS ARQUIVOS
		//---------------------------------------------------------------------//
		
		$map = directory_map($raiz_do_setor, 1);
		
		//$data['repositorio'] = ($folder ==  null) ? './files/'.$setor : './files/'.$setor.'/'.$folder;
		
		$objetos = $this->Repositorio_model->list_by_setor_folder($setor, $id_pasta)->result();
		
// 		if($folder ==  null){
// 			//$objetos = $this->Repositorio_model->list_by_setor($setor)->result();
// 			$objetos = $this->Repositorio_model->list_by_setor_folder($setor, $folder)->result();
// 		}else{
// 			//$folder = $data['repositorio'].'/'.$folder;
// 		//	echo $folder;
// 			$objetos = $this->Repositorio_model->list_by_setor_folder($setor, $folder)->result();
// 		}
		
		//print_r($objetos);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Arquivo','Tamanho','Nome', 'Descrição', 'Responsável', 'Ações');
		
		if($map != FALSE){
			
			$map = array_diff($map, array('index.html')); // esconde o arquivo index.html para que o usuario nao delete.
			
			//print_r($map);
			
			foreach ($objetos as $map_item){
				
				//$repositorio = str_replace("./", "", $data['repositorio']);
				
				$arquivo = $map_item->arquivo;

				$file_size = filesize($arquivo);
				$caminho_completo = base_url().'./'.$arquivo;
				
				$array_arquivo = explode('/', $arquivo);
				
				$arquivo = end($array_arquivo);

				$array_map_item = explode('.', $arquivo);
				
				$extensao = strtolower(end($array_map_item));

				$link = '<i class="cus-page"></i> <a href="'.$caminho_completo.'" target="_blank">'.$arquivo.'</a>';

				if($extensao == strtolower($arquivo)){
					//$link = '<i class="cus-picture"></i> <a href="#" id="pop" data-toggle="modal" data-img-url="'.$caminho_completo.'">'.$map_item.'</a>';
					$link = '<i class="cus-folder"></i> <a href="'.site_url().'/'.$this->area.'/index/'.$map_item->id.'" target="_self">'.$arquivo.'</a>';
				}
				
				if($extensao == 'png' || $extensao == 'jpg' || $extensao == 'gif'){
					//$link = '<i class="cus-picture"></i> <a href="#" id="pop" data-toggle="modal" data-img-url="'.$caminho_completo.'">'.$map_item.'</a>';
					$link = '<i class="cus-picture"></i> <a href="'.$caminho_completo.'" target="_blank">'.$arquivo.'</a>';
				}
				
				if($extensao == 'pdf'){
					$link = '<i class="cus-page_white_acrobat"></i> <a href="'.$caminho_completo.'" target="_blank">'.$arquivo.'</a>';
				}
				
				if($extensao == 'txt'){
					$link = '<i class="cus-page_white_text"></i> <a href="'.$caminho_completo.'" target="_blank">'.$arquivo.'</a>';
				}
				
				if($extensao == 'doc' || $extensao == 'docx'){
					$link = '<i class="cus-page_word"></i> <a href="'.$caminho_completo.'">'.$arquivo.'</a>';
				}

				if($extensao == 'xls' || $extensao == 'xlsx'){
					$link = '<i class="cus-page_excel"></i> <a href="'.$caminho_completo.'">'.$arquivo.'</a>';
				}
				
				if($extensao == 'ppt' || $extensao == 'pptx'){
					$link = '<i class="cus-page_white_powerpoint"></i> <a href="'.$caminho_completo.'">'.$arquivo.'</a>';
				} 
				
				if($extensao == 'zip' || $extensao == 'rar'){
					$link = '<i class="cus-compress"></i> <a href="'.$caminho_completo.'">'.$arquivo.'</a>';
				}
				
				$nome_usuario = $this->getUsuario($map_item->id_usuario)->nome;

				$this->table->add_row(
						$link,
						$this->format_size($file_size),
						$map_item->nome,
						$map_item->descricao,
						$nome_usuario,
						'<div class="btn-group">
							'. anchor($this->area.'/update/'.$map_item->id,'<i class="cus-pencil"></i> Alterar', array('class'=>'btn btn-default btn-sm')) .'
							'. anchor($this->area.'/delete/'.$map_item->id,'<i class="cus-cancel"></i> Deletar', array('class'=>'btn btn-default btn-sm')) .'
						</div>'
				);
			}
		}
		
		$tmpl = $this->Grid_model->monta_tabela_list();
		
		$this->table->set_template($tmpl);
		
		$data['table'] = $this->table->generate();
		//--- Fim da listagem dos arquivos ---//
		
		
		$id_pasta = $this->uri->segment(3);
		$data['form_action'] = ($folder ==  null) ? site_url()."/repositorio" : site_url()."/repositorio".'/index/'.$id_pasta;
		
		$data['form_action_folder'] = ($folder ==  null) ? site_url()."/repositorio/folder_add" : site_url()."/repositorio".'/folder_add/'.$id_pasta;
		
		//echo "<br>";
		//echo $data['form_action'];
		
		
		//--- breadcrumb ---//
		
		
		$data['breadcrumb'] = '<ol class="breadcrumb">
								  <li><a href="'.site_url().'/repositorio"><i class="cus-house"></i> Home</a></li>';
		
		
		if($id_pasta != 0){
			
			$pasta = $this->Repositorio_model->get_by_id($id_pasta)->row();
			
			$caminho = $pasta->arquivo;
			
			$caminho = str_replace($raiz_do_setor, "", $pasta->arquivo);
			
			$array_caminho = explode('/', $caminho);
			
			$array_caminho = array_filter($array_caminho);

			foreach ($array_caminho as $item){
				
				$pasta = $this->Repositorio_model->get_by_nome($item)->row();
				
				$data['breadcrumb'] .= '<li><a href="'.site_url().'/repositorio/index/'.$pasta->id.'" class="active">'.$pasta->nome.'</a></li>';
				
			}
			
		}
		
		$data['breadcrumb'] .= '</ol>';
		
		$this->load->view($this->area.'/'.$this->area.'_list', $data);
	}
	
	function delete($id){
		
		$obj = $this->Repositorio_model->get_by_id($id)->row();
	
		$path = $obj->arquivo; // arquivo ou pasta
		
		if (is_dir($path) === true){
				

			foreach(scandir($path) as $file) {
					
				if(count(scandir($path)) == 3 and $file == 'index.html') {
					unlink("$path/$file");
				}
				
			}
			
			if (!rmdir($path)){
					
				$mensagem =  "Erro ao deletar $path";
					
			}else{
			
				$this->Repositorio_model->delete($id);
					
				$mensagem =  "Pasta deletada";
				
			}
			
			/*
				$erro = false;
				
				foreach(scandir($path) as $file) {
					
					if ('.' === $file || '..' === $file) continue;
					
					if (is_dir("$path/$file")){
						
						$erro = true;
	
					}else {
						unlink("$path/$file");
					}
				}
				
				if($erro == true){
					
					echo "A pasta selecionada possui pelo menos outra pasta.";
					
					exit;
					
				}else{
				
	 				if (!rmdir($path)){
					
						echo "Erro ao deletar $path";
					
					}else{
						
						$this->Repositorio_model->delete($id);
					
						echo "Pasta deletada";
					
	 				}
				}
				*/
			
		}else if (is_file($path) === true){
			
        	if (!unlink($path)){
        	
        		$mensagem = "Erro ao deletar $path";
        	
        	}else{
        			
        		$this->Repositorio_model->delete($id);
        	
        		$mensagem = "Arquivo deletado";
        	
        	}

    	}
    	
    	///$_SESSION['mensagem'] = $mensagem;

    	//redirect($this->area.'/index/'.$obj->id_pasta);
	}
	
	
	function folder_add($id_pasta = 0){
		
		$folder = '';
		if($id_pasta != 0){
			$pasta = $this->Repositorio_model->get_by_id($id_pasta)->row();
			if($pasta){
				$folder = $pasta->arquivo;
			}
		}
		
		//echo "folder = $folder";
		
		//exit;
		

		$setor = $this->session->userdata('setor');
		
		if($id_pasta == 0){
			$repositorio = './files/'.$setor;
		}else{
			$repositorio = $folder;
		}
	
		$nova_pasta = $repositorio.'/'.mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8");
		
		$objeto_do_form = array(
				'id_setor' => $setor,
				'id_usuario' => $this->session->userdata('id_usuario'),
				'id_pasta' => $id_pasta,
				'arquivo' => $nova_pasta,
				'nome' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
				'descricao' => mb_convert_case($this->input->post('campoDescricao'), MB_CASE_UPPER, "UTF-8"),
				'data_criacao' =>  date('Y-m-d H:i:s'),
		);
		
		$this->Repositorio_model->save($objeto_do_form);
		
		if (!file_exists($nova_pasta)) {
			mkdir($nova_pasta, 0700);
			copy('./files/index.html', $nova_pasta.'/index.html');
		}
		
		redirect($this->area.'/index/'.$id_pasta);

	}
	
	
}
?>