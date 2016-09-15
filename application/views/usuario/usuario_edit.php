<div class="areaimage">
	<center>
		<img src="{TPL_images}user-group-icon.png" height="72px"/>
	</center>
</div>

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

	<div class="row">
		<div class="col-md-12">
			<p class="bg-success lead text-center">Usuário</p>
		</div>
	</div>

    <div class="row">
    
	    <div class="col-md-12">
	    	<div class="btn-group">
		    <?php

		    echo $link_back;

		    $readonly = '';
		    $painel = 'panel-primary';
		    if ($disabled != null){
		    	$readonly  = 'readonly : 1,';
		    	$painel = 'panel-default';
		    	echo $link_update_sm;
		    }
		    ?>
		  	</div>  
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
				    		echo form_error('campoSenha');
				    		echo form_error('campoConfSenha');
				    		echo form_error('campoNivel');
				    		echo form_error('campoTamanhoUpload');
				    		echo '</div>';
				    	}
			    	?>
		  	 
	    	</div>	
	   	</div>
	   	<!-- Fim das mensagens e alertas -->
	
	
		<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
		

		<fieldset <?php echo $disabled; ?>>
		
		<div class="panel <?php echo $painel; ?>">
		
			<div class="panel-heading">
				  <h3 class="panel-title"><?php echo $titulo; ?></h3>
			</div>
			
			<div class="panel-body">
		
		
				<div class="form-group <?php echo (form_error('campoCPF') != '')? 'has-error':''; ?>">
				    <label for="campoCPF" class="col-sm-3 control-label"><span style="color: red;">*</span> CPF</label>
				    <div class="col-md-3">
				      	<?php echo form_input($campoCPF); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoNome') != '')? 'has-error':''; ?>">
				    <label for="campoNome" class="col-sm-3 control-label"><span style="color: red;">*</span> Nome</label>
				    <div class="col-md-7">
				      	<?php echo form_textarea($campoNome); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoMail1') != '')? 'has-error':''; ?>">
				    <label for="campoMail1" class="col-sm-3 control-label"><span style="color: red;">*</span> E-mail</label>
				    <div class="col-md-7">
				      	<?php echo form_input($campoMail1); ?> 
				     </div>
				</div>
				
				
				<div class="form-group <?php echo (form_error('campoMail2') != '')? 'has-error':''; ?>">
				    <label for="campoMail2" class="col-sm-3 control-label"><span style="color: red;">*</span> Confirme o e-mail</label>
				    <div class="col-md-7">
				      	<?php echo form_input($campoMail2); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoSenha') != '')? 'has-error':''; ?>">
				    <label for="campoSenha" class="col-sm-3 control-label"><span style="color: red;">*</span> Senha</label>
				    <div class="col-md-4">
				      	<?php echo form_password($campoSenha); ?> 
				     </div>
				</div>
				
				
				<div class="form-group <?php echo (form_error('campoConfSenha') != '')? 'has-error':''; ?>">
				    <label for="campoConfSenha" class="col-sm-3 control-label"><span style="color: red;">*</span> Confirme a Senha</label>
				    <div class="col-md-4">
				      	<?php echo form_password($campoConfSenha); ?> 
				     </div>
				</div>
				
				<div class="form-group">
				    <label for="campoSetores[]" class="col-sm-3 control-label">Setor</label>
				    <div class="col-md-7">
				      	<?php echo form_multiselect('campoSetores[]', $setoresDisponiveis, $setoresSelecionados, 'class="form-control" size="7"'); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoNivel') != '')? 'has-error':''; ?>">
				    <label for="campoNivel" class="col-sm-3 control-label">Nível</label>
				    <div class="col-md-3">
				      	<?php echo form_dropdown('campoNivel', $niveisDisponiveis, $nivelSelecionado, 'class="form-control"'); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoTamanhoUpload') != '')? 'has-error':''; ?>">
				    <label for="campoTamanhoUpload" class="col-md-3 control-label"><span style="color: red;">*</span> Máximo de upload</label>
				    <div class="col-md-2">
				    	<?php echo form_input($campoTamanhoUpload); ?>
				    </div>
				     <div class="col-md-5"> <span id="helpBlock" class="help-block">em Kbytes. Ex.: o padrão é <strong>2048</strong> bytes = 2 MB.</span>
				    	
				    </div>
				  </div>
				
	
			</div>
			<!-- fim: div panel-body --> 
				
		</div>
		<!-- fim: div panel --> 
    
    	</fieldset>
    	
    	<div class="btn-group">
		   		<?php
			    	echo $link_cancelar;
			    	
					if ($disabled == null){
				    	echo $link_salvar;
				    }else{
						echo $link_update;
					}
			    ?>
		</div>

		</form> 

	 </div>
	 <!-- fim: div formulario --> 
	 
</div>
<!-- fim: div view_content --> 
