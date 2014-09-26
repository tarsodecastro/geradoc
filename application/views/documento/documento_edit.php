
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/datepicker/js/jquery.ui.datepicker-pt-BR.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/calendario/_scripts/jquery.click-calendario-1.0-min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>scripts/calendario/_style/jquery.click-calendario-1.0.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.countdown.css">


<link href="<?php echo base_url(); ?>js/jquery-ui.min.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url(); ?>js/countdown/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/countdown/jquery.countdown-pt-BR.js"></script>

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

		    echo $link_back;
		    
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
						<label for="campoRemetente" class="col-sm-2 control-label"><span style="color: red;">*</span> Remetente</label>
						<div class="col-md-8">
							<?php
								$jsRemet = 'class="form-control" id="campoRemetente" onChange="window.location.href=(\''.site_url('documento').'/'.$acao.'/r\' + \'/\' + document.form.campoRemetente.value + \'/t/\' + document.form.campoTipo.value + \'/c/\' + document.form.campoCarimbo.value)"';
	
								echo form_dropdown('campoRemetente', $remetentesDisponiveis, $remetenteSelecionado, $jsRemet);
							?> 
						</div>
					</div>
					
					
					<div class="form-group <?php echo (form_error('campoSetor') != '')? 'has-error':''; ?>">
						<label for="campoSetor" class="col-sm-2 control-label">Setor</label>
						<div class="col-md-8">
							<input type="hidden" name="setorId" id="setorId" value="<?php echo $setorId; ?>" />
							<?php echo form_input($campoSetor); ?>
						</div>
					</div>
					  
					  
					<div class="row">
					  
					  	<div class="col-md-4">
							<div class="form-group <?php echo (form_error('campoData') != '')? 'has-error':''; ?>">
								<label for="campoData" class="col-md-6 control-label"><span style="color: red;">*</span> Data</label>
								<div class="col-md-6">
									<?php echo form_input($campoData); ?>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group <?php echo (form_error('campoCarimbo') != '')? 'has-error':''; ?>">
								<label for="campoCarimbo" class="col-md-6 control-label">Carimbo de folha</label>
								<div class="col-md-6">
									<?php
										/*			
										if($acao == 'update'){
											$jsCarimbo = 'class="form-control"';
		
										}else{
											$jsCarimbo = 'class="form-control" onChange="window.location.href=(\''.site_url('documento').'/'.$acao.'/r/\' + document.form.campoRemetente.value + \'/t/\' + document.form.campoTipo.value + \'/c/\' + document.form.campoCarimbo.value)"';
										}
										
										echo form_dropdown('campoCarimbo', $carimbosDisponiveis, $carimboSelecionado, $jsCarimbo);
										*/
									
										echo form_dropdown('campoCarimbo', $carimbosDisponiveis, $carimboSelecionado, 'class="form-control"');
									?>
								</div>
							</div>
						</div>
					
					</div>
					
					
					<div class="form-group <?php echo (form_error('campoTipo') != '')? 'has-error':''; ?>">
						<label for="campoTipo" class="col-sm-2 control-label"><span style="color: red;">*</span> Tipo</label>
						<div class="col-md-8">
							<?php
										
								$jsTipo = 'class="form-control" onChange="window.location.href=(\''.site_url('documento').'/'.$acao.'/r/\' + document.form.campoRemetente.value + \'/t/\' + options[selectedIndex].value + \'/c/\' + document.form.campoCarimbo.value)"';
								echo form_dropdown('campoTipo', $tiposDisponiveis, $tipoSelecionado, $jsTipo);
							?>
						</div>
					</div>
					
					<div class="form-group <?php echo (form_error('campoAssunto') != '')? 'has-error':''; ?>">
						<label for="campoAssunto" class="col-sm-2 control-label"><span style="color: red;">*</span> Assunto</label>
						<div class="col-md-8">
							<?php echo form_input($campoAssunto);?> 
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
												
												if(count($campo) == 2){ // se campo tiver apenas 2 partes...
													$campo[2] = ''; // rotulo = ''
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
											if($campo[0] == 'S' and $coluna['tipo'] == 'string'){


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

							 $("textarea#campoPara").tinymce({
							      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
							      	<?php echo $readonly; ?>
							  		language : 'pt_BR',
							  		menubar : false,
							  		width : 540,
							  		browser_spellcheck : true,
							  		forced_root_block : false,
							  		setup : function(ed){
							  		ed.on('init', function() {
							  			   this.getDoc().body.style.fontSize = '10.5pt';
							  			});
							  	},
							  	toolbar: "undo redo | bold italic underline superscript ",
							  	statusbar : false,
							   });

						});

							function log( message ) {
								$("#campoPara").val(message);
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

						            var campoPara = $('#campoPara').val();
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
								<div style="width: 330px; margin-top: 3px; margin-left: auto; margin-right: auto; display:block; display: table; background-color: #eee;">
									<div style="float: left; color: #333; height:37px; border: 1px solid #ccc; line-height: 200%;"> &nbsp;Esta sessão expira em:&nbsp;</div>
									<div id="defaultCountdown" style="width: 170px; height:37px; float: right; color: #C00000;"></div>
								</div>
								<div class="error_field" id="monitor" style="background-color: #fff; position:relative; float: right; top: -23px; padding-right: 20px;"></div>
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
										
										if(count($campo) == 2){ // se campo tiver apenas 2 partes...
											$campo[2] = ''; // rotulo = ''
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
									if($campo[0] == 'S' and $coluna['tipo'] == 'blob'){

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
															 $("textarea#campo_'.$nome_campo.'").tinymce({
																  '.$readonly.'
															      script_url : "'. base_url() .'js/tinymce/tinymce.min.js",
															      language : "pt_BR",
															  	  menubar : false,
															  	  browser_spellcheck : true,
															  	  content_css : "'. base_url() .'css/style_editor.css" ,
															  	//  width : 800,
															  	  relative_urls: false,
															  	  setup : function(ed){
															  		ed.on("init", function() {
															  			   this.getDoc().body.style.fontSize = "10.5pt";
															  			});
															  	},
												
															  	plugins: "preview image jbimages spellchecker textcolor table lists code",
												
															  	toolbar: "undo redo | bold italic underline strikethrough | subscript superscript removeformat | alignleft aligncenter alignright alignjustify | forecolor backcolor | bullist numlist outdent indent | preview code | fontsizeselect table | jbimages ",
															  	statusbar : false,
															  	relative_urls: false
												
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
							
							echo $campos_dinamicos_grandes;
						
						?>

						
					</div>
					<!-- fim da div panel-body -->
					
			</div>
			<!-- fim da div panel -->	
			

			
		</fieldset>
		
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
        			$( "#campoData" ).datepicker();
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