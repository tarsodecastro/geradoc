<?php

class Campo_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
    
    /* 
     * Botoes dos links:
     */ 
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
	                'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
	                'maxlength' => '90',
	                'size' => '71',
	                'class' => 'textboxUpper',
	            ),
        		
        		
        		'campoSigla' => array(
        				'name' => 'campoSigla',
        				'id' => 'campoSigla',
        				'value' => mb_convert_case($this->input->post('campoSigla'), MB_CASE_UPPER, "ISO-8859-1"),
        				'maxlength' => '20',
        				'size' => '21',
        				'class' => 'textboxUpper',
        		),
        		
        		
        		'campoEndereco' => array(
        				'name' => 'campoEndereco',
        				'id' => 'campoEndereco',
        				'value' => mb_convert_case($this->input->post('campoEndereco'), MB_CASE_UPPER, "ISO-8859-1"),
        				'cols'  => '70',
                        'rows'  =>  '2',
        				'class' => 'textboxUpper',
        		),
        		
        		
        		
        		
        );

        return $campo[$indice];
    }
    
    
    function cargo($indice) {
    	$campo = array(
    			'campoNome' => array(
    					'name' => 'campoNome',
    					'id' => 'campoNome',
    					'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '90',
    					'size' => '71',
    					'class' => 'textboxUpper',
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
    					'class' => 'textboxLower',
    			),
    			'campoTamanho' => array(
    					'name' => 'campoTamanho',
    					'id' => 'campoTamanho',
    					'value' => mb_convert_case($this->input->post('campoTamanho'), MB_CASE_LOWER, "ISO-8859-1"),
    					'maxlength' => '4',
    					'size' => '5',
    					'class' => 'textboxLower',
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
    					'class' => 'textboxUpper',
    			),
    			
    			'campoNome' => array(
    					'name' => 'campoNome',
    					'id' => 'campoNome',
    					'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '90',
    					'size' => '61',
    					'class' => 'textboxUpper',
    			),
    			
    			'campoAbreviacao' => array(
    					'name' => 'campoAbreviacao',
    					'id' => 'campoAbreviacao',
    					'value' => mb_convert_case($this->input->post('campoAbreviacao'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '15',
    					'size' => '15',
    					'class' => 'textboxUpper',
    			),
    			
    			'campoInicio' => array(
    					'name' => 'campoInicio',
    					'id' => 'campoInicio',
    					'value' => $this->input->post('campoInicio'),
    					'maxlength' => '3',
    					'size' => '4',
    					'class' => 'textboxUpper',
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
    					'class' => 'textboxUpper',
    			),
    			
    			'campoFlagObjetivo' => array(
    					'name' => 'campoFlagObjetivo',
    					'id' => 'campoFlagObjetivo',
    					'value' => mb_convert_case($this->input->post('campoFlagObjetivo'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'textboxUpper',
    			),
    			
    			'campoFlagDocumentacao' => array(
    					'name' => 'campoFlagDocumentacao',
    					'id' => 'campoFlagDocumentacao',
    					'value' => mb_convert_case($this->input->post('campoFlagDocumentacao'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'textboxUpper',
    			),
    			
    			'campoFlagAnalise' => array(
    					'name' => 'campoFlagAnalise',
    					'id' => 'campoFlagAnalise',
    					'value' => mb_convert_case($this->input->post('campoFlagAnalise'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'textboxUpper',
    			),
    			
    			'campoFlagConclusao' => array(
    					'name' => 'campoFlagConclusao',
    					'id' => 'campoFlagConclusao',
    					'value' => mb_convert_case($this->input->post('campoFlagConclusao'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'textboxUpper',
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
    					'class' => 'textboxUpper',
    			),
    			 
    			'campoAssunto' => array(
    					'name' => 'campoAssunto',
    					'id' => 'campoAssunto',
    					'value' => $this->input->post('campoAssunto'),
    					'maxlength' => '80',
    					'size' => '51',
    					'class' => 'textbox',
    			),
    			 
    			'campoReferencia' => array(
    					'name' => 'campoReferencia',
    					'id' => 'campoReferencia',
    					'value' => $this->input->post('campoReferencia'),
    					'maxlength' => '80',
    					'size' => '51',
    					'class' => 'textbox',
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
    					'class' => 'textboxUpper',
    					'readonly'    => 'readonly',
    			),
    			
    			'desp_num_processo' => array(
    					'name' => 'desp_num_processo',
    					'id' => 'desp_num_processo',
    					'value' => $this->input->post('desp_num_processo'),
    					'maxlength' => '80',
    					'size' => '51',
    					'class' => 'textbox',
    			),
    			
    			'desp_interessado' => array(
    					'name' => 'desp_interessado',
    					'id' => 'desp_interessado',
    					'value' => $this->input->post('desp_interessado'),
    					'maxlength' => '80',
    					'size' => '51',
    					'class' => 'textbox',
    			),
    			
    			'desp_de' => array(
    					'name' => 'desp_de',
    					'id' => 'desp_de',
    					'value' => $this->input->post('desp_de'),
    					'maxlength' => '80',
    					'size' => '81',
    					'class' => 'textbox',
    			),
    			
    			
    			'desp_para' => array(
    					'name' => 'desp_para',
    					'id' => 'desp_para',
    					'value' => $this->input->post('desp_para'),
    					'maxlength' => '80',
    					'size' => '81',
    					'class' => 'textbox',
    			),
    			
    			'campoCarimbo' => array(
    					'name' => 'campoCarimbo',
    					'id' => 'campoCarimbo',
    					'value' => mb_convert_case($this->input->post('campoCarimbo'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'textboxUpper',
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
    					'class' => 'textboxUpper',
    			),
    			 
    			'campoSigla' => array(
    					'name' => 'campoSigla',
    					'id' => 'campoSigla',
    					'value' => mb_convert_case($this->input->post('campoSigla'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '31',
    					'size' => '30',
    					'class' => 'textboxUpper',
    			),
    			 
        		'campoEndereco' => array(
        				'name' => 'campoEndereco',
        				'id' => 'campoEndereco',
        				'value' => mb_convert_case($this->input->post('campoEndereco'), MB_CASE_UPPER, "ISO-8859-1"),
        				'cols'  => '70',
                        'rows'  =>  '2',
        				'class' => 'textboxUpper',
        		),
    			
    			'campoArtigo' => array(
    					'name' => 'campoArtigo',
    					'id' => 'campoArtigo',
    					'value' => mb_convert_case($this->input->post('campoArtigo'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'textboxUpper',
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
    					'class' => 'textboxUpper',
    			),
    			
    			'arrayRestricoes' => array(
    					'S'  => 'SIM',
    					'N'  => 'NÃO',
    			),
    			
    			'campoFuncionarios' => array(
    					'name' => 'campoFuncionarios[]',
    					'id' => 'campoFuncionarios[]',
    					'value' => $this->input->post('campoFuncionarios'),
    					'class' => 'textboxUpper',
    			),
    			
    			
    			'campoFuncionariosSelecionados' => array(
    					'name' => 'campoFuncionariosSelecionados',
    					'id' => 'campoFuncionariosSelecionados',
    					'value' => $this->input->post('campoFuncionariosSelecionados[]'),
    					'class' => 'textboxUpper',
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
    					'class' => 'textboxUpper',
    			),
    			
    			'campoNome' => array(
    					'name' => 'campoNome',
    					'id' => 'campoNome',
    					'value' => mb_convert_case($this->input->post('campoNome'), MB_CASE_UPPER, "ISO-8859-1"),
    					'cols'  => '70',
    					'rows'  =>  '2',
    					'class' => 'textboxUpper',
    			),
    			
    			'campoSenha' => array(
    					'name' => 'campoSenha',
    					'id' => 'campoSenha',
    					'value' => $this->input->post('campoSenha'),
    					'size' => '15',
    			),
    			
    			'campoConfSenha' => array(
    					'name' => 'campoConfSenha',
    					'id' => 'campoConfSenha',
    					'value' => $this->input->post('campoConfSenha'),
    					'size' => '15',
    			),
   
    			'campoNivel' => array(
    					'name' => 'campoNivel',
    					'id' => 'campoNivel',
    					'value' => mb_convert_case($this->input->post('campoNivel'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxlength' => '2',
    					'size' => '2',
    					'class' => 'textboxUpper',
    			),
    	
		    	'campoMail1' => array(
    					'name' 		=> 'campoMail1',
    					'id'		=> 'campoMail1',
    					'value' 	=> mb_convert_case($this->input->post('campoMail1'), MB_CASE_LOWER, "ISO-8859-1"),
    					'maxgenght' => '60',
                        'size'      => '45',
    					'class' 	=> 'textboxLower',
    			),
    	
		    	'campoMail2' => array(
				    	'name' 		=> 'campoMail2',
				    	'id'		=> 'campoMail2',
				    	'value' 	=> mb_convert_case($this->input->post('campoMail2'), MB_CASE_LOWER, "ISO-8859-1"),
				    	'maxgenght' => '60',
				    	'size'      => '45',
				    	'class' 	=> 'textboxLower',
		    	),
    			 
    			'arrayNiveis' => array(
    					'1'  => 'ADMINISTRADOR',
    					'2'  => 'REDATOR',
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
    					'class' 	=> 'textboxUpper',
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
    					'class'		=> 'textboxUpper',
    			),
    			
    			'campoCelular' => array(
    					'name' 		=> 'campoCelular',
    					'id' 		=> 'campoCelular',
    					'value' 	=> $this->input->post('campoCelular'),
    					'maxgenght' => '15',
                        'size'      => '16',
    					'class' 	=> 'textboxUpper',
    			),
    			
    			'campoFax' => array(
    					'name' 		=> 'campoFax',
    					'id' 		=> 'campoFax',
    					'value' 	=> $this->input->post('campoFax'),
    					'maxgenght'	=> '15',
                         'size'     => '16',
    					'class' 	=> 'textboxUpper',
    			),
    			
    			'campoMail1' => array(
    					'name' 		=> 'campoMail1',
    					'id' 		=> 'campoMail1',
    					'value' 	=> mb_convert_case($this->input->post('campoMail1'), MB_CASE_UPPER, "ISO-8859-1"),
    					'maxgenght' => '60',
                        'size'      => '45',
    					'class' 	=> 'textboxLower',
    			),
    			
    			'campoMail2' => array(
    					'name' 		=> 'campoMail2',
    					'id'		=> 'campoMail2',
    					'value' 	=> mb_convert_case($this->input->post('campoMail2'), MB_CASE_LOWER, "ISO-8859-1"),
    					'maxgenght' => '60',
                        'size'      => '45',
    					'class' 	=> 'textboxLower',
    			),
    			
    			'campoCargo' => array(
    					'name' => 'campoCargo',
    					'id' => 'campoCargo',
    					'value' => mb_convert_case($this->input->post('campoCargo'), MB_CASE_LOWER, "ISO-8859-1"),
    					'class' => 'textboxUpper',
    			),
    			
    			'campoSetor' => array(
    					'name' => 'campoSetor',
    					'id' => 'campoSetor',
    					'value' => mb_convert_case($this->input->post('campoSetor'), MB_CASE_UPPER, "ISO-8859-1"),
    					'class' => 'textboxUpper',
    			),
    			
    			'campoSexo' => array(
    					'name' => 'campoSexo',
    					'id' => 'campoSexo',
    					'value' => mb_convert_case($this->input->post('campoSexo'), MB_CASE_UPPER, "ISO-8859-1"),
    					'class' => 'textboxUpper',
    			),
    			
    			'arraySexos' => array(
    					'M'  => 'MASCULINO',
    					'F'  => 'FEMININO',
    			),
    			
    			'campoStatus' => array(
    					'name' => 'campoStatus',
    					'id' => 'campoStatus',
    					'value' => mb_convert_case($this->input->post('campoStatus'), MB_CASE_UPPER, "ISO-8859-1"),
    					'class' => 'textboxUpper',
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
                'size' => '11',
                'class' => 'textboxUpper',
            ),
    		
    		'campoDataFim' => array(
    			'name' => 'campoDataFim',
    			'id' => 'campoDataFim',
    			'value' => $this->input->post('campoDataFim'),
    			'maxgenght' => '10',
    			'size' => '11',
    			'class' => 'textboxUpper',
    		),
    			
    			
    	);
    
    	return $campo[$indice];
    }
    
  

}

?>