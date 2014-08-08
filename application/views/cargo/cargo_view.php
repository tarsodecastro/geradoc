<div class="areaimage">
	<center>
		<img src="{TPL_images}rescuers-icon.png" />
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
	    
	        <legend class="subTitulo6">Cargo</legend> 
	          
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class=gray><span class="text-red">*</span> Nome:
			        	</td>
			        	<td class="green"><?php echo $objeto->nome; ?> 
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	    </fieldset>
	    
	    <input type="button" class="button" value="&nbsp; OK &nbsp;" title=" OK " onclick="javascript:window.history.back();" /><br><br>
				
    </div>

</form> 

</div><!-- fim: div view_content --> 
