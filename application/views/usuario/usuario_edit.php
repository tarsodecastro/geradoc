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
    echo "<center>".$mensagem."</center>";
    echo form_open($form_action);
    ?>
	
	<div class="formulario">	
	
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Usuário</legend> 
	        
	        <table class="table_form">
	        	<tbody>
					
					<tr>
			        	<td class="gray" style="width: 150px;"><span class="text-red">*</span> CPF:
			        	</td>
			        	<td class="green"><?php echo form_input($campoCPF) .form_error('campoCPF'); ?> 
			        	</td>
		        	</tr>
					
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Nome:
			        	</td>
			        	<td class="green"><?php echo form_textarea($campoNome) .form_error('campoNome'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> E-mail:
			        	</td>
			        	<td class="green"><?php echo form_input($campoMail1) .form_error('campoMail1'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span>Confirme o e-mail:
			        	</td>
			        	<td class="green"><?php echo form_input($campoMail2) .form_error('campoMail2'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Senha:
			        	</td>
			        	<td class="green"><?php echo form_password($campoSenha) .form_error('campoSenha'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Confirme a Senha:
			        	</td>
			        	<td class="green"><?php echo form_password($campoConfSenha) .form_error('campoConfSenha'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
						<td class="gray">Setor:</td>
						<td class="green">
	                         <?php
	                            echo form_multiselect('campoSetores[]', $setoresDisponiveis, $setoresSelecionados);
	                            // echo $this->validation->orgao_error;
	                         ?>
	                    </td>
					</tr>
		        	<tr>
						<td class="gray"><span class="text-red">*</span> Nível:</td>
						<td class="green">
	                        <?php 
	                             echo form_dropdown('campoNivel', $niveisDisponiveis, $nivelSelecionado) .form_error('campoNivel');
	                         ?>
	                    </td>
					</tr>
		        	
	        	</tbody>
	        </table>
	    </fieldset>

		<input type="submit" class="button" value="Salvar" title="Salvar"/>&nbsp;&nbsp;							
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 
