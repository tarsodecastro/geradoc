<div class="areaimage">
	<center>
		<img src="{TPL_images}archive-icon.png" style="height: 65px;"/>
	</center>
</div>

<p class="bg-success lead text-center">
	<?php echo $titulo;?>
</p>

<div id="view_content">

	
	
	<div class="col-md-1"></div>
	<div class="col-md-10">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 alert alert-warning text-justify" role="alert"><strong>Atenção!</strong><br> 
																	O <strong>repositório</strong> é um espaço virtual de armazenamento de arquivos do seu setor. <br>
																	Este espaço é compartilhado com os demais usuários do setor e é destinado ao armazenamento de arquivos essencias para o trabalho.
																	Os arquivos aqui armazenados podem ser referenciados nos documentos criados, com o objetivo de evitar o excesso de impressões.
				</div>
				<div class="col-md-2"></div>
			</div>
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
			
			if(validation_errors() != ''){
				echo '<div class="form-group">';
				echo form_error('campoNome');
				echo form_error('campoDescricao');
				echo '</div>';
			}
			
			?>
			
			<a href="#modalFileUpload" id="fale" data-toggle="modal" class="btn btn-success" ><i class="fa fa-cloud-upload fa-lg"></i> Enviar arquivo</a>
			
			<a href="#modalFolder" id="fale" data-toggle="modal" class="btn btn-default" ><i class="fa fa-folder-open fa-lg"></i> Criar pasta</a>
			
			
		
		
		<div class="table-responsive">
				<?php echo $breadcrumb;?>
				<?php echo $table;?>
		</div>

	</div>
	<div class="col-md-1"></div>
	

	<div class="modal fade" id="modalFileUpload" tabindex="-1" role="dialog" aria-labelledby="modalFileUpload" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">Adicionar arquivo</h4>
			      </div>
			      
			      <form role="form" action="<?php echo $form_action;?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			      <div class="modal-body">
			      <p class="text-muted text-justify"> Utilize o formulário abaixo para enviar o arquivo.</p>
			      
			      
			      	 <div class="form-group <?php echo (form_error('campoNome') != '')? 'has-error':''; ?>">
					    <label for="campoNome" class="control-label"><span style="color: red;">*</span> Nome</label>
					      	<?php echo form_input($campoNome); ?> 
					  </div>
					  
					  <div class="form-group <?php echo (form_error('campoDescricao') != '')? 'has-error':''; ?>">
					    <label for="campoDescricao" class="control-label"><span style="color: red;">*</span> Descrição</label>
					    	<?php echo form_textarea($campoDescricao); ?>
					  </div>
					  
					  <div class="form-group">
					    <label for="campoArquivo" class="control-label"><span style="color: red;">*</span> Arquivo</label>
					    	<input type="file" name="userfile" id="userfile" size="20" class="form-control" />
					  </div>
			      		
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			        <button type="submit" class="btn btn-primary">Enviar</button>
			        
			      </div>
			      
			      </form>

		    </div>
		  </div>
	</div>
	
	<div class="modal fade" id="modalFolder" tabindex="-1" role="dialog" aria-labelledby="modalFolder" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">Adicionar pasta</h4>
			      </div>
			      
			      <form role="form" action="<?php echo $form_action_folder;?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			      <div class="modal-body">
			      <p class="text-muted text-justify"> Utilize o formulário abaixo para criar uma pasta.</p>
			      
			      
			      	 <div class="form-group <?php echo (form_error('campoNome') != '')? 'has-error':''; ?>">
					    <label for="campoNome" class="control-label"><span style="color: red;">*</span> Nome da nova pasta</label>
					      	<?php echo form_input($campoNome); ?> 
					  </div>
					  
					  <div class="form-group <?php echo (form_error('campoDescricao') != '')? 'has-error':''; ?>">
					    <label for="campoDescricao" class="control-label"><span style="color: red;">*</span> Descrição</label>
					    	<?php echo form_textarea($campoDescricao); ?>
					  </div>

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			        <button type="submit" class="btn btn-primary">Enviar</button>
			        
			      </div>
			      
			      </form>

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
