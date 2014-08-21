<div class="areaimage">
	<center>
		<img src="{TPL_images}document-icon.png" height="72px" />
	</center>
</div>

<ol class="breadcrumb">
	<li><a href="<?php echo site_url('/tipo/index'); ?>">Tipos</a></li>
  	<li class="active"><?php echo $titulo;?></li>
</ol>		

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

    <?php
    echo $link_back;
    echo $message;
    ?>
	
	<div class="formulario">	
	
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Tipo de documento</legend> 
	          
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class="gray">Nome:
			        	</td>
			        	<td class="green"><?php echo $objeto->nome; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Abreviação:
			        	</td>
			        	<td class="green"><?php echo $objeto->abreviacao; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Cabeçalho:
			        	</td>
			        	<td class="green"><?php echo $objeto->cabecalho; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Rodapé:
			        	</td>
			        	<td class="green"><?php echo $objeto->rodape; ?> 
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	    </fieldset>
	    
	    <input type="button" class="button" value="&nbsp; OK &nbsp;" title=" OK " onclick="javascript:window.history.back();" /><br><br>
				
    </div>

</form> 

</div><!-- fim: div view_content --> 
