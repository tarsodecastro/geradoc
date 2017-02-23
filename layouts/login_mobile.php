<?php
$CI = & get_instance();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="GeraDox">
	<meta name="reply-to" content="contato.geradox@gmail.com">
	<meta name="revised" content="GeraDox, 14/09/2016" />
	<meta name="abstract" content="GeraDox - Documentos padronizados com facilidade">

   	<link rel="shortcut icon" href="{TPL_images}file-text-o_4e8079_128.ico" type="image/x-icon" />
	<link rel="icon" href="{TPL_images}file-text-o_4e8079_128.ico" />

    <title><?php echo $CI->config->item('title');?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>bootstrap/css/sticky-footer.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>bootstrap/css/login_mobile.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url();?>bootstrap/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>bootstrap/css/animate.css" rel="stylesheet" >
    
     <script src="<?php echo base_url();?>js/jquery-1.11.1.min.js"></script>
     
  </head>

  <body>
  
  	{TPL_content}
  	
  	
  	<footer class="footer">
      <div class="container text-center">
        <p class="text-muted"><?php echo $CI->config->item('rodape_sistema');?></p>
      </div>
    </footer>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url();?>bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    {TPL_js}
  </body>
</html>
