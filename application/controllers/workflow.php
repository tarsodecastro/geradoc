<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workflow extends CI_Controller {
	
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
	
    private $area = "workflow";
        
	public function __construct (){
		parent::__construct();	
		$this->load->library(array('restrict_page','table','form_validation','session','datas'));
		$this->load->helper('url');
		$this->load->model('Workflow_model','',TRUE);
        $this->load->model('Grid_model','',TRUE);
        $this->load->model('Campo_model','',TRUE);
        $this->modal = $this->load->view('about_modal', '', TRUE);
        session_start();
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
	
	public function index($offset = 0){
		
		$this->js[] = 'tramitacao';
		
		$data['titulo']     = 'Recebimento de Documentos';
		$data['link_back'] = $this->Campo_model->make_link('', 'history_back');
		$data['form_action'] = site_url($this->area.'/search');
		
		$id_setor = $this->session->userdata('setor');
		
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

        $_SESSION['novoinicio'] = current_url();

        $config['base_url'] = site_url($this->area.'/index/');
        $config['total_rows'] = $this->Workflow_model->get_workflows($id_setor)->num_rows();
        $config['per_page'] = $maximo;

        $this->pagination->initialize($config);

        // load datas
        $objetos = $this->Workflow_model->get_workflows_paged_list($id_setor, $maximo, $inicio);

        // carregando os dados na tabela
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Item', 'Data do envio', 'Documento', 'Para', 'Assunto', 'Ações');
        
        $this->load->model('Documento_model','',TRUE);
        
        $this->load->library('utilities');
        
		foreach ($objetos as $objeto){
			
			$doc = $this->Documento_model->get_by_id($objeto->id_documento)->row();
	
			$tipoNome = $this->Documento_model->get_tipo($doc->tipo)->row();
			
			$setorRemetente = $this->getCaminho($doc->setor);
			
			$cor_texto = "";
			if($objeto->data_recebimento == null){
				$cor_texto = "text-primary";
				
				$botoes = '<a href="'.site_url().'/documento/view/'.$objeto->id_documento.'" class="btn btn-default btn-sm"><i class="cus-zoom"></i> Visualizar</a>
							<a href="'.site_url().'/workflow/acusar_recebimento/'.$objeto->id_workflow.'" class="btn btn-primary btn-sm" 
									data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-html="true" 
									title="<strong>Atenção</strong> <i class=\'fa fa-exclamation-triangle fa-lg\' style=\'color: #FF9933;\'></i>" 
									data-content="Este documento foi tramitado para o seu setor. Clique neste botão <strong>apenas</strong> se estiver com o documento em mãos. Caso não esteja, verifique com os demais membros do seu setor.">
									<span class="glyphicon glyphicon-ok"></span> Acusar recebimento
							</a>';
			}else{
				$cor_texto = "text-muted";
				$botoes = '<a href="'.site_url().'/documento/view/'.$objeto->id_documento.'" class="btn btn-default btn-sm"><i class="cus-zoom"></i> Visualizar</a>
							<a href="'.site_url().'/workflow/desfazer_recebimento/'.$objeto->id_workflow.'" class="btn btn-default btn-sm"><i class="cus-cross"></i> Desfazer recebimento</a>
							<a href="'.site_url().'/workflow/update/'.$objeto->id_documento.'" class="btn btn-success btn-sm"><i class="cus-paper_airplane"></i> Tramitação</a>';
			}
			
			if($doc->para == '0'){ // acontece com parecer tecnico 
				$doc->para = ''; 
			}
			
			$iconeComentario = $this->utilities->get_icone_comentario($objeto->id_documento);
			
			$this->table->add_row(
									'<span class="'.$cor_texto.'">'.$objeto->id_workflow.'</span>', 
									'<span class="'.$cor_texto.'">'.$this->datas->datetimeToBR($objeto->data_envio).'</span>', 
									'<span class="'.$cor_texto.'">'."$tipoNome->abreviacao Nº $doc->numero <span class='pull-right' style='padding-right:5px;'>$iconeComentario</span><br>$setorRemetente".'</span>',
									'<span class="'.$cor_texto.'">'.$doc->para.'</span>',
									'<span class="'.$cor_texto.'">'.$doc->assunto.'</span>',
									'<div class="btn-group">'.$botoes.'</div>'
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
	

    public function search($page = 1) { 
    	
    	$this->js[] = 'tramitacao';
        $data['titulo'] = "Recebimento de Documentos";
        $data['link_add']   = '';
        $data['link_back'] = $this->Campo_model->make_link('', 'history_back');
        $data['link_search_cancel'] = $this->Campo_model->make_link($this->area, 'search_cancel');
      
        $data['form_action'] = site_url($this->area.'/search');
        
        $id_setor = $this->session->userdata('setor');

        $this->load->library(array('pagination', 'table'));
        
        if(isset($_SESSION['keyword_'.$this->area]) == true and $_SESSION['keyword_'.$this->area] != null and $this->input->post('search') == null){
        	$keyword = $_SESSION['keyword_'.$this->area];
        }else{
        	
        	$keyword = ($this->input->post('search') == null or $this->input->post('search') == "pesquisa textual") ? redirect($this->area.'/index/') : $this->input->post('search');
        	$_SESSION['keyword_'.$this->area] = $keyword;
        	
        }
        
        $maximo = 10;  
        $uri_segment = 3;  
        
        $_SESSION['novoinicio'] = current_url();
        
        $config['per_page'] = $maximo;    
        $config['base_url'] = site_url($this->area.'/search');
        
        $config['total_rows'] = $this->Workflow_model->count_all_search($keyword, $id_setor);           
        
        $this->pagination->initialize($config);     
        $data['pagination'] = $this->pagination->create_links();
       

        $inicio = (!$this->uri->segment($uri_segment, 0)) ? 0 : ($this->uri->segment($uri_segment, 0) - 1) * $maximo;

        $objetos = $this->Workflow_model->listAllSearchPag($keyword, $maximo, $inicio, $id_setor);   
        
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Item', 'Data do envio', 'Documento', 'Para', 'Assunto', 'Ações');
        
     	$this->load->model('Documento_model','',TRUE);
        
		foreach ($objetos as $objeto){
			
			$doc = $this->Documento_model->get_by_id($objeto->id_documento)->row();
	
			$tipoNome = $this->Documento_model->get_tipo($doc->tipo)->row();
			
			$setorRemetente = $this->getCaminho($doc->setor);
			
			if($objeto->data_recebimento == null){
				$botoes = '<a href="'.site_url().'/documento/view/'.$objeto->id_documento.'" class="btn btn-default btn-sm"><i class="cus-zoom"></i> Visualizar</a>
							<a href="'.site_url().'/workflow/acusar_recebimento/'.$objeto->id_workflow.'" class="btn btn-primary btn-sm" 
									data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-html="true" 
									title="<strong>Atenção</strong> <i class=\'fa fa-exclamation-triangle fa-lg\' style=\'color: #FF9933;\'></i>" 
									data-content="Este documento foi tramitado para o seu setor. Clique neste botão <strong>apenas</strong> se estiver com o documento em mãos. Caso não esteja, verifique com os demais membros do seu setor.">
									<span class="glyphicon glyphicon-ok"></span> Acusar recebimento
							</a>';
			}else{
				$botoes = '<a href="'.site_url().'/documento/view/'.$objeto->id_documento.'" class="btn btn-default btn-sm"><i class="cus-zoom"></i> Visualizar</a>
							<a href="'.site_url().'/workflow/desfazer_recebimento/'.$objeto->id_workflow.'" class="btn btn-default btn-sm"><i class="cus-cross"></i> Desfazer recebimento</a>
							<a href="'.site_url().'/workflow/update/'.$objeto->id_documento.'" class="btn btn-success btn-sm"><i class="cus-paper_airplane"></i> Tramitação</a>';
			}
			
			if($doc->para == '0'){ // acontece com parecer tecnico 
				$doc->para = ''; 
			}
			
			$this->table->add_row($objeto->id_workflow, $this->datas->datetimeToBR($objeto->data_envio), 
					
				
					"$tipoNome->abreviacao Nº $doc->numero <br> $setorRemetente",

					$doc->para,
					
					$doc->assunto,
					
					'<div class="btn-group">'.$botoes.'</div>'
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
	
    function update($id){
    	$data['titulo']         = "Tramitação do documento";
    	$data['message']        = '';
    
    	$data['link_back'] = $this->Campo_model->make_link('', 'history_back');
    
    	$this->form_validation->set_error_delimiters('<div class="error_field"> <img class="img_align" src="{TPL_images}/error.png" alt="! " /> ', '</div>');
    
    	$data['form_action'] = site_url($this->area.'/update/'.$id);
    
    	$this->load->model('Documento_model','',TRUE);
    	$obj = $this->Documento_model->get_by_id($id)->row();
    
    	$this->load->model('Setor_model','',TRUE);
    	$setores = $this->Setor_model->list_all()->result();
    	$arraySetores[0] = "SELECIONE O DESTINO";
    	if($setores){
    		foreach ($setores as $setor){
    			$arraySetores[$setor->id] = $setor->nome . ' - ' . $setor->sigla;
    		}
    	}else{
    		$arraySetores[1] = "";
    	}
    	$setoresDisponiveis  =  $arraySetores;

    	$setor_origem = $this->Setor_model->get_by_id($obj->setor)->row();
    
    	$data['setor_origem'] = $setor_origem->nome;
    
    	$data['setor_destino'] = $obj->para;
    
    	$doc = $this->Documento_model->get_by_id($id)->row();
    	$tipoNome = $this->Documento_model->get_tipo($doc->tipo)->row();
    	$setorRemetente = $this->getCaminho($doc->setor);
    
    	$data['assunto'] = $doc->assunto;
    	$data['identificacao'] = "$tipoNome->abreviacao Nº $doc->numero - $setorRemetente" . ' <a href="'.site_url().'/documento/view/'.$id.'" class="btn btn-default btn-sm"><i class="cus-zoom"></i> Visualizar</a>';
    	
    
    	$campoSetor = '';
    
    	if($obj->setor == $this->session->userdata('setor')){
    
    		$campoSetor = form_dropdown('campoSetor', $setoresDisponiveis, 0, 'class="form-control input-sm selectpicker" data-size="5" data-style="btn-default" data-live-search="true"');
    
    	}
    	
    	$tramitacoes = $this->Workflow_model->list_workflow($id)->result();

    	$linhas_tramitacao = '';
    	$recebimento_prendente = false;
    
    	foreach ($tramitacoes as $tramitacao){
    			
    		if($tramitacao->id_setor_destino == $this->session->userdata('setor') and $tramitacao->data_recebimento != null){
    			$campoSetor = form_dropdown('campoSetor', $setoresDisponiveis, 0, 'class="form-control input-sm selectpicker" data-size="5" data-style="btn-default" data-live-search="true"');
    		}
    			
    		if($tramitacao->data_recebimento == null){
    			$tramitacao->data_recebimento = '-';
    			$recebimento_prendente = true;
    		}
    			
    		$remetente = $this->getUsuario($tramitacao->id_remetente);
    			
    		$setor = $this->getSetor($tramitacao->id_setor_destino);
    			
    			
    		$recebedor = $this->getUsuario($tramitacao->id_recebedor);
    			
    		if(isset($recebedor) and $recebedor != null){
    			$recebedorNome = $recebedor->nome;
    		}
    			
    	
    		if(isset($recebedor) and $recebedor == null and $tramitacao->id_remetente == $this->session->userdata('id_usuario')){
    			$recebedorNome = '<a href="'.site_url().'/workflow/delete/'.$tramitacao->id_workflow.'/'.$tramitacao->id_documento.'" class="btn btn-default btn-sm"><i class="cus-cross"></i> Cancelar</a>';
    		}
    			
    		if(isset($recebedor) and $recebedor == null and $tramitacao->id_remetente != $this->session->userdata('id_usuario')){
    			$recebedorNome = '';
    		}
    			
    		$linhas_tramitacao .= '<tr>
									<td width="100px">
										'.$this->datas->datetimeToBR($tramitacao->data_envio).'
									</td>
									<td>
										'.$remetente->nome.'
									</td>
									<td>
										'.$setor->nome.'
									</td>
									<td width="100px">
										'.$this->datas->datetimeToBR($tramitacao->data_recebimento).'
									</td>
									<td>
										'.$recebedorNome.'
									</td>
						        </tr>';
    			
    	}
    
    
    	if($recebimento_prendente == true){
    		$campoSetor = '';
    	}
    
    	$data['campoSetor'] = $campoSetor;
    
    	$data['privado'] = $doc->oculto;
    
    	$data['linhas_tramitacao'] = $linhas_tramitacao;
    
    	if ($this->form_validation->run($this->area."/update") == FALSE) {
    			
    		$this->load->view($this->area.'/workflow_edit', $data);
    			
    	} else {
    			

    		//cria o objeto com os dados passados via post
    		$objeto_do_form = array(
    				'id_documento' => $id,
    				'id_setor_destino' => $this->input->post('campoSetor'),
    				'id_remetente' => $this->session->userdata('id_usuario'),
    				'data_envio' => date("Y-m-d H:i:s"),
    		);
	
    		// Salva o registro
    		$this->Workflow_model->save($objeto_do_form);
    
    		$redirecionamento = site_url() . '/workflow/update/' . $id;
    
    		$this->js_custom = 'var sSecs = 4;
                                function getSecs(){
                                    sSecs--;
                                    if(sSecs<0){ sSecs=59; sMins--; }
                                    $("#clock1").html(sSecs+" segundos...");
                                    setTimeout("getSecs()",1000);
                                    var s =  $("#clock1").html();
                                    if (s == "1 segundos..."){
                                        window.location.href = "' .  $redirecionamento . '";
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
    
    
    function acusar_recebimento($id){
    	$obj["id_recebedor"] = $this->session->userdata('id_usuario');
    	$obj["data_recebimento"] = date("Y-m-d H:i:s");
    	$this->Workflow_model->update($id,$obj);
    	redirect('workflow');
    }
    
    function desfazer_recebimento($id){
    	$obj["data_recebimento"] = null;
    	$obj["id_recebedor"] = null;
    	$this->Workflow_model->update($id,$obj);
    	redirect('workflow');
    }
    
    function delete($id, $id_doc){
    	$this->Workflow_model->delete($id);
    	redirect('workflow/update/'. $id_doc);
    }
    
    function suspender_aviso(){
    	$_SESSION['workflow_wait'] = "wait";
    	redirect('documento/index/');
    }
    
    public function getUsuario ($id_usuario){
    
    	$this->load->model('Usuario_model', '', TRUE);
    	$usuario =  $this->Usuario_model->get_by_id($id_usuario)->row();
    
    	return $usuario;
    }
    
    public function getSetor ($id_setor){
    
    	$this->load->model('Setor_model', '', TRUE);
    	$setor =  $this->Setor_model->get_by_id($id_setor)->row();
    
    	return $setor;
    }
    
}
?>