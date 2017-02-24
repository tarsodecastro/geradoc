<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

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
	public $js = array('jquery-1.7.1.min','jquery.dataTables.min','jquery.blockUI','about','jquery.maskedinput-1.1.4.pack');
	public $js_custom;
	
    private $area = "usuario";
		
	public function __construct (){
		parent::__construct();			
		$this->load->helper('url');			
		$this->load->model('Usuario_model','',TRUE);
		$this->load->model('Grid_model','',TRUE);
		$this->load->model('Campo_model','',TRUE);
		$this->load->library('session');
		$this->load->library('convert');
		$this->modal = $this->load->view('about_modal', '', TRUE);
		session_start();
	}
	
	
	public function index($offset = 0){
		$this->load->library('restrict_page');
	
		$this->js[] = 'usuario';
	
		$data['titulo']     = 'Usuários';
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
		$config['total_rows'] = $this->Usuario_model->count_all();
		$config['per_page'] = $maximo;
	
		$this->pagination->initialize($config);
	
		// load datas
		$objetos = $this->Usuario_model->get_paged_list($maximo, $inicio)->result();
	
		// carregando os dados na tabela
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Item', 'Nome', 'Setor', 'Ações');
		foreach ($objetos as $objeto){
			
			if($objeto->setores != null){
					
				$setores_usuario = $objeto->setores;
			
				if(strpos($setores_usuario, ';') > 0){

					$setores_usuario = explode(';',$setores_usuario);
			
					$nome_setor = '';
					foreach ($setores_usuario as $value){
			
						$nome_setor .= $this->_get_setor($value) . "<br>";
					}
				}else{
					
					$nome_setor = $this->_get_setor($objeto->setores);
					
				}
			
			}else{
			
				$nome_setor = $this->_get_setor($objeto->setor);
			}
			
			$this->table->add_row($objeto->id, $objeto->nome, $nome_setor,
					
					'<div class="btn-group">'.
						$this->Campo_model->make_link($this->area, 'visualizar', $objeto->id).
						$this->Campo_model->make_link($this->area, 'alterar_sm', $objeto->id).
					'</div>'
					
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
		
		$this->load->model('Usuario_model','',TRUE);
		$qtd_usuarios = $this->Usuario_model->count_all();
			
		if($qtd_usuarios > 0){
			$this->load->library('restrict_page');
		}
	
		$this->js[] = 'usuario';
	
		$this->load->library(array('form_validation'));
		$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
	
		$data['titulo'] = 'Novo';

		$data['disabled'] = '';
		$data['link_back']  = $this->Campo_model->make_link($this->area, 'voltar');
		$data['link_cancelar'] = $this->Campo_model->make_link($this->area,'cancelar');
		$data['link_salvar'] = $this->Campo_model->make_link($this->area,'salvar');
		
		$data['form_action'] = site_url($this->area.'/add/');
		$data['mensagem'] = '';
	
		//constroe os campos que serao mostrados no formulario
		$this->load->model('Campo_model','',TRUE);
		$data['campoCPF'] = $this->Campo_model->usuario('campoCPF');
		$data['campoNome'] = $this->Campo_model->usuario('campoNome');
		$data['campoMail1'] = $this->Campo_model->usuario('campoMail1');
		$data['campoMail2'] = $this->Campo_model->usuario('campoMail2');
		$data['campoSenha'] = $this->Campo_model->usuario('campoSenha');
		$data['campoConfSenha'] = $this->Campo_model->usuario('campoConfSenha');
		$data['niveisDisponiveis'] = $this->Campo_model->usuario('arrayNiveis');
		$data['nivelSelecionado']  = '2';
		$data['campoTamanhoUpload'] = $this->Campo_model->usuario('campoTamanhoUpload');
		$data['campoTamanhoUpload']['value'] = 2048; // 2048 = 2 MB
	
			
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
		//$data['setorSelecionado'] = $this->input->post('campoSetor') ? $this->input->post('campoSetor') : 0;
		$data['setoresSelecionados'] = $this->input->post('campoSetores') ? $this->input->post('campoSetores') : 0;
		//fim dos setores
	
		if ($this->form_validation->run($this->area."/add") == FALSE) {
			$this->load->view($this->area . "/" . $this->area.'_edit', $data);
		} else {
			//cria o objeto com os dados passados via post
	
			$objeto_do_form = array(
					'cpf' => $this->convert->cpfToNum($this->input->post('campoCPF')),
					'nome' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
					'email' => mb_convert_case($this->input->post('campoMail1'), MB_CASE_LOWER, "UTF-8"),
					'senha' => $this->input->post('campoSenha'),
					'setor' => $this->input->post('campoSetor'),
					'setores' => $this->input->post('campoSetores'),
					'nivel' => $this->input->post('campoNivel'),
					'upload' => $this->input->post('campoTamanhoUpload'),
			);
			
			$campo_setores = null;
			foreach ($this->input->post('campoSetores') as $key => $value){
				$campo_setores .= $value . ';';
			}
			$objeto_do_form['setores'] = substr($campo_setores, 0, -1);
			
		
			$objeto_do_form['senha'] = md5($objeto_do_form['senha']);
		
	
			//checa a existencia de registro com o mesmo nome para evitar duplicatas
			$checa_duplicata = $this->Usuario_model->get_by_cpf($objeto_do_form['cpf'])->num_rows();
	
			if ($checa_duplicata > 0){
	
				$data['mensagem'] = '<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> O registro já existe </div>';
	
				$this->load->view($this->area . "/" . $this->area.'_edit', $data);
	
			}else{
	
				// Salva o registro
				$this->Usuario_model->save($objeto_do_form);
	
	
				$this->js_custom = 'var sSecs = 4;
                                function getSecs(){
                                    sSecs--;
                                    if(sSecs<0){ sSecs=59; sMins--; }
                                    $("#clock1").html(sSecs);
                                    setTimeout("getSecs()",1000);
                                    var s =  $("#clock1").html();
                                    if (s == "1"){
                                        window.location.href = "' . site_url('/'.$this->area) . '";
                                    }
                                }
                                ';

				$data['mensagem'] = "<br /> Redirecionando em... ";
				$data['mensagem'] .= '<span id="clock1"> ' . "<script>setTimeout('getSecs()',1000);</script> </span>";
				$data['link1'] = '';
				$data['link2'] = '';
	
				$this->load->view('success', $data);
	
			}
	
		}
	
	}
	
	public function update($id, $disabled = null) {
		$this->load->library('restrict_page');
		
		$this->js[] = 'usuario';
	
		$this->load->library(array('form_validation'));
		
		$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
	
		$data['titulo'] = 'Alteração';
		
		$data['disabled'] = ($disabled != null) ? 'disabled' : '';
		$data['link_back'] = $this->Campo_model->make_link($this->area, 'voltar');
		$data['link_cancelar'] = $this->Campo_model->make_link($this->area, 'cancelar');
		$data['link_salvar'] = $this->Campo_model->make_link($this->area, 'salvar');
		$data['link_update'] = $this->Campo_model->make_link($this->area, 'alterar', $id);
		$data['link_update_sm'] = $this->Campo_model->make_link($this->area, 'alterar_sm', $id);
		
		$data['form_action'] = site_url($this->area.'/update/'.$id);
		$data['mensagem'] = '';
		
		$obj = $this->Usuario_model->get_by_id($id)->row();
	
		//constroe os campos que serao mostrados no formulario
		$this->load->model('Campo_model','',TRUE);
		$data['campoCPF'] = $this->Campo_model->usuario('campoCPF');
		$data['campoCPF']['value'] = $obj->cpf;
		
		$data['campoNome'] = $this->Campo_model->usuario('campoNome');
		$data['campoNome']['value'] = $obj->nome;
		
		$data['campoMail1'] = $this->Campo_model->usuario('campoMail1');
		$data['campoMail1']['value'] = $obj->email;
		
		$data['campoMail2'] = $this->Campo_model->usuario('campoMail2');
		$data['campoMail2']['value'] = $obj->email;
		
		
		$data['campoSenha'] = $this->Campo_model->usuario('campoSenha');
		$data['campoSenha']['value'] = $obj->senha;
		
		
		$data['campoConfSenha'] = $this->Campo_model->usuario('campoConfSenha');
		$data['campoConfSenha']['value'] = $obj->senha;
		
		$data['niveisDisponiveis'] = $this->Campo_model->usuario('arrayNiveis');
		$data['nivelSelecionado']  = $obj->nivel;
		
		$data['campoTamanhoUpload'] = $this->Campo_model->usuario('campoTamanhoUpload');
		$data['campoTamanhoUpload']['value'] = $obj->upload;
	
			
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
		
		if($obj->setores != null){
			
			$setores_selecionados = $obj->setores;

			if(strpos($setores_selecionados, ';') > 0){
				
				$setores_selecionados = explode(';',$setores_selecionados);
				
			}

			$data['setoresSelecionados'] = $this->input->post('campoSetores') ? $this->input->post('campoSetores') : $setores_selecionados;
			
		}else{
			$data['setoresSelecionados'] = $this->input->post('campoSetores') ? $this->input->post('campoSetores') : $obj->setor;
		}
		//fim dos setores
		
		
		if ($this->form_validation->run($this->area."/edit") == FALSE) {
			$this->load->view($this->area . "/" . $this->area.'_edit', $data);
		} else {
			
			//cria o objeto com os dados passados via post
	
			$objeto_do_form = array(
					'cpf' => $this->convert->cpfToNum($this->input->post('campoCPF')),
					'nome' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
					'email' => mb_convert_case($this->input->post('campoMail1'), MB_CASE_LOWER, "UTF-8"),
					'senha' => $this->input->post('campoSenha'),
					'setores' => $this->input->post('campoSetores'),
					'nivel' => $this->input->post('campoNivel'),
					'upload' => $this->input->post('campoTamanhoUpload'),
					
			);
			
			$campo_setores = null;
			foreach ($this->input->post('campoSetores') as $key => $value){
				$campo_setores .= $value . ';';		
			}
			$objeto_do_form['setores'] = substr($campo_setores, 0, -1);
			
			if($obj->senha != $objeto_do_form['senha']){
				$objeto_do_form['senha'] = md5($objeto_do_form['senha']);
			}
	
			//checa a existencia de registro com o mesmo nome para evitar duplicatas
			$checa_duplicata = $this->Usuario_model->get_by_cpf($objeto_do_form['cpf'])->num_rows();
	
			if ($checa_duplicata > 1){
	
				$data['mensagem'] = '<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> O registro já existe </div>';
	
				$this->load->view($this->area . "/" . $this->area.'_edit', $data);
	
			}else{
	
				// Salva o registro
				$this->Usuario_model->update($id,$objeto_do_form);
	
	
				$this->js_custom = 'var sSecs = 4;
                                function getSecs(){
                                    sSecs--;
                                    if(sSecs<0){ sSecs=59; sMins--; }
                                    $("#clock1").html(sSecs);
                                    setTimeout("getSecs()",1000);
                                    var s =  $("#clock1").html();
                                    if (s == "1"){
                                        window.location.href = "' . site_url('/'.$this->area) . '";
                                    }
                                }
                                ';
	
				$data['mensagem'] = "<br /> Redirecionando em... ";
				$data['mensagem'] .= '<span id="clock1"> ' . "<script>setTimeout('getSecs()',1000);</script> </span>";
				$data['link1'] = '';
				$data['link2'] = '';
	
				$this->load->view('success', $data);
	
			}
	
		}
	
	}
	
	public function cadastro(){
		
		$this->load->library('restrict_page'); 

		$this->js[] = 'cadastro';
	
		$this->load->library(array('form_validation','datas'));
		$this->form_validation->set_error_delimiters('<div class="glyphicon glyphicon-warning-sign">', '</div>');
		 
		$data['titulo'] = 'Meu cadastro';
		$data['link_salvar'] = $this->Campo_model->make_link($this->area, 'salvar');
		$data['form_action'] = site_url("/usuario/cadastro");
		$data['mensagem'] = '';
			
		$id = $this->session->userdata('id_usuario');
		$obj =  $this->Usuario_model->get_by_id($id)->row();
		
		if($obj->email == null or $obj->email == ''){
			$data['mensagem'] = '<span class="error_field" style="font-size: 11pt;"><center><br><img class="img_align" src="{TPL_images}/error.png" alt="! " /> Por favor, atualize seu cadastro com as informações de <b>e-mail</b>. </center></span>';
		}
		
		//constroe os campos que serao mostrados no formulario
		$this->load->model('Campo_model','',TRUE);
		
		$data['campoCPF'] = $this->Campo_model->usuario('campoCPF');
		$data['campoCPF']['value'] = $obj->cpf;
		
		$data['campoNome'] = $this->Campo_model->usuario('campoNome');
		$data['campoNome']['value'] = $obj->nome;
		
		$data['campoMail1'] = $this->Campo_model->usuario('campoMail1');
		$data['campoMail1']['value'] = $obj->email;
		
		$data['campoMail2'] = $this->Campo_model->usuario('campoMail2');
		$data['campoMail2']['value'] = $obj->email;
		
		
		 
		if ($this->form_validation->run() == FALSE) {
			 
			$this->load->view('usuario/cadastro',$data);
			 
		} else {
			
			$objeto_do_form = array(
				'cpf' => $this->convert->cpfToNum($this->input->post('campoCPF')),
				'nome' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
				'email' => mb_convert_case($this->input->post('campoMail1'), MB_CASE_LOWER, "UTF-8"),	
			);
				
			//checa a existencia de registro com o mesmo nome para evitar duplicatas
			$checa_duplicata = $this->Usuario_model->get_by_cpf($objeto_do_form['cpf'])->num_rows();
			
			if ($checa_duplicata > 1){
			
				$data['mensagem'] = '<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> O registro já existe </div>';
			
				$this->load->view($this->area . "/" . 'cadastro', $data);
			
			}else{
				
				// Salva o registro
				$this->Usuario_model->update($id,$objeto_do_form);
				
				$this->js_custom = 'var sSecs = 4;
                                function getSecs(){
                                    sSecs--;
                                    if(sSecs<0){ sSecs=59; sMins--; }
                                    $("#clock1").html(sSecs);
                                    setTimeout("getSecs()",1000);
                                    var s =  $("#clock1").html();
                                    if (s == "1"){
                                        window.location.href = "' . site_url('/'.$this->area.'/cadastro') . '";
                                    }
                                }
                                ';
				
				
				$data['mensagem'] = "<br /> Redirecionando em... ";
				$data['mensagem'] .= '<span id="clock1"> ' . "<script>setTimeout('getSecs()',1000);</script> </span>";
				$data['link1'] = '';
				$data['link2'] = '';
				
				$this->load->view('success', $data);

			}
	
		}
	}

	public function altsenha(){
		$this->load->library('restrict_page');

	    $this->load->library(array('form_validation','datas'));    		
    	$this->form_validation->set_error_delimiters('<div>', '</div>');
      					
	  	$data['titulo'] = 'Alterar minha senha de acesso';
	  	$data['form_action'] = site_url("/usuario/altsenha");	  	
	 	$obj =  $this->Usuario_model->get_by_id($this->session->userdata('id_usuario'));	  	
	 	
	  	if ($this->form_validation->run() == FALSE) {	
	  				      		
        	$this->load->view('altsenha',$data);   
        	     	
      	} else {
      		$id_usuario = $this->session->userdata('id_usuario');
      		$obj->senha = $this->input->post('txtSenhaNova');      		
      		$obj->senha = md5($obj->senha);
      		
      		$this->Usuario_model->updateSenha($id_usuario, $obj->senha);	
      			
      		$this->js_custom = 'var sSecs = 6;		
								function getSecs(){
									sSecs--;
									if(sSecs<0){ sSecs=59; sMins--; }				
							   		$("#clock1").html(sSecs+" segundos...");		
							   		setTimeout("getSecs()",1000);		
									var s =  $("#clock1").html();
									if (s == "1 segundos..."){			
										window.location.href = "'.site_url('/login/logoff').'";
									}
								}     		
      						';   
      						   		
      		
        	$data['mensagem'] = "A sua senha de acesso foi alterada. <br /> Acesse novamente o sistema com a sua nova senha. <br />";
        	$data['mensagem'] .= 'Você será redirecionado à página de login automaticamente em: <br />';
        	$data['mensagem'] .= '<div id="clock1" style="text-align: center;"> '."<script>setTimeout('getSecs()',1000);</script> </div>";	
			$data['link1'] = '';
			$data['link2'] = '';
			
        	$this->load->view('success', $data);       	
      	}		
	}

	public function check_senhaAtual(){				
			$obj = new stdClass();
			$obj->id = $this->session->userdata('id_usuario');
			$obj->senha = $this->input->post('txtSenhaAtual');
			$obj->senha = md5($obj->senha);				
			$senha_correta =  $this->Usuario_model->checa_senha($obj->senha);	
			
			if ($senha_correta == true){				
				return TRUE;
			} else if ($senha_correta == false) {			
				$this->form_validation->set_message('check_senhaAtual', 'A senha atual está errada!');				
				return FALSE;
			}
	
	}	
	
	function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%';
		$retorno = '';
		$caracteres = '';
	
		$caracteres .= $lmin;
		if ($maiusculas){
			$caracteres .= $lmai;
		}
		if ($numeros){
			$caracteres .= $num;
		}
		if ($simbolos){
			$caracteres .= $simb;
		}
	
		$len = strlen($caracteres);
	
		for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
	
		return $retorno;
	}
	
	function email($cpf, $email, $nova_senha){
	
		$assunto = "Titulo do assunto";
	
		$mensagem = '<div style="font-size: 11pt">';
		$mensagem .= 'Conforme solicitação, sua nova <b>Senha de Acesso</b> é: '.$nova_senha.'<br/><br/>';
		$mensagem .= 'Não divulgue sua senha. Recomendamos trocá-la periodicamente.<br /><br/>';
		$mensagem .= '<b>Não responda esta mensagem</a></b><br /><br />';
		$mensagem .= '</div>';
	
		$list = array($email);
		$this->load->library('email');
		$this->email->from('seuemail@mail.com');
	
		$this->email->reply_to('seuemail@mail.com');
		$this->email->to($list);
		$this->email->subject($assunto);
		$this->email->message($mensagem);
	
		if ( ! $this->email->send() ){
			return false;
		} else {
			return true;
		}
	
	}

	public function nova_senha(){
		
		$this->layout = 'public';
		$this->js[] = 'nova_senha';
	
		$this->load->library(array('form_validation','datas'));
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$data['titulo'] = 'Nova senha';
		$data['form_action'] = site_url("/usuario/nova_senha");
		
		$data['mensagem'] = '';
			
		
		if ($this->form_validation->run() == FALSE) {
			 
			$this->load->view('nova_senha',$data);
			 
		} else {
			
			$this->load->library('convert');
			$obj = new stdClass();
			
			$cpf = $this->convert->cpfToNum($this->input->post('txtCPF'));
			
			$this->load->model('Login_model', '', TRUE);
			$obj = $this->Usuario_model->get_by_cpf($cpf)->row();
			
			
			if ($obj == null) {
				 
				$data['mensagem'] = '<span class="error_field"><center><br><img class="img_align" src="{TPL_images}/error.png" alt="! " /> O CPF '.$cpf.' não está cadastrado. </center></span>';
				$this->load->view('nova_senha', $data);
			
			}elseif ($obj->email == '' or $obj->email == null){
				
				$data['mensagem'] = '<span class="error_field"><center><br><img class="img_align" src="{TPL_images}/error.png" alt="! " /> Não há e-mail cadastrado para este CPF. <br> O usuário não atualizou o cadastro.</center></span>';
				$this->load->view('nova_senha', $data);
				
			} else {
				
				$id = $obj->id;
				$email = $obj->email;
				$novoObj = array(
					'senha' => $this->geraSenha(8, false, true, true),
				);
					
				if($this->email($cpf, $email, $novoObj['senha']) == false){
					
					$data['mensagem'] = '<center><span class="error_field"><br><img class="img_align" src="{TPL_images}/error.png" alt="! " />  ERRO com o envio do e-mail!</span> <br>' . "Não conseguimos enviar sua nova senha de acesso para o e-mail: $email. <br> Tente novamente em instantes.</center>";
					$this->load->view('nova_senha', $data);
					
				}else{
		
					$novoObj['senha'] = md5($novoObj['senha']);
					
					$this->Usuario_model->updateSenha($id, $novoObj['senha']);
					
					$data['mensagem'] = "<br> A sua nova senha de acesso foi enviada para o e-mail: <b> $email </b>";
					$data['link1'] = '<br><center><a href="'. site_url('login/logoff'). '" class="link1">Efetuar login</a></center>';
					$data['link2'] = '';
					$this->load->view('success', $data);	
					
				}

			}
			
		}
	}
	
	
 public function search($page = 1) { 
	$this->load->library('restrict_page');
	
    	$this->js[] = 'usuario';
        $data['titulo'] = "Busca por usuários";
        $data['link_add']   = anchor($this->area.'/add/','<span class="glyphicon glyphicon-plus"></span> Adicionar',array('class'=>'btn btn-primary btn-sm'));
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
        $config['total_rows'] = $this->Usuario_model->count_all_search($keyword);           
        
        $this->pagination->initialize($config);     
        $data['pagination'] = $this->pagination->create_links();
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Item', 'Nome', 'Setor', 'Ações');
        
        $inicio = (!$this->uri->segment($uri_segment, 0)) ? 0 : ($this->uri->segment($uri_segment, 0) - 1) * $maximo;

        $rows = $this->Usuario_model->listAllSearchPag($keyword, $maximo, $inicio);   
        
            
        foreach ($rows as $o){
	
        	if($o->setores != null){
			
				$setores_usuario = $o->setores;

				if(strpos($setores_usuario, ';') > 0){
					
					$this->load->model('Setor_model','',TRUE);
					
					$setores_usuario = explode(';',$setores_usuario);
				
					$nome_setor = '';
					foreach ($setores_usuario as $value){

						$nome_setor .= $this->_get_setor($value) . "<br>";
					}
				}else{
					
					$nome_setor = $this->_get_setor($o->setores);
					
				}

			}else{
				
				$nome_setor = $this->_get_setor($o->setor);
			}
        	
            $this->table->add_row($o->id,  $o->nome, $nome_setor,

            		'<div class="btn-group">'.
	            		$this->Campo_model->make_link($this->area, 'visualizar', $o->id).
	            		$this->Campo_model->make_link($this->area, 'alterar_sm', $o->id).
            		'</div>'
            		
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
    	$this->load->library('restrict_page');
    
    	$_SESSION['keyword_'.$this->area] = null;
    
    	redirect($this->area.'/index/');
    
    }
	
    function view($id){
    	
    	self::update($id, 'disabled');

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

	
}

?>
