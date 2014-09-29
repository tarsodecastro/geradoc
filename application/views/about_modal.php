
<div id="Layer1" style="position: relative; width:100%; height:200px; overflow: auto; text-align: justify; padding-left: 3px; padding-right: 10px;">
	<br>
	Sistema desenvolvido originalmente para facilitar a criação de documentos oficiais padronizados nos setores da Academia Estadual de Segurança Pública do Estado do Ceará.
	
	
	<br><br><b>VERSÃO 2.5:</b><br>
	
		- campos dinâmicos para os tipos de documentos; <br>
		- bootstrap; <br>
		- histórico de versões dos documentos; <br>
		
	<br><br><b>VERSÃO 2.4:</b><br>
	
		- utilização do GitHub para gerenciamento de código fonte e controle de versão; <br>
	
	<br><br><b>VERSÃO 2.3:</b><br>
	
		- cabeçalhos e rodapeś distintos para cada tipo de documento; <br>
		- corrigido o bug das bordas das tabelas; <br>
		
	<br><br><b>VERSÃO 2.2:</b><br>
	
		- incluído o mecanismo de segurança que evita a criação de documentos de anos anteriores ao atual para a proteção do contador da numeração dos tipos de documentos <br>
		- incluída rotina de alteração de dados cadastrais para a inclusão de e-mail, necessário para a rotina de recupeção de acesso; <br>
		- incluída rotina de recuperação de acesso com senha esquecida; <br>
		- atualizada a versão da biblioteca MPDF para a 5.7.1, que apresenta maior compatibilidade com o PHP 5.5; <br>
		
	<br><br><b>VERSÃO 2.1:</b><br>
	
		- revisão e ajustes nos layouts; <br>

	<br><br><b>VERSÃO 2.0:</b><br>
	
		- nova aparência;<br>
		- carimbo de folha;<br>
		- ato administrativo;<br>
		- nota de instrução;<br>
		- nota de elogio;<br>
		- novo editor de texto;<br>
		- upload de imagens;<br>
		- compatibilidade com tabelas de doc e odt;<br>
		- permissões por setor;<br>
		- auditoria;<br>
		- estatísticas.<br>
	<br>
	
	<?php 
	$CI = & get_instance();
	$CI->load->library(array('session', 'datas'));
	if ($CI->session->userdata('nivelId') == 1){?>
	<b>VERSÃO 2.0:</b> <br>
	
	<br><b>ATUALIZAÇÕES NO BANCO:</b> <br>
	
	- criado o campo ano(int(4)) na tabela de tipo de documentos;  <br>
	- criado o campo funcionarios(text) na tabela setor; <br>
	- criado o campo status(char(1)) na tabela contato; <br>
	- na tabela contato, os campos mail1 e mail2 agora sao varchar(60); <br>
	- na tabela usuario, o campo nome foi alterado de varchar(45) para varchar(100); <br>
	- criada uma tabela chamada setor_func_per, com os campos id(INT), setor(INT), usuario(INT), permissao(INT); <br>
	- criada uma tabela chamada tipo_ano, com os campos id(INT), tipo(INT), ano(INT(4)), inicio(INT) para controlar o início da numeração dos documentos; <br>
	- na tabela tipo, foi criado um flag de nome ativo char(1) de valor padrão = "N"; <br>
	- criada uma tabela chamada auditoria, com os campos: id(INT), usuario(INT), usuario_nome(VARCHAR(60)), data(DATETIME), URL(TEXT); <br>
	
	<br><b>ATUALIZAÇÕES NO CÓDIGO:</b> <br>
	
	- aplicação migrada para o CI 2.1.3; <br>
	- criado novo layout; <br>
	- criado um CRUD para os Tipos de Documentos (a tabela já existia e era utilizada); <br>
	- o CKeditor foi substituído pelo Tinymce para uma maior compatibilidade com tabelas; <br>
	- incluído um sistema de upload de fotos no Tinymce e seu arquivo de configração fica dentro da pasta js/tinymce/pugins/filemanager; <br>
	- acrescentados os ícones de cada área no topo da aplicacao e uma nova classe css chamada imagearea foi criada; <br>
	- a tela inicial de documentos lista os registros de acordo com o setor selecionado; <br>
	- efetuada correção na assinatura do parecer jurídico; <br>
	- implementado o controle de permissões por funcionário do setor com três níveis: 1 = Leitura (default), 2 = Escrita e 3 = Total (pode ocultar e cancelar o documento). Os chefes dos setores têm permissão total; <br>
	- estatísticas implementadas com filtros; <br>
	- auditoria implementada; <br>
	
	<br><b>A FAZER:</b><br>
	
	- ata de reunião;<br>
	- prazos nos despachos;<br>
	- tela de alerta dos prazos;<br>
	- tela de gerenciamento dos prazos;<br>
	- exportar em odt ou rtf;<br>
	- incluir a numeração do documento a partir da segunda página nos cabeçalhos dos documentos com mais de uma página;<br>
	
	<br><b>OUTRAS INFORMAÇÕES:</b><br>
	
	- a aplicação não está integrada ao SSO; <br>

	<?php } ?>
	<br><br><br><br>
</div>

<div style="text-align: right; position: relative; top:4px; z-index: 9; padding-top: 8px; color:#888">
		Criado por Tarso de Castro<br>
		tarsodecastro@gmail.com
</div>
	

