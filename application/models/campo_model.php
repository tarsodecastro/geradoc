<?php

class Campo_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
    
    /* 
     * Botoes dos links:
     */ 
	/*
 	function linkBack($area, $texto) {
        $link = anchor('' . $area . '/index/', 'Voltar para a lista de ' . $texto, array('class' => 'back'));
        return $link;
    }

    function linkPdf($area, $id) {
        $link = anchor('' . $area . '/export/' . $id, 'Imprimir', array('class' => 'imprimir'));
        return $link;
    }

    function linkMail($area, $id) {
        $link = anchor('' . $area . '/mail/' . $id, 'Enviar', array('class' => 'mail'));
        return $link;
    }
    
	function linkOk($area) {
        $link = 'onClick="location.href=\'' . base_url() . 'index.php/' . $area . '/index\'"';
        return $link;
    }
    */
	
	function make_link($area = null, $string, $id = null){
	
		switch ($string){
			
			case 'add':
				$link =  anchor($area.'/add/','<span class="glyphicon glyphicon-plus"></span> Adicionar',array('class'=>'btn btn-primary btn-sm'));
			break;
				
			case 'visualizar':
				$link =  anchor($area.'/view/'.$id,'<i class="cus-zoom"></i> Visualizar', array('class'=>'btn btn-default btn-sm'));
			break;
			
			case 'visualizar_historico':
				//$link =  anchor($area.'/view/'.$id,'<i class="cus-zoom"></i> Visualizar texto completo', array('class'=>'btn btn-default btn-sm'));
				$link = '<a href="#dialog" name="modal" class="btn btn-default btn-sm"><i class="cus-zoom"></i> Visualizar texto completo</a>';
			break;
				
			case 'voltar':
				$link = anchor($_SESSION['novoinicio'],'<span class="glyphicon glyphicon-arrow-left"></span> Voltar',array('class'=>'btn btn-default btn-sm'));
			break;
				
			case 'voltar_doc':
				//anchor($_SESSION['homepage'],'<span class="glyphicon glyphicon-arrow-left"></span> Voltar',array('class'=>'btn btn-warning btn-sm'));
				$link = anchor($_SESSION['homepage'],'<span class="glyphicon glyphicon-arrow-left"></span> Voltar',array('class'=>'btn btn-default btn-sm'));
			break;
			
			case 'history_back':
				//$link = anchor('#','<span class="glyphicon glyphicon-arrow-left"></span> Voltar', array('class'=>'btn btn-default btn-sm', 'onclick'=>'javascript: window.history.go(-1)'));
					
				$link = '<a href="javascript: window.history.go(-1)" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>';
			break;
				
			case 'cancelar':
				$link = anchor($_SESSION['novoinicio'],'<span class="glyphicon glyphicon-remove"></span> Cancelar',array('class'=>'btn btn-default'));
			break;
				
			case 'cancelar_doc':
				$link = anchor($_SESSION['homepage'],'<span class="glyphicon glyphicon-remove"></span> Cancelar',array('class'=>'btn btn-default'));
			break;
				
			case 'alterar_sm':
				$link = anchor($area.'/update/'.$id,'<i class="cus-pencil"></i> Alterar', array('class'=>'btn btn-default btn-sm'));
			break;
				
			case 'alterar':
				$link = anchor($area.'/update/'.$id,'<span class="glyphicon glyphicon-pencil"></span> Alterar', array('class'=>'btn btn-warning'));
			break;
			
			case 'alterar_doc':
				$link = anchor($area.'/update/'.$id,'<i class="cus-pencil"></i> Alterar', array('class'=>'btn btn-default btn-sm'));
			break;
			
			case 'stamp':
				$link = anchor($area.'/stamp/'.$id,'<i class="cus-stamp_in"></i> Carimbar', array('class'=>'btn btn-default btn-sm'));
			break;
			
			case 'stamp_out':
				$link = anchor($area.'/stamp_out/'.$id,'<i class="cus-stamp_out"></i> Retirar carimbo', array('class'=>'btn btn-default btn-sm'));
			break;
			
			case 'history':
				$link = anchor($area.'/history/'.$id,'<i class="cus-clock_history"></i> Versões', array('class'=>'btn btn-primary btn-sm'));
			break;
			
			case 'workflow':
				$link = anchor('/workflow/update/'.$id,'<i class="cus-paper_airplane"></i> Tramitação', array('class'=>'btn btn-success btn-sm'));
			break;
				
			case 'salvar':
				$link = '<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon glyphicon-ok"></span> Salvar</button>';
			break;
				
			case 'search_cancel':
				$link = anchor($area.'/search_cancel/','Cancelar pesquisa',array('class'=>'btn btn-warning'));
			break;
				
			case 'funcionarios':
				$link = anchor($area.'/funcionarios/'.$id,'<i class="cus-user"></i> Funcionários', array('class'=>'btn btn-default btn-sm'));
			break;
			
			case 'exportar':
				$link = anchor($area.'/export/'.$id,'<i class="fa fa-file-pdf-o fa-lg" style="color: #d9534f;"></i> Exportar', array('target'=>'_blank', 'class'=>'btn btn-default btn-sm'));
			break;
			
			case 'exportar_doc':
				$link = anchor($area.'/export/'.$id,'<span class="glyphicon glyphicon-print"></span> Exportar', array('target'=>'_blank', 'class'=>'btn btn-primary'));
			break;
			
			case 'ano':
				$link =  anchor($area.'/year/'.$id,'<i class="cus-date"></i> Ano', array('class'=>'btn btn-default btn-sm'));
			break;
			
			case 'despublicado':
				$link =  anchor($area.'/altera_publicacao/'.$id,'<i class="cus-cross"></i> Despublicado', array('class'=>'btn btn-default btn-sm'));
			break;
			
			case 'publicado':
				$link =  anchor($area.'/altera_publicacao/'.$id,'<i class="cus-tick"></i> Publicado', array('class'=>'btn btn-default btn-sm'));
			break;
				
		}
	
		return $link;
	
	}
    
    
    
    /*
     * Fim do botoes
     */

    /* 
     * Campos dos formularios
     */    
    
	function orgao($indice) {
        $campo = array(
         
	            'campoNome' => array(
	                'name' => 'campoNome',
	                'id' => 'campoNome',
	            	'type'=>'text',
	            	'placeholder'=> 'Nome',
	                'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
	                'maxlength' => '90',
	                'size' => '71',
	                'class' => 'form-control  text-uppercase',
	            ),
        		
        		'campoSigla' => array(
        				'name' => 'campoSigla',
        				'id' => 'campoSigla',
        				'type'=>'text',
        				'placeholder'=> 'Sigla',
        				'value' => mb_convert_case($this->input->post('campoSigla'), MB_CASE_UPPER, "ISO-8859-1"),
        				'maxlength' => '20',
        				'size' => '21',
        				'class' => 'form-control  text-uppercase',
        		),
        		
        		'campoEndereco' => array(
        				'name' => 'campoEndereco',
        				'id' => 'campoEndereco',
        				'type'=>'text',
        				'placeholder'=> 'Endereço',
        				'value' => mb_convert_case($this->input->post('campoEndereco'), MB_CASE_UPPER, "ISO-8859-1"),
        				'cols'  => '70',
                        'rows'  =>  '2',
        				'class' => 'form-control  text-uppercase',
        		),
        			
        );

        return $campo[$indice];
    }
    
    
    function cargo($indice) {
    	$campo = array(

    			'campoNome' => array(
    					'name' => 'campoNome',
    					'id' => 'campoNome',
    					'type'=>'text',
    					'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '90',
    					'size' => '71',
    					'class' => 'form-control text-uppercase',
    			),
    	);
    
    	return $campo[$indice];
    }
    
    function coluna($indice) {
    	$campo = array(
    			'campoNome' => array(
    					'name' => 'campoNome',
    					'id' => 'campoNome',
    					'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_LOWER, "ISO-8859-1"),
    					'maxlength' => '20',
    					'size' => '21',
    					'class' => 'form-control text-lowercase',
    			),
    			'campoTamanho' => array(
    					'name' => 'campoTamanho',
    					'id' => 'campoTamanho',
    					'value' => mb_convert_case($this->input->post('campoTamanho'), MB_CASE_LOWER, "ISO-8859-1"),
    					'maxlength' => '4',
    					'size' => '5',
    					'class' => 'form-control text-lowercase',
    			),
    	);
    
    	return $campo[$indice];
    }
    
    function tipo($indice) {
    	$campo = array(
    			'campoAno' => array(
    					'name' => 'campoAno',
    					'id' => 'campoAno',
    					'value' => $this->input->post('campoAno'),
    					'maxlength' => '4',
    					'size' => '5',
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoNome' => array(
    					'name' => 'campoNome',
    					'id' => 'campoNome',
    					'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '90',
    					'size' => '61',
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoAbreviacao' => array(
    					'name' => 'campoAbreviacao',
    					'id' => 'campoAbreviacao',
    					'value' => mb_convert_case($this->input->post('campoAbreviacao'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '15',
    					'size' => '15',
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoInicio' => array(
    					'name' => 'campoInicio',
    					'id' => 'campoInicio',
    					'value' => $this->input->post('campoInicio'),
    					'maxlength' => '3',
    					'size' => '4',
    					'class' => 'form-control text-uppercase',
    			),
    			'campoCabecalho' => array(
    					'name' => 'campoCabecalho',
    					'id' => 'campoCabecalho',
    					'value' => $this->input->post('campoCabecalho'),
    					'rows'  => '11',
    			),
    			'campoConteudo' => array(
    					'name' => 'campoConteudo',
    					'id' => 'campoConteudo',
    					'value' => $this->input->post('campoConteudo'),
    					'rows'  => '13',
    			),
    			'campoRodape' => array(
    					'name' => 'campoRodape',
    					'id' => 'campoRodape',
    					'value' => $this->input->post('campoRodape'),
    					'rows'  => '4',
    			),
    			
    			'campoFlagRedacao' => array(
    					'name' => 'campoFlagRedacao',
    					'id' => 'campoFlagRedacao',
    					'value' => mb_convert_case($this->input->post('campoFlagRedacao'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoFlagObjetivo' => array(
    					'name' => 'campoFlagObjetivo',
    					'id' => 'campoFlagObjetivo',
    					'value' => mb_convert_case($this->input->post('campoFlagObjetivo'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoFlagDocumentacao' => array(
    					'name' => 'campoFlagDocumentacao',
    					'id' => 'campoFlagDocumentacao',
    					'value' => mb_convert_case($this->input->post('campoFlagDocumentacao'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoFlagAnalise' => array(
    					'name' => 'campoFlagAnalise',
    					'id' => 'campoFlagAnalise',
    					'value' => mb_convert_case($this->input->post('campoFlagAnalise'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoFlagConclusao' => array(
    					'name' => 'campoFlagConclusao',
    					'id' => 'campoFlagConclusao',
    					'value' => mb_convert_case($this->input->post('campoFlagConclusao'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'form-control text-uppercase',
    			),
    			 
    			'arrayFlags' => array(
    					'S'  => 'SIM',
    					'N'  => 'NÃO',
    			),
    	);
    
    	return $campo[$indice];
    }
    
    //------- Documento -------//
    
    function documento($indice) {
    	$campo = array(
    			'campoData' => array(
    					'name' => 'campoData',
						'id'   => 'campoData',
    					'value' => $this->input->post('campoData'),
    					'maxlength' => '10',
    					'size' => '12',
    					'class' => 'form-control',
    			),
    			 
    			'campoAssunto' => array(
    					'name' => 'campoAssunto',
    					'id' => 'campoAssunto',
    					'value' => $this->input->post('campoAssunto'),
    					'maxlength' => '80',
    					'size' => '71',
    					'class' => 'form-control',
    			),
    			 
    			'campoReferencia' => array(
    					'name' => 'campoReferencia',
    					'id' => 'campoReferencia',
    					'value' => $this->input->post('campoReferencia'),
    					'maxlength' => '80',
    					'size' => '51',
    					'class' => 'form-control',
    			),
    			
    			'campoPara' => array(
    					'name' 	=> 'campoPara',
    					'id' 	=> 'campoPara',
    					'value' => $this->input->post('campoPara'),
    					'rows'  => '4',
    					'style' => 'display: true',
    			),
    			
    			'campoRedacao' 	=> array(
    					'name' 	=> 'campoRedacao',
    					'id'	=> 'campoRedacao',
    					'value'	=> $this->input->post('campoRedacao'),
    					'rows'  => '20',
    					
    			),
    			
    			'campoObjetivo' 	=> array(
    					'name' 	=> 'campoObjetivo',
    					'id'	=> 'campoObjetivo',
    					'value'	=> $this->input->post('campoObjetivo'),
    					'rows'  => '10',		
    			),
    			
    			'campoDocumentacao' 	=> array(
    					'name' 	=> 'campoDocumentacao',
    					'id'	=> 'campoDocumentacao',
    					'value'	=> $this->input->post('campoDocumentacao'),
    					'rows'  => '10',
    			),
    			
    			'campoAnalise' 	=> array(
    					'name' 	=> 'campoAnalise',
    					'id'	=> 'campoAnalise',
    					'value'	=> $this->input->post('campoAnalise'),
    					'rows'  => '20',
    			),
    			
    			'campoConclusao' 	=> array(
    					'name' 	=> 'campoConclusao',
    					'id'	=> 'campoConclusao',
    					'value'	=> $this->input->post('campoConclusao'),
    					'rows'  => '20',
    			),
    			
    			'campoSetor' => array(
    					'name' => 'campoSetor',
    					'id' => 'campoSetor',
    					'value' => $this->input->post('campoSetor'),
    					'maxlength' => '80',
    					'size' => '51',
    					'class' => 'form-control text-upper',
    					'readonly'    => 'readonly',
    			),
    			
    			'desp_num_processo' => array(
    					'name' => 'desp_num_processo',
    					'id' => 'desp_num_processo',
    					'value' => $this->input->post('desp_num_processo'),
    					'maxlength' => '80',
    					'size' => '51',
    					'class' => 'form-control',
    			),
    			
    			'desp_interessado' => array(
    					'name' => 'desp_interessado',
    					'id' => 'desp_interessado',
    					'value' => $this->input->post('desp_interessado'),
    					'maxlength' => '80',
    					'size' => '51',
    					'class' => 'form-control',
    			),
    			
    			'desp_de' => array(
    					'name' => 'desp_de',
    					'id' => 'desp_de',
    					'value' => $this->input->post('desp_de'),
    					'maxlength' => '80',
    					'size' => '81',
    					'class' => 'form-control',
    			),
    			
    			
    			'desp_para' => array(
    					'name' => 'desp_para',
    					'id' => 'desp_para',
    					'value' => $this->input->post('desp_para'),
    					'maxlength' => '80',
    					'size' => '81',
    					'class' => 'form-control',
    			),
    			
    			'campoCarimbo' => array(
    					'name' => 'campoCarimbo',
    					'id' => 'campoCarimbo',
    					'value' => mb_convert_case($this->input->post('campoCarimbo'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'form-control text-upper',
    			),
    			
    			'arrayCarimbos' => array(
    					'N'  => 'SEM CARIMBO',
    					'S'  => 'COM CARIMBO',
    			),
    			
    			
    	);
    
    	return $campo[$indice];
    }
    
    
    //--- Fim do Documento ---//
    
    
    function setor($indice) {
    	$campo = array(

    			
    			'campoNome' => array(
    					'name' => 'campoNome',
    					'id' => 'campoNome',
    					'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
    					'cols'  => '70',
    					'rows'  =>  '2',
    					'class' => 'form-control text-uppercase',
    			),
    			 
    			'campoSigla' => array(
    					'name' => 'campoSigla',
    					'id' => 'campoSigla',
    					'type'=>'text',
    					'value' => mb_convert_case($this->input->post('campoSigla'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '31',
    					'size' => '30',
    					'class' => 'form-control text-uppercase',
    			),
    			 
        		'campoEndereco' => array(
        				'name' => 'campoEndereco',
        				'id' => 'campoEndereco',
        				'value' => mb_convert_case($this->input->post('campoEndereco'), MB_CASE_UPPER, "ISO-8859-1"),
        				'cols'  => '70',
                        'rows'  =>  '2',
        				'class' => 'form-control  text-uppercase',
        		),
    			
    			'campoArtigo' => array(
    					'name' => 'campoArtigo',
    					'id' => 'campoArtigo',
    					'value' => mb_convert_case($this->input->post('campoArtigo'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'form-control  text-uppercase',
    			),
    			
    			'arrayArtigos' => array(
    					'A'  => 'A',
                        'O'  => 'O',
                        'AS' => 'AS',
                        'OS' => 'OS',
    			),
    			
    			'campoRestricao' => array(
    					'name' => 'campoRestricao',
    					'id' => 'campoRestricao',
    					'value' => mb_convert_case($this->input->post('campoRestricao'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'form-control  text-uppercase',
    			),
    			
    			'arrayRestricoes' => array(
    					'S'  => 'SIM',
    					'N'  => 'NÃO',
    			),
    			
    			'campoFuncionarios' => array(
    					'name' => 'campoFuncionarios[]',
    					'id' => 'campoFuncionarios[]',
    					'value' => $this->input->post('campoFuncionarios'),
    					'class' => 'form-control  text-uppercase',
    			),
    			
    			
    			'campoFuncionariosSelecionados' => array(
    					'name' => 'campoFuncionariosSelecionados',
    					'id' => 'campoFuncionariosSelecionados',
    					'value' => $this->input->post('campoFuncionariosSelecionados[]'),
    					'class' => 'form-control  text-uppercase',
    			),
    			
    			'campoTamanhoRepositorio' => array(
    					'name' => 'campoTamanhoRepositorio',
    					'id' => 'campoTamanhoRepositorio',
    					'type'=>'text',
    					'value' => mb_convert_case($this->input->post('campoTamanhoRepositorio'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '10',
    					'size' => '15',
    					'class' => 'form-control text-uppercase',
    			),
    			
    			
    			
    	);
    
    	return $campo[$indice];
    }
    
    
    function usuario($indice) {
    	$campo = array(
    
    			'campoCPF' => array(
    					'name' => 'campoCPF',
    					'id' => 'campoCPF',
    					'value' => $this->input->post('campoCPF'),
    					'maxlength' => '11',
    					'size' => '12',
    					'class' => 'form-control',
    			),
    			
    			'campoNome' => array(
    					'name' => 'campoNome',
    					'id' => 'campoNome',
    					'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
    					'cols'  => '70',
    					'rows'  =>  '2',
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoSenha' => array(
    					'name' => 'campoSenha',
    					'id' => 'campoSenha',
    					'value' => $this->input->post('campoSenha'),
    					'size' => '15',
    					'class' => 'form-control',
    			),
    			
    			'campoConfSenha' => array(
    					'name' => 'campoConfSenha',
    					'id' => 'campoConfSenha',
    					'value' => $this->input->post('campoConfSenha'),
    					'size' => '15',
    					'class' => 'form-control',
    			),
   
    			'campoNivel' => array(
    					'name' => 'campoNivel',
    					'id' => 'campoNivel',
    					'value' => mb_convert_case($this->input->post('campoNivel'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'form-control text-uppercase',
    			),
    	
		    	'campoMail1' => array(
    					'name' 		=> 'campoMail1',
    					'id'		=> 'campoMail1',
    					'value' 	=> mb_convert_case($this->input->post('campoMail1'), MB_CASE_LOWER, "ISO-8859-1"),
    					'maxgenght' => '60',
                        'size'      => '45',
    					'class' 	=> 'form-control text-lowercase',
    			),
    	
		    	'campoMail2' => array(
				    	'name' 		=> 'campoMail2',
				    	'id'		=> 'campoMail2',
				    	'value' 	=> mb_convert_case($this->input->post('campoMail2'), MB_CASE_LOWER, "ISO-8859-1"),
				    	'maxgenght' => '60',
				    	'size'      => '45',
				    	'class' 	=> 'form-control text-lowercase',
		    	),
    			 
    			'arrayNiveis' => array(
    					'1'  => 'ADMINISTRADOR',
    					'2'  => 'REDATOR',
    			),
    			
    			'campoTamanhoUpload' => array(
    					'name' => 'campoTamanhoUpload',
    					'id' => 'campoTamanhoUpload',
    					'type'=>'text',
    					'value' => mb_convert_case($this->input->post('campoTamanhoUpload'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '10',
    					'size' => '15',
    					'class' => 'form-control text-uppercase',
    			),
    			 
    			 
    			 
    	);
    
    	return $campo[$indice];
    }
    
    
    
    function contato($indice) {
    	$campo = array(
    			 
    			'campoNome' => array(
    					'name' 	 	=> 'campoNome',
    					'id'	 	=> 'campoNome',
    					'value' 	=> mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
    					'cols'  	=> '70',
    					'rows'  	=>  '2',
    					'class' 	=> 'form-control text-uppercase',
    			),
    			
    			'campoAssinatura' => array(
    					'name' 	 	=> 'campoAssinatura',
    					'id'	 	=> 'campoAssinatura',
    					'value' 	=> $this->input->post('campoAssinatura'),
    					'cols'  	=> '70',
    					'rows'  	=> '2',
    					'class' 	=> 'text',
    			),
    			
    			'campoFone' => array(
    					'name'		=> 'campoFone',
    					'id' 		=> 'campoFone',
    					'value'		=> $this->input->post('campoFone'),
    					'maxgenght' => '15',
                        'size'      => '16',
    					'class'		=> 'form-control text-uppercase',
    			),
    			
    			'campoCelular' => array(
    					'name' 		=> 'campoCelular',
    					'id' 		=> 'campoCelular',
    					'value' 	=> $this->input->post('campoCelular'),
    					'maxgenght' => '15',
                        'size'      => '16',
    					'class' 	=> 'form-control text-uppercase',
    			),
    			
    			'campoFax' => array(
    					'name' 		=> 'campoFax',
    					'id' 		=> 'campoFax',
    					'value' 	=> $this->input->post('campoFax'),
    					'maxgenght'	=> '15',
                         'size'     => '16',
    					'class' 	=> 'form-control text-uppercase',
    			),
    			
    			'campoMail1' => array(
    					'name' 		=> 'campoMail1',
    					'id' 		=> 'campoMail1',
    					'value' 	=> mb_convert_case($this->input->post('campoMail1'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxgenght' => '60',
                        'size'      => '45',
    					'class' 	=> 'form-control text-lowercase',
    			),
    			
    			'campoMail2' => array(
    					'name' 		=> 'campoMail2',
    					'id'		=> 'campoMail2',
    					'value' 	=> mb_convert_case($this->input->post('campoMail2'), MB_CASE_LOWER, "ISO-8859-1"),
    					'maxgenght' => '60',
                        'size'      => '45',
    					'class' 	=> 'form-control text-lowercase',
    			),
    			
    			'campoCargo' => array(
    					'name' => 'campoCargo',
    					'id' => 'campoCargo',
    					'value' => mb_convert_case($this->input->post('campoCargo'), MB_CASE_LOWER, "ISO-8859-1"),
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoSetor' => array(
    					'name' => 'campoSetor',
    					'id' => 'campoSetor',
    					'value' => mb_convert_case($this->input->post('campoSetor'), MB_CASE_UPPER, "ISO-8859-1"),
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'campoSexo' => array(
    					'name' => 'campoSexo',
    					'id' => 'campoSexo',
    					'value' => mb_convert_case($this->input->post('campoSexo'), MB_CASE_UPPER, "ISO-8859-1"),
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'arraySexos' => array(
    					'M'  => 'MASCULINO',
    					'F'  => 'FEMININO',
    			),
    			
    			'campoStatus' => array(
    					'name' => 'campoStatus',
    					'id' => 'campoStatus',
    					'value' => mb_convert_case($this->input->post('campoStatus'), MB_CASE_UPPER, "ISO-8859-1"),
    					'class' => 'form-control text-uppercase',
    			),
    			
    			'arrayStatus' => array(
    					'A'  => 'ATIVO',
    					'I'  => 'INATIVO',
    			),
    			 
    			
    
    
    
    	);
    
    	return $campo[$indice];
    }
    
	function funcao($indice) {
        $campo = array(
         
            'campoNome' => array(
                'name' => 'campoNome',
                'id' => 'campoNome',
                'value' => $this->input->post('campoNome'),
                'maxlength' => '50',
                'size' => '51',
                'class' => 'textboxUpper',
            ),
        );

        return $campo[$indice];
    }
    
    
    function estatisticas($indice) {
    	$campo = array(
    			 
    			
        	'campoDataIni' => array(
                'name' => 'campoDataIni',
                'id' => 'campoDataIni',
                'value' => $this->input->post('campoDataIni'),
                'maxgenght' => '10',
                'class' => 'form-control',
            ),
    		
    		'campoDataFim' => array(
    			'name' => 'campoDataFim',
    			'id' => 'campoDataFim',
    			'value' => $this->input->post('campoDataFim'),
    			'maxgenght' => '10',
    			'class' => 'form-control',
    		),
    			
    			
    	);
    
    	return $campo[$indice];
    }
    
    function repositorio($indice) {
    	$campo = array(
    			 
    			'campoNome' => array(
    					'name' => 'campoNome',
    					'id' => 'campoNome',
    					'type'=>'text',
    					'placeholder'=> 'Nome',
    					'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '90',
    					'size' => '71',
    					'class' => 'form-control  text-uppercase',
    					'required' => 'required',
    			),

    			'campoDescricao' => array(
    					'name' => 'campoDescricao',
    					'id' => 'campoDescricao',
    					'type'=>'text',
    					'placeholder'=> 'Descrição',
    					'value' => mb_convert_case($this->input->post('campoDescricao'), MB_CASE_UPPER, "ISO-8859-1"),
    					'cols'  => '70',
    					'rows'  =>  '2',
    					'class' => 'form-control  text-uppercase',
    					'required' => 'required',
    			),
    			 
    	);
    
    	return $campo[$indice];
    }
    
  

}

?>