<div class="areaimage">
	<center>
		<img src="{TPL_images}Calendar-icon.png" height="72px" />
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
    echo form_open($form_action);
    ?>
	
	<div class="formulario">	
	
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Tipo de documento</legend> 
	          
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class=gray>Nome:
			        	</td>
			        	<td class="green"><?php echo $objeto->nome; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class=gray>Abreviação:
			        	</td>
			        	<td class="green"><?php echo $objeto->abreviacao; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class=gray>Ano:
			        	</td>
			        	<td class="green"><?php echo $objeto->ano; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class=gray><span class="text-red">*</span> Início da contagem:
			        	</td>
			        	<td class="green"><?php echo form_input($campoInicio) .form_error('campoInicio'); ?> 
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	    </fieldset>
	    
	    <input type="button" class="button" value="&nbsp; CANCELAR &nbsp;" title=" CANCELAR " onclick="javascript:window.history.back();" /> &nbsp; <input type="submit" class="button" value="Salvar" title="Salvar"/>&nbsp;&nbsp;	<br><br>
				
    </div>

</form> 

</div><!-- fim: div view_content --> 
