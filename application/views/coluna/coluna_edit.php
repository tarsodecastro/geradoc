<div class="areaimage">
	<center>
		<img src="{TPL_images}rescuers-icon.png" />
	</center>
</div>

<script type="text/javascript"> 
    $(document).ready(function(){		
        window.document.body.oncopy  = function() { return false; };
        window.document.body.onpaste = function() { return false; }
    });
</script> 
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
	    
	        <legend class="subTitulo6">Cargo</legend> 
	        
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class=gray><span class="text-red">*</span> Nome:
			        	</td>
			        	<td class="green"><?php echo form_input($campoNome) .form_error('campoNome'); ?> 
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	    </fieldset>

		<input type="submit" class="button" value="Salvar" title="Salvar"/>&nbsp;&nbsp;							
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 
