<div class="areaimage">
	<center>
		<img src="{TPL_images}document-icon.png" height="72px" />
	</center>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.blockUI.js"></script>

<script type="text/javascript"> 
    $(document).ready(function(){		
    	 $("textarea#campoCabecalho").tinymce({
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

		  	plugins: "preview image jbimages spellchecker textcolor table lists code",
		  	
		  	toolbar: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | forecolor backcolor |subscript superscript removeformat | preview code | fontsizeselect jbimages ",
		  	statusbar : false,
		   });

    	 $("textarea#campoConteudo").tinymce({
		      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
		      language : 'pt_BR',
		  	  menubar : false,
		  	  browser_spellcheck : true,
		  	  forced_root_block : false, // <br />, para <p> deve ser comentado
		  	  setup : function(ed){
		  		ed.on('init', function() {
		  			   this.getDoc().body.style.fontSize = '10.5pt';
		  			});
		  	},

		  	plugins: "preview image jbimages spellchecker textcolor table lists code",
		  	
		  	toolbar: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | forecolor backcolor |subscript superscript removeformat |  preview code | fontsizeselect jbimages | table  ",
		  	statusbar : false,
		   });

    	 $("textarea#campoRodape").tinymce({
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

		  	plugins: "preview image jbimages spellchecker textcolor table lists code",
		  	
		  	toolbar: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | forecolor backcolor |subscript superscript removeformat | preview code | fontsizeselect jbimages ",
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
    echo $mensagem;
    echo form_open($form_action);
    ?>
	
	<div class="formulario">	
	
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Tipo</legend> 
	        
	        <table class="table_form">
	        	<tbody>
	        		
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Nome:
			        	</td>
			        	<td class="green"><?php echo form_input($campoNome) .form_error('campoNome'); ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Abreviação:
			        	</td>
			        	<td class="green"><?php echo form_input($campoAbreviacao) .form_error('campoAbreviacao'); ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Cabeçalho:
			        	</td>
			        	<td class="green" style="width: 1000px;"><?php echo form_textarea($campoCabecalho) .form_error('campoCabecalho'); ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Conteúdo:
			        	</td>
			        	<td class="green" style="width: 1000px;">
			        		<strong> Variáveis: </strong> 
			        		[tipo_doc], [numero], [ano_doc], [setor_doc], [data], [destinatario], [referencia], [assunto], [redacao], [remetente_assinatura], [remetente_nome], [remetente_cargo]
			        		[objetivo], [documentacao], [analise], [conclusao] <br /><br />
			        		<?php echo form_textarea($campoConteudo) .form_error('campoConteudo'); ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray">Rodapé:
			        	</td>
			        	<td class="green"><?php echo form_textarea($campoRodape) .form_error('campoRodape'); ?> 
			        	</td>
		        	</tr>
		        	
	        	</tbody>
	        </table>
	    </fieldset>

		<input type="button" class="button" value="&nbsp; CANCELAR &nbsp;" title=" CANCELAR " onclick="javascript:window.history.back();" /> &nbsp;  <input type="submit" class="button" value="Salvar" title="Salvar"/>							
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 
