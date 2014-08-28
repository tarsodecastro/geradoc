<div class="areaimage">
	<center>
		<img src="{TPL_images}Actions-document-edit-icon.png" height="72px" />
	</center>
</div>

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 


<div id="view_content">	

    <div class="row">
		<div class="col-md-12">
			<p class="bg-success lead text-center">Permissão negada</p>
		</div>
	</div>

	<div class="row">
    
	    <div class="col-md-12">
	    	<div class="btn-group">
		    	<?php echo $link_back; ?>
		  	</div>  
	    </div>

    </div>
	
	<div class="formulario">	
	
		<img src="{TPL_images}Button-warning-icon.png"/>
		<br>   
		<br>
       	<h2><?php echo $message;?></h2>
       	<br> 
       	<br> 

	    <input type="button" class="btn btn-success" value="&nbsp; OK &nbsp;" title=" OK " onclick="javascript:window.location ='<?php echo $bt_ok; ?>'" /><br><br>
				
    </div>
 

</div><!-- fim: div view_content --> 
