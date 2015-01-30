<div class="areaimage">
	<center>
		<img src="{TPL_images}rescuers-icon.png" />
	</center>
</div>

<p class="bg-success lead text-center">Cargo</p>	

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

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

</form> 

</div><!-- fim: div view_content --> 
