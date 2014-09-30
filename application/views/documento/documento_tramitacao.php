<style>
.table>tbody>tr>td
{
    vertical-align: middle;
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/pdf.css">

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
	
	<table class="table table-bordered table-striped table-hover">
	   	<thead>
	   		<?php echo $linhas_cabecalho;?>
	   </thead>
	<tbody>
	
	</tbody>
		<?php echo $linhas_corpo;?>
	</table>
	
	
	<table class="table table-bordered table-striped table-hover" style="width: 500px; margin: 0 auto;">
	   	<thead>
	   	<tr>
		   	<th class="text-center">Data</th>
		   	<th class="text-center">Local</th>
	   	</tr>
	   		
	   </thead>
	<tbody>
	
	</tbody>
		<?php echo $linhas_tramitacao;?>
	</table>
	

	</div>
	<!-- fim da div formulario -->

	
</div>
<!-- fim da div  view_content -->
