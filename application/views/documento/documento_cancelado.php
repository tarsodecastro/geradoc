<div class="areaimage">
	<center>
		<img src="{TPL_images}Actions-document-edit-icon.png" height="72px" />
	</center>
</div>

<div id="titulo" class="titulo1"> 
    <?php echo $titulo; ?>
</div>		

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

    <?php
    echo $link_back;
    echo $message;
    ?>
	
	<div class="formulario">	
	
		<img src="{TPL_images}alert-icon.png"/>
		<br>   
		<br>
       	<h2>DOCUMENTO CANCELADO</h2>
       	<br> 
       	<br> 

	    <input type="button" class="button" value="&nbsp; OK &nbsp;" title=" OK " onclick="javascript:window.location ='<?php echo $bt_ok; ?>'" /><br><br>
				
    </div>
 

</div><!-- fim: div view_content --> 
