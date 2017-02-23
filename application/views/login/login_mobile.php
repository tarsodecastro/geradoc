<?php 
$CI =& get_instance();
?>

<script>
    	if (window.innerWidth > 1024) window.location.replace("<?php echo base_url();?>")
</script>

<div class="container">

      <form class="form-signin" role="form" action="<?php echo $form_action;?>" method="post">
      <div class="sm-12 text-center" >
      <img src="<?php echo base_url().'images/'.$CI->config->item('orgao');?>.ico" width="100px">
      </div>
        <h3 class="form-signin-heading"><?php echo $CI->config->item('title_short');?></h3>
        
        <?php 
			echo form_error('cpf');
			echo form_error('txtSenha'); 
			echo $mensagem;
		?>
        
        <?php if(isset($setores) and $setores != null ){
				
					echo "<div style='padding: 7px; font-size: 12pt; line-height: 150%;'>Selecione o setor: <br>".$setores."</div>";
					
				}else{
		?>
        <input type="text" class="form-control" placeholder="CPF" required autofocus  name="cpf"  id="cpf" value="<?php echo set_value('cpf');?>">
        <input type="password" class="form-control" placeholder="Senha" required name="txtSenha" id="txtSenha">

        <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>

		<a href="<?php echo base_url() . "index.php/usuario/nova_senha"; ?>" class="btn btn-lg btn-primary btn-block">Esqueci a senha</a> 
		<?php } ?>
      </form>

</div> <!-- /container -->