<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-select.min.css">
<div class="areaimage">
	<center>
		<img src="{TPL_images}black-pages-icon.png" height="72px"/>
	</center>
</div>
	
<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	


	<div class="row">
		<div class="col-md-12">
			<p class="bg-success lead text-center">Remetente</p>
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
				    		echo form_error('campoNome');
				    		echo form_error('campoAssinatura');
				    		echo form_error('campoSexo');
				    		echo form_error('campoStatus');
				    		echo form_error('campoCargo');
				    		echo form_error('campoSetor');
				    		echo form_error('campoFone');
				    		echo form_error('campoCelular');
				    		echo form_error('campoMail1');
				    		echo form_error('campoMail2');
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
			
			
				<div class="form-group <?php echo (form_error('campoNome') != '')? 'has-error':''; ?>">
				    <label for="campoNome" class="col-sm-3 control-label"><span style="color: red;">*</span> Nome</label>
				    <div class="col-md-7">
				      	<?php echo form_textarea($campoNome); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoAssinatura') != '')? 'has-error':''; ?>">
				    <label for="campoAssinatura" class="col-sm-3 control-label">Assinatura</label>
				    <div class="col-md-7">
				      	<?php echo form_textarea($campoAssinatura); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoSexo') != '')? 'has-error':''; ?>">
				    <label for="campoSexo" class="col-sm-3 control-label">Sexo</label>
				    <div class="col-md-3">
				      	<?php echo form_dropdown('campoSexo', $sexosDisponiveis, $sexoSelecionado, 'class="form-control"') ; ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoStatus') != '')? 'has-error':''; ?>">
				    <label for="campoStatus" class="col-sm-3 control-label">Status</label>
				    <div class="col-md-3">
				      	<?php echo form_dropdown('campoStatus', $statusDisponiveis, $statusSelecionado, 'class="form-control"'); ?> 
				     </div>
				</div>
				
				
				<div class="form-group <?php echo (form_error('campoCargo') != '')? 'has-error':''; ?>">
				    <label for="campoCargo" class="col-sm-3 control-label"><span style="color: red;">*</span> Cargo</label>
				    <div class="col-md-7">
				      	<?php echo form_dropdown('campoCargo', $cargosDisponiveis, $cargoSelecionado, 'class="form-control selectpicker" data-style="btn-default" data-live-search="true" '); ?> 
				     </div>
				</div>
			
			
				<div class="form-group <?php echo (form_error('campoSetor') != '')? 'has-error':''; ?>">
				    <label for="campoSetor" class="col-sm-3 control-label"><span style="color: red;">*</span> Setor</label>
				    <div class="col-md-7">
				      	<?php echo form_dropdown('campoSetor', $setoresDisponiveis, $setorSelecionado, 'class="form-control selectpicker" data-style="btn-default" data-live-search="true"'); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoFone') != '')? 'has-error':''; ?>">
				    <label for="campoFone" class="col-sm-3 control-label"><span style="color: red;">*</span> Telefone fixo</label>
				    <div class="col-md-3">
				      	<?php echo form_input($campoFone); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoFax') != '')? 'has-error':''; ?>">
				    <label for="campoFax" class="col-sm-3 control-label">Fax</label>
				    <div class="col-md-3">
				      	<?php echo form_input($campoFax); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoCelular') != '')? 'has-error':''; ?>">
				    <label for="campoCelular" class="col-sm-3 control-label">Telefone celular</label>
				    <div class="col-md-3">
				      	<?php echo form_input($campoCelular); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoMail1') != '')? 'has-error':''; ?>">
				    <label for="campoMail1" class="col-sm-3 control-label"><span style="color: red;">*</span> E-mail institucional</label>
				    <div class="col-md-7">
				      	<?php echo form_input($campoMail1); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoMail2') != '')? 'has-error':''; ?>">
				    <label for="campoMail2" class="col-sm-3 control-label">E-mail particular</label>
				    <div class="col-md-7">
				      	<?php echo form_input($campoMail2); ?> 
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

</div><!-- fim: div view_content --> 

<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.blockUI.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	   $("#campoFone").mask("(99)9999.9999");
	   $("#campoFax").mask("(99)9999.9999");
	   $("#campoCelular").mask("(99)9999.9999");

	   $("textarea#campoAssinatura").tinymce({
		      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
		      <?php echo $readonly;?>
		      language : 'pt_BR',
		  	  menubar : false,
		  	  browser_spellcheck : true,
		  	  forced_root_block : false,
		  	  setup : function(ed){
		  		ed.on('init', function() {
		  			   this.getDoc().body.style.fontSize = '10.5pt';
		  			});
		  	},

		  	plugins: "preview image spellchecker textcolor table lists",
		  	
		  	toolbar: "bold italic underline strikethrough | subscript superscript removeformat",
		  	statusbar : false,
		   });
	});
</script>
