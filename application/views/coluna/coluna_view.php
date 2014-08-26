<div class="areaimage">
	<center>
		<img src="{TPL_images}rescuers-icon.png" />
	</center>
</div>

<script type="text/javascript"> 
    $(document).ready(function(){		
        window.document.body.oncopy  = function() { return false; };
        window.document.body.onpaste = function() { return false; }
    });
</script> 

<p class="bg-success lead text-center">Campo</p>	

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 


<div id="view_content">	

    <?php
    echo $link_back;
    echo $mensagem;
    ?>
	
	<div class="formulario">	
	
	<form class="form-horizontal" role="form" id="frm1" name="frm1" method="post">
	<fieldset disabled>
			
		<div class="panel panel-default">
	
			  <div class="panel-heading">
			    <h3 class="panel-title"><?php echo $titulo; ?></h3>
			  </div>
			  	  
			  <div class="panel-body">
			  	
					  <div class="form-group">
					    <label for="campoNome" class="col-sm-5 control-label">Nome</label>
					    <div class="col-md-3">
					     <input type="text" class="form-control" name="campoNome" id="campoNome"  value="<?php echo $objeto['nome']; ?>" > 
					     </div>
					  </div>
					   
					  <div class="form-group">
					    <label for="campoTamanho" class="col-sm-5 control-label">Tamanho</label>
					    <div class="col-md-3">
					    	<div class="input-group">
					   	 	 <input type="text" class="form-control" name="campoNome" id="campoNome"  value="<?php echo $tamanho_atual; ?>">
					   	 	 <span class="input-group-addon">caracteres</span>
					   	 	 </div>
					    </div>
					  </div>
					  
					  <div class="form-group">
					    <label for="campoTamanho" class="col-sm-5 control-label">Tipo</label>
					    <div class="col-md-3">
					   	 	 <input type="text" class="form-control" name="campoNome" id="campoNome"  value="<?php echo $objeto['tipo']; ?>" > 
					    </div>
					  </div>

			  </div>
			  <!-- fim da div panel-body -->
			  
		</div>
		<!-- fim da div panel -->	
		
		
		
		</fieldset>
		
		<div class="btn-group">
		   		<?php
		    	echo $link_cancelar;
		    	echo $link_alterar;
		    ?>
		</div>
	
	</form>
						
    	
    </div>

</form> 

</div><!-- fim: div view_content -->