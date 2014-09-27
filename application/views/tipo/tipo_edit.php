<div class="areaimage">
	<center>
		<img src="{TPL_images}document-icon.png" height="72px" />
	</center>
</div>

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 


<div id="view_content">	

	<div class="row">
		<div class="col-md-12">
			<p class="bg-success lead text-center">Tipo</p>
		</div>
	</div>

	<div class="row">
    
	    <div class="col-md-12">
	    	<div class="btn-group">
		    <?php

		    echo $link_back;
		    
		    $readonly = '';
		    $painel = 'panel-primary';
		    if ($disabled != null){
		    	$readonly  = 'readonly : 1,';
		    	$painel = 'panel-default';
		    	echo $link_update_sm;
		    }
		    ?>
		  	</div>  
	    </div>

    </div>
	
	<div class="formulario">
	
	<!-- Mensagens e alertas -->
			<div class="row">
		   		<div class="col-md-12">
		    	
				    	<?php 
				    		echo "<center>".$mensagem."</center>"; 
				    	
					    	if(validation_errors() != ''){
					    		echo '<div class="alert alert-danger" role="alert">';
					    		echo form_error('campoNome');
								echo form_error('campoAbreviacao');
								echo form_error('campoConteudo');
					    		echo '</div>';
					    	}
				    	?>
			  	 
		    	</div>	
		   	</div>
		   	<!-- Fim das mensagens e alertas -->	
	
	<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
	
		<fieldset <?php echo $disabled; ?>>
	
		<div class="panel <?php echo $painel; ?>">
		
			<div class="panel-heading">
				  <h3 class="panel-title"><?php echo $titulo; ?></h3>
			</div>
			
			<div class="panel-body">
			
			
				<div class="form-group <?php echo (form_error('campoNome') != '')? 'has-error':''; ?>"">
				    <label for="campoNome" class="col-sm-3 control-label"><span style="color: red;">*</span> Nome</label>
				    <div class="col-md-7">
				      	<?php echo form_input($campoNome); ?> 
				     </div>
				</div>
				
				<div class="form-group <?php echo (form_error('campoAbreviacao') != '')? 'has-error':''; ?>"">
				    <label for="campoAbreviacao" class="col-sm-3 control-label"><span style="color: red;">*</span> Abreviação</label>
				    <div class="col-md-3">
				      	<?php echo form_input($campoAbreviacao); ?> 
				     </div>
				</div>

				<table class="table table-bordered table-striped table-hover">
				   	<thead>
				   		<tr>
				   			<th class="text-center">Campo</th>
				   			<th class="text-center">Disponível</th>
				   			<th class="text-center">Obrigatório</th>
				   			<th class="text-center">Rótulo</th>
				   			<th class="text-center">Ordem</th>
				   		</tr>
				   	</thead>
				    <tbody>
			        	<?php echo $linhas;?>
			        </tbody>
				</table>
			    
			    
			    <div class="col-lg-12">							
				    <div class="form-group text-left <?php echo (form_error('campoCabecalho') != '')? 'has-error':''; ?>"">
					    <label for="campoCabecalho" class="control-label">Cabeçalho</label>
					     <?php echo form_textarea($campoCabecalho); ?> 
					</div>
				</div>
				
				
						
				<div class="col-lg-12">	
					<div class="form-group text-left <?php echo (form_error('campoConteudo') != '')? 'has-error':''; ?>"">
					    <label for="campoConteudo" class="control-label"><span class="text-red">*</span> Distribuição do conteúdo</label>
					    <div class="bg-warning text-center" style="padding: 7px;">
						  	<strong> Variáveis disponíveis: </strong>
							 <?php 

								$variaveis =  explode (', ', $variaveis_disponiveis);
								
								natsort($variaveis);
							 
							 	echo form_dropdown('variaveis', $variaveis,'' ,'id="variaveis"');
							 	
							 ?>
						</div>
					    <?php echo form_textarea($campoConteudo); ?>  
					</div>
				</div>
			   
			    
			    <div class="col-lg-12">	
			     	<div class="form-group text-left <?php echo (form_error('campoRodape') != '')? 'has-error':''; ?>"">
				   		<label for="campoRodape" class="control-label">Rodapé</label>
				      	<?php echo form_textarea($campoRodape); ?> 
					</div>
				</div>
				
	    	 </div>
    		<!-- fim: div panel-body --> 
	    
	    </div>
    	<!-- fim: div panel --> 
    
   		</fieldset>

		<div class="btn-group">
		   		<?php
			    	echo $link_cancelar;
			    	
					if ($disabled == null){
				    	echo $link_salvar;
				    }else{
						echo $link_update;
					}
			    ?>
		</div>
		
    </form> 
    

    </div>
    <!-- fim: div formulario --> 

</div>
<!-- fim: div view_content --> 

<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/jquery.tinymce.min.js"></script>


<script type="text/javascript"> 
    $(document).ready(function(){	


    	$('#variaveis').change(function(){
    	    $('textarea#campoConteudo').val($('textarea#campoConteudo').val()+" "+$('#variaveis option:selected').text());
    		//$('textarea#campoConteudo').html($('textarea#campoConteudo').val() + $('#variaveis option:selected').text());
    	});
    				
    	 $("textarea#campoCabecalho").tinymce({
		      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
		      <?php echo $readonly; ?>
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
		      <?php echo $readonly; ?>
		      language : 'pt_BR',
		  	  menubar : false,
		  	  browser_spellcheck : true,
		  	  //forced_root_block : false, // <br />, para <p> deve ser comentado
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
		      <?php echo $readonly; ?>
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
