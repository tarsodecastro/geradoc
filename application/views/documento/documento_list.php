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


		<div class="col-md-2">
			<?php echo $link_add;?>
		</div>

		<div class="col-sm-12 visible-xs" style="padding: 5px;"></div>

		<div class="col-md-6">
			<form class="form-inline">
				<?php

				$options = array();
					
				if(isset($setores)){

					$var = site_url('documento/index');

					$js = 'id="setores" onChange="window.location.href=(\''.$var.'/s\'+ document.getElementById(\'setores\').value)"';//\''.site_url('documento/index').'"';//.'\' + document.form.setores.value)"';

					echo '<div class="input-group">';
					echo '<div class="input-group-addon">Setor</div>';
					echo form_dropdown('setores', $setoresDisponiveis, $setorSelecionado, 'class="form-control"' . $js);
					echo '</div>';
				}
				?>
			</form>
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
		<div class="col-md-4">
			<div class="dataTables_info" role="status">
				<p>Total de registros:
				<span class="label label-default">&nbsp; <?php echo $total_rows; ?> &nbsp;</span>
				</p>
			</div>
		</div>
		<div class="col-md-2">
		</div>
		<div class="col-md-6">
			<div class="dataTables_paginate paging_simple_numbers">
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
	<!-- Fium da paginacao -->