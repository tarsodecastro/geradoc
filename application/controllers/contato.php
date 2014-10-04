<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends CI_Controller {

	/*
	 * Atributos opcionais para as views
	 * public $layout;  define o layout default 
	 * public $title; define o titulo default da view
	 * public $css = array('css1','css2'); define os arquivos css default
	 * public $js = array('js1','js2'); define os arquivos javascript default
	 * public $images = 'dir_images'; define a diretório default das imagens
	 * public $js_custom = armazena os scripts js gerados pelo php e os coloca no head
	 *  
	 */	
	public $layout = 'default';
	public $css = array('style','demo_page','demo_table_jui','jquery-ui-1.8.11.custom');
	public $js = array('jquery-1.7.1.min','jquery.dataTables.min','jquery.blockUI','about', 'jquery.maskedinput-1.1.4.pack',);
	public $js_custom;
	
    private $area = "contato";
		
	public function __construct (){
		parent::__construct();			
		$this->load->helper('url');			
		$this->load->model('Contato_model','',TRUE);
		$this->load->model('Grid_model','',TRUE);
		$this->load->model('Campo_model','',TRUE);
		$this->load->library('session');
		$this->load->library('restrict_page');
		$this->modal = $this->load->view('about_modal', '', TRUE);
		session_start();
	}
	
	
	public function index(){
		
		$this->_checa_tabelas();
	
		$this->js[] = 'contato';
	
		$data['titulo']     = 'Remetentes';
		$data['link_add']   = anchor($this->area.'/add/','<span class="glyphicon glyphicon-plus"></span> Adicionar',array('class'=>'btn btn-primary btn-sm'));
		$data['link_back']  = anchor('documento/index/','Lista de Documentos',array('class'=>'back'));
		$data['form_action'] = site_url($this->area.'/search');
	
		// BUSCA
		$data['keyword_'.$this->area] = '';
		if(isset($_SESSION['keyword_'.$this->area]) == true and $_SESSION['keyword_'.$this->area] != null){
			$data['keyword_'.$this->area] = $_SESSION['keyword_'.$this->area];
			redirect($this->area.'/search/');
		}else{
			$data['keyword_'.$this->area] = 'pesquisa textual';
			$data['link_search_cancel'] = '';
		}
		// FIM DA BUSCA
	
		//Inicio da Paginacao
		$this->load->library('pagination');
		$maximo = 10;
		$uri_segment = 3;
		$inicio = (!$this->uri->segment($uri_segment, 0)) ? 0 : ($this->uri->segment($uri_segment, 0) - 1) * $maximo;
		//$_SESSION['novoinicio'] = $this->uri->segment($uri_segment, 0);  //cria uma variavel de sessao para retornar a pagina correta apos visualizacao, delecao ou alteracao
		$_SESSION['novoinicio'] = current_url();
		$config['base_url'] = site_url($this->area.'/index/');
		$config['total_rows'] = $this->Contato_model->count_all();
		$config['per_page'] = $maximo;
	
		$this->pagination->initialize($config);
	
		// load datas
		$objetos = $this->Contato_model->get_paged_list($maximo, $inicio)->result();
	
		// carregando os dados na tabela
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Item', 'Nome', 'Setor', 'Ações');
		foreach ($objetos as $objeto){
			$this->table->add_row($objeto->id, $objeto->nome, $this->_get_setor($objeto->setor),
					
					'<div class="btn-group">'.
						$this->Campo_model->make_link($this->area, 'visualizar', $objeto->id).
						$this->Campo_model->make_link($this->area, 'alterar_sm', $objeto->id).
					'</div>'
					
					
					//anchor($this->area.'/view/'.$objeto->id,'visualizar',array('class'=>'view')).' '.
					//anchor($this->area.'/update/'.$objeto->id,'alterar',array('class'=>'update'))
					//  anchor($this->area.'/delete/'.$objeto->id,'deletar',array('class'=>'delete','onclick'=>"return confirm('Deseja REALMENTE deletar esse contato?')"))
			);
		}
	
		//Monta a DataTable
		$tmpl = $this->Grid_model->monta_tabela_list();
		$this->table->set_template($tmpl);
		// Fim da DataTable
	
		$data['table'] = $this->table->generate();
		$data["total_rows"] = $config['total_rows'];
		$data['pagination'] = $this->pagination->create_links();
	
		$this->load->view($this->area.'/'.$this->area.'_list', $data);
	
	}
	
	public function add() {
	
		//$this->js[] = '';
	
		$this->load->library(array('form_validation'));
		$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
	
		$data['titulo'] = 'Novo Remetente';
		
		$data['disabled'] = '';
		$data['link_back']  = $this->Campo_model->make_link($this->area, 'voltar');
		$data['link_cancelar'] = $this->Campo_model->make_link($this->area,'cancelar');
		$data['link_salvar'] = $this->Campo_model->make_link($this->area,'salvar');
		
		$data['form_action'] = site_url($this->area.'/add/');
		$data['mensagem'] = '';
	
		//constroe os campos que serao mostrados no formulario
		$this->load->model('Campo_model','',TRUE);
		$data['campoNome'] = $this->Campo_model->contato('campoNome');
		$data['campoAssinatura'] = $this->Campo_model->contato('campoAssinatura');
		$data['campoFone'] = $this->Campo_model->contato('campoFone');
		$data['campoCelular'] = $this->Campo_model->contato('campoCelular');
		$data['campoFax'] = $this->Campo_model->contato('campoFax');
		$data['campoMail1'] = $this->Campo_model->contato('campoMail1');
		$data['campoMail2'] = $this->Campo_model->contato('campoMail2');
		$data['campoSexo'] = $this->Campo_model->contato('campoSexo');
		$data['sexosDisponiveis'] = $this->Campo_model->contato('arraySexos');
		$data['sexoSelecionado']  = 'M';
		$data['campoStatus'] = $this->Campo_model->contato('campoStatus');
		$data['statusDisponiveis'] = $this->Campo_model->contato('arrayStatus');
		$data['statusSelecionado']  = 'A';
		
		$data['campoCargo'] = $this->Campo_model->contato('campoCargo');
		//carrega os cargos
		$this->load->model('Cargo_model','',TRUE);
		$cargos = $this->Cargo_model->list_all()->result();
		$arrayCargos[0] = "SELECIONE";
		if($cargos){
			foreach ($cargos as $cargo){
				$arrayCargos[$cargo->id] = $cargo->nome;
			}
		}else{
			$arrayCargos[1] = "";
		}
		$data['cargosDisponiveis']  =  $arrayCargos;
		$data['cargoSelecionado'] = $this->input->post('campoCargo') ? $this->input->post('campoCargo') : 0;
		//fim dos cargos
		
		$data['campoSetor'] = $this->Campo_model->contato('campoSetor');
		//carrega os setores
		$this->load->model('Setor_model','',TRUE);
		$setores = $this->Setor_model->list_all()->result();
		$arraySetores[0] = "SELECIONE";
		if($setores){
			foreach ($setores as $setor){
				$arraySetores[$setor->id] = $setor->nome;
			}
		}else{
			$arraySetores[1] = "";
		}
		$data['setoresDisponiveis']  =  $arraySetores;
		$data['setorSelecionado'] = $this->input->post('campoSetor') ? $this->input->post('campoSetor') : 0;
		//fim dos setores
		

		if ($this->form_validation->run($this->area."/add") == FALSE) {
			
			$this->load->view($this->area . "/" . $this->area.'_edit', $data);
			
		} else {
			
			//cria o objeto com os dados passados via post
	
			$objeto_do_form = array(
					'nome' 		 => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
					'sexo' 		 => mb_convert_case($this->input->post('campoSexo'), MB_CASE_UPPER, "UTF-8"),
					'cargo' 	 => $this->input->post('campoCargo'),
					'setor'		 => $this->input->post('campoSetor'),
					'fone' 		 => $this->input->post('campoFone'),
					'celular'	 => $this->input->post('campoCelular'),
					'fax' 		 => $this->input->post('campoFax'),
					'mail1'		 => $this->input->post('campoMail1'),
					'mail2' 	 => $this->input->post('campoMail2'), 
					'assinatura' => $this->input->post('campoAssinatura'),
					'status' 	 => $this->input->post('campoStatus'),
			);
	
			//checa a existencia de registro com o mesmo nome para evitar duplicatas
			$checa_duplicata = $this->Contato_model->get_by_nome($objeto_do_form['nome'])->num_rows();
	
			if ($checa_duplicata > 0){
	
				$data['mensagem'] = '<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> O registro já existe </div>';
	
				$this->load->view($this->area . "/" . $this->area.'_edit', $data);
	
			}else{
	
				// Salva o registro
				$this->Contato_model->save($objeto_do_form);
	
	
				$this->js_custom = 'var sSecs = 3;
                                function getSecs(){
                                    sSecs--;
                                    if(sSecs<0){ sSecs=59; sMins--; }
                                    $("#clock1").html(sSecs+" segundos...");
                                    setTimeout("getSecs()",1000);
                                    var s =  $("#clock1").html();
                                    if (s == "1 segundos..."){
                                        window.location.href = "' . site_url('/'.$this->area) . '";
                                    }
                                }
                                ';
	
	
				$data['mensagem'] = "<br /><br />Redirecionando em... ";
				$data['mensagem'] .= '<span id="clock1"> ' . "<script>setTimeout('getSecs()',1000);</script> </span>";
				$data['link1'] = '';
				$data['link2'] = '';
	
				$this->load->view('success', $data);
	
			}
	
		}
	
	}
	
	function view($id){
		
		self::update($id, 'disabled');
	
		/*
		$data['titulo'] = 'Detalhes do Remetente';
	
		$data['message'] = '';
	
		$data['link_back'] = anchor($this->area.'/index/'.$_SESSION['novoinicio'],'<span class="glyphicon glyphicon-arrow-left"></span> Voltar',array('class'=>'btn btn-warning btn-sm'));
		 
		$data['objeto'] = $this->Contato_model->get_by_id($id)->row();
		
		//echo $this->db->last_query();

		$data['objeto']->setor = $this->_get_setor($data['objeto']->setor);
	
		$data['objeto']->cargo = $this->_get_cargo($data['objeto']->cargo);
		 
		switch ($data['objeto']->sexo) {
			case "M":
				$data['objeto']->sexo = "MASCULINO";
				break;
			case "2":
				$data['objeto']->sexo = "FEMININO";
				break;
		}
	
		$this->load->view($this->area.'/'.$this->area.'_view', $data);
		*/
	
	}
	
	public function update($id, $disabled = null) {
		
		$this->load->library(array('form_validation'));
		
		$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
	
		$data['titulo'] = 'Edição';
		
		$data['disabled'] = ($disabled != null) ? 'disabled' : '';
		$data['link_back'] = $this->Campo_model->make_link($this->area, 'voltar');
		$data['link_cancelar'] = $this->Campo_model->make_link($this->area, 'cancelar');
		$data['link_salvar'] = $this->Campo_model->make_link($this->area, 'salvar');
		$data['link_update'] = $this->Campo_model->make_link($this->area, 'alterar', $id);
		$data['link_update_sm'] = $this->Campo_model->make_link($this->area, 'alterar_sm', $id);
		
		$data['form_action'] = site_url($this->area.'/update/'.$id);
		$data['mensagem'] = '';
		
		$obj = $this->Contato_model->get_by_id($id)->row();
		
		//--- Construcao dos campos ---//
		//constroe os campos que serao mostrados no formulario
		$this->load->model('Campo_model','',TRUE);
		$data['campoNome'] = $this->Campo_model->contato('campoNome');
		$data['campoNome']['value'] = $obj->nome;
		
		$data['campoAssinatura'] = $this->Campo_model->contato('campoAssinatura');
		$data['campoAssinatura']['value'] = $obj->assinatura;
		
		$data['campoFone'] = $this->Campo_model->contato('campoFone');
		$data['campoFone']['value'] = $obj->fone;
		
		$data['campoCelular'] = $this->Campo_model->contato('campoCelular');
		$data['campoCelular']['value'] = $obj->celular;
		
		$data['campoFax'] = $this->Campo_model->contato('campoFax');
		$data['campoFax']['value'] = $obj->fax;
		
		$data['campoMail1'] = $this->Campo_model->contato('campoMail1');
		$data['campoMail1']['value'] = $obj->mail1;
		
		$data['campoMail2'] = $this->Campo_model->contato('campoMail2');
		$data['campoMail2']['value'] = $obj->mail2;
		
		$data['campoSexo'] = $this->Campo_model->contato('campoSexo');		
		$data['sexosDisponiveis'] = $this->Campo_model->contato('arraySexos');
		$data['sexoSelecionado']  = $obj->sexo;
		
		$data['campoStatus'] = $this->Campo_model->contato('campoStatus');
		$data['statusDisponiveis'] = $this->Campo_model->contato('arrayStatus');
		$data['statusSelecionado']  = $obj->status;
		
		$data['campoCargo'] = $this->Campo_model->contato('campoCargo');
		//carrega os cargos
		$this->load->model('Cargo_model','',TRUE);
		$cargos = $this->Cargo_model->list_all()->result();
		$arrayCargos[0] = "SELECIONE";
		if($cargos){
			foreach ($cargos as $cargo){
				$arrayCargos[$cargo->id] = $cargo->nome;
			}
		}else{
			$arrayCargos[1] = "";
		}
		$data['cargosDisponiveis']  =  $arrayCargos;
		$data['cargoSelecionado'] = $this->input->post('campoCargo') ? $this->input->post('campoCargo') : $obj->cargo;
		//fim dos cargos
		
		$data['campoSetor'] = $this->Campo_model->contato('campoSetor');
		//carrega os setores
		$this->load->model('Setor_model','',TRUE);
		$setores = $this->Setor_model->list_all()->result();
		$arraySetores[0] = "SELECIONE";
		if($setores){
			foreach ($setores as $setor){
				$arraySetores[$setor->id] = $setor->nome;
			}
		}else{
			$arraySetores[1] = "";
		}
		$data['setoresDisponiveis']  =  $arraySetores;
		$data['setorSelecionado'] = $this->input->post('campoSetor') ? $this->input->post('campoSetor') : $obj->setor;
		//fim dos setores
		
		//--- Fim da construcao dos campos ---//
		

		if ($this->form_validation->run($this->area."/add") == FALSE) {
			
			
			$this->load->view($this->area . "/" . $this->area.'_edit', $data);
			
			
		} else {
			//cria o objeto com os dados passados via post
	
			$objeto_do_form = array(
					'nome' 		 => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
					'sexo' 		 => mb_convert_case($this->input->post('campoSexo'), MB_CASE_UPPER, "UTF-8"),
					'cargo' 	 => $this->input->post('campoCargo'),
					'setor'		 => $this->input->post('campoSetor'),
					'fone' 		 => $this->input->post('campoFone'),
					'celular'	 => $this->input->post('campoCelular'),
					'fax' 		 => $this->input->post('campoFax'),
					'mail1'		 => $this->input->post('campoMail1'),
					'mail2' 	 => $this->input->post('campoMail2'), 
					'assinatura' => $this->input->post('campoAssinatura'),	
					'status'     => $this->input->post('campoStatus'),
			);
			
			
			//checa a existencia de registro com o mesmo nome para evitar duplicatas
			$checa_duplicata = $this->Contato_model->get_by_nome($objeto_do_form['nome'])->num_rows();
	
			if ($checa_duplicata > 1){
	
				$data['mensagem'] = '<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> O registro já existe </div>';
	
				$this->load->view($this->area . "/" . $this->area.'_edit', $data);
	
			}else{
			
				// Atualiza o cadastro
				$this->Contato_model->update($id, $objeto_do_form);
	
				$this->js_custom = 'var sSecs = 3;
                                function getSecs(){
                                    sSecs--;
                                    if(sSecs<0){ sSecs=59; sMins--; }
                                    $("#clock1").html(sSecs+" segundos...");
                                    setTimeout("getSecs()",1000);
                                    var s =  $("#clock1").html();
                                    if (s == "1 segundos..."){
                                        window.location.href = "' . site_url('/'.$this->area) . '";
                                    }
                                }
                                ';
	
	
				$data['mensagem'] = "<br /><br />Redirecionando em... ";
				$data['mensagem'] .= '<span id="clock1"> ' . "<script>setTimeout('getSecs()',1000);</script> </span>";
				$data['link1'] = '';
				$data['link2'] = '';
	
				$this->load->view('success', $data);
	
			}
	
		}
	
	}

public function search($page = 1) { 
    	$this->js[] = 'contato';
        $data['titulo'] = "Busca por remetentes";
        $data['link_add']   = $this->Campo_model->make_link($this->area, 'add');
        $data['link_search_cancel'] = $this->Campo_model->make_link($this->area, 'search_cancel');
        $data['form_action'] = site_url($this->area.'/search');

        $this->load->library(array('pagination', 'table'));
        
        if(isset($_SESSION['keyword_'.$this->area]) == true and $_SESSION['keyword_'.$this->area] != null and $this->input->post('search') == null){
        	$keyword = $_SESSION['keyword_'.$this->area];
        }else{
        	
        	$keyword = ($this->input->post('search') == null or $this->input->post('search') == "pesquisa textual") ? redirect($this->area.'/index/') : $this->input->post('search');
        	$_SESSION['keyword_'.$this->area] = $keyword;
        	
        }
        
        $maximo = 10;  
        $uri_segment = 3;   
        $config['per_page'] = $maximo;    
        $config['base_url'] = site_url($this->area.'/search');
        $config['total_rows'] = $this->Contato_model->count_all_search($keyword);           
        
        $this->pagination->initialize($config);     
        $data['pagination'] = $this->pagination->create_links();
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Item', 'Nome', 'Setor', 'Ações');
        
        $inicio = (!$this->uri->segment($uri_segment, 0)) ? 0 : ($this->uri->segment($uri_segment, 0) - 1) * $maximo;

        $rows = $this->Contato_model->listAllSearchPag($keyword, $maximo, $inicio);   
            
        foreach ($rows as $o){

            $this->table->add_row($o->id,  $o->nome, $this->_get_setor($o->setor),
            		
            		'<div class="btn-group">'.
	            		$this->Campo_model->make_link($this->area, 'visualizar', $o->id).
	            		$this->Campo_model->make_link($this->area, 'alterar_sm', $o->id).
            		'</div>'
            		
               // anchor($this->area.'/view/'.$o->id,'visualizar',array('class'=>'view')).' '.
               // anchor($this->area.'/update/'.$o->id,'alterar',array('class'=>'update'))
              //  anchor($this->area.'/delete/'.$objeto->id,'deletar',array('class'=>'delete','onclick'=>"return confirm('Deseja REALMENTE deletar esse contato?')"))
            );
        }
        
        //Monta a DataTable
        $tmpl = $this->Grid_model->monta_tabela_list();
        $this->table->set_template($tmpl);
        // Fim da DataTable

        $data['table'] = $this->table->generate();
        $data['total_rows'] = $config['total_rows'];
        $data['keyword_'.$this->area] = $keyword;    
                
        $this->load->view($this->area.'/'.$this->area.'_list', $data); 

    }
    
    public function search_cancel() {
    
    	$_SESSION['keyword_'.$this->area] = null;
    
    	redirect($this->area.'/index/');
    
    }
	
    function _get_setor($id_setor){
    
    	$this->load->model('Setor_model','',TRUE);
    	$obj = $this->Setor_model->get_by_id($id_setor)->row();
    	
    	if($obj){
    	 
    		$setor = "$obj->sigla/$obj->setorPaiSigla";
    		
    	}else{
    		$setor = "NENHUM";
    	}
    	 
    	return $setor;
    
    }
    
    
    function _get_cargo($id_cargo){
    
    	$this->load->model('Cargo_model','',TRUE);
    	$obj = $this->Cargo_model->get_by_id($id_cargo)->row();
    	 
    	if($obj){
    
    		$cargo = "$obj->nome";
    
    	}else{
    		$cargo = "NENHUM";
    	}
    
    	return $cargo;
    
    }
    
    function _checa_tabelas(){
    	 
    	$data['message'] = '';
       		
    	$this->load->model('Orgao_model','',TRUE);
    	if($this->Orgao_model->count_all() == 0){
    		$data['message'] .= 'Nenhum órgão cadastrado. Cadastre um.<br>';
    	}
    		
    	$this->load->model('Setor_model','',TRUE);
    	if($this->Setor_model->count_all() == 0){
    		$data['message'] .= 'Nenhum setor cadastrado. Cadastre um.<br>';
    	}
    		
    	$this->load->model('Cargo_model','',TRUE);
    	if($this->Cargo_model->count_all() == 0){
    		$data['message'] .= 'Nenhum cargo cadastrado. Cadastre um.<br>';
    	}
    		
    	$_SESSION['message'] = $data['message'];
    		
    	if($data['message'] != ''){
			redirect('documento/erro_tabelas/');
		}
    		
    }
    
    function erro_tabelas(){
    
    	$data['titulo'] = 'Erro';
    
    	$data['message'] = $_SESSION['message'];
    
    	$data['link_back'] = '';
    
    	$this->load->view('erro', $data);
    
    }

	
}

?>
