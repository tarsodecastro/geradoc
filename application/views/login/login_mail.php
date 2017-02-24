<?php 
$CI =& get_instance();
?>

<div class="container">

      <form class="form-signin" role="form" action="<?php echo $form_action;?>" method="post">
      <div class="sm-12 text-center" >
      	<i id="emblema" class="fa fa-file-text-o fa-5x" style="color: #555;"></i>
      </div>
        <h3 class="form-signin-heading" style="color: #555;"><?php echo $CI->config->item('title');?></h3>
        
        <?php 
			echo form_error('email');
			echo form_error('txtSenha'); 
			echo $mensagem;
		?>
        
        <?php if(isset($setores) and $setores != null ){
				
					echo "<div style='padding: 7px; font-size: 12pt; line-height: 150%;'>Selecione o setor: <br>".$setores."</div>";
					
				}else{
		?>
        <input type="email" class="form-control" placeholder="E-mail" required autofocus  name="email"  id="email" value="<?php echo set_value('email');?>">
        
        <input type="password" class="form-control" placeholder="Senha" required name="txtSenha" id="txtSenha">

        <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>

		<a href="<?php echo base_url() . "index.php/usuario/nova_senha"; ?>" class="btn btn-lg btn-primary btn-block">Esqueci a senha</a> 
		<?php } ?>
      </form>

</div> <!-- /container -->
		
<script type="text/javascript">

$( "#emblema" ).hover(function() {
	$( this ). toggleClass('animated rubberBand');
});  

</script>