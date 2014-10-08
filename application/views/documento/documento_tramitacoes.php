<link rel="stylesheet" href="<?php echo base_url(); ?>css/pdf.css">

<div class="areaimage">
	<center>
		<img src="{TPL_images}document-icon.png" height="72px" />
	</center>
</div>

<p class="bg-success lead text-center">Entrada de documentos</p>

<div id="msg" style="display: none;">
	<img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde
	carregando...
</div>

<div id="view_content">

    <!-- Formulario de pesquisa -->
	<div class="row">

		<div class="col-md-2">
			<?php echo $link_back;?>
		</div>

	</div>
	<!-- Fim do formulario de pesquisa -->
	
	<div style="clear:both;"></div> 
	        
	<div class="conteiner_tabela">
			<?php echo $table; ?>
	</div>
	
	<!-- Paginacao -->
	<div class="row">
		<div class="col-md-6">
			<div class="dataTables_info" role="status">
				<p>Total de registros:
				<span class="label label-default">&nbsp; <?php echo $total_rows; ?> &nbsp;</span>
				</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="dataTables_paginate paging_simple_numbers">
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
	<!-- Fium da paginacao -->

	
</div>
<!-- fim da div  view_content -->
