<div class="areaimage">
	<center>
		<img src="{TPL_images}harddisk-icon.png" />
	</center>
</div>

<p class="bg-success lead text-center">
	<?php echo $titulo;?>
</p>

<div id="view_content">

	<div class="col-md-1"></div>
	<div class="col-md-10">
	
			<div class="row">
				<div class="col-md-6">
					
					<?php  
					
						$progress_bar_class = "progress-bar";
						
						if($porcentagem_ocupada < 25){
							$progress_bar_class = "progress-bar progress-bar-success";
						}
						
						if($porcentagem_ocupada > 75 and $porcentagem_ocupada < 90){
							$progress_bar_class = "progress-bar progress-bar-warning";
						}
						
						if($porcentagem_ocupada > 90){
							$progress_bar_class = "progress-bar progress-bar-danger";
						}

					?>
					
					<div class="progress">
						  <div class="<?php echo $progress_bar_class;?>" role="progressbar" aria-valuenow="<?php echo $porcentagem_ocupada;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentagem_ocupada;?>%;">
						    <?php echo $porcentagem_ocupada;?>%
						  </div>
						</div>
					
				</div>
				
				<div class="col-md-6">
			
					Cota total: <?php echo $cota;?>, utilizada: <?php echo $cota_usada;?>, restante: <?php echo $cota_restante;?>
				
						
		
				</div>
			</div>
			
			

			<?php 

			if($erro){
				echo'<div class="alert alert-danger text-center" role="alert">'.$erro['erro'].'</div>';
			}
			
			?>
			
			<form action="<?php echo site_url()."/repositorio"?>" class="form-inline" method="post" accept-charset="utf-8" enctype="multipart/form-data">			
			
			
			<div class="form-group">
			
			<label for="userfile">Adicionar arquivo</label>
			<input type="file" name="userfile" id="userfile" size="20" class="form-control" />
	
			</div>
			
			<button type="submit" class="btn btn-success">Enviar</button>
			
			</form>
			
	
		
		<div class="table-responsive">
				<?php echo $table;?>
		</div>

	</div>
	<div class="col-md-1"></div>
	
	
	<div class="modal fade" id="modalImagem" tabindex="-1" role="dialog" aria-labelledby="modalImagem" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
		        <h4 class="modal-title" id="exampleModalLabel">
		        Preview
		        </h4>
		      </div>
		      <div class="modal-body text-center">
		        <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>

<script>
$("#pop").on("click", function() {
	   $('#imagepreview').attr('src', $('#pop').attr('data-img-url')); // here asign the image to the modal when the user click the enlarge link
	   $('#modalImagem').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
	});
</script>
