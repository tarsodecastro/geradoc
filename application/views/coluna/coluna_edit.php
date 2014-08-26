<div class="areaimage">
	<center>
		<img src="{TPL_images}rescuers-icon.png" />
	</center>
</div>

<p class="bg-success lead text-center">Campo</p>	

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 


<div id="view_content">	

    <?php
    echo $link_back;
    echo $mensagem;
    ?>
	
	<div class="formulario">	
	
	<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
			
		<div class="panel panel-primary">
	
			  <div class="panel-heading">
			    <h3 class="panel-title"><?php echo $titulo; ?></h3>
			  </div>
			  	  
			  <div class="panel-body">
			  	
					  <div class="form-group <?php echo (form_error('campoNome') != '')? 'has-error':''; ?>"">
					    <label for="campoNome" class="col-sm-5 control-label">Nome</label>
					    <div class="col-md-3">
					      	<?php echo form_input($campoNome); ?> 
					     </div>
					  </div>
					  
					  
					  <div class="form-group <?php echo (form_error('campoTamanho') != '')? 'has-error':''; ?>">
					    <label for="campoTamanho" class="col-sm-5 control-label">Tamanho</label>
					    <div class="col-md-3">
					    	<div class="input-group">
					   	 	<?php 
					   	 		echo form_input($campoTamanho); 
					   	 	?>
					   	 	<span class="input-group-addon">caracteres</span>
					   	 	</div>
					    </div>
					   </div>
					    
					  <?php if(isset($tamanho_atual)){?>
					  <div class="form-group">
					   <label for="campoConsumo" class="col-sm-5 control-label">Consumo atual</label>
					   <div class="col-md-3">
					    	<div class="input-group">
					   	 	 <input type="text" class="form-control" name="campoConsumo" id="campoConsumo"  value="<?php echo $tamanho_atual; ?>" disabled>
					   	 	 <span class="input-group-addon">caracteres</span>
					   	 	 </div>
					    </div>

					  </div>

					    <?php 
					   	}
					    if(validation_errors() != ''){
								echo '<div class="form-group">';
								echo form_error('campoNome');
								echo form_error('campoTamanho');
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

