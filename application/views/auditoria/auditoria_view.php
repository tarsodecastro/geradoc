<div class="areaimage">
	<center>
		<img src="{TPL_images}Security-Camera-icon.png" />
	</center>
</div>

<div id="titulo" class="titulo1"> 
    <?php echo $titulo; ?>
</div>		

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

    <?php
    echo $link_back;
    echo $message;
    ?>
	
	<div class="formulario">	
	
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Registro</legend> 
	          
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class=gray> Data:
			        	</td>
			        	<td class="green"><?php echo $objeto->data; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class=gray> Usuário:
			        	</td>
			        	<td class="green"><?php echo $usuario_nome; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class=gray> URL:
			        	</td>
			        	<td class="green">
			        	
			        	<?php 
			        	
			        	if(stristr($objeto->url, 'view') === FALSE) {

			        		echo $objeto->url;
			        		
			        	}else{

							echo anchor($objeto->url);
			        		
			        	}

			        	?> 
			        	
			        	
			        	
			        	
			        	</td>
		        	</tr>
		        	
	        	</tbody>
	        </table>
	    </fieldset>
	    
	    <input type="button" class="button" value="&nbsp; OK &nbsp;" title=" OK " onclick="javascript:window.history.back();" /><br><br>
				
    </div>

</form> 

</div><!-- fim: div view_content --> 
