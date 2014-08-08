<div class="areaimage">
<center>
	<img src="{TPL_images}office-women-glasses-icon.png" height="72px"/>
	</cente>
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
	    
	        <legend class="subTitulo6">Setor</legend> 
	          
	        <table class="table_form">
	        	<tbody>
		        	<tr>
						<td class="gray">Órgão: </td>
						<td class="green">
	                        <?php 
	                             echo $objeto->orgao;
	                         ?>
	                    </td>
					</tr>
					<tr>
					<td class="gray">Setor pai:</td>
					<td class="green">
                         <?php
                            echo $objeto->setorPai;
                         ?>
                    </td>
					</tr>
		        	<tr>
			        	<td class="gray">Nome:
			        	</td>
			        	<td class="green"><?php echo $objeto->nome; ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Sigla:
			        	</td>
			        	<td class="green"><?php echo $objeto->sigla; ?> 
			        	</td>
		        	</tr>
		        	<tr>
						<td class="gray">Artigo:</td>
						<td class="green">
	                        <?php 
	                             echo $objeto->artigo;
	                         ?>
	                    </td>
					</tr>
		        	<tr>
			        	<td class="gray">Endereço:
			        	</td>
			        	<td class="green"><?php echo $objeto->endereco;?>
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	    </fieldset>
	    
	    <input type="button" class="button" value="&nbsp; OK &nbsp;" title=" OK " onclick="javascript:window.history.back();" /><br><br>
				
    </div>

</form> 

</div><!-- fim: div view_content --> 
