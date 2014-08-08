<div class="areaimage">
	<center>
		<img src="{TPL_images}black-pages-icon.png" height="72px"/>
	</center>
</div>

<div id="content" class="content">

	 <h2><?php echo $titulo; ?></h2>

    <div id="conteiner_subMenu">

        <div style="float: left;">
            <?php echo $link_add; ?> &nbsp;   
        </div>
        
        <div style="float: right;">    
            <form id="frm_search" name="frm_search" action="<?php  echo $form_action; ?>" method="post">  
                <input class="search_text" type="text" id="search" name="search" value="<?php  echo $keyword_setor; ?>"/>
                <input type="submit" value="Pesquisar" class="button_search">              
            </form>
        </div>  

        <div style="clear:both;"></div> 

    </div>
	 
	<div id="dt_example" style="width:95%">
            <div id="cont">
	            <div class="demo">
					<?php 
                    echo $tabela; 
                    echo "<br />";
                    echo "Total de registros: <b>$total_rows</b> <br />";
                	?>
                	<div class="paginacao">
                		<?php echo $pagination; ?>
                	</div>
				</div>
            	<div class="spacer"></div>
           </div>
	</div> 
		
</div>
