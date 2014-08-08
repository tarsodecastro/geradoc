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
    echo form_open($form_action);
    ?>
	
	<div class="formulario">	
	
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Setor</legend> 
	        
	        <table class="table_form">
	        	<tbody>
	        	 	<tr>
						<td class="gray"><?php echo $link_orgaos; ?><span class="text-red">*</span></td>
						<td class="green">
	                        <?php 
	                             echo form_dropdown('campoOrgao', $orgaosDisponiveis, $orgaoSelecionado) .form_error('campoOrgao');
	                         ?>
	                    </td>
					</tr>
					<tr>
						<td class="gray">Setor pai:</td>
						<td class="green">
	                         <?php
	                            echo form_dropdown('campoSetorPai', $setoresPaiDisponiveis, $setorPaiSelecionado);
	                            // echo $this->validation->orgao_error;
	                         ?>
	                    </td>
					</tr>
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Nome:
			        	</td>
			        	<td class="green"><?php echo form_textarea($campoNome) .form_error('campoNome'); ?> 
			        	</td>
		        	</tr>
		        	<tr>
						<td class="gray"><span class="text-red">*</span> Chefe:</td>
						<td class="green">
	                         <?php
	                            echo form_dropdown('campoResponsavel', $responsaveis, $responsavel) .form_error('campoResponsavel');
	                         ?>
	                    </td>
					</tr>
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Sigla:
			        	</td>
			        	<td class="green"><?php echo form_input($campoSigla) .form_error('campoSigla'); ?> 
			        	</td>
		        	</tr>
		        	<tr>
						<td class="gray"><span class="text-red">*</span> Artigo:</td>
						<td class="green">
	                        <?php 
	                             echo form_dropdown('campoArtigo', $artigosDisponiveis, $artigoSelecionado) .form_error('campoArtigo');
	                         ?>
	                    </td>
					</tr>
					<tr>
						<td class="gray">Restrito:</td>
						<td class="green">
							Selecione SIM caso queira restringir o <b>universo de pesquisa</b>  e de <b>produção de documentos</b> de um usuário a apenas aos documentos deste setor, 
							ou seja, usuários associados a este setor não encontrarão documentos de outros setores, apenas deste, da mesma forma que só poderão produzir documentos de remetentes deste setor.  O valor padrão é NÃO <br>
	                        <?php 
	                             echo form_dropdown('campoRestricao', $restricoesDisponiveis, $restricaoSelecionada) .form_error('campoRestricao');
	                         ?>
	                         <br> 
	                    </td>
					</tr>
		        	<tr>
			        	<td class="gray"> Endereço:
			        	</td>
			        	<td class="green"><?php echo form_textarea($campoEndereco) . form_error('campoEndereco'); ?>
			        	</td>
		        	</tr>

	        	</tbody>
	        </table>
	    </fieldset>

		<input type="submit" class="button" value="Salvar" title="Salvar"/>&nbsp;&nbsp;							
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 
