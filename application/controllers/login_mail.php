<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_mail extends CI_Controller {
	
    /*
     * Atributos opcionais para as views
     * public $layout;  define o layout default 
     * public $title; define o titulo default da view
     * public $css = array('css1','css2'); define os arquivos css default
     * public $js = array('js1','js2'); define os arquivos javascript default
     * public $images = 'dir_images'; define a diretorio default das imagens
     *  
     */

    public $layout = 'login_mobile';
    public $css = array('');
    public $js = array('jquery-1.11.1.min', 'jquery.maskedinput-1.1.4.pack', 'login');

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
       $data['form_action'] = site_url('/login_mail');  

       $this->load->model('Usuario_model','',TRUE);
       $qtd_usuarios = $this->Usuario_model->count_all();
       
       if($qtd_usuarios == 0){
       	
       		echo "NENHUM USUÁRIO CADASTRADO";
       		redirect('usuario/add');	
       }
       
       if ($this->form_validation->run('login/login_mail') == FALSE) {
       	
       		$this->load->view('login/login_mail', $data);
       		
       } else {  
       	              
       		$this->autentica();
       }        
    }

    public function autentica() {
    	$this->load->library('convert');
        $obj = new stdClass();
        $obj->login = $this->input->post('email');
        $obj->senha = $this->input->post('txtSenha');
        $obj->senha = md5($obj->senha);
        $data['mensagem'] = '';

        $this->load->model('Login_model', '', TRUE);
        $user_cadastrado = $this->Login_model->get_usuario_mail($obj->login, $obj->senha);
        //echo $this->db->last_query();
       // echo "1";
        $data['form_action'] = site_url('/login_mail');
        
       //print_r($user_cadastrado);
        
        if (empty($user_cadastrado) or $user_cadastrado->email == null) {
        	
        	//echo "2";
            $data['mensagem'] = '<div class="alert alert-danger"><center><img class="img_align" src="{TPL_images}/error.png" alt="! " /> E-mail ou senha inválidos! </center></div>';
            $data['link1'] = '<a class="link1" href="javascript:window.history.back();" title="Tentar novamente"> &raquo; tentar novamente</a>';
            $this->load->view('login/login_mail', $data);
            
        } else {
        	//echo "3";
        	
        	if($user_cadastrado->setores != null){
        		//echo "4";
        		$_SESSION['usuario'] = $user_cadastrado;
					
				$setores_usuario = $user_cadastrado->setores;

				if(strpos($setores_usuario, ';') > 0){

					$setores_usuario = explode(';',$setores_usuario);
			
					$nome_setor = '';
					
					foreach ($setores_usuario as $value){
			
						$nome_setor .= $this->get_setor($value) . "<br>";
						
					}
					
					$data['setores'] = $nome_setor;
					
					$this->load->view('login/login_mail', $data);
					
				}else{
					
					$this->set_setor($setores_usuario);
					
				}

			}else{
				
				if(!$user_cadastrado->email){
					$user_cadastrado->email = '';
				}
				
				$dados = array(
						'id_usuario' => $user_cadastrado->id,
						'login' => $user_cadastrado->cpf,
						'cpf' => $user_cadastrado->cpf,
						'nome' => $user_cadastrado->nome,
						'nivelId' => $user_cadastrado->nivel,
						'setor' => $user_cadastrado->setor,
						'email' => $user_cadastrado->email,
						'logado' => TRUE,
				);
				
				$this->load->database("default", TRUE);
				$this->session->set_userdata($dados);
							
				//--- Executa a limpeza na tabela auditoria para esse usuario --//
				$this->load->model('Auditoria_model','',TRUE);
				$this->Auditoria_model->delete($user_cadastrado->id);
				//--- Fim da limpeza ---//
				 
				if(!$user_cadastrado->email or $user_cadastrado->email == '' or $user_cadastrado->email == null){
					redirect('usuario/cadastro');
				}else{
					redirect('documento/');
				}
				
			}	
			
        }
        
    }
    
	function get_setor($id_setor){
    
    	$this->load->model('Setor_model','',TRUE);
    	
    	$obj = $this->Setor_model->get_by_id($id_setor)->row();
    	
    	if($obj){

    		$setor = "$obj->sigla/$obj->setorPaiSigla";
    		
    	}else{
    		$setor = "NENHUM";
    	}
 
    	return anchor('login/set_setor/'.$id_setor, $setor,array('class'=>'link1'));

    }
    
    function set_setor($id_setor){
    	
    	$user_cadastrado = $_SESSION['usuario'];
    	unset($_SESSION['usuario']);
    	
    	if(!$user_cadastrado->email){
    		$user_cadastrado->email = '';
    	}
    	
    	 	$dados = array(
                'id_usuario' => $user_cadastrado->id,
                'login' => $user_cadastrado->cpf,
            	'cpf' => $user_cadastrado->cpf,
                'nome' => $user_cadastrado->nome,
                'nivelId' => $user_cadastrado->nivel,
            	'setor' => $id_setor,
    	 		'email' => $user_cadastrado->email,
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

    public function logoff() {
        $this->session->sess_destroy();
        redirect('login_mail/');
    }

}

