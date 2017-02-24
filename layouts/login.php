<?php 
	$CI =& get_instance();
	$CI->load->library('datas');
	$today = $CI->datas->getMinDateExtenso(); 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="pt-br" />

	<meta name="author" content="GeraDox">
	<meta name="reply-to" content="contato.geradox@gmail.com">
	<meta name="revised" content="GeraDox, 14/09/2016" />
	<meta name="abstract" content="GeraDox - Documentos padronizados com facilidade">

	<link rel="shortcut icon" href="{TPL_images}file-text-o_4e8079_128.ico" type="image/x-icon" />
	<link rel="icon" href="{TPL_images}file-text-o_4e8079_128.ico" />

	<title><?php echo $CI->config->item('title');?></title>
	{TPL_css}
	<link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
	<link href="<?php echo base_url();?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"> 
    {TPL_js}
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="geral"> 
		<div id="topo">			
				<div id="topo_left"></div>				
				<div id="campo_data"><?php echo $today; ?></div>					
				<div id="topo_right"></div>	
		</div>
		 
		<div id="conteudo">				 
			{TPL_content}		 
		</div>		
				 
	  <div id="rodape">
	  	<?php echo $CI->config->item('rodape_sistema');?>
	  </div>	 
	</div>
</body>
</html>
