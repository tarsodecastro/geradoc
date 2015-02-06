<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setor extends CI_Controller {
	
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
	public $js = array('jquery-1.7.1.min','jquery.dataTables.min','jquery.blockUI','about');
	public $js_custom;
	
    private $area = "setor";
        
	public function __construct (){
		parent::__construct();	
		$this->load->library(array('restrict_page','table','form_validation','session'));
		$this->load->helper('url');
		$this->load->model('Setor_model','',TRUE);
        $this->load->model('Grid_model','',TRUE);
        $this->load->model('Campo_model','',TRUE);
        $this->modal = $this->load->view('about_modal', '', TRUE);
        session_start();
	}

	public function index($offset = 0){
		
		$this->_checa_tabelas();
		
		$this->js[] = 'setor';
		
		
		$data['titulo']     = 'Setores';
		
		$data['link_add']   = $this->Campo_model->make_link($this->area, 'add');
		$data['link_back']  = $this->Campo_model->make_link($this->area, 'history_back');
		
		
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
       // $_SESSION['novoinicio'] = $this->uri->segment($uri_segment, 0);  //cria uma variavel de sessao para retornar a pagina correta apos visualizacao, delecao ou alteracao
        $_SESSION['novoinicio'] = current_url();
        $config['base_url'] = site_url($this->area.'/index/');
        $config['total_rows'] = $this->Setor_model->count_all();
        $config['per_page'] = $maximo;

        $this->pagination->initialize($config);

        // load datas
        $objetos = $this->Setor_model->get_paged_list($maximo, $inicio)->result();
        
        // carregando os dados na tabela
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Item', 'Sigla', 'Nome', 'Ações');
        foreach ($objetos as $objeto){
            $this->table->add_row($objeto->id, $objeto->sigla, $objeto->nome,
            	'<div class="btn-group">'.
                $this->Campo_model->make_link($this->area, 'visualizar', $objeto->id).
                $this->Campo_model->make_link($this->area, 'alterar_sm', $objeto->id).
            	$this->Campo_model->make_link($this->area, 'funcionarios', $objeto->id).
            	'</div>'
              //  anchor($this->area.'/delete/'.$objeto->id,'deletar',array('class'=>'delete','onclick'=>"return confirm('Deseja REALMENTE deletar esse setor?')"))
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
		
		$this->js[] = 'setor';
	
		$this->load->library(array('form_validation'));
		$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
	
		$data['titulo'] = 'Novo Setor';
		$data['disabled']     = '';
		
		$data['link_back']  = $this->Campo_model->make_link($this->area, 'voltar');
		$data['link_cancelar'] = $this->Campo_model->make_link($this->area,'cancelar');
		$data['link_salvar'] = $this->Campo_model->make_link($this->area,'salvar');
		
		$data['form_action'] = site_url($this->area.'/add/');
		$data['mensagem'] = '';
	
		//constroe os campos que serao mostrados no formulario
		$this->load->model('Campo_model','',TRUE);
		$data['campoNome'] = $this->Campo_model->setor('campoNome');
		$data['campoSigla'] = $this->Campo_model->setor('campoSigla');
		$data['campoEndereco'] = $this->Campo_model->setor('campoEndereco');
		$data['campoArtigo'] = $this->Campo_model->setor('campoArtigo');
		
		$data['campoTamanhoRepositorio'] = $this->Campo_model->setor('campoTamanhoRepositorio');
		$data['campoTamanhoRepositorio']['value'] = 104857600; // 104857600 = 100 MB
		
		$data['artigosDisponiveis'] = $this->Campo_model->setor('arrayArtigos');
		$data['artigoSelecionado']  = 'A';
		
		$data['campoRestricao'] = $this->Campo_model->setor('campoRestricao');
		$data['restricoesDisponiveis'] = $this->Campo_model->setor('arrayRestricoes');
		$data['restricaoSelecionada']  = 'N';
		
			
		//carrega os responsaveis
		//informa o banco a ser utilizado, no caso o sso
		//$this->load->database("sso", TRUE);
		$this->load->model('Usuario_model', '', TRUE);
		$responsaveis = $this->Usuario_model->list_all()->result();
		
		$arrayResponsaveis[0] = "SELECIONE";
		if($responsaveis){
			foreach ($responsaveis as $responsavel){
				$arrayResponsaveis[$responsavel->id] = mb_convert_case($responsavel->nome, MB_CASE_UPPER, "UTF-8");
			}
		}else{
			$arrayResponsaveis[1] = "";
		}
		$data['responsaveis']  =  $arrayResponsaveis;
		$data['responsavel'] = $this->input->post('campoResponsavel') ? $this->input->post('campoResponsavel') : 0;
		

		//retorna ao banco default
		$this->load->database("default", TRUE);
		//fim dos responsaveis
		

		
		//carrega os orgaos
		$orgaos = $this->Setor_model->list_all_orgaos()->result();
		$arrayOrgaos[0] = "SELECIONE";
		foreach ($orgaos as $orgao){
			$arrayOrgaos[$orgao->id] = $orgao->nome;
		}
		$arrayOrgaos[0] = "SELECIONE";
		$data['orgaosDisponiveis']  =  $arrayOrgaos;
		$data['orgaoSelecionado']   = $this->input->post('campoOrgao') ? $this->input->post('campoOrgao') : 0;
		$data['link_orgaos']        = anchor('orgao/index/','Órgão',array('class'=>'back'));
		//fim dos orgaos
		
		//carrega os setores
		$setores = $this->Setor_model->list_all()->result();
		$arraySetoresPai[0] = "SELECIONE";
		if($setores){
			foreach ($setores as $setorPai){
				$arraySetoresPai[$setorPai->id] = $setorPai->nome;
			}
		}else{
			$arraySetoresPai[1] = "";
		}
		$data['setoresPaiDisponiveis']  =  $arraySetoresPai;
		$data['setorPaiSelecionado'] = $this->input->post('campoSetorPai') ? $this->input->post('campoSetorPai') : 0;
		//fim dos setores
		
		if ($this->form_validation->run($this->area."/add") == FALSE) {
			$this->load->view($this->area . "/" . $this->area.'_edit', $data);
		} else {
			//cria o objeto com os dados passados via post

			if($this->input->post('campoFuncionarios') and $this->input->post('campoFuncionarios') != ''){
				$funcionarios = implode("|", $this->input->post('campoFuncionarios'));
			}
			
			//echo "funcionarios =". $funcionarios;
			
			$objeto_do_form = array(
					'nome' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
					'orgao' => $this->input->post('campoOrgao'),
					'setorPai' => $this->input->post('campoSetorPai'),
					'sigla' => mb_convert_case($this->input->post('campoSigla'), MB_CASE_UPPER, "UTF-8"),
					'endereco' => mb_convert_case($this->input->post('campoEndereco'), MB_CASE_UPPER, "UTF-8"),
					'artigo' => $this->input->post('campoArtigo'),
					'restricao' => $this->input->post('campoRestricao'),
					'dono' => $this->input->post('campoResponsavel'),
					'repositorio' => $this->input->post('campoTamanhoRepositorio'),
			);
			
			//OBS: se a tabela setor estiver vazia:
			if($this->Setor_model->count_all() == 0 or $objeto_do_form['setorPai'] == 0){
				$objeto_do_form['setorPai'] = '1';
			}
			//fim da OBS.
	
			//checa a existencia de registro com o mesmo nome para evitar duplicatas
			$checa_duplicata = $this->Setor_model->get_by_nome($objeto_do_form['nome'], $objeto_do_form['orgao'])->num_rows();
	
			if ($checa_duplicata > 0){
	
				$data['mensagem'] = '<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> O registro já existe </div>';
	
				$this->load->view($this->area . "/" . $this->area.'_edit', $data);
	
			}else{
	
				// Salva o registro
				$this->Setor_model->save($objeto_do_form);
	
				
				$this->js_custom = 'var sSecs = 4;
                                function getSecs(){
                                    sSecs--;
                                    if(sSecs<0){ sSecs=59; sMins--; }
                                    $("#clock1").html(sSecs+" segundos...");
                                    setTimeout("getSecs()",1000);
                                    var s =  $("#clock1").html();
                                    if (s == "1 segundos..."){
                                        window.location.href = "' .  $_SESSION['novoinicio'] . '";
                                    }
                                }
                                ';
	
				$data['mensagem'] = "<br /> Redirecionando em ";
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
		$data['titulo'] = 'Detalhes do setor';
		
        $data['message'] = '';
        
		$data['link_back'] = $this->Campo_model->make_link($this->area, 'voltar');
		
		$data['objeto'] = $this->Setor_model->get_by_id($id)->row();
		
		//echo $this->db->last_query();

		$this->load->view($this->area.'/'.$this->area.'_view', $data);
		*/

	}
	
public function update($id, $disabled = null) {
	
		$data['disabled'] = ($disabled != null) ? 'disabled' : '';
	
		// Instancia um objeto com o resultado da consulta
		$obj = $this->Setor_model->get_by_id($id)->row();
		
		//echo $this->db->last_query();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
			
		// define as variaveis comuns
		$data['titulo'] = "Edição de setor";
		$data['mensagem'] = '';
	
		$data['link_back'] = $this->Campo_model->make_link($this->area, 'voltar');
		$data['link_cancelar'] = $this->Campo_model->make_link($this->area, 'cancelar');
		$data['link_salvar'] = $this->Campo_model->make_link($this->area, 'salvar');
		$data['link_update'] = $this->Campo_model->make_link($this->area, 'alterar', $id);
		
		$data['form_action'] = site_url($this->area.'/update/'.$id);

		//Constroe os campos do formulario
		$this->load->model('Campo_model','',TRUE);
		$data['linkBack'] 				= 	$this->Campo_model->setor('campoNome');
		$data['campoNome'] 				= 	$this->Campo_model->setor('campoNome');
		$data['campoSigla'] 			= 	$this->Campo_model->setor('campoSigla');
		$data['campoTamanhoRepositorio'] = 	$this->Campo_model->setor('campoTamanhoRepositorio');
		$data['campoEndereco'] 			= 	$this->Campo_model->setor('campoEndereco');
		$data['artigosDisponiveis'] 	=  	$this->Campo_model->setor('arrayArtigos');
		$data['artigoSelecionado']   	= 	$obj->artigo;
		
		$data['restricoesDisponiveis'] 	=  	$this->Campo_model->setor('arrayRestricoes');
		$data['restricaoSelecionada']   = 	$obj->restricao;
		
		//carrega os responsaveis
		//informa o banco a ser utilizado, no caso o sso
		//$this->load->database("sso", TRUE);
		$this->load->model('Usuario_model', '', TRUE);
		$responsaveis = $this->Usuario_model->list_all()->result();
		
		$arrayResponsaveis[0] = "SELECIONE";
		if($responsaveis){
			foreach ($responsaveis as $responsavel){
				$arrayResponsaveis[$responsavel->id] = mb_convert_case($responsavel->nome, MB_CASE_UPPER, "UTF-8");
			}
		}else{
			$arrayResponsaveis[1] = "";
		}
		$data['responsaveis']  =  $arrayResponsaveis;
		
		
		$obj->dono = $obj->dono ? $obj->dono : 0;
		$data['responsavel'] = $this->input->post('campoResponsavel') ? $this->input->post('campoResponsavel') : $obj->dono;
		//$data['responsavel'] = $obj->dono;
		
		
		//retorna ao banco default
		$this->load->database("default", TRUE);
		//fim dos responsaveis
		
		//carrega os orgaos
		$orgaos = $this->Setor_model->list_all_orgaos()->result();
		foreach ($orgaos as $orgao){
			$arrayOrgaos[$orgao->id] = $orgao->sigla;
		}
		$data['orgaosDisponiveis']  =  $arrayOrgaos;
		$data['orgaoSelecionado'] = $obj->orgao;
		
		$data['link_orgaos']    = anchor('orgao/index/','Órgão',array('class'=>'back'));
		//fim dos orgaos
		
		//carrega os setores
		$setores = $this->Setor_model->list_all()->result();
		foreach ($setores as $setorPai){
			$arraySetoresPai[$setorPai->id] = $setorPai->nome;
		}
		$data['setoresPaiDisponiveis']  =  $arraySetoresPai;
		$data['setorPaiSelecionado'] = $obj->setorPai;
		//fim dos setores
		

		//Popula os campos com os dados do objeto
		$data['campoNome']['value'] = $obj->nome;
		$data['campoSigla']['value'] = $obj->sigla;
		$data['campoEndereco']['value'] = $obj->endereco;
		$data['campoTamanhoRepositorio']['value'] = $obj->repositorio;

		if ($this->form_validation->run($this->area."/add") == FALSE) {

			$this->load->view($this->area.'/'.$this->area.'_edit', $data);
				
		} else {

			//cria um objeto com os dados passados via post
			$objeto_do_form = array(
					'orgao' => $this->input->post('campoOrgao'),
					'setorPai' => $this->input->post('campoSetorPai'),
               		'nome' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
					'sigla' => mb_convert_case($this->input->post('campoSigla'), MB_CASE_UPPER, "UTF-8"),
					'repositorio' => $this->input->post('campoTamanhoRepositorio'),
					'artigo' => mb_convert_case($this->input->post('campoArtigo'), MB_CASE_UPPER, "UTF-8"),
					'restricao' => mb_convert_case($this->input->post('campoRestricao'), MB_CASE_UPPER, "UTF-8"),
					'endereco' => mb_convert_case($this->input->post('campoEndereco'), MB_CASE_UPPER, "UTF-8"),
					'dono' => $this->input->post('campoResponsavel'),
					//'funcionarios' => implode("|", $this->input->post('campoFuncionarios')),
			);
			

			//trata os campos necessarios

			// $objeto_do_form['data_nascimento'] = $this->_trata_dataDoFormParaBanco($objeto_do_form['data_nascimento']);
			// $objeto_do_form['cpf'] = $this->_trata_CPFdoFormParaBanco($objeto_do_form['cpf']);

			// Checa duplicata
			$checa_duplicata = $this->Setor_model->get_by_nome($objeto_do_form['nome'], $objeto_do_form['orgao'])->num_rows();

			if ($checa_duplicata > 1){

				$data['mensagem'] = '<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> O registro já existe </div>';

				$this->load->view($this->area.'/'.$this->area.'_edit', $data);

			}else{

				// Atualiza o cadastro
				$this->Setor_model->update($id, $objeto_do_form);

				$this->js_custom = 'var sSecs = 3;
                                function getSecs(){
                                    sSecs--;
                                    if(sSecs<0){ sSecs=59; sMins--; }				
                                    $("#clock1").html(sSecs+" segundos...");		
                                    setTimeout("getSecs()",1000);		
                                    var s =  $("#clock1").html();
                                    if (s == "1 segundos..."){			
                                        window.location.href = "' . $_SESSION['novoinicio']  . '";
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
	
	
	
	public function funcionarios($id) {
	
		
		$form_action = site_url($this->area.'/funcionario_permissao');
		
		// Instancia um objeto com o resultado da consulta
		$obj = $this->Setor_model->get_by_id($id)->row();
		

		//echo $this->db->last_query();
	
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
			
		// define as variaveis comuns
		$data['titulo'] = "Funcionários do setor";
		$data['mensagem'] = '';
		$data['link_back'] = $this->Campo_model->make_link($this->area, 'voltar');
		$data['form_action'] = site_url($this->area.'/funcionarios/'.$id);
	
		//Constroe os campos do formulario
		$this->load->model('Campo_model','',TRUE);
		$data['linkBack'] 				= 	$this->Campo_model->setor('campoNome');
		$data['campoNome'] 				= 	$this->Campo_model->setor('campoNome');
		$data['campoSigla'] 			= 	$this->Campo_model->setor('campoSigla');

	
		//Popula os campos com os dados do objeto
		$data['setorNome'] = $obj->nome;
		$data['setorSigla'] = $obj->sigla;
		$data['dono'] = ($obj->dono) ? $this->Setor_model->get_nome_dono($obj->dono)->row()->nome : null;
		
//---------- FUNCIONÁRIOS ----------//
		
		$this->load->model('Setor_model', '', TRUE);
		$funcionarios = $this->Setor_model->list_funcionarios($id)->result();
		
		$arrayPermissoes = array('1' => 'LEITURA', '2' => 'ESCRITA', '3' => 'TOTAL');
		
		$linha = "";
		if($funcionarios){
			
			$linha = "<table class='table table-striped table-bordered table-hover'>\n";
			foreach ($funcionarios as $key => $funcionario){
				
				//if($funcionario->id != $obj->dono){
					
					$permissao = $this->get_permissao($id, $funcionario->id);
					
					switch ($permissao) {
						case 1:
							$permissaoNome = "LEITURA";
							break;
						case 2:
							$permissaoNome = "ESCRITA";
							break;
						case 3:
							$permissaoNome = "TOTAL";
							break;
					}
					
					
					$linha .= "<tr>\n";
					
						$linha .= "<td>\n";
						
							$linha .=  mb_convert_case($funcionario->nome, MB_CASE_UPPER, "UTF-8");
		
						$linha .= "</td>\n";
						
						$linha .= "<td>\n";
							
						$linha .= "<form name='form_permissao_$funcionario->id' action=$form_action method='post' accept-charset='utf-8'>\n";
						
						$linha .= "<input type='hidden' name='id_setor' value='$id'>\n";
						
						$linha .= "<input type='hidden' name='id_usuario' value='$funcionario->id'>\n";
						
							$linha .=  "<select name='permissao' onchange='this.form.submit()' class='form-control'>\n";
							
							foreach ($arrayPermissoes as $key => $value){
								
								$selecionado = null;
								if($key == $permissao){
									$selecionado = "selected";
								}
								
								$linha .=  "<option value='$key' $selecionado>$value</option>\n";
								
								
							}
	
							$linha .=  "</select>\n";
							
						$linha .= "</form>\n";
						
						$linha .= "</td>\n";
					
					$linha .= "</tr>\n";
				//}
				
			}
			$linha .= "</table>\n";
		}else{
			$arrayFuncionarios[1] = "";
		}
		$data['funcionarios']  =  $linha;
		
		
//---------- FIM ------------------//
		
	
		$this->load->view($this->area.'/'.$this->area.'_funcionarios', $data);
	
		
	}
	
	function funcionario_permissao(){
		
		//$id_usuario = $this->input->post('id_usuario');
		
		$obj = array(
				
				'setor' => $this->input->post('id_setor'),
				'usuario' => $this->input->post('id_usuario'),
				'permissao' => $this->input->post('permissao'),
		);
		
		$this->Setor_model->funcionario_permissao($obj);
		
		redirect($this->area.'/funcionarios/'.$this->input->post('id_setor'));
	}
	
	public function get_permissao($setor, $usuario){
		
		$this->load->model('Setor_model', '', TRUE);
		
		//$data['objeto'] = $this->Setor_model->get_by_id($id)->row();
		
		$permissao = $this->Setor_model->get_permissao($setor, $usuario)->row();
		
		if($permissao){
			return $permissao->permissao;
		}else{
			return 1;
		}

	}

    public function search($page = 1) { 
    	$this->js[] = 'setor';
        $data['titulo'] = "Busca por setores";
        $data['link_add']   = $this->Campo_model->make_link($this->area, 'add');
        $data['link_search_cancel'] = $this->Campo_model->make_link($this->area, 'search_cancel');
        $data['form_action'] = site_url($this->area.'/search');
        $_SESSION['novoinicio'] = current_url();

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
        $config['total_rows'] = $this->Setor_model->count_all_search($keyword);           
        
        $this->pagination->initialize($config);     
        $data['pagination'] = $this->pagination->create_links();
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Item', 'Sigla', 'Nome', 'Ações');
        
        $inicio = (!$this->uri->segment($uri_segment, 0)) ? 0 : ($this->uri->segment($uri_segment, 0) - 1) * $maximo;

        $rows = $this->Setor_model->listAllSearchPag($keyword, $maximo, $inicio);   
            
        foreach ($rows as $o){

            $this->table->add_row($o->id, $o->sigla, $o->nome,
            	'<div class="btn-group">'.
                $this->Campo_model->make_link($this->area, 'visualizar', $o->id).
                $this->Campo_model->make_link($this->area, 'alterar_sm', $o->id).
            	$this->Campo_model->make_link($this->area, 'funcionarios', $o->id).
            	'</div>'
              //  anchor($this->area.'/delete/'.$objeto->id,'deletar',array('class'=>'delete','onclick'=>"return confirm('Deseja REALMENTE deletar esse setor?')"))
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
	
	// date_validation callback
	function valid_date($str){
		if(!preg_match('^(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-([0-9]{4})$^', $str))
		{
			$this->validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function _checa_tabelas(){
		 
		$data['message'] = '';
	
		$this->load->model('Orgao_model','',TRUE);
		if($this->Orgao_model->count_all() == 0){
			$data['message'] .= 'Nenhum órgão cadastrado. Cadastre um.<br>';
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