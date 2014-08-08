<div class="areaimage">
	<center>
		<img src="{TPL_images}cabinet-icon.png" height="72px"/> 
	</cente>
</div>

<div class="titulo1">
	<?php echo $titulo;?>
</div>

<div id="msg" style="display: none;">
	<img src="{TPL_images}loader.gif" class="img_aling2" alt="Carregando" />Aguarde
	carregando...
</div>



<div id="view_content">

	<div style="float: left;">
	<div id="conteiner_subMenu">
		<?php echo $link_add; ?> &nbsp; 
		
		<?php

	        $options = array();
	
	        if(isset($setores)){
	
	            $var = site_url('documento/index');
	
	            $js = 'id="setores" onChange="window.location.href=(\''.$var.'/s\'+ document.getElementById(\'setores\').value)"';//\''.site_url('documento/index').'"';//.'\' + document.form.setores.value)"';
	            
	            echo "<b> SETOR:</b> ";
	            echo form_dropdown('setores', $setoresDisponiveis, $setorSelecionado, $js);
	            echo "<br />";
	
	        }
    	?> 
		</div>
	</div>
	
	<div style="float: right;">    
	            <form id="frm_search" name="frm_search" action="<?php  echo $form_action; ?>" method="post">  
	                <input class="search_text" type="text" id="search" name="search" value="<?php  echo $keyword_documento; ?>"/>
	                <input type="submit" value="Pesquisar" class="button_search">
	                <?php echo $link_search_cancel; ?>
	            </form>
	</div>  
	
	<div style="clear:both;"></div> 
	        
	<div class="conteiner_tabela">
			<?php echo $table; ?>
	</div>

	<div class="subTitulo2">
		Total de registros: <?php echo $total_rows; ?>
	</div>

	<div class="paginacao">
		<?php echo $pagination; ?>
	</div>

</div>


