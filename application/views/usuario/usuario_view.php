<div class="areaimage">
	<center>
		<img src="{TPL_images}user-group-icon.png" height="72px"/>
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
	    
	        <legend class="subTitulo6">Usuário</legend> 
	          
	        <table class="table_form">
	        	<tbody>
	        		<tr>
			        	<td class="gray">CPF:
			        	</td>
			        	<td class="green"><?php echo $objeto->cpf; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Nome:
			        	</td>
			        	<td class="green"><?php echo $objeto->nome; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Setor:
			        	</td>
			        	<td class="green"><?php echo $objeto->setor; ?> 
			        	</td>
		        	</tr>
		        	<tr>
						<td class="gray">Nível:</td>
						<td class="green">
	                        <?php 
	                             echo $objeto->nivel;
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
