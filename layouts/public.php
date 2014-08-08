<?php
$CI 			= & get_instance();
$CI->load->library(array('session', 'datas'));

$today 			= 	$CI->datas->getMinDateExtenso();


//--- Importante para o ajax ---//
$_SESSION['CI_ROOT'] = site_url();
//--- fim ---//

//--- Importante para o upload de fotos ---//
$base_url_upload = str_replace('http://geradoc', '', base_url());
$_SESSION['base_url_upload'] = $base_url_upload;
//--- fim ---//

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
                </div>					
                <div id="topo_right"></div> 
            </div> 
            <div id="logo"> 
                <div id="logo_left" style="background-image: url(<?php echo $CI->config->item('base_url');?>images/bg_logo_left_<?php echo $CI->config->item('orgao');?>.png);"></div>			
                <div id="logo_right"><?php echo $CI->config->item('title_short');?></div>		
            </div>
            
             <div id="menu">
                <div id="menu_itens">
                	<span>|</span>
                	<a href="#" id="about" title="Sobre este sistema">Sobre</a>
                	<span>|</span>
                	<a href="<?php echo site_url('login/logoff'); ?>" title="Sair do sistema" >Login</a>		
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
