<div class="areaimage">
	<center>
		<img src="{TPL_images}statistics_64.png" />
	</center>
</div>

<div id="titulo" class="titulo1"> 
    <?php echo $titulo; ?>
</div>		

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

    <?php
    echo $message;
    echo form_open($form_action);
    ?>
	
	<div class="formulario">	
	
	    <fieldset id="filtros">
		<legend class="subTitulo1">Filtros</legend>
		<table cellpadding="3px">
			<tr valign="top">
				<td><label><span class="titulo3">Tipo de documento:</span> </label><br> <?php echo form_dropdown( 'campoTipo', $tipos, $tipoSelecionado, 'id=campoTipo size=5'); ?>
				</td>
				<td><label><span class="titulo3">Data inicial:</span> </label><br> <?php echo form_input($campoDataIni); ?> <br><br>
				
					<label><span class="titulo3">Data final:</span> </label><br> <?php echo form_input($campoDataFim); ?>
				</td>
				<td valign="middle">
					<input type="submit" class="button" value="Consultar" title="Consultar" />
				</td>
			</tr>
		</table>
	</fieldset>
	 <img src="<?php echo base_url().$graph; ?>" />  <br>
	<img src="<?php echo base_url().$grafico1; ?>" /> <br>
	<br><br>
				
    </div>
    <br><br>

</form> 

</div><!-- fim: div view_content --> 
