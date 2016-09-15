<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-select.min.css">

<div class="areaimage">
	<center>
		<img src="{TPL_images}cabinet-icon.png" height="72px" />
	</cente>
</div>

<p class="bg-success lead text-center"><?php echo $titulo;?></p>

<div id="msg" style="display: none;">
	<img src="{TPL_images}loader.gif" class="img_aling2" alt="Carregando" />Aguarde
	carregando...
</div>

	<div class="row">

		<div class="col-md-4">
			<?php echo $link_add;?>
			<a href="<?php echo site_url();?>/workflow" class="btn btn-danger"><span class="glyphicon glyphicon-inbox"></span> Entrada <span class="badge"><?php echo $workflow;?></span></a>
			<a href="<?php echo site_url();?>/repositorio" class="btn btn-warning"><i class="fa fa-archive"></i> Repositório <span class="badge"></span></a>
		</div>

		<div class="col-sm-12 visible-xs" style="padding: 5px;"></div>
		
		<div class="col-md-4">
			
				
				<?php if (isset($setorCaminho)){?>
				<div class="input-group">
					<span class="input-group-btn">
			        <a href="#" class="btn btn-info" disabled> Setor</a>
			      </span>
					<input type="text" class="form-control" value="<?php echo $setorCaminho?>" readonly>
			      <span class="input-group-btn">
			        <a href="#" id="setorSelect" class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span> Mudar</a>
			      </span>
			    </div>
			    <?php }?>
				
				
			
			<!-- /input-group -->
		</div>

		<div class="col-sm-12 visible-xs" style="padding: 5px;"></div>
		
		<div class="col-md-4" style="text-align: right;">


			<form class="form-inline" id="frm_search" name="frm_search"
				action="<?php  echo $form_action; ?>" method="post">


				<div class="input-group">
					<input type="text" class="form-control" id="search" name="search"
						placeholder="pesquisa textual"
						value="<?php echo $keyword_documento; ?>"> <span
						class="input-group-btn">
						<button class="btn btn-success" type="submit">Pesquisar</button> <?php echo $link_search_cancel; ?>
					</span>
				</div>


			</form>
		</div>
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
				<p>Total de registros:
				<span class="label label-default">&nbsp; <?php echo $total_rows; ?> &nbsp;</span>
				</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="dataTables_paginate paging_simple_numbers">
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
	<!-- Fim da paginacao -->
	
	
	<!-- dialogSetor -->
	<div id="dialogSetor" style="display:none;">

	<form class="form-horizontal" role="form" id="frm1" name="frm1" method="post">
	
		<div class="panel panel-primary" style="height: 210px; margin-bottom: 0px">
		
				  <div class="panel-heading">
				  
					    <div class="row">
					     <div class="col-md-2">
					     </div>
					    <div class="col-md-8">
					    	<h2 class="panel-title"><strong>Selecione um setor</strong></h2>
					    </div>
					    <div class="col-md-2 text-right">
					    	<a href="#" id="setor_bt_cancelar" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a>
					    </div>
					    </div>
	
				  </div>
				  
				  <div class="panel-body" style="padding-top: 30px;">
					<div class="form-group">
						<label for="campoNome" class="col-md-1 control-label">Setor</label>
						<div class="col-md-11">
						<?php
			
							$options = array();
								
							if(isset($setores)){
			
								$var = site_url('documento/index');
			
								$js = 'class="form-control selectpicker" data-style="btn-info" data-live-search="true" id="setores" onChange="window.location.href=(\''.$var.'/s\'+ document.getElementById(\'setores\').value)"';//\''.site_url('documento/index').'"';//.'\' + document.form.setores.value)"';
			
							
								echo form_dropdown('setores', $setoresDisponiveis, $setorSelecionado, $js);
							
							}
							?>
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
		$.blockUI({ 
      	 message: $('#dialogAlerta'),
      	 overlayCSS: { backgroundColor: '#000', opacity: 0.8, cursor: 'default'},
      	 css: { 
               top: '150px',
               left: ($(window).width() - 800) /2 + 'px', 
               width: '800px',
               cursor: 'default' 
           } 
       
       }); 
       $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 

       $('#alerta_bt_cancelar').click(function() { 
    	   $.blockUI({ message: '<h1>Aguarde...</h1>' });
           setTimeout($.unblockUI); 
       });

       $('#alerta_bt_cancelar').click(function() { 
    	   $.blockUI({ message: '<h1>Aguarde...</h1>' });
           setTimeout($.unblockUI); 
       });

       $('#btn_workflow_wait').click(function() { 
    	   $.blockUI({ message: '<h1>Aguarde...</h1>' });
       });

       $('#btn_workflows').click(function() { 
    	   $.blockUI({ message: '<h1>Aguarde...</h1>' });
       });
	</script>
	<?php }?>