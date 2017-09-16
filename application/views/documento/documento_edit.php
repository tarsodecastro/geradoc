
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/datepicker/js/jquery.ui.datepicker-pt-BR.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/calendario/_scripts/jquery.click-calendario-1.0-min.js"></script>


<link rel="stylesheet" href="<?php echo base_url(); ?>scripts/calendario/_style/jquery.click-calendario-1.0.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.countdown.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-select.min.css">
<link href="<?php echo base_url(); ?>js/jquery-ui.min.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url(); ?>js/countdown/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/countdown/jquery.countdown-pt-BR.js"></script>

<script src="<?php echo base_url(); ?>js/ckeditor/ckeditor.js"></script>

<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>

<div class="areaimage">
	<center>
		<img src="{TPL_images}Actions-document-edit-icon.png" height="72px" />
	</center>
</div>

<style>

.ui-autocomplete-loading {
	background: white
		url('<?php echo base_url(); ?>scripts/images/ui-anim_basic_16x16.gif')
		right center no-repeat;
}

.blink {
    background: #FFFF00;
    !important;
}

div.ui-datepicker{
 font-size:10pt;
}

</style>

<script type="text/javascript">
//--- Tela de Aguarde... (Loading) ---/
$.blockUI({ message: '<h1><img src="<?php echo base_url(); ?>scripts/images/ui-anim_basic_16x16.gif" /> Aguarde...</h1>' });
//--- Fim ---//
</script>


<p class="bg-success lead text-center">Documento</p>

<div id="view_content">

    <div class="row">
    
	    <div class="col-md-12">
	    	<div class="btn-group">
		    <?php

		    $readonly = '';
		    $painel = 'panel-primary';
		    if ($disabled != null){
		    	$readonly  = 'readonly : 1,';
		    	$painel = 'panel-default';
		    	echo $link_export_sm;
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
			    		echo "<center>".$message."</center>"; 
			    	
				    	if(validation_errors() != ''){
				    		echo '<div class="alert alert-danger" role="alert">';
				    		echo validation_errors();
				    		echo '</div>';
				    	}
			    	?>
		  	 
	    	</div>	
	   	</div>
	   	<!-- Fim das mensagens e alertas -->
	
	
	<form class="form-horizontal" role="form" id="form" name="form" action="<?php echo $form_action; ?>" method="post" >
	
		<fieldset <?php echo $disabled; ?>>
	
			<div class="panel <?php echo $painel; ?>">
			
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $titulo; ?></h3>
				</div>
			

				<div class="panel-body">

					
						
					<div class="form-group <?php echo (form_error('campoRemetente') != '')? 'has-error':''; ?>">
						<label for="campoRemetente" class="col-md-2 control-label"><span style="color: red;">*</span> Remetente</label>
						<div class="col-md-8">
						
								<?php
									$jsRemet = 'class="form-control selectpicker" data-style="btn-default" data-live-search="true" id="campoRemetente" onChange="window.location.href=(\''.site_url('documento').'/'.$acao.'/r\' + \'/\' + document.form.campoRemetente.value + \'/t/\' + document.form.campoTipo.value)"';
		
									echo form_dropdown('campoRemetente', $remetentesDisponiveis, $remetenteSelecionado, $jsRemet);
								?> 
						</div>
					
						<div class="col-md-2 text-left">
							<a href="#" class="btn" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-html="true" title='<strong>Remetente</strong> <i class="fa fa-question-circle fa-lg" style="color: #428bca;"></i>' data-content="<div class='text-justify'>É quem assina o documento. <br> O remetente está associado a um setor. É possível criar um documento para que outra pessoa o assine. Uma vez que o documento é salvo não se pode alterar o remente.</div>">
								<i class="fa fa-question-circle fa-lg" style="color: #428bca;"></i>
							</a>	
						</div>

					</div>
					
					<div class="form-group <?php echo (form_error('campoSetor') != '')? 'has-error':''; ?>">
						<label for="campoSetor" class="col-sm-2 control-label">Setor</label>
						<div class="col-md-8">
							<input type="hidden" name="setorId" id="setorId" value="<?php echo $setorId; ?>" />
							<div class="alert alert-success text-left" style="margin-bottom: 0px; padding: 7px;"><strong><?php echo $campoSetor['value']; ?></strong>&nbsp;</div>
							
						</div>
						
						<div class="col-md-2 text-left">
							<a href="#" class="btn" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-html="true" title='<strong>Setor</strong> <i class="fa fa-question-circle fa-lg" style="color: #428bca;"></i>' data-content="<div class='text-justify'>É a unidade adiministrativa a qual pertence o rementente do documento. <br> Não é possível alterar diretamento o setor, mas durante a criação do documento é possível mudar o remetente.</div>">
								<i class="fa fa-question-circle fa-lg" style="color: #428bca;"></i>
							</a>	
						</div>
					</div>
					
					  
					  
					<div class="row">
					  
					  	<div class="col-md-6">
					  	
					  		<div class="form-group <?php echo (form_error('campoTipo') != '')? 'has-error':''; ?>">
								<label for="campoTipo" class="col-md-4 control-label"><span style="color: red;">*</span> Tipo</label>
								<div class="col-md-8">
									<?php
												
										$jsTipo = 'class="form-control selectpicker" data-style="btn-default" data-live-search="true" onChange="window.location.href=(\''.site_url('documento').'/'.$acao.'/r/\' + document.form.campoRemetente.value + \'/t/\' + options[selectedIndex].value)"';
										echo form_dropdown('campoTipo', $tiposDisponiveis, $tipoSelecionado, $jsTipo);
									?>
								</div>
							</div>

						</div>
						
						<div class="col-md-4">
						
							<div class="form-group <?php echo (form_error('campoData') != '')? 'has-error':''; ?>">
								<label for="campoData" class="col-md-6 control-label"><span style="color: red;">*</span> Data</label>
								<div class="col-md-6">
									<?php echo form_input($campoData); ?>
								</div>
							</div>
							
						
						</div>

					</div>

					<div class="form-group <?php echo (form_error('campoAssunto') != '')? 'has-error':''; ?>">
						<label for="campoAssunto" class="col-sm-2 control-label"><span style="color: red;">*</span> Assunto</label>
						<div class="col-md-8">
							<?php echo form_input($campoAssunto);?> 
						</div>
					</div>
					
					<div class="form-group <?php echo (form_error('campoAnexo') != '')? 'has-error':''; ?>">
						<label for="campoAnexo" class="col-sm-2 control-label">Anexos</label>
						<div class="col-md-8">
							<?php 
							
								$jsAnexo = 'class="form-control selectpicker" multiple data-style="btn-default" data-live-search="true" title="SELECIONE"';
								
								echo form_dropdown('campoAnexo[]', $anexosDisponiveis, $anexoSelecionado, $jsAnexo);
		
							?> 
						</div>
						
						<div class="col-md-2 text-left">
							<a href="#" class="btn" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-html="true" title='<strong>Anexos</strong> <i class="fa fa-question-circle fa-lg" style="color: #428bca;"></i>' data-content="<div class='text-justify'>São os documentos que compõem o documento. Você pode selecionar arquivos que foram armazenados no <strong>respositório</strong> do seu setor e eles estarão visíveis durante a visualização do documento, evitando a necessidade de imprimí-los.</div>">
								<i class="fa fa-question-circle fa-lg" style="color: #428bca;"></i>
							</a>	
						</div>
					</div>
						
								<?php 
						
								$campos_dinamicos_pequenos = '';
								
								if($tipoSelecionado != null){
										
										$obj_tipo = $this->Tipo_model->get_by_id($tipoSelecionado)->row();
										
										$this->load->model('Coluna_model','',TRUE);
										$campos_especiais = $this->Coluna_model->list_all();
										
										$campos_especiais = array_diff($campos_especiais, array('para'));
										
										// Reordena os campos com base no valor da ordenacao 
										
										foreach ($campos_especiais as $key => $nome_campo){

											
											$campo = explode(';' , $obj_tipo->$nome_campo);
											
											$campo[3] = isset($campo[3]) ? $campo[3] : '';
											
											$campos_especiais[$key] = $campo[3] . '#'. $nome_campo;

										}
	
										natsort($campos_especiais);
										//Fim da reordenacao dos campos
										
										/*
										echo "<pre>";
										print_r($campos_especiais);
										echo "</pre>";
										*/
										//exit;
							
										foreach ($campos_especiais as $key => $nome_campo){	
											
											//retira o # apos a reordenacao
											$pos = strpos($nome_campo, '#');
											$nome_campo = substr($nome_campo, $pos + 1);
											//fim
											
											if(strpos($obj_tipo->$nome_campo, ';') != FALSE){

												$campo = explode(';' , $obj_tipo->$nome_campo);
												
												if(isset($campo[2]) and $campo[2] == ''){ // se o rotulo estiver em branco
													$campo[2] = $nome_campo; // rotulo = ao nome do campo
												}
												
												if($campo[1] == 'S'){
													$asterisco = '<span style="color: red;">*</span>';
												}else{
													$asterisco = '';
												}
												 
												
											}else{
												$campo[0] = $obj_tipo->$nome_campo;
												$campo[2] = $nome_campo;
											}
											
											
											$coluna = $this->Coluna_model->get_by_nome($nome_campo);
											
											$erro = '';
// 											if($campo[0] == 'S' and $coluna['tipo'] == 'string'){
											if($campo[0] == 'S' and ($coluna['tipo'] == 'string' or $coluna['tipo'] == 'varchar')){


												if(form_error('campo_'.$nome_campo) != ''){
													$erro = 'has-error';
												}
												
											
												$campos_dinamicos_pequenos .= '	
					
													<!--  Campo '.$nome_campo.' -->
		
													<div class="form-group '.$erro.'">
														<label for="'.'campo_'.$nome_campo.'" class="col-sm-2 control-label">'. $asterisco .' '. $campo[2].'</label>
															<div class="col-md-8">
															'.$input_campo[$nome_campo].'
															</div>
													</div>
				
													<!--  Fim do campo '.$nome_campo.' -->
												';	
		
											}	
								
										}	
							
									}
									
									echo $campos_dinamicos_pequenos;
									
											
									if($tipoSelecionado != null){ // testa se o tipo foi selecionado
									
										$campo_para = explode(';' , $obj_tipo->para);
									
										if($campo_para[0] != 'N'){ // testa se o campo 'para'esta disponivel
								
								?>
					
					
							<div class="form-group <?php echo (form_error('campoPara') != '')? 'has-error':''; ?>">
								<label for="campoPara" class="col-sm-2 control-label"><br><br><span style="color: red;">*</span> Para</label>
								<div class="col-md-8">
									<div class="input-group">
									<span class="input-group-addon glyphicon glyphicon-search" style="top: 0px;"></span>
									<input type="text" name="campoBusca" value="pesquisa textual" id="campoBusca" size="30" class="form-control">
									</div>
									<?php echo form_textarea($campoPara); ?>
									<span class="error_field" id="para_error" style="display: none;"></span> 
									
								</div>
							</div>
							
							<script type="text/javascript">
						$().ready(function() {

							 $("#campoBusca").focus(function() {
							        if($("#campoBusca").val() == 'pesquisa textual'){
							        	$("#campoBusca").addClass('campo_busca_hover');
							            $("#campoBusca").attr('value','');
							        }
							        
							    }).blur(function() {
							        if($("#campoBusca").val() == ''){
							        	 $("#campoBusca").addClass('campo_busca');
							            $("#campoBusca").attr('value','pesquisa textual');
							        }
							       
							    });

							
// 							 $("textarea#campoPara").tinymce({
//							      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
//							      	<?php echo $readonly; ?>
// 							  		language : 'pt_BR',
// 							  		menubar : false,
// 							  		width : 540,
// 							  		browser_spellcheck : true,
// 							  		forced_root_block : false,
// 							  		setup : function(ed){
// 							  		ed.on('init', function() {
// 							  			   this.getDoc().body.style.fontSize = '10.5pt';
// 							  			});
// 							  	},
// 							  	toolbar: "undo redo | bold italic underline superscript ",
// 							  	statusbar : false,
// 							   });
							 

							// Replace the <textarea id="editor1"> with a CKEditor
							// instance, using default configuration.
							
							CKEDITOR.replace( 'campoPara', {

								contentsCss: '<?php echo base_url();?>/css/ckeditor_styles.css',
								language: 'pt-BR',
								enterMode: CKEDITOR.ENTER_BR,
								height: '150',

								filebrowserBrowseUrl: 		'<?php echo base_url();?>js/kcfinder/browse.php?opener=ckeditor&type=files',
								filebrowserImageBrowseUrl: 	'<?php echo base_url();?>js/kcfinder/browse.php?opener=ckeditor&type=images',
								filebrowserFlashBrowseUrl: 	'<?php echo base_url();?>js/kcfinder/browse.php?opener=ckeditor&type=flash',
								filebrowserUploadUrl: 		'<?php echo base_url();?>js/kcfinder/upload.php?opener=ckeditor&type=files',
								filebrowserImageUploadUrl:	'<?php echo base_url();?>js/kcfinder/upload.php?opener=ckeditor&type=images',
								filebrowserFlashUploadUrl: 	'<?php echo base_url();?>js/kcfinder/upload.php?opener=ckeditor&type=flash',
							   
								toolbar: [
								  		{ name: 'document', items: [ 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
								  		[ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ],			// Defines toolbar group without name.
								  		
								  	]
							  	
// 							    removeButtons: 'Source,Preview,Templates,'+
// 							    			   'Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Scayt,'+
// 							    			   'NumberedList,BulletedList,Outdent,Indent,'+
// 							    			   'Link,Unlink,Anchor,'+
// 							    			   'Table,SpecialChar,'+
// 							    			   'Font,'+
// 							    			   'Maximize,ShowBlocks,'+
// 							    			   'Save,NewPage,Print,Find,Replace,SelectAll,Form,Checkbox,Radio,' +
// 								    		   'TextField,Textarea,Select,Button,ImageButton,HiddenField,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,'+
// 								    		   'Image,Flash,HorizontalRule,Smiley,PageBreak,Iframe,Styles,Format,About'
							
							});
							 

						});

							function log( message ) {
						
							//	$("#campoPara").val(message); // descomentar essa linha sem o ckeditor

								CKEDITOR.instances.campoPara.setData( message ); // descomentar essa linha com o ckeditor
							}

						    $('#campoBusca').autocomplete({
								minLength: 3,
								source: function(req, add){
									$.ajax({
									    url: '<?php echo base_url(); ?>index.php/documento/loadDestinatario/',
									    dataType: 'json',
									    type: 'POST',
									    data: req,
									    success: function(data){
									        if(data.response =='true'){
									           add(data.message);
									        }else{
									            $('#campoBusca').removeClass( "ui-autocomplete-loading" );
									        }
									    },
									});
						    	},

							select: function( event, ui ) {

								log( ui.item ? ui.item.label : "Nothing selected, input was " + this.value);
								this.value = "";
								return false;
							},
						            
						    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
						        return $( "<li></li>" )
						            .data( "ui-autocomplete-item", item )
						            .append( "<a>" + item.label + "</a>" )
						            .appendTo( ul );
						    };

						    
						        $("#form").submit(function() {

						            //var campoPara = $('#campoPara').val(); // descomentar essa linha se nao estiver usando o ckeditor
						            var campoPara = CKEDITOR.instances.campoPara.getData(); // descomentar essa linha se estiver usando o ckeditor
						            var campoRedacao = $('#campoRedacao').val();

						            var teste1 = false;
						            var teste2 = false;
						          
						            if (campoPara == '') {
						                //alert(campoPara);
						                $("#para_error").html("<img class='img_align' src='{TPL_images}error.png' alt='!' /> * requerido").show();
						                teste1 = false;
						            }else{
						                //alert(campoPara);
						                $("#para_error").hide();
						                teste1 = true;
						            }

						            if (campoRedacao == '') {
						               // alert(campoRedacao);
						                $("#redacao_error").html("<img class='img_align' src='{TPL_images}error.png' alt='!' /> * requerido").show();
						                teste2 = false;
						            }else{
						                // alert(campoRedacao);
						                $("#redacao_error").hide();
						                teste2 = true;
						            }

						            if(teste1 == true && teste2 == true){
						                return true;
						            }else{
						                return false;
						            }

						        });
						        

						</script>
					
						<?php 
							} // fim do teste que verifica se o campo para esta disponivel
						}// fim do teste que verifica se o tipo foi selecionado 
						
						if ($tipoSelecionado != null and $disabled == null){
						
						?>
						
						<div class="form-group">
							<div class="col-md-12">
							
								<div class="alert alert-warning text-center" style="margin: 0px auto; padding: 7px; width: 330px;">
									Esta sessão expira em <span id="defaultCountdown" style="color: #C00000;"></span>
								</div>

							</div>
						</div>
						
						<?php 
						}
						
						$campos_dinamicos_grandes = '';
						
						if($tipoSelecionado != null){
								
								$obj_tipo = $this->Tipo_model->get_by_id($tipoSelecionado)->row();
								
								$this->load->model('Coluna_model','',TRUE);
								$campos_especiais = $this->Coluna_model->list_all();
								
								// Reordena os campos com base no valor da ordenacao
								foreach ($campos_especiais as $key => $nome_campo){
								
									$campo = explode(';' , $obj_tipo->$nome_campo);
										
									$campo[3] = isset($campo[3]) ? $campo[3] : ''; // campo da ordenacao pode estar vazio
									
									$campos_especiais[$key] = $campo[3] . '#'. $nome_campo;
								
								}
								
								natsort($campos_especiais);
								//Fim da reordenacao dos campos
					
								foreach ($campos_especiais as $key => $nome_campo){

									//retira o # apos a reordenacao
									$pos = strpos($nome_campo, '#');
									$nome_campo = substr($nome_campo, $pos + 1);
									//fim
					
									if(strpos($obj_tipo->$nome_campo, ';') != FALSE){
										$campo = explode(';' , $obj_tipo->$nome_campo);
										
										if(isset($campo[2]) and $campo[2] == ''){ // se o rotulo estiver em branco
											$campo[2] = $nome_campo; // rotulo = ao nome do campo
										}
										
										if($campo[1] == 'S'){
											$asterisco = '<span style="color: red;">*</span>';
										}else{
											$asterisco = '';
										}
										
										
									}else{
										$campo[0] = $obj_tipo->$nome_campo;
										$campo[2] = $nome_campo;
									}
									
									$coluna = $this->Coluna_model->get_by_nome($nome_campo);
									
									$erro = '';
									if($campo[0] == 'S') {
										
										if($nome_campo != 'para' and ($coluna['tipo'] == 'blob' or $coluna['tipo'] == 'text' or $coluna['tipo'] == 'longtext')){

										if(form_error('campo_'.$nome_campo) != ''){
											$erro = 'has-error';
										}

										$campos_dinamicos_grandes .= '	
					
											<!--  Campo '.$nome_campo.' -->
		
												<div class="col-lg-12">
		
												<div class="text-left form-group '.$erro.'">
													<label class="control-label text-left">'. $asterisco .' '. $campo[2].'</label>
													
													<script type="text/javascript">
		    										$().ready(function() {
		    		
		    											CKEDITOR.replace( \'campo_'.$nome_campo.'\', {

															contentsCss: \''.base_url().'css/ckeditor_styles.css\',
															language: \'pt-BR\',
		  													height: \'350\',
							
															filebrowserBrowseUrl: 		\''.base_url().'js/kcfinder/browse.php?opener=ckeditor&type=files\',
															filebrowserImageBrowseUrl: 	\''.base_url().'js/kcfinder/browse.php?opener=ckeditor&type=images\',
															filebrowserFlashBrowseUrl: 	\''.base_url().'js/kcfinder/browse.php?opener=ckeditor&type=flash\',
															filebrowserUploadUrl: 		\''.base_url().'js/kcfinder/upload.php?opener=ckeditor&type=files\',
															filebrowserImageUploadUrl:	\''.base_url().'js/kcfinder/upload.php?opener=ckeditor&type=images\',
															filebrowserFlashUploadUrl: 	\''.base_url().'js/kcfinder/upload.php?opener=ckeditor&type=flash\',
														   
															toolbar: [
							
																		[\'Source\'],
						
																		[\'Cut\', \'Copy\', \'Paste\', \'PasteText\', \'PasteFromWord\'],
							
															  			[\'Bold\', \'Italic\', \'Underline\', \'Strike\', \'Subscript\', \'Superscript\', \'-\', \'RemoveFormat\'],	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
															  		
																		[\'JustifyLeft\', \'JustifyCenter\', \'JustifyRight\', \'JustifyBlock\', \'-\', \'Outdent\', \'Indent\', \'-\', \'NumberedList\', \'BulletedList\'],
																		
																		[\'Image\', \'Table\'],
							
																		\'/\',
							
																		[\'FontSize\'],
							
																		[\'TextColor\', \'BGColor\'],
							
																		[\'Scayt\'],
																  		
																  	]
														    
// 														    removeButtons: \'Templates,\'+
// 														    			   \'Cut,Copy,\'+
// 														    			   \'Link,Unlink,Anchor,\'+
// 														    			   \'SpecialChar,\'+
// 														    			   \'Font,\'+
// 														    			   \'Maximize,ShowBlocks,\'+
// 														    			   \'Save,NewPage,Print,Find,Replace,SelectAll,Form,Checkbox,Radio,\' +
// 															    		   \'TextField,Textarea,Select,Button,ImageButton,HiddenField,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,\'+
// 															    		   \'Flash,HorizontalRule,Smiley,PageBreak,Iframe,Styles,Format,About\'

														});
		    										});
												   </script>
													'.$input_campo[$nome_campo].'

												</div>
										
											</div>
		
											<!--  Fim do campo '.$nome_campo.' -->
										';	

									}	
									
								}
						
								}	
					
							}
							
							echo $campos_dinamicos_grandes;
						
						?>

						
					</div>
					<!-- fim da div panel-body -->
					
			</div>
			<!-- fim da div panel -->	
			

			
		</fieldset>
		
		<!-- Mensagens e alertas -->
		<div class="row">
	   		<div class="col-md-12">
	    	
			    	<?php 
			    		echo "<center>".$message."</center>"; 
			    	
				    	if(validation_errors() != ''){
				    		echo '<div class="alert alert-danger" role="alert">';
				    		echo validation_errors();
				    		echo '</div>';
				    	}
			    	?>
		  	 
	    	</div>	
	   	</div>
	   	<!-- Fim das mensagens e alertas -->
		
			<div class="btn-group">
		   		<?php
		   		
			    	echo $link_cancelar;
			    	
					if ($disabled == null){
				    	echo $link_salvar;
				    }else{
						echo $link_export;
						echo $link_update;
					}
			    	
			    ?>
			</div>	
		
		</form>
		
		

	</div>
	<!-- fim da div formulario -->
	
</div>
<!-- fim da div  view_content -->


<script type="text/javascript">
//$(document).ready(function () {

    //call the blink function on the element you want to blink
    //blink("#myDiv", 4, 500); //blink a div with the ID of myDiv
    //blink("input[type='submit']", 3, 1000); //blink a submit button
    //blink("ol > li:first", -1, 100); //blink the first element in an ordered list (infinite times)
    //blink(".myClass", 25, 5000); //blink anything that has a myClass on it
//});

/**
 * Purpose: blink a page element
 * Preconditions: the element you want to apply the blink to, the number of times to blink the element (or -1 for infinite times), the speed of the blink
 **/
function blink(elem, times, speed) {
    if (times > 0 || times < 0) {
        if ($(elem).hasClass("blink")) $(elem).removeClass("blink");
        else $(elem).addClass("blink");
    }

    clearTimeout(function () {
        blink(elem, times, speed);
    });

    if (times > 0 || times < 0) {
        setTimeout(function () {
            blink(elem, times, speed);
        }, speed);
        times -= .5;
    }
}


        $(function () {
        	var austDay = new Date();
        	austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
				
        	$('#defaultCountdown').countdown({
        										until: <?php echo $sess_expiration;?>, 
        										onTick: warnUser, 
        										compact: true,
        										layout: '{hnn}h{sep}{mnn}m{sep}{snn}s',
        										format: 'HMS',
        										expiryUrl: "<?php echo site_url('login/logoff'); ?>"
        									});
        	function warnUser(periods) { 
        		   if ($.countdown.periodsToSeconds(periods) == <?php echo $sess_expiration / 4;?>) { 
        			   blink(".panel-body", 30, 500);
        			   $('#monitor').html("<img class='img_align' src='{TPL_images}/error.png' alt='!' /> Salve seu documento!");
        		   } 
        		}
        	
        	$('#year').text(austDay.getFullYear());
        })

                $(document).ready(function(){
                    
                	if ($("#campoRemetente").val() == "0") {
        					$("#tr_tipo").hide();
        				}

        			$("#campoRemetente").bind("change", function () {
        				if ($(this).val() == "empty") {
        					$("#tr_tipo").hide();
        				}
        				else if($(this).val() != "0") {
        					$("#tr_tipo").slideDown();
        				}
        			});

        			$.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
        			$( "#campoData" ).datepicker({
        				beforeShow: function() {
        			        setTimeout(function(){
        			            $('.ui-datepicker').css('z-index', 99999999999999);
        			        }, 0);
        			    }
        			});
        			/*
                    $('#campoData').focus(function(){
                          $(this).calendario({
                                target:'#campoData',
                                 top:0,
                                left:80
                            });
                       });
                    */
                });

        $(function() {
        	$('option[value=empty]').prop('disabled', true);
        });


//--- Fim da tela de Aguarde... (Loading) ---/
   	$.unblockUI({ });
//--- Fim ---//							
</script>