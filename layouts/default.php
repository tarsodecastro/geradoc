<?php
$CI 			= & get_instance();
$CI->load->library(array('session', 'datas'));

$today 			= 	$CI->datas->getMinDateExtenso();
$id_usuario 	= 	$CI->session->userdata('id_usuario');
$nome_usuario 	= 	$CI->session->userdata('nome');
$nomeGuerra 	= 	$CI->session->userdata('nomeGuerra');
$funcao 		= 	$CI->session->userdata('funcao');
$nivel_id 		= 	$CI->session->userdata('nivelId');
$nivel_usuario  = '';
switch ($nivel_id){
	case 1 : $nivel_usuario  = "administrador";
	break;
	case 2 : $nivel_usuario  = "redator";
	break;

}

/*
| -------------------------------------------------------------------
|	Importante para o ajax
| -------------------------------------------------------------------
*/

$_SESSION['CI_ROOT'] = site_url();

/*
| -------------------------------------------------------------------
|	Importante para o upload de fotos 
|	Mude o valor de $base_url_upload se aparecer o seguinte erro: "The upload path does not appear to be valid" 
| -------------------------------------------------------------------
*/

//$base_url_upload = str_replace('http://geradoc', '', base_url()); //AESP

//echo $_SERVER['SERVER_NAME'];

$base_url_upload = str_replace('http://'.$_SERVER['SERVER_NAME'], '', base_url()); //localhost

$_SESSION['base_url_upload'] = $base_url_upload; // sera passado para o arquivo /js/tinymce/plugins/jbimages/config.php

//echo $_SESSION['base_url_upload'];

/*
| -------------------------------------------------------------------
|	Importante para o rodape dos documentos
| -------------------------------------------------------------------
*/

$_SESSION['orgao_documento'] = $CI->config->item('orgao');
$_SESSION['rodape_documento'] = $CI->config->item('rodape_documento');

/*
| -------------------------------------------------------------------
|	Fim
| -------------------------------------------------------------------
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="pt-br" />
    <meta http-equiv="refresh" content="<?php echo $CI->config->item('sess_expiration');?>" />
    <meta name="author" content="Tarso de Castro">
	<meta name="reply-to" content="tarsodecastro@gmail.com">
	<meta name="revised" content="Tarso de Castro, 12/09/2013" />
	<meta name="description" content="GeraDoc - Sistema desenvolvido para facilitar a criação de documentos oficiais padronizados nos setores da Academia Estadual de Segurança Pública do Estado do Ceará.">
	<meta name="abstract" content="GeraDoc - AESP-CE">
	<meta name="keywords" content="aluno on-line, fale conosco, aesp, geradoc, documento, oficio, comunicacao interna, memorando, despacho, portaria, php, software livre, corpo de bombeiros">
	<meta name="ROBOT" content="Index,Follow">
	<link rel="shortcut icon" href="{TPL_images}<?php echo $CI->config->item('orgao');?>.ico" type="image/x-icon" />
	<link rel="icon" href="{TPL_images}<?php echo $CI->config->item('orgao');?>.ico" />
    <title><?php echo $CI->config->item('title');?></title>
	{TPL_css}
	<script type="text/javascript">
		var CI_ROOT = '<?php echo site_url(); ?>';    	 
    </script>
    {TPL_js}
    {TPL_js_custom}
    </head>
    <body>
        <div id="geral"> 
            <div id="topo">			
                <div id="topo_left"></div>				
                <div id="topo_center"> 
                    <strong><?php echo $today; ?></strong> &nbsp; &nbsp;
                    <span class="topo_campo"> Usuário: </span> <?php echo $nome_usuario; ?> &nbsp; &nbsp;
                    <span class="topo_campo"> Nível neste sistema: </span> <?php echo $nivel_usuario; ?>
                </div>					
                <div id="topo_right"></div> 
            </div> 
            <div id="logo"> 
                <div id="logo_left" style="background-image: url(<?php echo $CI->config->item('base_url');?>images/bg_logo_left_<?php echo $CI->config->item('orgao');?>.png);"></div>			
                <div id="logo_right"><?php echo $CI->config->item('title_short');?></div>		
            </div>
            
             <div id="menu">
                <div id="menu_itens">
                	<a href="<?php echo site_url('/documento/index'); ?>" title="Documentos">Documentos</a>
                	<span>|</span>
                	<?php if ($nivel_id == 1){ //apenas para administradores?>
                	<a href="<?php echo site_url('/tipo/index'); ?>" title="Tipos">Tipos de Documentos</a>
                	<span>|</span>
                	<a href="<?php echo site_url('/orgao/index'); ?>" title="Órgãos">Órgãos</a>
                	<span>|</span>
                	<a href="<?php echo site_url('/setor/index'); ?>" title="Setores">Setores</a>
                	<span>|</span>
                	<a href="<?php echo site_url('/cargo/index'); ?>" title="Cargos">Cargos</a>
                	<span>|</span>
                	<a href="<?php echo site_url('/contato/index'); ?>" title="Contatos">Remetentes</a>
                	<span>|</span>
                	<a href="<?php echo site_url('/usuario/index'); ?>" title="Usuários">Usuários</a>
                	<span>|</span>
                	<a href="<?php echo site_url('/auditoria/index'); ?>" title="Auditoria">Auditoria</a>
                	<span>|</span>
                	<a href="<?php echo site_url('/estatistica/index'); ?>" title="Estatísticas">Estatísticas</a>
                	<span>|</span>
                	<?php } ?>
                	<a href="<?php echo site_url('usuario/cadastro'); ?>" title="Alterar minha senha de acesso">Meu cadastro</a>
                	<span>|</span>
                	<a href="<?php echo site_url('usuario/altsenha'); ?>" title="Alterar minha senha de acesso">Senha</a>
                	<span>|</span>
                	<a href="#" id="about" title="Sobre este sistema">Sobre</a>
                	<span>|</span>
                	<a href="<?php echo site_url('login/logoff'); ?>" title="Sair do sistema" >Sair</a>		
                </div> 
            </div>

            <div id="conteudo">	
			{TPL_content}		 
            </div>

            <div id="rodape">		
              <?php echo $CI->config->item('rodape_sistema');?>			
            </div> 
        </div>
        
		<div id="modalDialog" style="display:none; min-height: 300px;">
			<div class="title">
			<?php 
			$pos = strpos($CI->config->item('title_short'), "<");
			$titulo_modal = substr($CI->config->item('title_short'), 0, $pos);
			echo $titulo_modal;
			?></div>
			<div class="close"><a href="#"  id="bt_cancelar"> X </a></div>
			<div class="text">
				{TPL_modal}
			</div>
			<div class="foot"></div>
		</div> 
    </body>
</html>
