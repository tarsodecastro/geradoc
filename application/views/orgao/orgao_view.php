<div class="areaimage" >
	<center>
		<img src="{TPL_images}companies-icon_2.png" height="72px"/>
	</cente>
</div>

<script type="text/javascript"> 
    $(document).ready(function(){		
        window.document.body.oncopy  = function() { return false; };
        window.document.body.onpaste = function() { return false; }
    });
</script> 		

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<p class="bg-success lead text-center">Órgão</p>

<div id="view_content">	

    <?php
    echo $link_back;
    echo $message;
    ?>
	
	<div class="formulario">	
	
		<div class="panel panel-default">
			
			<div class="panel-heading">
				<h3 class="panel-title">
					<?php echo $titulo; ?>
				</h3>
			</div>
			<div class="panel-body">
				
				<form class="form-horizontal" role="form" id="frm1" name="frm1"  method="post">
					<fieldset disabled>
					
							  <div class="form-group">
							    <label for="campoNome" class="col-sm-3 control-label">Nome</label>
							    <div class="col-md-7">
							    <input type="text" class="form-control" name="campoNome" id="campoNome"  value="<?php echo $objeto->nome; ?>" > 	
							     </div>
							  </div>
							  
							  <div class="form-group">
							    <label for="campoSigla" class="col-sm-3 control-label">Sigla</label>
							    <div class="col-md-7">
							    <input type="text" class="form-control" name="campoSigla" id="campoSigla"  value="<?php echo $objeto->sigla; ?>" >
							    </div>
							  </div>
							  
							  
							  <div class="form-group">
							    <label for="campoEndereco" class="col-sm-3 control-label">Endereço</label>
							    <div class="col-md-7">
							    	<textarea class="form-control" name="campoEndereco" id="campoEndereco"><?php echo $objeto->endereco; ?></textarea>
							    </div>
							  </div>
					</fieldset>
				</form>
	 
			</div>
			<!-- fim: div panel-body --> 
		</div>
		<!-- fim: div panel panel-default --> 
	
	   	<div class="btn-group">
	   		<?php
		    	echo $link_cancelar;
		    	echo $link_alterar;
		    ?>
		</div>
				
    </div>
    <!-- fim: div formulario --> 


</div><!-- fim: div view_content --> 
