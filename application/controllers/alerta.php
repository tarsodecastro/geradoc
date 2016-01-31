<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alerta extends CI_Controller {
	
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
	
    private $area = "alerta";
        
	public function __construct (){
		parent::__construct();	
		$this->load->library(array('table','form_validation','session'));
		$this->load->helper('url');
		$this->load->model('Alerta_model','',TRUE);
		$this->load->model('Documento_model','',TRUE);
        $this->load->model('Grid_model','',TRUE);
        $this->load->model('Campo_model','',TRUE);
        $this->modal = $this->load->view('about_modal', '', TRUE);
        session_start();
	}

	public function index($offset = 0){
		
		
		$this->load->library('restrict_page');
		
		$this->js[] = 'alerta';
		
		$data['titulo']     = 'Alertas';
		$data['link_add']   = $this->Campo_model->make_link($this->area, 'add');
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
        $config['total_rows'] = $this->Alerta_model->count_all($this->session->userdata('id_usuario'));
        $config['per_page'] = $maximo;

        $this->pagination->initialize($config);
        
        if($config['total_rows'] == 0){
        	redirect($this->area.'/sem_alertas/');
        }

        // load datas
        $objetos = $this->Alerta_model->get_paged_list($maximo, $inicio, $this->session->userdata('id_usuario'))->result();

        // carregando os dados na tabela
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Item', 'Documento', 'Data do alerta', 'Motivo', 'Conclusão', 'Ações');
        foreach ($objetos as $objeto){
        	
        	$documento =  $this->Documento_model->get_by_id($objeto->id_documento)->row();
        	
        	$tipoNome = $this->Documento_model->get_tipo($documento->tipo)->row();
        	
        	$setorRemetente = $this->getCaminho($documento->setor);

            $this->table->add_row($objeto->id_alerta, "$tipoNome->abreviacao Nº $documento->numero <br> $setorRemetente", $this->datas->datetimeToBR($objeto->data_alerta) . " - " . $this->datas->trataHoraBancoForm($objeto->hora_alerta), $objeto->motivo_alerta, $objeto->conclusao_alerta,
            	'<div class="btn-group">'.
//                $this->Campo_model->make_link($this->area, 'visualizar', $objeto->id_alerta).
               $this->Campo_model->make_link($this->area, 'alterar_sm', $objeto->id_alerta).
              	$this->Campo_model->make_link($this->area, 'deletar_sm', $objeto->id_alerta).
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

        $this->load->view($this->area.'/alerta_list', $data);

	}
	
	public function consulta() {
		
		$this->load->model('Documento_model','',TRUE);
		
		$this->layout = 'json';

		$alerta = $this->Documento_model->check_alerta_by_date($this->session->userdata('id_usuario'),  date("Y-m-d"));
		
		if(count($alerta) > 0){
			
			$teste = 1;
		
			echo "1";
		     
		}else{
			
			$teste = 0;
			
			echo "0";
		}
		
		$_SESSION['tem_alerta'] = $teste;

	}
	
	

	public function add() {
	
		$this->load->library(array('form_validation'));
		$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
	
		$data['titulo'] = 'Novo Órgão';
		$data['link_back'] = $this->Campo_model->make_link($this->area, 'voltar');
		$data['link_cancelar'] = $this->Campo_model->make_link($this->area,'cancelar');
		$data['link_salvar'] = $this->Campo_model->make_link($this->area,'salvar');
		
		$data['form_action'] = site_url($this->area.'/add/');
		$data['message'] = '';
	
		//constroe os campos que serao mostrados no formulario
		$this->load->model('Campo_model','',TRUE);
		$data['campoNome'] = $this->Campo_model->orgao('campoNome');
		$data['campoSigla'] = $this->Campo_model->orgao('campoSigla');
		$data['campoEndereco'] = $this->Campo_model->orgao('campoEndereco');
	
		if ($this->form_validation->run($this->area."/add") == FALSE) {
			$this->load->view($this->area . "/" . $this->area.'_edit', $data);
		} else {
			//cria o objeto com os dados passados via post
			$objeto_do_form = array(
					'nome' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "UTF-8"),
					'sigla' => mb_convert_case($this->input->post('campoSigla'), MB_CASE_UPPER, "UTF-8"),
					'endereco' => mb_convert_case($this->input->post('campoEndereco'), MB_CASE_UPPER, "UTF-8"),
			);
	
			//checa a existencia de registro com o mesmo nome para evitar duplicatas
			$checa_duplicata = $this->Alerta_model->get_by_nome($objeto_do_form['nome'])->num_rows();
	
			if ($checa_duplicata > 0){
	
				$data['mensagem'] = '<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> O registro já existe </div>';
	
				$this->load->view($this->area . "/" . $this->area.'_edit', $data);
	
			}else{
	
				// Salva o registro
				$this->Alerta_model->save($objeto_do_form);
	
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

		$data['titulo'] = 'Detalhes';
		
        $data['message'] = '';
        
        $data['link_back'] = $this->Campo_model->make_link($this->area, 'voltar');
        $data['link_cancelar'] = $this->Campo_model->make_link($this->area, 'cancelar');
        $data['link_alterar'] = $this->Campo_model->make_link($this->area, 'alterar', $id);
		
		$data['objeto'] = $this->Alerta_model->get_by_id($id)->row();

		$this->load->view($this->area.'/'.$this->area.'_view', $data);

	}
	
public function update($id) {

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
			
		// define as variaveis comuns
		$data['titulo'] = "Alteração de  alerta";
		$data['message'] = '';
		
		$data['form_action'] = site_url($this->area.'/update/'.$id);
		
		$data['link_back'] = $this->Campo_model->make_link($this->area, 'voltar');
		$data['link_cancelar'] = $this->Campo_model->make_link($this->area, 'cancelar');
		$data['link_salvar'] = $this->Campo_model->make_link($this->area, 'salvar');

		//Constroe os campos do formulario
		$this->load->model('Campo_model','',TRUE);
// 		$data['linkBack'] = $this->Campo_model->orgao('campoNome');
		
		$data['campoDataAlerta'] = $this->Campo_model->alerta('campoDataAlerta');
		
		$data['campoHoraMinutoAlerta'] = $this->Campo_model->alerta('campoHoraMinutoAlerta');
		
		$data['campoMotivoAlerta'] = $this->Campo_model->alerta('campoMotivoAlerta');
		
		$data['campoConclusaoAlerta'] = $this->Campo_model->alerta('campoConclusaoAlerta');

		// Instancia um objeto com o resultado da consulta
		$obj = $this->Alerta_model->get_by_id($id)->row();

		//Popula os campos com os dados do objeto
		$data['campoDataAlerta']['value'] = $this->_trata_dataDoBancoParaForm($obj->data_alerta);
		$data['campoHoraMinutoAlerta']['value'] = $this->datas->trataHoraBancoForm($obj->hora_alerta);
		$data['campoMotivoAlerta']['value'] = $obj->motivo_alerta;
		$data['campoConclusaoAlerta']['value'] = $obj->conclusao_alerta;
		
		
		$alerta_documento_conteudo = $this->Documento_model->get_historico($obj->id_documento)->result();
		
		$data['alerta_documento_conteudo'] = $alerta_documento_conteudo[0]->texto;

		if ($this->form_validation->run($this->area."/update") == FALSE) {

			$this->load->view($this->area.'/'.$this->area.'_edit', $data);
				
		} else {

			//cria um objeto com os dados passados via post
			$objeto_do_form = array(
					
					'data_alerta' => $this->datas->dateToUS($this->input->post('campoDataAlerta')),
					'hora_alerta' => $this->datas->trataHoraFormBanco($this->input->post('campoHoraMinutoAlerta')),
               		'motivo_alerta' => mb_convert_case($this->input->post('campoMotivoAlerta'), MB_CASE_UPPER, "UTF-8"),
					'conclusao_alerta' => mb_convert_case($this->input->post('campoConclusaoAlerta'), MB_CASE_UPPER, "UTF-8"),
			);
			
// 			print_r($objeto_do_form);
			
// 			exit();

			//trata os campos necessarios

			// $objeto_do_form['data_nascimento'] = $this->_trata_dataDoFormParaBanco($objeto_do_form['data_nascimento']);
			// $objeto_do_form['cpf'] = $this->_trata_CPFdoFormParaBanco($objeto_do_form['cpf']);

			// Checa duplicata
// 			$checa_duplicata = $this->Alerta_model->get_by_nome($objeto_do_form['nome'])->num_rows();

// 			if ($checa_duplicata > 1){

// 				$data['mensagem'] = '<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> O registro já existe </div>';

// 				$this->load->view($this->area.'/'.$this->area.'_edit', $data);

// 			}else{

				// Atualiza o cadastro
				$this->Alerta_model->update($id, $objeto_do_form);

				$this->js_custom = 'var sSecs = 4;
                                function getSecs(){
                                    sSecs--;
                                    if(sSecs<0){ sSecs=59; sMins--; }				
                                    $("#clock1").html(sSecs+" segundos...");		
                                    setTimeout("getSecs()",1000);		
                                    var s =  $("#clock1").html();
                                    if (s == "1 segundos..."){			
                                        window.location.href = "' . $_SESSION['novoinicio'] . '";
                                    }
                                }     		
                                ';

				$data['mensagem'] = "<br /><br />Redirecionando em... ";
				$data['mensagem'] .= '<span id="clock1"> ' . "<script>setTimeout('getSecs()',1000);</script> </span>";
				$data['link1'] = '';
				$data['link2'] = '';

				$this->load->view('success', $data);
					
// 			}

		}
	}
	
	function delete($id){
		// delete orgao
		$this->Alerta_model->delete($id);
		
		// redirect to orgao list page
		redirect($_SESSION['novoinicio']);
	}
	
	
	function sem_alertas(){
		$data['titulo'] = "Aletas";
		 $this->load->view($this->area.'/alerta_nenhum', $data);
	}


    public function search($page = 1) { 
    	$this->js[] = 'alerta';
        $data['titulo'] = "Busca por alertas";
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
        $config['total_rows'] = $this->Alerta_model->count_all_search($keyword, $this->session->userdata('id_usuario'));           
        
        $this->pagination->initialize($config);     
        $data['pagination'] = $this->pagination->create_links();
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Item', 'Documento', 'Data do alerta', 'Motivo', 'Conclusão', 'Ações');
        
        $inicio = (!$this->uri->segment($uri_segment, 0)) ? 0 : ($this->uri->segment($uri_segment, 0) - 1) * $maximo;

        $rows = $this->Alerta_model->listAllSearchPag($keyword, $maximo, $inicio, $this->session->userdata('id_usuario'));   
            
        foreach ($rows as $o){
        	
        	$documento =  $this->Documento_model->get_by_id($o->id_documento)->row();
        	 
        	$tipoNome = $this->Documento_model->get_tipo($documento->tipo)->row();
        	 
        	$setorRemetente = $this->getCaminho($documento->setor);

            $this->table->add_row($o->id_alerta, "$tipoNome->abreviacao Nº $documento->numero <br> $setorRemetente", $this->datas->datetimeToBR($o->data_alerta) . " - " . $this->datas->trataHoraBancoForm($o->hora_alerta), $o->motivo_alerta, $o->conclusao_alerta,
               '<div class="btn-group">'.
	               //$this->Campo_model->make_link($this->area, 'visualizar', $o->id_alerta).
	              // $this->Campo_model->make_link($this->area, 'alterar_sm', $o->id_alerta).
	               $this->Campo_model->make_link($this->area, 'alterar_sm', $o->id_alerta).
              	$this->Campo_model->make_link($this->area, 'deletar_sm', $o->id_alerta).
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
	
	function _trata_dataDoBancoParaForm($str){
		$ano = substr($str,0,4);
		$mes = substr($str,5,2);
		$dia = substr($str,8,2);
		return "$dia/$mes/$ano";
	}
	
	function _trata_dataDoFormParaBanco($str){
		$dia = substr($str,0,2);
		$mes = substr($str,3,2);
		$ano = substr($str,6,4);
		return "$ano-$mes-$dia";
	}
	
	public function getCaminho ($id_setor){
	
		$this->load->model('Setor_model', '', TRUE);
		$setor =  $this->Setor_model->get_by_id($id_setor)->row();
		 
		if($setor->setorPaiSigla and $setor->setorPaiSigla != "NENHUM" and $setor->setorPaiSigla != $setor->orgaoSigla and $setor->sigla != $setor->setorPaiSigla){
	
			$caminho =  $setor->sigla ."/" . $setor->setorPaiSigla ."/" . $setor->orgaoSigla;
			 
		}else{
	
			if($setor->sigla != $setor->orgaoSigla){
				$caminho =  $setor->sigla ."/" . $setor->orgaoSigla;
			}else{
				$caminho =  $setor->sigla;
			}
			 
		}
		 
		return $caminho;
	}
	
}
?>