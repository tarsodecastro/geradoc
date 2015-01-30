<div class="areaimage">
<center>
	<img src="{TPL_images}office-women-glasses-icon.png" height="72px"/>
	</cente>
</div>

<p class="bg-success lead text-center">Funcionários do setor</p>		

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

    <?php
    echo $link_back;
    echo "<center>".$mensagem."</center>";
    ?>
	
	<div class="formulario">	
	
	    
	   <div class="panel panel-primary">
	
			  <div class="panel-heading">
			    <h3 class="panel-title"><?php echo $titulo; ?></h3>
			  </div>
			  	  
			  <table class="table table-bordered table-striped">
			    <tbody>
		        	<tr>
			        	<td>Nome:
			        	</td>
			        	<td><?php echo "$setorNome - $setorSigla"; ?> 
			        	</td>
		        	</tr>
		        	<tr>
						<td>Chefe:</td>
						<td>
	                         <?php
	                            echo $dono;
	                         ?>
	                    </td>
					</tr>
		        	
		        	<tr>
						<td>Funcionários:</td>
						<td>
	                         <?php
	                            echo $funcionarios;
	                         ?>
	                    </td>
					</tr>
	        	</tbody>
			  </table>
			  
		</div>
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 
