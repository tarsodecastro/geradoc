
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tinymce/jquery.tinymce.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>scripts/calendario/_scripts/jquery.click-calendario-1.0-min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>scripts/calendario/_style/jquery.click-calendario-1.0.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.countdown.css">


<link href="<?php echo base_url(); ?>scripts/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/countdown/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/countdown/jquery.countdown-pt-BR.js"></script>

<script src="<?php echo base_url(); ?>scripts/jquery-ui.min.js"></script>

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


#geral { 	
	background-color: #F7F7F7;    
}
</style>

<script type="text/javascript">
//--- Tela de Aguarde... (Loading) ---/
$.blockUI();
//--- Fim ---//

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

               $('#campoData').focus(function(){
                    $(this).calendario({
                        target:'#campoData',
                         top:0,
                        left:80
                    });
                });
        
        //var urlList = '<?php echo base_url(); ?>index.php/documento/loadDestinatario/teste' + campoAssunto;

        });

$(function() {
	$('option[value=empty]').prop('disabled', true);
});

//--- Fim da tela de Aguarde... (Loading) ---/
	$.unblockUI({ });
//--- Fim ---//

</script>


<div id="view_content">

<?php echo $link_back; ?>

	<div class="formulario">

		<fieldset class="conteiner2">

			<legend class="subTitulo6">Documento</legend>

			<div class="documento">

				<div class="content">
					<?php 
					
					echo $message; 
					
				//	echo validation_errors();
					
					?>
					
					<form action="<?php echo $form_action; ?>" method="post" id="form" name="form">

						<div class="data" align="center">
							<table style="width:100%" class="table_form">
							
								<tr>
									<td class="gray"><span style="color: red;">*</span> <strong>Remetente:</strong>
									</td>
									<td valign="top" class="green">
									<?php
										$jsRemet = 'id="campoRemetente" onChange="window.location.href=(\''.site_url('documento').'/'.$acao.'/r\' + \'/\' + document.form.campoRemetente.value + \'/t/\' + document.form.campoTipo.value + \'/c/\' + document.form.campoCarimbo.value)"';

										echo form_dropdown('campoRemetente', $remetentesDisponiveis, $remetenteSelecionado, $jsRemet);
										echo form_error('campoRemetente');
										?>
									</td>
								</tr>
								
								<tr>
									<td class="gray"><strong>Setor:</strong>
									</td>
									<td valign="top" class="green"><input type="hidden" name="setorId" id="setorId" value="<?php echo $setorId; ?>" /> <?php echo form_input($campoSetor) . form_error('campoSetor'); ?>
									</td>
								</tr>
								
								<tr>
									<td class="gray"><span style="color: red;">*</span> <strong>Data:</strong>
									</td>
									<td valign="middle" class="green">
											<input type="hidden" name="id" size="6" value="<?php echo $id; ?>" />
											<?php echo form_input($campoData) . form_error('campoData'); ?>
									</td>
								</tr>
								<tr>
									<td class="gray" style="width: 140px;"><strong>Carimbo de folha:</strong>
									</td>
									<td valign="middle" class="green">
											<?php
											
												if($acao == 'update'){
													$jsCarimbo = '';

												}else{
													$jsCarimbo = 'onChange="window.location.href=(\''.site_url('documento').'/'.$acao.'/r/\' + document.form.campoRemetente.value + \'/t/\' + document.form.campoTipo.value + \'/c/\' + document.form.campoCarimbo.value)"';
												}
												
												echo form_dropdown('campoCarimbo', $carimbosDisponiveis, $carimboSelecionado, $jsCarimbo);
												echo form_error('campoCarimbo');
											?>
									</td>
								</tr>
								
								
								<tr id="tr_tipo">
									<td class="gray"><span style="color: red;">*</span> <strong>Tipo:</strong>
									</td>
									<td valign="top" class="green">
									<?php
										$jsTipo = 'onChange="window.location.href=(\''.site_url('documento').'/'.$acao.'/r/\' + document.form.campoRemetente.value + \'/t/\' + options[selectedIndex].value + \'/c/\' + document.form.campoCarimbo.value)"';
										echo form_dropdown('campoTipo', $tiposDisponiveis, $tipoSelecionado, $jsTipo);
										echo form_error('campoTipo');
									?>
									</td>
								</tr>
								<tr>
									<td class="gray"><span style="color: red;">*</span> <strong>Assunto:</strong></td>
									<td valign="top" class="green">
										<?php echo form_input($campoAssunto) .form_error('campoAssunto'); ?> 
									</td>
								</tr>

								<?php
								if($tipoSelecionado == 3 or $tipoSelecionado == 5){

									$tr_td = '<tr><td class="gray">';
									
									echo $tr_td;
									
										echo form_label('<span style="color: red;">*</span> <strong>Número do processo</strong>:', 'desp_num_processo').'</td><td valign="top" class="green">';
									
										echo form_input($desp_num_processo);
										
										if(isset($this->validation->desp_num_processo_error))
											if($this->validation->desp_num_processo_error !== "")
											echo $this->validation->desp_num_processo_error;
										
									echo '</td></tr>';
							
									echo $tr_td;
									
										echo form_label('<span style="color: red;">*</span> <strong>Interessado</strong>:', 'desp_interessado').'</strong></td><td valign="top" class="green">';
									
										echo form_input($desp_interessado);
										
										if(isset($this->validation->desp_interessado_error))
											if($this->validation->desp_interessado_error !== "")
											echo '</br>'.$this->validation->desp_interessado_error;
										
									echo '</td></tr>';
						
								}
								?>
								
								<?php if($tipoSelecionado != 0 and $tipoSelecionado != 3 and $tipoSelecionado != 4 and $tipoSelecionado != 5 and $tipoSelecionado != 6 and $tipoSelecionado != 7 and $tipoSelecionado != 8 and $tipoSelecionado != 9){ // 3 = DESPACHO, 7 = PARECER TECNICO, 7 = ATO ADMINISTRATIVO, 8 = NOTA DE INTRUCAO E 9 = NOTA DE ELOGIO?>
								<tr>
									<td class="gray"><strong>Referência:</strong>
									</td>
									<td valign="top" class="green">
										<?php echo form_input($campoReferencia) . form_error('campoReferencia'); ?>
									</td>
								</tr>
								<?php } ?>
								
								<?php if($tipoSelecionado and $tipoSelecionado != 0 and $tipoSelecionado != 4 and $tipoSelecionado != 6 and $tipoSelecionado != 7 and $tipoSelecionado != 8 and $tipoSelecionado != 9){ // 7 = ATO ADMINISTRATIVO, 8 = NOTA DE INTRUCAO E 9 = NOTA DE ELOGIO?>
								<tr>
									<td class="gray"><strong><span style="color: red;">*</span> Destinatário:</strong>
									</td>
									<td valign="top" class="green">

										<input type="text" name="campoBusca" value="pesquisa textual" id="campoBusca" size="30" class="campo_busca" />
										
										<?php echo form_textarea($campoPara) . form_error('campoPara'); ?>
										<span class="error_field" id="para_error" style="display: none;"></span>

									</td>
								</tr>
								<?php } ?>
										
							</table>
						</div>
						

						<?php if($tipoSelecionado and $tipoSelecionado != 0){ // $tipoSelecionado = 7 = ATO ADMINISTRATIVO, 8 = NOTA DE INTRUCAO E 9 = NOTA DE ELOGIO (LEGADO DA AESP, pode e deve ser retirado em uma nova instalacao.?>
						<div style="width: 320px; margin-top: 3px; margin-left: auto; margin-right: auto;display:block; display: table; background-color: #eee;">
							<div style="float: left; color: #333; height:30px; border: 1px solid #ccc; line-height: 200%;"> &nbsp;Esta sessão expira em:&nbsp;</div>
							<div id="defaultCountdown" style="width: 160px; height:30px; float: right; color: #C00000;"></div>
						</div>
						<div class="error_field" id="monitor" style="background-color: #fff; position:relative; float: right; top: -23px; padding-right: 20px;"></div>
						<?php } ?>
						
						<?php 
						
						$campos_dinamicos = '';
						
						if($tipoSelecionado != null){
								
								$obj_tipo = $this->Tipo_model->get_by_id($tipoSelecionado)->row();
								
								$this->load->model('Coluna_model','',TRUE);
								$campos_especiais = $this->Coluna_model->list_all();
					
								foreach ($campos_especiais as $key => $nome_campo){
					
									if(strpos($obj_tipo->$nome_campo, ';') != FALSE){
										$campo = explode(';' , $obj_tipo->$nome_campo);
									}else{
										$campo[0] = $obj_tipo->$nome_campo;
										$campo[1] = 'Sem rótulo';
									}
									
									if($campo[0] == 'S'){
									
										$campos_dinamicos .= '				
											<!--  Campo '.$nome_campo.' -->
											<div style="padding-left: 5px; padding-top: 15px; padding-bottom: 5px;">
												<span style="color: red;">*</span> <strong>'.$campo[1].'</strong> '.form_error('campo_'.$nome_campo).'
												<br>
											</div>
											<script type="text/javascript">
												$().ready(function() {				
													 $("textarea#campo_'.$nome_campo.'").tinymce({
													      script_url : "'. base_url() .'js/tinymce/tinymce.min.js",
													      language : "pt_BR",
													  	  menubar : false,
													  	  browser_spellcheck : true,
													  	  content_css : "'. base_url() .'css/style_editor.css" ,
													  	  width : 800,
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
											<p style="padding-left: 15px;">'.$input_campo[$nome_campo].
											'</p>
											<!--  Fim do campo '.$nome_campo.' -->
										';	

									}	
						
								}	
					
							}
							
							echo $campos_dinamicos;
						
						?>

						<p style="text-align: center;">
						<br>
							<input type="submit" class="button" value="Salvar" title="Salvar"/>&nbsp;&nbsp;	
						</p>
						<br>
					
					</form>
				</div>
			</div>
			<!-- fim do conteudo -->

		</fieldset>
	</div>
	<!-- fim da div  formulario -->
</div>
<!-- fim da div  view_content -->

<?php if($tipoSelecionado != 0 and $tipoSelecionado != 4 and $tipoSelecionado != 6 and $tipoSelecionado != 7 and $tipoSelecionado != 8 and $tipoSelecionado != 9){ // SE NAO FOR: 7 = ATO ADMINISTRATIVO, 8 = NOTA DE INTRUCAO E 9 = NOTA DE ELOGIO ?>
				
<script type="text/javascript">
//Initializes all textareas with the tinymce class
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
	  		language : 'pt_BR',
	  		menubar : false,
	  		width : 550,
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
            
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
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


<?php } else {?>

<script type="text/javascript">


$().ready(function() {

   $("textarea#campoRedacao").tinymce({
	      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
	      language : 'pt_BR',
	  	  menubar : false,
	  	  browser_spellcheck : true,
	  	  content_css : '<?php echo base_url(); ?>css/style_editor.css',
	  	  width : 800,
	  	  relative_urls: false,
	  	  setup : function(ed){
	  		ed.on('init', function() {
	  			   this.getDoc().body.style.fontSize = '10.5pt';
	  			});
	  	},

	  	table_default_attributes: {
	        title: 'My table',
		    border: '1'
	    },

	  	plugins: "preview image jbimages spellchecker textcolor table lists code",
	  	
	  	toolbar: "undo redo | bold italic underline strikethrough | subscript superscript removeformat | alignleft aligncenter alignright alignjustify | forecolor backcolor | bullist numlist outdent indent | preview code | fontsizeselect table | jbimages ",
	  	statusbar : false,
	  	relative_urls: false
	  	
	   });

});

        $("#form").submit(function() {

            var campoRedacao = $('#campoRedacao').val();

            var testeRedacao = false;
        
            if (campoRedacao == '') {
               // alert(campoRedacao);
                $("#redacao_error").html("<img class='img_align' src='{TPL_images}error.png' alt='!' /> * requerido").show();
                testeRedacao = false;
            }else{
                // alert(campoRedacao);
                $("#redacao_error").hide();
                testeRedacao = true;
            }

            if(testeRedacao == true){
                return true;
            }else{
                return false;
            }

        });

        //--- Fim da tela de Aguarde... (Loading) ---/
       	$.unblockUI({ });
        //--- Fim ---//
        
								
</script>

<?php } ?>
