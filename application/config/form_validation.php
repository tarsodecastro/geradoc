<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function valid_date($str){
	if(!preg_match('^(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/([0-9]{4})$^', $str))
	{
		$this->validation->set_message('valid_date', 'A data deve ter o formato: dd/mm/aaaa. Valores para dia: 01 a 31. Valores para mês: 01 a 12.');
		return false;
	}
	else
	{
		return true;
	}
}

$config = array(
		'login/index' => array(
				array(
						'field' => 'cpf',
						'label' => 'Login(cpf)',
						'rules' => 'required'
				),
				array(
						'field' => 'txtSenha',
						'label' => 'senha',
						'rules' => 'required'
				)
		),
		
		'login/login_mail' => array(
				array(
						'field' => 'email',
						'label' => 'E-mail',
						'rules' => 'required'
				),
				array(
						'field' => 'txtSenha',
						'label' => 'senha',
						'rules' => 'required'
				)
		),


		'orgao/add' => array(
				 
				array(
						'field' => 'campoNome',
						'label' => 'nome',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'campoSigla',
						'label' => 'sigla do órgão',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'campoEndereco',
						'label' => 'endereço do órgão',
						'rules' => 'required|trim'
				),
				 
		),

		'cargo/add' => array(
				array(
						'field' => 'campoNome',
						'label' => 'nome',
						'rules' => 'required|trim'
				),
					
		),
		
		'coluna/add' => array(
				array(
						'field' => 'campoNome',
						'label' => 'nome',
						'rules' => 'required|trim|callback_valida_palavra'
				),
				array(
						'field' => 'campoTamanho',
						'label' => 'tamanho',
						'rules' => 'required|trim|numeric'
				),
					
		),

		'tipo/add' => array(
				
				array(
						'field' => 'campoNome',
						'label' => 'nome',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'campoAbreviacao',
						'label' => 'abreviação',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'campoConteudo',
						'label' => 'conteudo',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'campoCabecalho',
						'label' => 'cabeçalho',
						'rules' => 'trim'
				),
				array(
						'field' => 'campoRodape',
						'label' => 'rodapé',
						'rules' => 'trim'
				),
				
					
		),
		
		'tipo/year' => array(
				array(
						'field' => 'campoAno',
						'label' => 'ano',
						'rules' => 'required|numeric|greater_than[0]|trim'
				),
				
				array(
						'field' => 'campoInicio',
						'label' => 'início',
						'rules' => 'required|numeric|greater_than[0]|trim'
				),
					
		),
		
		'tipo/year_update' => array(
				array(
						'field' => 'campoInicio',
						'label' => 'início',
						'rules' => 'required|greater_than[0]|trim'
				),
					
		),
		
		
		'documento/add' => array(
				
				array(
						'field' => 'campoData',
						'label' => 'data',
						'rules' => 'trim|callback_valid_date'
				),
				
				array(
						'field' => 'campoRemetente',
						'label' => 'para',
						'rules' => 'required|greater_than[0]|trim'
				),
				
				array(
						'field' => 'campoTipo',
						'label' => 'tipo',
						'rules' => 'required|greater_than[0]|trim'
				),
				
				array(
						'field' => 'campoAssunto',
						'label' => 'assunto',
						'rules' => 'required|trim'
				),
				
				/*
				array(
						'field' => 'campoPara',
						'label' => 'para',
						'rules' => 'required|trim'
				),
				
				array(
						'field' => 'campoRedacao',
						'label' => 'redacao',
						'rules' => 'required|trim'
				),
				*/
					
		),
		
		'documento/add_sem_para' => array(
		
				array(
						'field' => 'campoData',
						'label' => 'data',
						'rules' => 'trim|callback_valid_date'
				),
		
				array(
						'field' => 'campoRemetente',
						'label' => 'para',
						'rules' => 'required|greater_than[0]|trim'
				),
		
				array(
						'field' => 'campoTipo',
						'label' => 'tipo',
						'rules' => 'required|greater_than[0]|trim'
				),
		
				array(
						'field' => 'campoAssunto',
						'label' => 'assunto',
						'rules' => 'required|trim'
				),

				array(
						'field' => 'campoRedacao',
						'label' => 'redacao',
						'rules' => 'required|trim'
				),
					
		),
		
		'workflow/update' => array(
		
				array(
						'field' => 'campoSetor',
						'label' => 'destino',
						'rules' => 'trim|required|greater_than[0]'
				),
			
		),
		
		'documento/add_parecer_tecnico' => array(
				
				array(
						'field' => 'campoRemetente',
						'label' => '<strong>Para</strong>',
						'rules' => 'required|greater_than[0]|trim'
				),
		
				array(
						'field' => 'campoData',
						'label' => '<strong>data</strong>',
						'rules' => 'trim|callback_valid_date'
				),
		
				array(
						'field' => 'campoTipo',
						'label' => '<strong>Tipo</strong>',
						'rules' => 'required|greater_than[0]|trim'
				),
		
				array(
						'field' => 'campoAssunto',
						'label' => '<strong>Assunto</strong>',
						'rules' => 'required|trim'
				),
		
				array(
						'field' => 'campoObjetivo',
						'label' => '<strong>Objetivo</strong>',
						'rules' => 'required|trim'
				),
				
				array(
						'field' => 'campoDocumentacao',
						'label' => '<strong>Documentação</strong>',
						'rules' => 'required|trim'
				),
				
				array(
						'field' => 'campoAnalise',
						'label' => '<strong>Análise</strong>',
						'rules' => 'required|trim'
				),
				
				array(
						'field' => 'campoConclusao',
						'label' => '<strong>Conclusão</strong>',
						'rules' => 'required|trim'
				),
					
		),


		'setor/add' => array(
				array(
						'field' => 'campoOrgao',
						'label' => 'órgão',
						'rules' => 'required|greater_than[0]|trim'
				),
				array(
						'field' => 'campoResponsavel',
						'label' => 'responsável',
						'rules' => 'required|greater_than[0]|trim'
				),
				array(
						'field' => 'campoNome',
						'label' => 'nome',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'campoSigla',
						'label' => 'sigla',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'campoTamanhoRepositorio',
						'label' => 'Tamanho do repositório',
						'rules' => 'required|greater_than[0]|trim|numeric'
				),
				/*
				array(
						'field' => 'campoEndereco',
						'label' => 'endereco',
						'rules' => 'required|min_length[10]|trim'
				),
				*/

		),
		
		'contato/add' => array(
		
				array(
						'field' => 'campoNome',
						'label' => 'nome',
						'rules' => 'trim|required|min_length[3]'
				),
				
				array(
						'field' => 'campoAssinatura',
						'label' => 'nome',
						'rules' => 'trim'
				),
		
				array(
						'field' => 'campoCargo',
						'label' => 'cargo',
						'rules' => 'trim|required|greater_than[0]'
				),
				
				array(
						'field' => 'campoSetor',
						'label' => 'setor',
						'rules' => 'trim|required|greater_than[0]'
				),
				
				array(
						'field' => 'campoSexo', //dropdown
						'label' => 'sexo',
						'rules' => 'required'
				),
				
				array(
						'field' => 'campoFone',
						'label' => 'fone',
						'rules' => 'trim|required'
				),
				
				array(
						'field' => 'campoCargo',
						'label' => 'cargo',
						'rules' => 'trim|required|greater_than[0]'
				),
				
				array(
						'field' => 'campoSetor',
						'label' => 'setor',
						'rules' => 'trim|required|greater_than[0]'
				),
				
				array(
						'field' => 'campoMail1',
						'label' => 'e-mail institucional',
						'rules' => 'trim|required|valid_email'
				),
				
				array(
						'field' => 'campoMail2',
						'label' => 'e-mail particular',
						'rules' => 'trim|valid_email'
				),
				
				
				
		),
		
		
		'usuario/add' => array(
				
				array(
						'field' => 'campoCPF',
						'label' => 'CPF',
						'rules' => 'trim|required|min_length[11]'
				),
				
				array(
						'field' => 'campoNome',
						'label' => 'nome',
						'rules' => 'trim|required|min_length[3]'
				),
				
				array(
						'field' => 'campoMail1',
						'label' => 'E-mail',
						'rules' => 'trim|required|valid_email'
				),
				
				array(
						'field' => 'campoMail2',
						'label' => 'Confirmação',
						'rules' => 'trim|required|valid_email|matches[campoMail1]'
				),
				
				array(
						'field' => 'campoSenha',
						'label' => 'nova senha',
						'rules' => 'trim|required|min_length[6]'
				),
		
				array(
						'field' => 'campoConfSenha',
						'label' => 'confirmação da nova senha',
						'rules' => 'trim|required|matches[campoSenha]'
				),
				
				array(
						'field' => 'campoTamanhoUpload',
						'label' => 'Tamanho máximo de upload',
						'rules' => 'trim|required|max_length[10]|numeric'
				),
		
		),

		'usuario/edit' => array(
		
				array(
					'field' => 'campoCPF',
					'label' => 'CPF',
					'rules' => 'trim|required|min_length[11]'
				),
				
				array(
					'field' => 'campoNome',
					'label' => 'nome',
					'rules' => 'trim|required|min_length[3]'
				),
		
				array(
					'field' => 'campoMail1',
					'label' => 'E-mail',
					'rules' => 'trim|required|valid_email'
				),
				
				array(
					'field' => 'campoMail2',
					'label' => 'Confirmação',
					'rules' => 'trim|required|valid_email|matches[campoMail1]'
				),
		
				array(
						'field' => 'campoSenha',
						'label' => 'nova senha',
						'rules' => 'trim|required|min_length[6]'
				),

				array(
						'field' => 'campoConfSenha',
						'label' => 'confirmação da nova senha',
						'rules' => 'trim|required|matches[campoSenha]'
				),
				array(
						'field' => 'campoTamanhoUpload',
						'label' => 'Tamanho máximo de upload',
						'rules' => 'trim|required|max_length[10]|numeric'
				),

		),

		'usuario/altsenha' => array(
				array(
						'field' => 'txtSenhaAtual',
						'label' => 'senha atual',
						'rules' => 'trim|required|callback_check_senhaAtual'
				),
				array(
						'field' => 'txtSenhaNova',
						'label' => 'nova senha',
						'rules' => 'trim|required|min_length[6]'
				),
				array(
						'field' => 'txtSenhaNovaConf',
						'label' => 'confirmação da nova senha',
						'rules' => 'trim|required|matches[txtSenhaNova]'
				) 
		),

		'usuario/cadastro' => array(
				array(
					'field' => 'campoCPF',
					'label' => 'CPF',
					'rules' => 'trim|required'
				),
		
				array(
					'field' => 'campoNome',
					'label' => 'Nome',
					'rules' => 'trim|required'
				),
				
				array(
					'field' => 'campoMail1',
					'label' => 'E-mail',
					'rules' => 'trim|required|valid_email'
				),
				
				array(
					'field' => 'campoMail2',
					'label' => 'Confirmação',
					'rules' => 'trim|required|valid_email|matches[campoMail1]'
				),
		),

		'usuario/nova_senha' => array(
				array(
					'field' => 'txtCPF',
					'label' => 'CPF',
					'rules' => 'trim|required'
				),
		
		/*
				array(
					'field' => 'txtEmail',
					'label' => 'E-mail',
					'rules' => 'required|valid_email'
				),
				
				array(
					'field' => 'txtConfEmail',
					'label' => 'Confirmação',
					'rules' => 'required|valid_email|matches[txtEmail]'
				),
				*/
				
		),
		
		'repositorio/update' => array(
				array(
						'field' => 'campoNome',
						'label' => 'nome',
						'rules' => 'required|trim'
				),
				array(
						'field' => 'campoDescricao',
						'label' => 'descricao',
						'rules' => 'required|trim'
				),
					
		),
		
		
		'comentario/add' => array(
				array(
						'field' => 'campoComentario',
						'label' => 'texto',
						'rules' => 'required|trim'
				),
					
		),
		
		 
);


?>
