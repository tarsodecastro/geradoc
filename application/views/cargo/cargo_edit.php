<div class="areaimage">
	<center>
		<img src="{TPL_images}rescuers-icon.png" />
	</center>
</div>

<script type="text/javascript"> 
    $(document).ready(function(){		
        window.document.body.oncopy  = function() { return false; };
        window.document.body.onpaste = function() { return false; }
    });
</script> 

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<p class="bg-success lead text-center">Cargo</p>

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
			  	
					  <div class="form-group <?php echo (form_error('campoNome') != '')? 'has-error':''; ?>"">
					    <label for="campoNome" class="col-sm-3 control-label"><span style="color: red;">*</span> Nome</label>
					    <div class="col-md-7">
					      	<?php echo form_input($campoNome); ?> 
					     </div>
					  </div>
	
					    <?php 
					    	if(validation_errors() != ''){
								echo '<div class="form-group">';
								echo form_error('campoNome');
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
	
	
	
		<!-- 
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Cargo</legend> 
	        
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class=gray><span class="text-red">*</span> Nome:
			        	</td>
			        	<td class="green"><?php echo form_input($campoNome) .form_error('campoNome'); ?> 
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	    </fieldset>

		<input type="submit" class="button" value="Salvar" title="Salvar"/>&nbsp;&nbsp;	
		
		 -->
		
		
		
								
    	
    </div><!-- fim: div formulario -->

</form> 

</div><!-- fim: div view_content --> 
