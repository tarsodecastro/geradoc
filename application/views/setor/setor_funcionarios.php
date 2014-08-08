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
    echo "<center>".$mensagem."</center>";
    ?>
	
	<div class="formulario">	
	
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Setor</legend> 
	        
	        <table class="table_form">
	        	<tbody>

		        	<tr>
			        	<td class="gray">Nome:
			        	</td>
			        	<td class="green"><?php echo "$setorNome - $setorSigla"; ?> 
			        	</td>
		        	</tr>
		        	<tr>
						<td class="gray">Chefe:</td>
						<td class="green">
	                         <?php
	                            echo $dono;
	                         ?>
	                    </td>
					</tr>
		        	
		        	<tr>
						<td class="gray">Funcionários:</td>
						<td class="green">
	                         <?php
	                            echo $funcionarios;
	                         ?>
	                    </td>
					</tr>
	        	</tbody>
	        </table>
	    </fieldset>						
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 
