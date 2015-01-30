<div class="areaimage">
	<center>
		<img src="{TPL_images}rescuers-icon.png" />
	</center>
</div>

<p class="bg-success lead text-center"><?php echo $titulo;?></p>

<div id="msg" style="display: none;">
	<img src="{TPL_images}loader.gif" class="img_aling2" alt="Carregando" />Aguarde
	carregando...
</div>

<div id="view_content">
	
	<!-- Formulario de pesquisa -->
	<div class="row">

		<div class="col-md-2">
			<?php echo $link_add;?>
		</div>

		<div class="col-md-10" style="text-align: right;">

			
		</div>

	</div>
	<!-- Fim do formulario de pesquisa -->  
	
	<div style="clear:both;"></div> 
	        
	<div class="conteiner_tabela">
			<?php echo $table; ?>
	</div>
</div>


