<div class="areaimage">
	<center>
		<img src="{TPL_images}Calendar-icon.png" height="72px" />
	</center>
</div>
	
<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

	<div class="row">
		<div class="col-md-12">
			<p class="bg-success lead text-center">Tipo</p>
		</div>
	</div>
	
	<div class="row">
    
	    <div class="col-md-12">
	    	<div class="btn-group">
		    <?php

		    echo $link_back;
		    echo '<center>'.$message.'</center>';
		    
		    $readonly = '';
		    $painel = 'panel-primary';
		    ?>
		  	</div>  
	    </div>

    </div>

	
	<div class="formulario">	
	
	<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
	
		<div class="panel panel-primary">
		
			<div class="panel-heading">
				  <h3 class="panel-title"><?php echo $titulo; ?></h3>
			</div>
		
			<div class="panel-body">
			
					<div class="form-group">
					    <label for="campoNome" class="col-sm-3 control-label">Nome</label>
					    <div class="col-md-7">
					   		<input type="text" class="form-control" name="campoNome" id="campoNome"  value="<?php echo $objeto->nome; ?>" > 	
					    </div>
				  	</div>
				  	
				  	<div class="form-group">
					    <label for="campoAbreviacao" class="col-sm-3 control-label">Abreviação</label>
					    <div class="col-md-3">
					   		<input type="text" class="form-control" name="campoAbreviacao" id="campoAbreviacao"  value="<?php echo $objeto->abreviacao; ?>" > 	
					    </div>
				  	</div>
				  	
				  	<div class="form-group <?php echo (form_error('campoAno') != '')? 'has-error':''; ?>">
					    <label for="campoAno" class="col-sm-3 control-label">Ano</label>
					    <div class="col-md-3">
					   		<?php echo form_input($campoAno); ?>  	
					    </div>
				  	</div>
				  	
				  	<div class="form-group <?php echo (form_error('campoInicio') != '')? 'has-error':''; ?>">
					    <label for="campoInicio" class="col-sm-3 control-label">Início da contagem</label>
					    <div class="col-md-3">
					   		<?php echo form_input($campoInicio); ?>  	
					    </div>
				  	</div>
				  	
				  	<div class="form-group">
					    <label for="campoVigencias" class="col-sm-3 control-label">Vigências</label>
					    <div class="col-md-7">
					   		<?php echo $years; ?>  	
					    </div>
				  	</div>
				  	
				  	<?php 
					    if(validation_errors() != ''){
							echo '<div class="form-group">';
							echo form_error('campoNome');
							echo form_error('campoAbreviacao');
							echo form_error('campoAno');
							echo form_error('campoInicio');
							echo '</div>';
						}
					?>

			</div>	

	    </div>
	    
	    <div class="btn-group">
		   		<?php
			    	echo $link_cancelar;
				    echo $link_salvar;
			    ?>
		</div>

	</form> 
	
	</div><!-- fim: div view_content --> 
