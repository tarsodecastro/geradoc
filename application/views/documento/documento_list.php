<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-select.min.css">

<script type="text/javascript" src="<?php echo base_url(); ?>js/datepicker/js/jquery.ui.datepicker-pt-BR.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maskedinput.min.js"></script>


<div class="areaimage">
	<center>
		<h4 class="text-mutted"><img src="{TPL_images}cabinet-icon.png" height="62px" /> <?php echo $titulo;?></h4>
	</cente>
</div>

<!-- 
<p class="bg-success lead text-center"></p>


<div id="msg" style="display: none;">
	<img src="{TPL_images}loader.gif" class="img_aling2" alt="Carregando" />Aguarde
	carregando...
</div>
 -->

<script type="text/javascript">
//      $(window).load(function(){
//          $('#modal_loading').modal('toggle');
//      });
</script>


	<div class="row">

		<div class="col-md-6">
			<?php echo $link_add;?>
			<a href="<?php echo site_url();?>/workflow" class="btn btn-default" data-container="body" data-trigger="hover" data-placement="bottom" data-html="html" 
				title='<i class="fa fa-inbox fa-lg" style="color: #CC0000;"></i> Caixa de entrada'
				data-content="Clique nesse botão para verificar os documentos enviados para o seu setor.">
				<i class="fa fa-inbox fa-lg" style="color: #CC0000;"></i> Entrada <span class="badge" style="background-color: #CC0000;"><?php echo $workflow;?></span></a>
	
			<a href="<?php echo site_url();?>/alerta" class="btn btn-default" data-container="body" data-trigger="hover" data-placement="bottom" data-html="html" 
				title='<i class="cus-bell"></i> Alertas' 
				data-content="Clique nesse botão para verificar os alertas que você criou.">
				<i class="cus-bell"></i> Alertas <span class="badge"></span></a>
			
			<a href="#" class="btn btn-default" data-toggle="popover" id="btnPopoverPeriodo" data-target="#modalConfig" data-container="body" data-trigger="hover" data-placement="bottom" data-html="html" 
				title='<i class="fa fa-calendar fa-lg" style="color: #0000FF;"></i> Período' 
				data-content="Clicando nesse botão você poderá definir a <strong>data inicial</strong> e a <strong>data final</strong> dos documentos listados.">
				<i class="fa fa-calendar fa-lg" style="color: #0000FF;"></i> Período</a>
			
			<a href="#" class="btn btn-default" data-toggle="popover" id="btnPopoverPesquisa" data-target="#modalPesquisa" data-container="body" data-trigger="hover" data-placement="right" data-html="html" 
				title='<i class="fa fa-search fa-lg" style="color: #008000;"></i> Pesquisa' 
				data-content="Clique nesse botão para realizar pesquisas textuais nos conteúdos dos documentos públicos.">
				<i class="fa fa-search fa-lg" style="color: #008000;"></i> Pesquisa</a>

			
		</div>

		<div class="col-sm-12 visible-xs" style="padding: 5px;"></div>
		
		<div class="col-md-3">
			<?php echo $link_search_cancel; ?>
		</div>
		
		
		<div class="col-md-3">

				<?php 
				if (isset($setorCaminho)){
				
					$bg_setor = '';
					
					if($setorSelecionado != $this->session->userdata('setor')){
							
						//$bg_setor = 'style="background-color: #f8efc0;"';		
						
						$bg_setor = 'style="background-color: #fcf8e3;"';
					}

				?>
				<div class="input-group">
					<span class="input-group-btn">
			        <a href="#" class="btn btn-default" data-toggle="popover"  id="btnPopoverSetor" data-target="#modalSetor" data-container="body" data-trigger="hover" data-placement="left" data-html="html" 
					title=' <i class="fa fa-university fa-lg" style="color: #EEA236;"></i> Setor' 
					data-content="Clicando nesse botão você poderá escolher outro setor e listar os documentos <strong>públicos</strong> que lá foram criados">
			        
			        <i class="fa fa-university fa-lg" style="color: #EEA236;"></i> Setor:</a>
			      </span>
					<input type="text" class="form-control" value="<?php echo $setorCaminho?>" readonly <?php echo $bg_setor?>>
			    </div>
			    <?php }?>

			<!-- /input-group -->
		</div>

		<div class="col-sm-12 visible-xs" style="padding: 5px;"></div>
		
		
		<!-- /.col-lg-6 -->
		
		<div class="col-sm-12 visible-xs" style="padding: 5px;"></div>

	</div>
	<!-- /.row -->


	<div style="clear: both;"></div>

	<div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
		<?php echo $table; ?>
	</div>
	
	<!-- Paginacao -->
	<div class="row">
		<div class="col-md-6">
			<div class="dataTables_info" role="status">
				
				<button class="btn btn-default" id="totalRegistros" type="button" data-target="#modalConfig" 
				data-toggle="popover" data-container="body" data-trigger="hover" data-placement="top" 
				data-html="html" title="<span class='badge' style='background-color: #06ab5f;'><?php echo number_format($total_rows, 0, ',', '.');?></span> registros nesse período" 
				data-content="Você pode mudar o período clicando nesse botão.">
				  Total de <span class="badge" style="background-color: #06ab5f; font-weight: normal !important; letter-spacing: 1px; font-size: 0.9em; text-shadow: 0 0px 0 #fff;"><?php echo number_format($total_rows, 0, ',', '.');?></span> registros 
				  entre <span class="badge" style="background-color: #658b6f; font-weight: normal !important; letter-spacing: 1px; font-size: 0.9em; text-shadow: 0 0px 0 #fff;"><?php echo $dataInicial;?></span>
				  e <span class="badge" style="background-color: #658b6f; font-weight: normal !important; letter-spacing: 1px; font-size: 0.9em; text-shadow: 0 0px 0 #fff;"><?php echo $dataFinal;?></span>
				</button>

			</div>
		</div>
		<div class="col-md-6">
			<div class="dataTables_paginate paging_simple_numbers">
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
	<!-- Fim da paginacao -->
	

	
<!-- Modal Setor -->
<div class="modal fade" id="modalSetor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-university fa-lg" style="color: #FF7F50;"></i> Setor</h4>
      </div>
			
			<form class="form-horizontal" role="form" id="frm1" name="frm1" method="post">
			
			<div class="modal-body" style="padding: 5px;">
			
				<div class="alert alert-warning text-justify" role="alert" style="padding: 10px;">
					<h4><strong>Leia-me!</strong></h4>
					<p>Por padrão, listamos os documentos <strong>do seu setor</strong>. Para um setor diferente, selecione no campo abaixo:</p>
				</div>
	
				<div class="row">
						<div class="col-md-10 col-md-offset-1">

							<div class="form-group">
								<label for="campoNome" class="col-md-1 control-label">Setor</label>
								<div class="col-md-11">
								<?php

									$options = array();
										
									if(isset($setores)){
					
										$var = site_url('documento/index');
					
										$js = 'class="form-control selectpicker" data-style="btn-warning" data-live-search="true" id="setores" onChange="window.location.href=(\''.$var.'/s\'+ document.getElementById(\'setores\').value)"';//\''.site_url('documento/index').'"';//.'\' + document.form.setores.value)"';
					
									
										echo form_dropdown('setores', $setoresDisponiveis, $setorSelecionado, $js);
									
									}
									?>
								</div>
							</div>

						</div>
						  
				</div>
							
			</div>
			
			<div class="modal-footer" style="padding-top: 3px; text-align: center;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		    </div>
		    
		    </form>
		
    </div>
  </div>
</div>
	
<!-- Modal Config -->
<div class="modal fade" id="modalConfig" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar fa-lg" style="color: #0000FF;"></i> Período</h4>
      </div>
			
			<form  id="configForm" role="form" action="<?php echo $form_action_config_update;?>" method="post">
			
			<div class="modal-body" style="padding: 5px;">
			
				<div class="alert alert-info text-justify" role="alert" style="padding: 10px;">
					<h4><strong>Leia-me!</strong></h4>
					<p>Por padrão, listamos os documentos <strong>criados nos últmimos 12(doze) meses</strong>. Períodos maiores podem tornar a listagem dos documentos mais lenta.<br> </p>
					<p>Para um período diferente, informe as datas desejadas nos campos abaixo:</p>
				</div>
	
				<div class="row">
						<div class="col-md-1">
						</div>
						
						<div class="col-md-5">
							<div class="form-group">
							  	<label for="campoDataInicial">Data inicial</label>
							    <input type="text" class="form-control" name="campoDataInicial" id="campoDataInicial" required value="<?php echo $dataInicial; ?>">
						  	</div>
						 </div>
						  
						 <div class="col-md-5">
						 	<div class="form-group">
							    <label for="campoDataFinal">Data final</label>
							    <input type="text" class="form-control" name="campoDataFinal" id="campoDataFinal" required value="<?php echo $dataFinal; ?>">
						 	</div>
						 </div>
						 
						 <div class="col-md-1">
						</div>
						  
				</div>
							
			</div>
			
			<div class="modal-footer" style="padding-top: 3px; text-align: center;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<?php echo $link_periodo_cancel;?>
			        <button type="submit" class="btn btn-primary" id="btnSalvarPeriodo">Salvar <span class="glyphicon glyphicon glyphicon-ok"></span></button>
		    </div>
		    
		    </form>
		
    </div>
  </div>
</div>



<!-- Modal Pesquisa -->
<div class="modal fade" id="modalPesquisa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <form id="frm_search" name="frm_search" action="<?php  echo $form_action; ?>" method="post">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-search fa-lg" style="color: #008000;"></i> Pesquisa</h4>
      </div>
			
			<div class="modal-body" style="padding: 5px;">
			
			
			<div class="alert alert-success" role="alert" style="padding: 10px;">
				<h4><strong>Leia-me!</strong></h4>
				<p>A pesquisa é realizada nos conteúdos dos documentos <strong>públicos</strong> e <strong>em seus documentos privados</strong>, de acordo com os filtros selecionados abaixo, <strong>excetuando-se</strong>, obviamente, os documentos privados dos outros usuários do sistema.</p>
			
			<!-- 
				<p>
					<button class="btn btn-default" id="bntModalPesquisaPeriodo" type="button"><i class="fa fa-calendar fa-lg" style="color: #0000FF;"></i> Perídodo definido: 
					  <strong><?php echo $dataInicial;?></strong>
					  à <strong><?php echo $dataFinal;?></strong>
					</button>
					
					<?php 
						if($link_search_cancel == ""){
							
							$parametros_btn_setor = 'id="bntModalPesquisaSetor"';

						}else{
							$parametros_btn_setor = "disabled";
						}
					?>
					<button class="btn btn-default"  type="button" <?php echo $parametros_btn_setor;?>><i class="fa fa-university fa-lg" style="color: #FF7F50;"></i> Setor selecionado: 
					  <strong><?php echo $setorCaminho;?></strong>
					</button>
				</p>
				 -->

			</div>
			
			
			<div class="row">
			
						<div class="col-md-1">
							
						 </div>
						
						<div class="col-md-2">
							<div class="form-group">
							  	<label for="campoDataInicial">Data inicial</label>
							    <input type="text" class="form-control" name="campoDataInicial" id="campoDataInicialPesquisa" required value="<?php echo $dataInicial; ?>">
						  	</div>
						 </div>
						  
						 <div class="col-md-2">
						 	<div class="form-group">
							    <label for="campoDataFinal">Data final</label>
							    <input type="text" class="form-control" name="campoDataFinal" id="campoDataFinalPesquisa" required value="<?php echo $dataFinal; ?>">
						 	</div>
						 </div>

						<div class="col-md-6">
						 	<div class="form-group">
							    <label for="campoTipo">Tipo de documento</label>
		
									<?php
												
										$jsTipo = 'class="form-control selectpicker" data-style="btn-default" data-live-search="true" ';
										echo form_dropdown('campoTipo', $tiposDisponiveis, $tipoSelecionado, $jsTipo);
										?>
								</div>
						
						 </div>
						 
						 <div class="col-md-1">
							
						 </div>
						  
				</div>
				
				
				<div class="row">
						
						<div class="col-md-1">
							
						 </div>	 
						<div class="col-md-10">
						 		<div class="form-group">
							    <label for="campoDataFinal">Setor</label>
						 
						 			<?php
					
									$options = array();
										
									if(isset($setores)){
					
										$var = site_url('documento/index');
					
										$js = 'class="form-control selectpicker" data-style="btn-default" data-live-search="true" id="setores" ';//\''.site_url('documento/index').'"';//.'\' + document.form.setores.value)"';
											 
						
									
										echo form_dropdown('setorPesquisa', $setoresDisponiveis, $setorSelecionado, $js);
									
									}
									?>
									</div>
						</div>
						<div class="col-md-1">
							
						 </div>
						
						  
				</div>
			
		

			<div class="row">
					
			<div class="col-md-1">
			</div>
				<div class="col-md-5">
				
				
								<div class="form-group">
								    <label for="searchText">Palavra, frase ou valor</label>
									<?php echo $campoSearchText; ?> 
								</div>
								
						
						
					 
				</div>
				<div class="col-md-5">
				
				
								<div class="form-group">
								    <label for="searchNumber">Número do documento</label>
								    
								    <?php echo $campoSearchNumber; ?> 
								</div>
				
						

				</div>
				<div class="col-md-1">
			</div>


					
			
			
			
			</div>
	
<!-- 
			<div class="row" style="padding: 10px;">
				<div class="col-md-6 col-md-offset-3">
					<?php echo $link_search_cancel; ?> 
				</div>

			</div>
			 -->

							
			</div>
			
			<div class="modal-footer" style="padding-top: 3px; text-align: center;">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					<button type="submit" class="btn btn-success" id="btnPesquisar">Pesquisar <i class="fa fa-search fa-lg fa-flip-horizontal" style="color: #FFF;"></i></button>
					 
		    </div>
		
		</form>
    </div>
  </div>
</div>

<script>

$( document ).ready( function() {

	 $('[data-toggle="popover"]').popover()
	
	$("#totalRegistros").popover();

	$('#totalRegistros').click(function () {
	     $('#modalConfig').modal('show');  
	     $('[data-toggle=popover]').popover('hide'); //EDIT: added this line to hide popover on button click.
	});

	
	$("#btnPopoverPeriodo").popover();

	$('#btnPopoverPeriodo').click(function () {
	     $('#modalConfig').modal('show');  
	     $('[data-toggle=popover]').popover('hide');
	});


	$("#btnPopoverPesquisa").popover();

	$('#btnPopoverPesquisa').click(function () {
	     $('#modalPesquisa').modal('show');  
	     $('[data-toggle=popover]').popover('hide');
	});


	$("#btnPopoverSetor").popover();

	$('#btnPopoverSetor').click(function () {
	     $('#modalSetor').modal('show');  
	     $('[data-toggle=popover]').popover('hide');
	});
	
	

	$('#bntModalPesquisaPeriodo').click(function () {
		 $("#modalConfig").modal('show');
		 $("#modalPesquisa").modal('hide');
	});

	$('#bntModalPesquisaSetor').click(function () {
		 $("#modalSetor").modal('show');
		 $("#modalPesquisa").modal('hide');
	});

	$('#setores').change(function () {
		 $("#modal_loading").modal('show');
		 $("#modalSetor").modal('hide');
	});


	$('#btnSalvarPeriodo').click(function () {
		$("#modalConfig").modal('hide');
		$("#modal_loading").modal('show');
	});

	$('#btnPesquisar').click(function () {
		$("#modalPesquisa").modal('hide');
		$("#modal_loading").modal('show');
	});
	
	
// 	$("input[id='radioPesquisa']").change(function(){
		
// 		var tipoPesquisa = $(this).val();
	
// 		if(tipoPesquisa == "texto"){
	
// 			$("#search").prop('disabled', false);
	
// 			$("#searchNumero").prop('disabled', true);
	
// 		}
	
// 		if(tipoPesquisa == "numero"){
	
// 			$("#search").prop('disabled', true);
			
// 			$("#searchNumero").prop('disabled', false);
	
// 		}
	
// 	});

	jQuery('#searchNumero').keyup(function () { 
		if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
		       this.value = this.value.replace(/[^0-9\.]/g, '');
		    }
	});
	
	$.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
	$( "#campoDataInicial" ).datepicker({
		beforeShow: function() {
	        setTimeout(function(){
	            $('.ui-datepicker').css('z-index', 99999999999999);
	        }, 0);
	    }
	});
	
	$( "#campoDataFinal" ).datepicker({
		beforeShow: function() {
	        setTimeout(function(){
	            $('.ui-datepicker').css('z-index', 99999999999999);
	        }, 0);
	    }
	});


	$.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
	$( "#campoDataInicialPesquisa" ).datepicker({
		beforeShow: function() {
	        setTimeout(function(){
	            $('.ui-datepicker').css('z-index', 99999999999999);
	        }, 0);
	    }
	});

	$.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
	$( "#campoDataFinalPesquisa" ).datepicker({
		beforeShow: function() {
	        setTimeout(function(){
	            $('.ui-datepicker').css('z-index', 99999999999999);
	        }, 0);
	    }
	});


	$("#search").focus(function(){
	    $("#searchNumero").val("");
	}); 

	$("#searchNumero").focus(function(){
	    $("#search").val("");
	}); 


//         $.wait = function( callback, seconds){
//         	   return window.setTimeout( callback, seconds * 1000 );
//         	}
        
//         $.wait( function(){ $("#modal_loading").modal('hide') }, 1.5);
});

</script>

	
	<?php 
	//echo $_SESSION['workflow_wait'];
	if(!isset($_SESSION['workflow_wait'])){
		$_SESSION['workflow_wait'] = '';
	}

	
	if($workflow > 0 and $_SESSION['workflow_wait'] == null){
	?>
	<!-- dialogSetor -->
	<div id="dialogAlerta" style="display:none;">

	<form class="form-horizontal" role="form" id="frm_tramitacao" name="frm_tramitacao" method="post">
	
		<div class="panel panel-warning" style="height: 240px; margin-bottom: 0px">
		
				  <div class="panel-heading">
				  
					    <div class="row">
					    <div class="col-md-2 text-right">
					    	
					    </div>
					    <div class="col-md-8" style="font-size: 14pt;">
					    	<strong>Atenção!</strong>
					    </div>
					    <div class="col-md-2 text-right">
					    	<a href="#" id="alerta_bt_cancelar" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a>
					    </div>
					    </div>
	
				  </div>
				  
				  <div class="panel-body" style="padding-top: 5px;">
				  
					<h4>Existem documentos aguardando recebimento!</h4>
					
					<p>Clique em uma das opções abaixo:</p>
					
					<div class="row">
						<div class="col-md-12">
							<a href="<?php echo site_url();?>/workflow/suspender_aviso" id="btn_workflow_wait" class="btn btn-primary"><span class="glyphicon glyphicon-time"></span> Suspender este aviso</a>
							<a href="<?php echo site_url();?>/workflow" id="btn_workflows" class="btn btn-danger"><span class="glyphicon glyphicon-inbox"></span> Verificar entrada</a>
						</div>
					</div>
					
					<div class="row" style="vertical-align: bottom; padding-top: 40px; color: #AAA; font-size: 10pt;">
						<div class="col-md-12 text-right">
							Desenvolvido por Tarso de Castro <br>
							<a href="https://github.com/tarsodecastro" target="_blank">https://github.com/tarsodecastro</a>
						</div>
					</div>
				</div>  
		</div>
		
	</form>
	
	</div>
	<!-- fim dialogSetor -->

	<script type="text/javascript">
// 		$.blockUI({ 
//       	 message: $('#dialogAlerta'),
//       	 overlayCSS: { backgroundColor: '#000', opacity: 0.8, cursor: 'default'},
//       	 css: { 
//                top: '150px',
//                left: ($(window).width() - 800) /2 + 'px', 
//                width: '800px',
//                cursor: 'default' 
//            } 
       
//        }); 
//        $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 

//        $('#alerta_bt_cancelar').click(function() { 
//     	   $.blockUI({ message: '<h1>Aguarde...</h1>' });
//            setTimeout($.unblockUI); 
//        });

//        $('#alerta_bt_cancelar').click(function() { 
//     	   $.blockUI({ message: '<h1>Aguarde...</h1>' });
//            setTimeout($.unblockUI); 
//        });

//        $('#btn_workflow_wait').click(function() { 
//     	   $.blockUI({ message: '<h1>Aguarde...</h1>' });
//        });

//        $('#btn_workflows').click(function() { 
//     	   $.blockUI({ message: '<h1>Aguarde...</h1>' });
//        });
	</script>
	<?php }?>
	

	<?php 

		if(count($alerta) > 0){
	
	?>


<!-- Modal Alerta -->
<div class="modal fade" id="modalAlerta" tabindex="-1" role="dialog" aria-labelledby="Alerta">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="cus-bell"></i> Alerta agendado para <strong><span class="text-danger"><?php echo $data_alerta; ?></span></strong></h4>
      </div>

			<div class="modal-body" style="padding: 5px;">
				
					<div class="alert alert-danger" role="alert" style="margin-bottom: 5px; padding: 10px;"><strong>Motivo:</strong>  <?php echo $motivo_alerta; ?></div>
					
					<div class="panel panel-default-origin" style="margin-bottom: 2px;">
					  <div class="panel-heading"><h3 class="panel-title">Conteúdo do documento:</h3></div>
					  <div class="panel-body" style="height: 250px; overflow: auto;">

							     <?php echo $alerta_documento_conteudo; ?>

					  </div>
					</div>
							
			</div>
			
			 <div class="modal-footer" style="padding-top: 3px; text-align: center;">
		      		
		      		<div class="row">
		      			<div class="text-center">
		      				<h4 style="margin-top:5px; margin-bottom:5px; " class="text-danger" id="perguntaAlerta">Qual das <strong>ações abaixo</strong> deseja executar? </h4>
		      			</div>
		      		</div>
		      	
		      		<form  id="alertaForm" role="form" action="<?php echo $form_action_alerta_update;?>" method="post">
		      	
		      		<div class="row">	
		      		
		      			
		      				<div class="col-md-1"></div>
		      				<div class="col-md-5 alert" style="margin-right: 5px; margin-bottom: 10px;" id="alertaPainelAcaoNovo">
		      				
		      						<div class="row">	
		      						
		      							<p>
							            	<button type="button" id="alerta_acao_novo" class="btn btn-warning btn-sm"><strong><i class="fa fa-bell fa-lg"></i> Alertar novamente</strong></button>
							            </p>
							            	
		      							<div class="col-md-6">
				      						<div class="form-group">
									           	<div class="input-group" id="grupoData">
										           	<span class="input-group-addon" id="basic-addon1">Data</span>
										           	<input type="text" name="campoDataAlerta" id="campoDataAlerta" value="<?php echo $data_alerta_banco;?>" maxlength="10" size="12" class="form-control" placeholder="" style="width: 100px; margin: 0 auto;">
												</div>
									        </div>
								        </div>
								        
								        <div class="col-md-6">
				      						<div class="form-group">
									           	<div class="input-group" id="grupoHora">
										           	<span class="input-group-addon" id="basic-addon1">Hora</span>
										           	<input type="text" name="campoHoraAlerta" id="campoHoraAlerta" value="" maxlength="5" size="10" class="form-control" placeholder="" style="width: 100px; margin: 0 auto;">
												</div>
									        </div>
								        </div>
								        
							 		</div>
							 		
							 		
							 		<div class="row">	
							 		
							 			<div class="col-md-12" id="grupoMotivo">
								           	<textarea class="form-control" rows="2" name="campoMotivoAlerta" id="campoMotivoAlerta" placeholder="Descreva aqui o motivo do novo alerta"></textarea>
							           	</div>
							 		
							 		</div>
		      				</div>

		      				<div class="col-md-5 alert" style="margin-left: 5px; margin-bottom: 10px;" id="alertaPainelAcaoConluir">
		      						
			      					<div class="form-group" id="grupoConclusao">
			      						
							            <label for="campoConclusaoAlerta" class="control-label">
							            	<button type="button" id="alerta_acao_concluir" class="btn btn-primary btn-sm"><i class="fa fa-bell-slash fa-lg"></i> Encerrar o alerta</button>
							            </label>
							           	<textarea class="form-control" rows="3" name="campoConclusaoAlerta" id="campoConclusaoAlerta" placeholder="Descreva aqui o motivo da conclusão do alerta"></textarea>
						      		</div>

		      				</div>
		      				<div class="col-md-1"></div>
		      				
				      	
			        </div>
			        
			        
			        <div class="row">	
			        <button type="submit" class="btn btn-success" id="btn_salvar">Salvar ação <span class="glyphicon glyphicon glyphicon-ok"></span></button>
			        </div>
			        
			        </form>

		      </div>
		
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>js/documento_list_alerta.js"></script>
<?php }?>