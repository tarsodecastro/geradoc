<script type="text/javascript" src="<?php echo base_url(); ?>js/datepicker/js/jquery.ui.datepicker-pt-BR.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskedinput.min.js"></script>

<div class="areaimage">
	<center>
		<h4 class="text-mutted"><img src="{TPL_images}bell.png" height="62px" /> <?php echo $titulo;?></h4>
	</cente>
</div>
	
<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

    <?php
    echo $link_back;
    ?>
	
	<div class="formulario">	
	
	<!-- Mensagens e alertas -->
		<div class="row">
	   		<div class="col-md-12">
	    	
			    	<?php 

			    		echo "<center>".$message."</center>"; 
			    	
				    	if(validation_errors() != ''){
				    		echo '<div class="alert alert-danger" role="alert" style="margin-top: 10px;">';
				    		echo form_error('campoDataAlerta');
				    		echo form_error('campoHoraMinutoAlerta');
				    		echo form_error('campoMotivoAlerta');
				    		echo '</div>';
				    	}
				    	
				    	
			    	?>
		  	 
	    	</div>	
	   	</div>
	   	<!-- Fim das mensagens e alertas -->
	
	<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
	
		<div class="row">
			<div class="panel panel-default" style="margin-bottom: 2px;">
					  <div class="panel-heading"><h3 class="panel-title">Conteúdo do documento:</h3></div>
					  <div class="panel-body" style="height: 250px; overflow: auto; text-align: justify;">
								
							     <?php echo $alerta_documento_conteudo; ?>
							   
	
					  </div>
			</div>
		</div>
			
		<div class="row"  style="padding-top: 10px;">
		
		<div class="panel panel-primary">
	
			  <div class="panel-heading">
			    <h3 class="panel-title"><?php echo $titulo; ?></h3>
			  </div>
			  	  
			  <div class="panel-body">
			  	
			  	
			  	
			  		<div class="row">
			  		
			  		
			  		
			  		<div class="col-md-7">
			  		
			  			<div class="form-group <?php echo (form_error('campoDataAlerta') != '')? 'has-error':''; ?>">
					    <label for="campoDataAlerta" class="col-md-5 control-label"><span style="color: red;">*</span> Data</label>
					    <div class="col-md-4">
					      	<?php echo form_input($campoDataAlerta); ?> 
					     </div>
					  </div>
			  		
			  		</div>
			  		
			  		<div class="col-md-4">
			  		
			  			<div class="form-group <?php echo (form_error('campoHoraMinutoAlerta') != '')? 'has-error':''; ?>">
					    <label for="campoHoraMinutoAlerta" class="col-md-3 control-label"><span style="color: red;">*</span> Hora</label>
					    <div class="col-md-6">
					      	<?php echo form_input($campoHoraMinutoAlerta); ?> 
					     </div>
					  	</div>
			  		
			  		
			  		</div>
					  
					  
					  
				  	 
					 
					  
					  <div class="form-group <?php echo (form_error('campoMotivoAlerta') != '')? 'has-error':''; ?>">
					    <label for="campoMotivoAlerta" class="col-sm-3 control-label"><span style="color: red;">*</span> Motivo</label>
					    <div class="col-md-7">
					    	<?php echo form_textarea($campoMotivoAlerta); ?>
					    </div>
					  </div>
					  
					  
					  <div class="form-group <?php echo (form_error('campoConclusaoAlerta') != '')? 'has-error':''; ?>">
					    <label for="campoConclusaoAlerta" class="col-sm-3 control-label">Conclusão</label>
					    <div class="col-md-7">
					    	<?php echo form_textarea($campoConclusaoAlerta); ?>
					    </div>
					  </div>
	
			  </div>
			  <!-- fim da div panel-body -->
			  
		</div>
		<!-- fim da div panel -->	
		
		
		
		<div class="btn-group">
				<p>
		   		<?php
			    	echo $link_cancelar;
			    	echo $link_salvar;
			    ?>
			    </p>
			   
		</div>
		
		</div>
		
		</div>
	
	</form>
						
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 


<script type="text/javascript">

$(document).ready(function(){

	

	$.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
	$( "#campoDataAlerta" ).datepicker({
		beforeShow: function() {
	        setTimeout(function(){
	            $('.ui-datepicker').css('z-index', 99999999999999);
	        }, 0);
	    }
	});

	$("#campoHoraMinutoAlerta").mask("99:99");

});
</script>