<div class="areaimage">
	<center>
		<img src="{TPL_images}black-pages-icon.png" height="72px"/>
	</center>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.blockUI.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	   $("#campoFone").mask("(99)9999.9999");
	   $("#campoFax").mask("(99)9999.9999");
	   $("#campoCelular").mask("(99)9999.9999");

	   $("textarea#campoAssinatura").tinymce({
		      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
		      language : 'pt_BR',
		  	  menubar : false,
		  	  browser_spellcheck : true,
		  	  forced_root_block : false,
		  	  setup : function(ed){
		  		ed.on('init', function() {
		  			   this.getDoc().body.style.fontSize = '10.5pt';
		  			});
		  	},

		  	plugins: "preview image spellchecker textcolor table lists",
		  	
		  	toolbar: "bold italic underline strikethrough | subscript superscript removeformat",
		  	statusbar : false,
		   });
	});
</script>

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
	    
	        <legend class="subTitulo6">Remetente</legend> 
	        
	        <table class="table_form" style="min-width: 750px">
	        	<tbody>
					
		        	<tr>
			        	<td class="gray" style="width: 150px"><span class="text-red">*</span> Nome:
			        	</td>
			        	<td class="green"><?php echo form_textarea($campoNome) .form_error('campoNome'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
			        	<td class="gray"> Assinatura:
			        	</td>
			        	<td class="green"><?php echo form_textarea($campoAssinatura) .form_error('campoAssinatura'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
			        	<td class="gray"> Sexo:
			        	</td>
			        	<td class="green"><?php echo form_dropdown('campoSexo', $sexosDisponiveis, $sexoSelecionado) .form_error('campoSexo'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
			        	<td class="gray"> Status:
			        	</td>
			        	<td class="green"><?php echo form_dropdown('campoStatus', $statusDisponiveis, $statusSelecionado) .form_error('campoStatus'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
						<td class="gray"><span class="text-red">*</span> Cargo:</td>
						<td class="green">
	                         <?php echo form_dropdown('campoCargo', $cargosDisponiveis, $cargoSelecionado) . form_error('campoCargo'); ?>
	                    </td>
					</tr>
					
		        	<tr>
						<td class="gray"><span class="text-red">*</span> Setor:</td>
						<td class="green">
	                        <?php  echo form_dropdown('campoSetor', $setoresDisponiveis, $setorSelecionado) .form_error('campoSetor'); ?>
	                    </td>
					</tr>
					
					<tr>
						<td class="gray"><span class="text-red">*</span> Telefone fixo:</td>
						<td class="green">
	                       <?php echo form_input($campoFone) .form_error('campoFone'); ?> 
	                    </td>
					</tr>
					
					<tr>
						<td class="gray"> Fax:</td>
						<td class="green">
	                       <?php echo form_input($campoFax) .form_error('campoFax'); ?> 
	                    </td>
					</tr>
					
					<tr>
						<td class="gray"> Telefone celular:</td>
						<td class="green">
	                       <?php echo form_input($campoCelular) .form_error('campoCelular'); ?> 
	                    </td>
					</tr>
					
					<tr>
						<td class="gray"><span class="text-red">*</span> E-mail institucional:</td>
						<td class="green">
	                       <?php echo form_input($campoMail1) .form_error('campoMail1'); ?> 
	                    </td>
					</tr>
					
					<tr>
						<td class="gray"> E-mail particular:</td>
						<td class="green">
	                       <?php echo form_input($campoMail2) .form_error('campoMail2'); ?> 
	                    </td>
					</tr>
					
	        	</tbody>
	        </table>
	    </fieldset>

		<input type="submit" class="button" value="Salvar" title="Salvar"/>&nbsp;&nbsp;							
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 
