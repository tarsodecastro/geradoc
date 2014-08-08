<div class="titulo1">	 			
	<?php echo $titulo; ?>
</div>

<div class="areaimage">
	<center>
		<img src="{TPL_images}secrecy-icon.png" height="72px"/>
	</center>
</div>
			
<div class="formulario">	

<?php echo "<center>".$mensagem."</center>"; ?>
    
	<form id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
	
	<fieldset class="conteiner2"> 
	    
	        <legend class="subTitulo6">Cadastro</legend> 
	        
	        <table class="table_form">
	        	<tbody>
		        	<tr>
			        	<td class=gray style="width: 170px;"><span class="text-red">*</span> CPF: </td>
			        	<td class="green">
			        	<?php echo form_input($campoCPF) .form_error('campoCPF'); ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class="gray"><span class="text-red">*</span> Nome: </td>
			        	<td class="green">
			        	<?php echo form_textarea($campoNome) .form_error('campoNome'); ?> 
			        	</td>
		        	</tr>
		        	<tr>
			        	<td class=gray><span class="text-red">*</span> E-mail: </td>
			        	<td class="green">
			        	<?php echo form_input($campoMail1) .form_error('campoMail1'); ?> 
			        	</td>
		        	</tr>
		        	
		        	<tr>
			        	<td class=gray><span class="text-red">*</span> Confirmação do e-mail: </td>
			        	<td class="green">
			        	<?php echo form_input($campoMail2) .form_error('campoMail2'); ?> 
			        	</td>
		        	</tr>
	        	</tbody>
	        </table>
	    </fieldset>

		<br>
		
		<input type="button" class="button" value="Voltar" title="Voltar" onclick="javascript:window.history.back();"/> &nbsp; &nbsp;					
		<input type="submit" class="button" value="Salvar" title="Salvar"/>&nbsp;&nbsp;		
			
	</form>
</div>
