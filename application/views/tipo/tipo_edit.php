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
 
<ol class="breadcrumb">
	<li><a href="<?php echo site_url('/tipo/index'); ?>">Tipos</a></li>
  	<li class="active"><?php echo $titulo;?></li>
</ol>		

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

    <?php
    echo $link_back;
    echo $mensagem;
    echo form_open($form_action);
    ?>
	
	<div class="formulario">	
	
	    <fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Identificação</legend> 
	        
	        <table class="table_form">
	        	<tbody>
	        		
		        	<tr>
			        	<td class="gray" style="width: 150px;"><span class="text-red">*</span> Nome:
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
		        	
	        	</tbody>
	        </table>
	        
	    </fieldset>
	    
	    
	    <fieldset class="conteiner2" style="margin-top: 20px;"> 
	    
	        <legend class="subTitulo6">Itens presentes no formulário</legend> 
	        
	        <table class="table_form" style="border-collapse: collapse;">
	        	<tbody>
	        	<tr>
		        	<td class="gray" style="text-align: center; font-weight: bold;">Campo
		        	</td>
		        	<td class="gray" style="text-align: center; font-weight: bold;">Disponível
		        	</td>
		        	<td class="gray" style="text-align: center; font-weight: bold;">Rótulo
		        	</td>
	        	</tr>
	        		<?php echo $linhas;?>
	
	        	</tbody>
	        </table>

	    </fieldset>
	    
	    
	     <fieldset class="conteiner2" style="margin-top: 20px;"> 
	    
	        <legend class="subTitulo6">Itens presentes na exportação</legend> 
	        
	         <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class="gray">Cabeçalho:
			        	</td>
			        	<td class="green" style="width: 1000px;"><?php echo form_textarea($campoCabecalho) .form_error('campoCabecalho'); ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Organização do Conteúdo:
			        	</td>
			        	<td class="green" style="width: 1000px;">
			        		<strong> Variáveis: </strong> 
			        		[tipo_doc], [numero], [ano_doc], [setor_doc], [data], [destinatario], [referencia], [assunto], [redacao], [remetente_assinatura], [remetente_nome], [remetente_cargo]
			        		<?php
				        		echo $variaveis_disponiveis;
								echo "<br /><br />";
								echo form_textarea($campoConteudo) .form_error('campoConteudo');
			        		?>
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
	    
	    
	    

		<input type="button" class="button" value="&nbsp; Cancelar &nbsp;" title=" Cancelar " onclick="javascript:window.history.back();" /> &nbsp;  <input type="submit" class="button" value=" Salvar " title="Salvar"/>							
    	
    </div>

</form> 

</div><!-- fim: div view_content --> 
