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

$area = $this->uri->segment(1);

$menu_documento = '';
$menu_modelos = '';
$menu_organograma = '';
$menu_pessoas = '';
$menu_ferramentas = '';
$menu_cadastro = '';
$menu_senha = '';

if($this->uri->segment(2) == 'cadastro' or $this->uri->segment(2) == 'altsenha'){
	$area = $this->uri->segment(2);
}

switch ($area){
	
	case 'documento':
		$menu_documento =  'active';
	break;
	
	case 'coluna':
		$menu_modelos =  'active';
	break;
	
	case 'tipo':
		$menu_modelos =  'active';
		break;
		
	case 'orgao':
		$menu_organograma =  'active';
	break;
	
	case 'setor':
		$menu_organograma = 'active';
	break;
	
	case 'cargo':
		$menu_pessoas = 'active';
	break;
	
	case 'contato':
		$menu_pessoas = 'active';
		break;
		
	case 'usuario':
		$menu_pessoas = 'active';
	break;
	
	case 'cadastro':
		$menu_cadastro = 'active';
	break;
	
	case 'altsenha':
		$menu_senha = 'active';
	break;
	
	case 'auditoria':
		$menu_ferramentas = 'active';
	break;
	
	case 'estatistica':
		$menu_ferramentas = 'active';
	break;
	
}
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="pt-br" />
    <meta http-equiv="refresh" content="<?php echo $CI->config->item('sess_expiration');?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
	<link href="<?php echo base_url();?>bootstrap/css/datatables.bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url();?>bootstrap/css/bootstrap-theme.css" rel="stylesheet">
	<link href="<?php echo base_url();?>bootstrap/css/bootstrap_custom.css" rel="stylesheet">
	<link href="<?php echo base_url();?>bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
	
	

	<script type="text/javascript">
		var CI_ROOT = '<?php echo site_url(); ?>';    	 
    </script>
    {TPL_js}
    {TPL_js_custom}
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url();?>bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
            
            <div class="container">
        	<!--  Topo -->
            <div id="topo">			
                <div id="topo_left"></div>				
                <div id="topo_center"> 
                    <strong><?php echo $today; ?></strong> &nbsp; &nbsp;
                    <span class="topo_campo"> Usuário: </span> <?php echo $nome_usuario; ?> &nbsp; &nbsp;
                    <span class="topo_campo"> Nível neste sistema: </span> <?php echo $nivel_usuario; ?>
                </div>					
                <div id="topo_right"></div> 
            </div> 
            <!--  Fim do Topo -->
            
            <!--  Logo -->
            <div id="logo"> 
                <div id="logo_left" style="background-image: url(<?php echo $CI->config->item('base_url');?>images/bg_logo_left_<?php echo $CI->config->item('orgao');?>.png);"></div>			
                <div id="logo_right"><?php echo $CI->config->item('title_short');?></div>		
            </div>
            <!-- Fim do Logo -->
            
            <!--  Menu -->
             <div id="menu">
             
	             <nav class="navbar navbar-default" role="navigation">
				  <div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				    </div>
				
				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav">
				        <li class="<?php echo $menu_documento;?>"><a href="<?php echo site_url('/documento/index'); ?>" title="Documentos"><span class="glyphicon glyphicon-file"></span> Documentos</a></li>
				           
				        <?php if ($nivel_id == 1){ //apenas para administradores?>
				        
					        <li class="dropdown <?php echo $menu_modelos;?>">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list-alt"></span> Modelos <span class="caret"></span></a>
					          <ul class="dropdown-menu" role="menu">
					            <li><a href="<?php echo site_url('/coluna/index'); ?>" title="Campos">Campos</a></li>
					            <li><a href="<?php echo site_url('/tipo/index'); ?>" title="Tipos">Tipos de Documentos</a></li>
					          </ul>
					        </li>
					        
					        <li class="dropdown <?php echo $menu_organograma;?>">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-tree-conifer"></span> Organograma <span class="caret"></span></a>
					          <ul class="dropdown-menu" role="menu">
					            <li><a href="<?php echo site_url('/orgao/index'); ?>" title="Órgãos">Órgãos</a></li>
					            <li><a href="<?php echo site_url('/setor/index'); ?>" title="Setores">Setores</a></li>
					          </ul>
					        </li>
					        
					        <li class="dropdown <?php echo $menu_pessoas;?>">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Pessoas <span class="caret"></span></a>
					          <ul class="dropdown-menu" role="menu">
					            <li><a href="<?php echo site_url('/cargo/index'); ?>" title="Cargos">Cargos</a></li>
					            <li><a href="<?php echo site_url('/contato/index'); ?>" title="Contatos">Remetentes</a></li>
					            <li><a href="<?php echo site_url('/usuario/index'); ?>" title="Usuários">Usuários</a></li>
					            
					          </ul>
					        </li>
					        
					        <li class="dropdown <?php echo $menu_ferramentas;?>">
					          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-wrench"></span> Ferramentas <span class="caret"></span></a>
					          <ul class="dropdown-menu" role="menu">
					            <li><a href="<?php echo site_url('/auditoria/index'); ?>" title="Auditoria">Auditoria</a></li>
					            <li><a href="<?php echo site_url('/estatistica/index'); ?>" title="Estatísticas">Estatísticas</a></li>
					          </ul>
					        </li>
				        
				        <?php } ?>
				        
				        <li class="<?php echo $menu_cadastro;?>"><a href="<?php echo site_url('usuario/cadastro'); ?>" title="Meu cadastro">Meu cadastro</a></li>
				       	<li class="<?php echo $menu_senha;?>"><a href="<?php echo site_url('usuario/altsenha'); ?>" title="Alterar minha senha de acesso">Minha senha</a></li>
				        <li><a href="#" id="about" title="Sobre este sistema"><span class="glyphicon glyphicon-thumbs-up"></span> Sobre</a></li>
				        <li><a href="<?php echo site_url('login/logoff'); ?>" title="Sair do sistema" ><span class="glyphicon glyphicon-off"></span> Sair</a></li>
				        
				      </ul>
	
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>

            </div>
            <!--  Fim do Menu -->
            
            {TPL_content}	
            
            </div>
            <!--  Fim do container-->

  
            <!--  Rodape -->
            <div id="rodape" class="footer">
            	<div class="container">	
              		<?php echo $CI->config->item('rodape_sistema');?>	
             	</div>		
            </div> 
            <!--  Fim do Rodape  -->
           
           <div id="modalDialog" style="display:none; min-height: 300px;">
				<div class="title">
					<?php 
						$pos = strpos($CI->config->item('title_short'), "<");
						$titulo_modal = substr($CI->config->item('title_short'), 0, $pos);
						echo $titulo_modal;
					?>
				</div>
				<div class="close"><a href="#" id="bt_cancelar"> X </a></div>
				<div class="text">
					{TPL_modal}
				</div>
				<div class="foot"></div>
			</div> 
            
         <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
         <script src="<?php echo base_url();?>bootstrap/js/datatables.bootstrap.js"></script>
         
    </body>
</html>
