<div class="areaimage">
	<center>
		<img src="{TPL_images}black-pages-icon.png" height="72px"/>
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
	    
	        <legend class="subTitulo6">Remetente</legend> 
	          
	        <table class="table_form" style="min-width: 750px">
	        	<tbody>
		        	<tr>
			        	<td class="gray" style="width: 150px">Nome:
			        	</td>
			        	<td class="green"><?php echo $objeto->nome; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Assinatura:
			        	</td>
			        	<td class="green"><?php echo $objeto->assinatura; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Sexo:
			        	</td>
			        	<td class="green"><?php echo $objeto->sexo; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Cargo:
			        	</td>
			        	<td class="green"><?php echo $objeto->cargo; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Setor:
			        	</td>
			        	<td class="green"><?php echo $objeto->setor; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Telefone fixo:
			        	</td>
			        	<td class="green"><?php echo $objeto->fone; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Telefone fax:
			        	</td>
			        	<td class="green"><?php echo $objeto->fax; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Telefone celular:
			        	</td>
			        	<td class="green"><?php echo $objeto->celular; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">E-mail institucional:
			        	</td>
			        	<td class="green"><?php echo $objeto->mail1; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">E-mail particular:
			        	</td>
			        	<td class="green"><?php echo $objeto->mail2; ?> 
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	        
	       
	        
	    </fieldset>
	    
	    <input type="button" class="button" value="&nbsp; OK &nbsp;" title=" OK " onclick="javascript:window.history.back();" /><br><br>
				
    </div>

</form> 

</div><!-- fim: div view_content --> 
