<link rel="stylesheet" href="<?php echo base_url(); ?>css/pdf.css">

<div class="areaimage">
	<center>
		<img src="{TPL_images}Actions-document-edit-icon.png" height="72px" />
	</center>
</div>

<p class="bg-success lead text-center">Documento</p>

<div id="msg" style="display: none;">
	<img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde
	carregando...
</div>

<div id="view_content">

	<div class="row">
    
	    <div class="col-md-12 text-center">
	    	<div class="btn-group">
		    <?php
			    echo $link_back;
			    echo $link_export_sm;
			    echo $link_update_sm;
			    echo $link_history;
			    echo $link_workflow;
			    
			    if ($carimbos == 'yes'){
		    ?>
		    <div class="btn-group">
			  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <i class="cus-stamp_in"></i> Carimbo <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" role="menu">
			    <li><?php echo $carimbo_pagina;?></li>
			    <li><?php echo $carimbo_via;?></li>
			    <li><?php echo $carimbo_confidencial;?></li>
			    <li><?php echo $carimbo_urgente;?></li>
			  </ul>
			</div> 
			<?php }?>
			<button type="button" class="btn btn-default btn-sm" id="btnComentarios"><i class="cus-comments"></i> Comentários</button>
			
		  	</div> 
		  	
	    </div>

    </div>
    
	<div class="formulario">

	<?php 
	
	if($comentarios != ''){
		
		$display_comentarios = 'yes';
		
	}else{
		
		$display_comentarios = 'none';
		
	}
	
	?>
	<div class="row" style="display: <?php echo $display_comentarios;?>;" id="painelComentarios">
			
			
		 <form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo site_url('comentario/add/' . $objeto->id); ?>" method="post">
		 
		<div class="panel panel-info">
		  <div class="panel-heading text-center"><i class="cus-comments"></i> <strong>Comentários</strong></div>
		  
		  
		  <div class="panel-body" style="padding-bottom: 10px;">
		  
			  <div style="overflow-y: auto; height: 125px; line-height: 90%;" class="text-justify">
			   <?php echo $comentarios;?>
			  
			  </div>
			  
			  <?php 				    		
		    		if(isset($_SESSION['mensagem']) and $_SESSION['mensagem'] != ''){	
		    					
		    			echo $_SESSION['mensagem'];
		    			
		    			unset($_SESSION['mensagem']);
		    						
		    		}
			  ?>
			  
			  <div class="row" style="padding-top: 10px;">
			  	<div class="col-md-11 text-center">
			  		<textarea class="form-control" name="campoComentario" id="campoComentario" rows="2" style="width: 100%;" maxlength="100"></textarea>
			  	</div>
			  	<div class="help-block text-left small"><span id="caracteresRestantes" class="text-danger"></span></div>
			  </div>
			  
		  </div>
		  
		  <div class="panel-footer">
		  
		  <div class="row">
		  	<div class="col-md-6 text-center">
		  		<button type="button" class="btn btn-default btn-sm" id="btnComentariosClose"><span class="glyphicon glyphicon glyphicon-remove"></span> Fechar</button>
		  	</div>
		  	
		  	<div class="col-md-6 text-center">
		  		<button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon glyphicon-ok"></span> Comentar</button>
		  	</div>
		  
		  </div>
		  
		  </div>
		  
		  
		  
		</div>
		
		  </form>
	</div>
	
	
	<div class="pagina">
	
	
	
	<?php 
	
	$header = '<div style="padding-bottom: 20px;">
				<table width="100%" style="vertical-align: bottom;">
				<tr>
				<td align="center">'.$cabecalho.'</td>
				</tr>
				</table>
				</div>';
	
	if($objeto->carimbo == 'S'){
		$header .= '<div style="position: absolute; float: right; text-align: right; margin-top:-119px; margin-left: 617px;">
						<img src="../../../images/carimbo_folha.png" width="80px"/>
					</div>';
	}
	
	
	if($objeto->carimbo_via == 'S'){
		$header .= '<div  style="position: absolute; text-align: right; margin-top:0px; margin-left: 630px; ">
						<img src="../../../images/carimbo_via_2.png" width="35px"/>
					</div>';
	}

	if($objeto->carimbo_confidencial == 'S'){
		$header .= '<div style="position: absolute; text-align: right; margin-top:140px; margin-left: 630px; ">
						<img src="../../../images/carimbo_confidencial_2.png" width="40px"/>
					</div>';
	}
	
	if($objeto->carimbo_urgente == 'S'){
		$header .= '<div  style="position: absolute;  text-align: right; margin-top:300px; margin-left: 630px;">
						<img src="../../../images/carimbo_urgente_2.png" width="45px"/>
					</div>';
	}
	
	
	$content = '<div class="conteudo" style="min-height:900px; font-size:17px;">
				'.htmlspecialchars_decode($objeto->layout).'
			</div>';
	
	$footer = '
		<table width="100%" style="vertical-align: top;font-family:\'Times New Roman\',Times,serif; font-size: 11px;">
			<tr>
				<td align="center" colspan="2">
					<div style="padding-top: 20px;">'.$rodape.'</div>
				</td>
			</tr>
			<tr>
				<td style="font-size: 9px" align="left">'.$documento_identificacao.'</td>	
				<td align="right">página x de x</td>
			</tr>
		</table>
		';
	
	echo $header;
	echo $content;
	echo $footer;
	
	?>
	
	</div>	

	</div>
	<!-- fim da div formulario -->
	
	<div class="row" style="padding-top: 15px">
    
	    <div class="col-md-12 text-center">
	    	<div class="btn-group">
		    <?php

		    echo $link_back;
		    echo $link_export_sm;
		    echo $link_update_sm;
		    echo $link_history;
		    echo $link_workflow;
		   
		    if ($carimbos == 'yes'){

		    ?>
		     <div class="btn-group">
			  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <i class="cus-stamp_in"></i> Carimbo <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu" role="menu">
			    <li><?php echo $carimbo_pagina;?></li>
			    <li><?php echo $carimbo_via;?></li>
			    <li><?php echo $carimbo_confidencial;?></li>
			    <li><?php echo $carimbo_urgente;?></li>
			  </ul>
			</div> 
			<?php } ?>
			
		  	</div>  
	    </div>

    </div>
	
</div>
<!-- fim da div  view_content -->





 <script type="text/javascript">

 $(document).ready(function(){
	    $("#btnComentarios").click(function(){
	        $("#painelComentarios").toggle();
	    });

	    $("#btnComentariosClose").click(function(){
	        $("#painelComentarios").toggle();
	    });


	    $("#caracteresRestantes").text((100 - $('#campoComentario').val().length));

        $("#caracteresRestantes").hide();
	 		
		$("#campoComentario").focusin(function() {
		    $("#caracteresRestantes").show();
		}).focusout(function () {
		    $("#caracteresRestantes").fadeOut("medium");
		});

		$('#campoComentario').on('keyup',function(){
			   var charCount = $(this).val().length;
			   var restante = 100 - charCount;
				$("#caracteresRestantes").text(restante);
		});
	});
 </script>