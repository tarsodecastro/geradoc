<link rel="stylesheet" href="<?php echo base_url(); ?>css/pdf.css">

<div class="areaimage">
	<center>
		<img src="{TPL_images}Actions-document-edit-icon.png" height="72px" />
	</center>
</div>

<p class="bg-success lead text-center">Versões do documento</p>

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

	
	<div style="clear:both;"></div> 
	        
	<div class="conteiner_tabela" style="width: 600px; margin: 0 auto">
			<?php echo $table; ?>
	</div>

	
</div>
<!-- fim da div  view_content -->

<div id="boxes">
	<?php echo $dialogos; ?>
	<div id="mask"></div>
</div>
