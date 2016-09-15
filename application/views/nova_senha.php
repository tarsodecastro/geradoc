<div class="areaimage">
	<center>
		<img src="{TPL_images}secrecy-icon.png" height="72px"/>
	</center>
</div>
<?php echo $mensagem; ?>
			
<div class="formulario">	

	<!-- Mensagens e alertas -->
			<div class="row">
		   		<div class="col-md-12">
				    	<?php 
					    	if(validation_errors() != ''){
					    		echo '<div class="alert alert-danger" role="alert">';
					    		echo form_error('txtCPF');
					    		echo '</div>';
					    	}
				    	?>
		    	</div>	
		   	</div>
	<!-- Fim das mensagens e alertas -->
	
	<div class="panel panel-primary">

		  <div class="panel-heading">
		    <h3 class="panel-title">Solicitação de nova senha</h3>
		  </div>
		  
		  
		  <div class="panel-body">
		   	
			<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
			
			
				<div class="form-group <?php echo (form_error('txtCPF') != '')? 'has-error':''; ?>"">
				    <label for="txtSenhaAtual" class="col-sm-4 control-label"><span style="color: red;">*</span> CPF</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" name="txtCPF" id="txtCPF" placeholder="informe o CPF" value="<?php echo set_value('txtCPF')?>" >
				    </div>
				</div>
			
				<div class="form-group">
				    <div class="col-sm-offset-4 col-sm-4">
				    	<button type="button" class="btn btn-default" onclick="javascript:window.history.back();">Voltar</button>
				      	<button type="submit" class="btn btn-success">Enviar</button>
				    </div>
				</div>
		
			</form>
		</div>
	</div>
</div>
