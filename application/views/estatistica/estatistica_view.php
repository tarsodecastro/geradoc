<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-select.min.css">

<div class="areaimage">
	<center>
		<img src="{TPL_images}statistics_64.png" />
	</center>
</div>	

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

    <?php
    echo $message;
    ?>
	
	<div class="formulario">	
	
	
		<form class="form-inline" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
		
			<div class="panel panel-primary">
			
				<div class="panel-heading">
			    	<h3 class="panel-title">Estatísticas</h3>
			  	</div>
			
				<div class="panel-body">
				
					 <div class="form-group">
					    <label for="campoNome" class="control-label">Tipo de documento</label>
					   
					     <?php echo form_dropdown( 'campoTipo', $tipos, $tipoSelecionado, 'id="campoTipo" class="form-control selectpicker" data-style="btn-default" data-live-search="true"  '); ?> 
					  
					 </div>
					 
					 <div class="form-group">
					    <label for="campoDataIni" class="control-label">Data inicial</label><br>
					  
					    <?php echo form_input($campoDataIni); ?> 
					   
					 </div>
					 
					 <div class="form-group">
					    <label for="campoDataFim" class="control-label">Data final</label><br>
					  
					    <?php echo form_input($campoDataFim); ?> 
					   
					 </div>
				 </div>
				 
				 <div class="form-group" style="padding-bottom: 10px">
					<input type="submit" class="btn btn-primary" value="Consultar" title="Consultar" />
				</div>
			
			
			</div>
			
			
			
		</form> 
		
		<img src="<?php echo base_url().$graph; ?>" />  <br>
				<img src="<?php echo base_url().$grafico1; ?>" /> <br>
				
				<br><br>
			
    </div>




</div><!-- fim: div view_content --> 
