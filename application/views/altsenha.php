<div class="areaimage">
	<center>
		<img src="{TPL_images}secrecy-icon.png" height="72px"/>
	</center>
</div>
			

<div id="view_content">	

	<div class="row">
		<div class="col-md-12">
			<p class="bg-success lead text-center">Senha</p>
		</div>
	</div>
		
<div class="formulario">	

			<!-- Mensagens e alertas -->
			<div class="row">
		   		<div class="col-md-12">
				    	<?php 
					    	if(validation_errors() != ''){
					    		echo '<div class="alert alert-danger" role="alert">';
					    		echo form_error('txtSenhaAtual');
					    		echo form_error('txtSenhaNova');
					    		echo form_error('txtSenhaNovaConf');
					    		echo '</div>';
					    	}
				    	?>
		    	</div>	
		   	</div>
		   	<!-- Fim das mensagens e alertas -->

	<div class="panel panel-primary">

		  <div class="panel-heading">
		    <h3 class="panel-title"><?php echo $titulo; ?></h3>
		  </div>
		  
		  
		  <div class="panel-body">
		  
		  	<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
		
				  <div class="form-group <?php echo (form_error('txtSenhaAtual') != '')? 'has-error':''; ?>"">
				    <label for="txtSenhaAtual" class="col-sm-4 control-label"><span style="color: red;">*</span> Senha atual</label>
				    <div class="col-sm-4">
				      <input type="password" class="form-control" name="txtSenhaAtual" id="txtSenhaAtual" placeholder="Senha atual" value="<?php echo set_value('txtSenhaAtual')?>" >
				    </div>
				  </div>
				  
				  <div class="form-group <?php echo (form_error('txtSenhaNova') != '')? 'has-error':''; ?>">
				    <label for="txtSenhaNova" class="col-sm-4 control-label"><span style="color: red;">*</span> Nova Senha</label>
				    <div class="col-sm-4">
				      <input type="password" class="form-control" name="txtSenhaNova" id="txtSenhaNova" placeholder="Nova Senha" value="<?php echo set_value('txtSenhaNova')?>">
				    </div>
				  </div>
				  
				  <div class="form-group <?php echo (form_error('txtSenhaNovaConf') != '')? 'has-error':''; ?>">
				    <label for="txtSenhaNovaConf" class="col-sm-4 control-label"><span style="color: red;">*</span> Confirmação</label>
				    <div class="col-sm-4">
				      <input type="password" class="form-control" name="txtSenhaNovaConf" id="txtSenhaNovaConf" placeholder="Confirmação" value="<?php echo set_value('txtSenhaNovaConf')?>">
				    </div>
				  </div>

				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-4">
				    	<button type="button" class="btn btn-default" onclick="javascript:window.history.back();">Voltar</button>
				      	<button type="submit" class="btn btn-success">Salvar</button>
				    </div>
				  </div>
			  
			</form>
		    
		  </div>
	</div>

</div>

</div>
