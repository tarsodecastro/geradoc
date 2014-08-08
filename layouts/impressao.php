<?php
$CI = & get_instance();
$CI->load->library(array('session', 'datas'));
$today = $CI->datas->getMinDateExtenso();
$id_usuario = $CI->session->userdata('id_usuario');
$nome_usuario = $CI->session->userdata('nome');
$nomeGuerra = $CI->session->userdata('nomeGuerra');
$funcao = $CI->session->userdata('funcao');
$nivel_id = $CI->session->userdata('nivelId');
$nivel_usuario = $CI->session->userdata('nivelNome');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-language" content="pt-br" />
        <meta http-equiv="refresh" content="<?php echo $CI->config->item('sess_expiration');?>" />

        <title>{TPL_title}</title> 
	{TPL_css}
        <script type="text/javascript">
            var CI_ROOT = '<?php echo site_url(); ?>';    	 
        </script>
        {TPL_js} 
        {TPL_js_custom}
    </head>
    <body style="font-size:10px">
    {TPL_content}		 
    </body>
</html>















