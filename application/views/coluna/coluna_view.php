<div class="areaimage">
	<center>
		<img src="{TPL_images}rescuers-icon.png" />
	</center>
</div>

<ol class="breadcrumb">
	<li><a href="<?php echo site_url('/coluna/index'); ?>">Campos</a></li>
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
	    
	        <legend class="subTitulo6">Campo</legend> 
	          
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class="gray" style="width: 150px;"> Nome:
			        	</td>
			        	<td class="green"><?php echo $objeto['nome']; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray"> Tipo:
			        	</td>
			        	<td class="green"><?php echo $objeto['tipo']; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Tamanho atual:
			        	</td>
			        	<td class="green"><?php echo $tamanho_atual; ?> 
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	    </fieldset>
	    
	    <input type="button" class="button" value="&nbsp; OK &nbsp;" title=" OK " onclick="javascript:window.history.back();" /><br><br>
				
    </div>

</form> 

</div><!-- fim: div view_content --> 