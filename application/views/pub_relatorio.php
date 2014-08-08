<div class="titulo1">
	<?php echo $titulo; ?>
</div> 

<div id="msg" style="display:none;">
	<img src="{TPL_images}loader.gif" class="img_aling2" alt="Carregando" />Aguarde carregando...
</div>

<div id="view_content">

	<div id="conteiner_subMenu">	
	<span class="subTitulo5" ><b>Atendimentos registrados nesse sistema: <span style="color:red; font-size:15px; font-weight: bold"><?php echo $total; ?></span></b> </span><br><br>			
		<form id="frmMes" name="frmMes" action="<?php echo site_url('/atendimento/relatorio/'); ?>">
			<span class="subTitulo5" >
				<b>Período:</b> 
				<?php echo form_dropdown('pub_selMes', $mesesDisponiveis, $mesSelecionado, 'id="pub_selMes" class="select"'); ?> de 
				<?php echo form_dropdown('pub_selAno', $anosDisponiveis, $anoSelecionado, 'id="pub_selAno" class="select"'); ?>
			</span>	
				<br /> <br /> 
			<span class="subTitulo5" >
				<b> Atendimentos no período: </b><b> 	<span style="color:red; font-size:19px; font-weight: bold"> <?php echo $total_mes; ?> </span>
			</span>	
		
		</form>					
	</div>	

	<br>
	  
	<div class="conteiner_tabela2" style="width:600px">
		<span class="titulo3">Setores atendidos em <span style="color:red; font-size:15px; font-weight: bold"><?php echo $mes ?></span> de <?php echo $anoSelecionado; ?>:</span>
		<br><br>  
		<?php echo $tabela1; ?>
	</div> 

	<br><br>

	<div id="container" style="min-width: 400px; margin: 0 auto"></div>
<!--
	<div class="conteiner_tabela2" style="width:600px">
		<span class="titulo3">* Quantidade de serviços prestados por setor em <?php echo $mes ?> de <?php echo $anoSelecionado; ?>:</span><br>
		<span style="font-size:13px"></span>
		<?php echo $tabela2; ?>
	</div> 

	<br><br>
		
	<div class="conteiner_tabela2" style="width:600px">
		<span class="titulo3">** Quantidade de manutenções de equipamentos por setor em <?php echo $mes ?> de <?php echo $anoSelecionado; ?>:</span> <br>
		<span style="font-size:13px"></span>
		<?php echo $tabela3; ?>
	</div> 
-->
		<!--
	<div class="conteiner_tabela2">
		<span class="titulo3">Manutenções de equipamentos TOMBADOS:</span> 
		<?php echo $tabela4; ?>			
	</div> 
	-->
	<!--
	<br><br>

	<p>
	* Referente a desenvolvimento de sistemas, gerenciamento de servidores, elaboração de projetos, arquitetura de redes, conexões, <br> &nbsp;&nbsp; controle de acessos, instalação de aplicativos, operação de sistemas, gestão de impressoras e suporte técnico.
	</p>
	<br>
	<p>
	** Referente a formatações, instalações de sistemas operacionais, backups, recuperações de arquivos e substituições de peças.
	</p>
-->
	<br>
</div>

<a class="link1" href="http://sistemas.aesp.ce.gov.br" title="Voltar"> &raquo; Intranet - AESP </a>




