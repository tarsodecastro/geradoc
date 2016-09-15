<div class="areaimage" >
	<center>
		<img src="{TPL_images}archive-icon.png" style="height: 65px;"/>
	</center>
</div>
	
<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<p class="bg-success lead text-center">Repositório</p>

<div id="view_content">	

    <?php
    echo $link_back;
    echo $message;
    ?>
	
	<div class="formulario">	
	
	<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
			
		<div class="panel panel-primary">
	
			  <div class="panel-heading">
			    <h3 class="panel-title"><?php echo $titulo; ?></h3>
			  </div>
			  	  
			  <div class="panel-body">
			  	
					  <div class="form-group <?php echo (form_error('campoNome') != '')? 'has-error':''; ?>">
					    <label for="campoNome" class="col-sm-3 control-label"><span style="color: red;">*</span> Nome</label>
					    <div class="col-md-7">
					      	<?php echo form_input($campoNome); ?> 
					     </div>
					  </div>

					  <div class="form-group <?php echo (form_error('campoDescricao') != '')? 'has-error':''; ?>">
					    <label for="campoEndereco" class="col-sm-3 control-label"><span style="color: red;">*</span> Descrição</label>
					    <div class="col-md-7">
					    	<?php echo form_textarea($campoDescricao); ?>
					    </div>
					  </div>
	
					    <?php 
					    if(validation_errors() != ''){
								echo '<div class="form-group">';
								echo form_error('campoNome');
								echo form_error('campoDescricao'); 
								echo '</div>';
								}
						?>
			  </div>
			  <!-- fim da div panel-body -->
			  
		</div>
		<!-- fim da div panel -->	
		
		<div class="btn-group">
		   		<?php
			    	echo $link_cancelar;
			    	echo $link_salvar;
			    ?>
		</div>
	
	</form>
						
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 
