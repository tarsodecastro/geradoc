<div class="areaimage" >
	<center>
		<img src="{TPL_images}companies-icon_2.png" height="72px"/>
	</cente>
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
    ?>
	
	<div class="formulario">	
	
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Órgão</legend> 
	          
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class=gray><span class="text-red">*</span> Nome:
			        	</td>
			        	<td class="green"><?php echo $objeto->nome; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Sigla:
			        	</td>
			        	<td class="green"><?php echo $objeto->sigla; ?>
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Endereço:
			        	</td>
			        	<td class="green"><?php echo $objeto->endereco; ?>
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	    </fieldset>
	    
	    <input type="button" class="button" value="&nbsp; OK &nbsp;" title=" OK " onclick="javascript:window.history.back();" /><br><br>
				
    </div>

</form> 

</div><!-- fim: div view_content --> 
