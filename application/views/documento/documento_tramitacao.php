<style>
.table>tbody>tr>td
{
    vertical-align: middle;
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-select.min.css">

<div class="areaimage">
	<center>
		<img src="{TPL_images}Actions-document-edit-icon.png" height="72px" />
	</center>
</div>

<p class="bg-success lead text-center">Tramitação do documento</p>

<div id="msg" style="display: none;">
	<img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde
	carregando...
</div>

<div id="view_content">

	<div class="row">
    
	    <div class="col-md-12 text-center">
	    	<div class="btn-group">
		    <?php
		    	
		    	echo $link_back;
		    ?>
		  	</div>  
	    </div>

    </div>


	<div class="formulario">
	
	<!-- Mensagens e alertas -->
		<div class="row">
	   		<div class="col-md-12">
	    	
			    	<?php 
			    		echo "<center>".$message."</center>"; 
			    	
				    	if(validation_errors() != ''){
				    		echo '<div class="alert alert-danger" role="alert">';
				    		echo validation_errors();
				    		echo '</div>';
				    	}
			    	?>
		  	 
	    	</div>	
	   	</div>
	   	<!-- Fim das mensagens e alertas -->
	
	<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
	
	<fieldset>
		
		<div class="panel panel-default">
		
			<div class="panel-heading">
				  <h3 class="panel-title">Detalhes do documento</h3>
			</div>
	
				<table class="table table-bordered table-striped table-hover">
				   
				<tbody>
					<tr>
						<td class="text-right text-muted">
							Documento
						</td>
						<td class="text-left">
							<?php echo $identificacao; ?>
						</td>
					</tr>
					<tr>
						<td class="text-right text-muted">
							Assunto
						</td>
						<td class="text-left">
							<?php echo $assunto; ?>
						</td>
					</tr>
					<tr>
						<td class="text-right text-muted">
							Origem
						</td>
						<td class="text-left" style="color: #777">
							<?php echo $setor_origem; ?>
						</td>
					</tr>
					<tr>
						<td class="text-right" style="width: 150px;">
							<strong>Destino informado no documento</strong>
						</td>
						<td class="text-left">
							<?php echo $setor_destino; ?>
						</td>
					</tr>
					
				</tbody>
					
				</table>
	
		</div>
		
	</fieldset>
	
	
	<?php if($campoSetor != null) {?>
	<fieldset>
		
		<div class="panel panel-default">
	
			<div class="panel-heading">
				  <h3 class="panel-title">Envio</h3>
			</div>
			
			
			<div class="panel-body">
			
				<?php if($privado == 'N'){ ?>
				<div class="form-group <?php echo (form_error('campoSetor') != '')? 'has-error':''; ?>">
					<label for="campoSetor" class="col-sm-2 control-label">Setor de destino</label>
					<div class="col-md-10">
		
						<?php echo $campoSetor;?>
						
					</div>
				</div>
				
				<button type="submit" class="btn btn-success" style="margin-top: 10px;"><span class="glyphicon glyphicon glyphicon-send"></span> Enviar </button>
				<?php }else{?>
				
				<div class="alert alert-warning" role="alert"><h4><strong>Documento privado!</strong> <br><br><p> Para tramitar um documento ele deve ser <strong>público</strong>.</p></h4></div>
				
				<?php }?>
			</div>
			
			
		</div>
	</fieldset>
	<?php }?>
	
	
	<fieldset>
		
		<div class="panel panel-default">
	
			<div class="panel-heading">
				  <h3 class="panel-title">Histórico da tramitação</h3>
			</div>
			
			<table class="table table-bordered table-striped table-hover">
			   	<thead>
			   	<tr>
				   	<th class="text-center">Data do envio</th>
				   	<th class="text-center">Remetente</th>
				   	<th class="text-center">Destino</th>
				   	<th class="text-center">Data do recebimento</th>
				   	<th class="text-center">Recebedor</th>
			   	</tr>
			   		
			   </thead>
			<tbody>
				<?php echo $linhas_tramitacao;?>
			</tbody>
			
			</table>
			
		</div>
	</fieldset>
	
	</form>
	
	</div>
	<!-- fim da div formulario -->

	
</div>
<!-- fim da div  view_content -->
