<div class="titulo1">	 			
	<?php echo $titulo; ?>
</div>

<div class="areaimage">
	<center>
		<img src="{TPL_images}secrecy-icon.png" height="72px"/>
	</center>
</div>
<?php echo $mensagem; ?>
			
<div class="formulario">		
	<form id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
	
	<fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Identificação</legend> 
	        
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class=gray style="width: 150px;"><span class="text-red">*</span> CPF: </td>
			        	<td class="green">
			        	<input class="textbox" value="<?php echo set_value('txtCPF')?>"  name="txtCPF"  id="txtCPF" size="15" /><?php echo form_error('txtCPF'); ?>
			        	</td>
		        	</tr>
		        	
		        	<!-- 
		        	<tr>
			        	<td class=gray><span class="text-red">*</span> E-mail: </td>
			        	<td class="green">
			        	<input class="textbox" value="<?php echo set_value('txtEmail')?>"  name="txtEmail"  id="txtEmail" size="35" /><?php echo form_error('txtEmail'); ?>
			        	</td>
		        	</tr>
		        	
		        	<tr>
			        	<td class=gray><span class="text-red">*</span> Confirme o e-mail: </td>
			        	<td class="green">
			        	<input class="textbox" value="<?php echo set_value('txtConfEmail')?>"  name="txtConfEmail"  id="txtConfEmail" size="35" /><?php echo form_error('txtConfEmail'); ?>
			        	</td>
		        	</tr>
		        	 -->
		        	
	        	</tbody>
	        </table>
	    </fieldset>

		<br>
		
		<input type="button" class="button" value="Voltar" title="Voltar" onclick="javascript:window.history.back();"/> &nbsp; &nbsp;					
		<input type="submit" class="button" value="Enviar" title="Enviar" id="enviar" style="display:true;" />&nbsp;&nbsp;		
		<div id="msg" style="display:none; margin: 0 auto; width: 300px; padding-top: 20px; font-size: 13pt"><img src="{TPL_images}loader.gif" alt="Enviando" /> Aguarde, enviando...</div>
			
	</form>
</div>
