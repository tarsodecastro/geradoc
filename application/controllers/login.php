<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
    /*
     * Atributos opcionais para as views
     * public $layout;  define o layout default 
     * public $title; define o titulo default da view
     * public $css = array('css1','css2'); define os arquivos css default
     * public $js = array('js1','js2'); define os arquivos javascript default
     * public $images = 'dir_images'; define a diretório default das imagens
     *  
     */

    public $layout = 'login';
    public $css = array('style_login');
    public $js = array('jquery-1.7.1.min', 'jquery.maskedinput-1.1.4.pack', 'login');

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
        $this->load->helper('url');
        $this->load->library('session');
        session_start();
    }

    public function index() { 
	   $data['mensagem'] = '';
       $this->session->unset_userdata('logado');            
       $data['form_action'] = site_url('/login');  

       
       $this->load->model('Usuario_model','',TRUE);
       $qtd_usuarios = $this->Usuario_model->count_all();
       
       if($qtd_usuarios == 0){
       	
       	
       		echo "NENHUM USUÁRIO CADASTRADO";
       		
       		
       		redirect('usuario/add');
       		
       }
       
       
       if ($this->form_validation->run() == FALSE) {
       		$this->load->view('login', $data);
       } else {                
       		$this->autentica();
       }        
    }

    public function autentica() {
    	$this->load->library('convert');
        $obj = new stdClass();
        $obj->login = $this->convert->cpfToNum($this->input->post('cpf'));
        $obj->senha = $this->input->post('txtSenha');
        $obj->senha = md5($obj->senha);
        $data['mensagem'] = '';

        //informa o banco a ser utilizado, no caso o sso
       // $this->load->database("sso", TRUE);
        $this->load->model('Login_model', '', TRUE);
        $user_cadastrado = $this->Login_model->get_usuario($obj->login, $obj->senha);
        //echo $this->db->last_query();

        if ($user_cadastrado == null) {
        	
        	$data['form_action'] = site_url('/login');
            $data['mensagem'] = '<span class="error_field"><center><br><img class="img_align" src="{TPL_images}/error.png" alt="! " /> CPF ou senha inválidos! </center></span>';
            $data['link1'] = '<a class="link1" href="javascript:window.history.back();" title="Tentar novamente"> &raquo; tentar novamente</a>';
            $this->load->view('login', $data);
            
        } else {
        	
        	/*
        	if(!isset($user_cadastrado->setores)){
        		echo "O campo setores não existe na tabela usuarios";
        		exit;
        	}
        	*/
        	
        	if($user_cadastrado->setores != null){
        		
        		$_SESSION['usuario'] = $user_cadastrado;
					
				$setores_usuario = $user_cadastrado->setores;

				if(strpos($setores_usuario, ';') > 0){

					$setores_usuario = explode(';',$setores_usuario);
			
					$nome_setor = '';
					
					foreach ($setores_usuario as $value){
			
						$nome_setor .= $this->get_setor($value) . "<br>";
						
					}
					
					$data['setores'] = $nome_setor;
					
					$this->load->view('login', $data);
					
				}else{
					
					$this->set_setor($setores_usuario);
					
				}

			}else{
				
				$dados = array(
						'id_usuario' => $user_cadastrado->id,
						'login' => $user_cadastrado->cpf,
						'cpf' => $user_cadastrado->cpf,
						'nome' => $user_cadastrado->nome,
						'nivelId' => $user_cadastrado->nivel,
						'setor' => $user_cadastrado->setor,
						'logado' => TRUE,
				);
				
				$this->load->database("default", TRUE);
				$this->session->set_userdata($dados);
				
				$this->load->model('Auditoria_model','',TRUE);
				
				//--- Executa a limpeza na tabela auditoria para esse usuário --//
				$this->Auditoria_model->delete($user_cadastrado->id);
				 
				 
				if(!$user_cadastrado->email or $user_cadastrado->email == '' or $user_cadastrado->email == null){
					redirect('usuario/cadastro');
				}else{
					redirect('documento/');
				}
						
			}	
			
			// limpa a variavel de sessao 'workflow_wait'para obrigar a visualizacao do alerta caso exista documento aguardando recebimento.
			$_SESSION['workflow_wait'] = null;
			
        }
        
    }
    
	function get_setor($id_setor){
    
    	$this->load->model('Setor_model','',TRUE);
    	
    	$obj = $this->Setor_model->get_by_id($id_setor)->row();
    	
    	/*
    	if($obj){

    		$setor = "$obj->sigla/$obj->setorPaiSigla";
    		
    	}else{
    		$setor = "NENHUM";
    	}
    	*/
    	
    	if($obj){
    	
    		if($obj->sigla != $obj->setorPaiSigla){
    			$setor = "$obj->sigla/$obj->setorPaiSigla";
    		}else{
    			$setor = "$obj->sigla";
    		}
    	
    	}else{
    		$setor = "NENHUM";
    	}
    	
    	
 
    	return anchor('login/set_setor/'.$id_setor, $setor,array('class'=>'link1'));

    }
    
    function set_setor($id_setor){
    	
    	$user_cadastrado = $_SESSION['usuario'];
    	unset($_SESSION['usuario']);
    	
    	 	$dados = array(
                'id_usuario' => $user_cadastrado->id,
                'login' => $user_cadastrado->cpf,
            	'cpf' => $user_cadastrado->cpf,
                'nome' => $user_cadastrado->nome,
                'nivelId' => $user_cadastrado->nivel,
            	'setor' => $id_setor,
                'logado' => TRUE,
            );

            $this->load->database("default", TRUE);
            $this->session->set_userdata($dados);    

            $this->load->model('Auditoria_model','',TRUE);
            $this->Auditoria_model->delete($dados['id_usuario']);

            if(!$user_cadastrado->email or $user_cadastrado->email == '' or $user_cadastrado->email == null){
				redirect('usuario/cadastro');
            }else{
            	redirect('documento/');
            }
    
    }
    
    
    /*
    public function autentica_sso() {        
        $uri_segment = 3;                
        session_start();
        $cpf = $_SESSION['cpf_usuario']; // pega a variavel de sessao declarada no arquivo default.php da intranet

        $this->load->library('convert');
        $obj = new stdClass();
        $obj->login = $this->convert->cpfToNum($this->input->post('txtLogin'));
        $obj->senha = $this->input->post('txtSenha');
        $obj->senha = md5($obj->senha);

        //informa o banco a ser utilizado, no caso o sso
        $this->load->database("sso", TRUE);
        $this->load->model('Login_model', '', TRUE);
        $user_cadastrado = $this->Login_model->get_usuario_sso($cpf);

       if ($user_cadastrado == null) {
            $data['mensagem'] = 'Usuário (CPF) ou senha inválidos!';
            $data['link1'] = '<a class="link1" href="javascript:window.history.back();" title="Tentar novamente"> &raquo; tentar novamente</a>';

            $this->load->view('erro', $data);
        } else {

            $dados = array(
                'id_usuario' => $user_cadastrado->usuarioId,
                'login' => $user_cadastrado->usuarioCPF,
                'nome' => $user_cadastrado->usuarioNome, 
                'funcao' => $user_cadastrado->usuarioFuncao, 
                'nomeGuerra' => $user_cadastrado->usuarioNomeGuerra, 
                'nivelId' => $user_cadastrado->nivelId,
                'nivelNome' => $user_cadastrado->nivelNome,
            	'setor' => $user_cadastrado->usuarioSetorId,
                'logado' => TRUE,
            );

            $this->load->database("default", TRUE);
            $this->session->set_userdata($dados);
             
            redirect('documento/');
        }
    }
    */

    public function logoff() {
        $this->session->sess_destroy();
        redirect('login/');
    }

}

