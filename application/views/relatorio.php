<div class="titulo1">
	<?php echo $titulo; ?>
</div> 

<div id="msg" style="display:none;">
	<img src="{TPL_images}loader.gif" class="img_aling2" alt="Carregando" />Aguarde carregando...
</div>

<div id="view_content">

	<div id="conteiner_subMenu">				
		<form id="frmMes" name="frmMes" action="<?php echo $form_action; ?>">
			<span class="subTitulo5" >
				 Mostrando atendimentos de 
				<?php echo form_dropdown('selAno', $anosDisponiveis, $anoSelecionado, 'id="selAno" class="select"'); ?>
				/
				<?php echo form_dropdown('selMes', $mesesDisponiveis, $mesSelecionado, 'id="selMes" class="select"'); ?>
				<br /> <br />
				Total de atendimentos no período: <b> <?php echo $total_mes; ?> </b>
			</span>	
					
		</form>					
	</div>
	<br><br>

	
	
	
	<div class="conteiner_tabela2" style="width:600px">
		<span class="titulo3">Atendimentos por Setor:</span>  
		<?php echo $tabela1; ?>
	</div> 
	<br><br>
		
	<div class="conteiner_tabela2" style="width:600px">
		<span class="titulo3">Serviços prestados:</span>  
		<?php echo $tabela2; ?>
	</div> 
	<br><br>
		
	<div class="conteiner_tabela2" style="width:600px">
		<span class="titulo3">Manutenções de equipamentos:</span> 
		<?php echo $tabela3; ?>
	</div> 
	<br><br>
		
	<div class="conteiner_tabela2" style="width:600px">
		<span class="titulo3">Equipamentos tombados:</span> 
		<?php echo $tabela4; ?>			
	</div> 
</div>




