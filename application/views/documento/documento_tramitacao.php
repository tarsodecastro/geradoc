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
    
	    <div class="col-md-12 text-left">
	    	<div class="btn-group">
		    <?php
		    	echo $link_back;
		    ?>
		  	</div>  
	    </div>

    </div>


	<div class="formulario">
	
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
							Origem
						</td>
						<td class="text-left" style="color: #777">
							<?php echo $setor_origem; ?>
						</td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Destino</strong>
						</td>
						<td class="text-left">
							<?php echo $setor_destino; ?>
						</td>
					</tr>
				</tbody>
					
				</table>
	
		</div>
		
	</fieldset>
	
	
	<fieldset>
		
		<div class="panel panel-primary">
	
			<div class="panel-heading">
				  <h3 class="panel-title">Tramitação</h3>
			</div>
			
			<table class="table table-bordered table-striped table-hover">
			   	<thead>
			   		<?php echo $linhas_cabecalho;?>
			   </thead>
			<tbody>
					<?php echo $linhas_corpo;?>
			</tbody>
				
			</table>
		</div>
	</fieldset>
	
	
	<fieldset style="width: 500px; margin: 0 auto;">
		
		<div class="panel panel-default">
	
			<div class="panel-heading">
				  <h3 class="panel-title">Histórico da tramitação</h3>
			</div>
			
	<table class="table table-bordered table-striped table-hover">
	   	<thead>
	   	<tr>
		   	<th class="text-center">Data</th>
		   	<th class="text-center">Local</th>
	   	</tr>
	   		
	   </thead>
	<tbody>
		<?php echo $linhas_tramitacao;?>
	</tbody>
	
	</table>
	</div></fieldset>
	
	</form>
	</div>
	<!-- fim da div formulario -->

	
</div>
<!-- fim da div  view_content -->
