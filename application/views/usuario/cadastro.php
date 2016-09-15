<div class="areaimage">
	<center>
		<img src="{TPL_images}secrecy-icon.png" height="72px"/>
	</center>
</div>

<div id="view_content">	

		<div class="row">
			<div class="col-md-12">
				<p class="bg-success lead text-center">Usuário</p>
			</div>
		</div>
		
		<div class="formulario">
		
			<!-- Mensagens e alertas -->
			<div class="row">
		   		<div class="col-md-12">
		    	
				    	<?php 
				    		echo "<center>".$mensagem."</center>"; 
				    	
					    	if(validation_errors() != ''){
					    		echo '<div class="alert alert-danger" role="alert">';
					    		echo form_error('campoCPF');
					    		echo form_error('campoNome');
					    		echo form_error('campoMail1');
					    		echo form_error('campoMail2');
					    		echo '</div>';
					    	}
				    	?>
			  	 
		    	</div>	
		   	</div>
		   	<!-- Fim das mensagens e alertas -->
		
		    
		    <form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
		    
			
			<div class="panel panel-primary">
			
				<div class="panel-heading">
				  	<h3 class="panel-title"><?php echo $titulo; ?></h3>
				</div>
			
				<div class="panel-body">
				
					<div class="form-group <?php echo (form_error('campoCPF') != '')? 'has-error':''; ?>"">
					    <label for="campoCPF" class="col-sm-3 control-label"><span style="color: red;">*</span> CPF</label>
					    <div class="col-md-3">
					      	<?php echo form_input($campoCPF); ?> 
					    </div>
					</div>
					
					<div class="form-group <?php echo (form_error('campoNome') != '')? 'has-error':''; ?>"">
					    <label for="campoNome" class="col-sm-3 control-label"><span style="color: red;">*</span> Nome</label>
					    <div class="col-md-7">
					      	<?php echo form_textarea($campoNome); ?> 
					     </div>
					</div>
					
					<div class="form-group <?php echo (form_error('campoMail1') != '')? 'has-error':''; ?>"">
					    <label for="campoMail1" class="col-sm-3 control-label"><span style="color: red;">*</span> E-mail</label>
					    <div class="col-md-7">
					      	<?php echo form_input($campoMail1); ?> 
					     </div>
					</div>
					
					<div class="form-group <?php echo (form_error('campoMail2') != '')? 'has-error':''; ?>"">
					    <label for="campoMail2" class="col-sm-3 control-label"><span style="color: red;">*</span> Confirmação do e-mail</label>
					    <div class="col-md-7">
					      	<?php echo form_input($campoMail2); ?> 
					     </div>
					</div>
				
				</div>
				
			</div>
			
			<div class="btn-group">
		   		<?php
				    echo $link_salvar;
			    ?>
			</div>
					
			</form>
		</div>

</div>
