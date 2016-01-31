<div class="areaimage">
	<center>
		<h4 class="text-mutted"><img src="{TPL_images}secrecy-icon.png" height="62px" /><?php echo $titulo;?></h4>
	</cente>
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
	
	<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
	
	<div class="panel panel-primary">

		  <div class="panel-heading">
		    <h3 class="panel-title"><strong>Informe os dados abaixo:</strong></h3>
		  </div>
		  
		  
		  <div class="panel-body">

				<div class="form-group <?php echo (form_error('txtCPF') != '')? 'has-error':''; ?>"">
				    <label for="txtSenhaAtual" class="col-sm-4 control-label"><span style="color: red;">*</span> CPF</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" name="txtCPF" id="txtCPF" placeholder="informe o CPF" value="<?php echo set_value('txtCPF')?>" >
				    </div>
				</div>

		</div>
		
		<div class="panel-footer">
	
			    	<button type="button" class="btn btn-default" onclick="javascript:window.history.back();"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</button>
			      	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon glyphicon-ok"></span> Enviar</button>

		 </div>
		  
	</div>
	</form>
</div>
