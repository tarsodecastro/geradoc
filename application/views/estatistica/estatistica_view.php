<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-select.min.css">

<div class="areaimage">
	<center>
		<img src="{TPL_images}statistics_64.png" />
	</center>
</div>	

<div id="msg" style="display:none;"><img src="{TPL_images}loader.gif" alt="Enviando" />Aguarde carregando...</div> 

<div id="view_content">	

    <?php
    echo $message;
    ?>
	
	<div class="formulario">	
	
	
		<form class="form-inline" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
		
			<div class="panel panel-primary">
			
				<div class="panel-heading">
			    	<h3 class="panel-title">Estatísticas</h3>
			  	</div>
			
				<div class="panel-body">
				
					 <div class="form-group">
					    <label for="campoNome" class="control-label">Tipo de documento</label>
					   
					     <?php echo form_dropdown( 'campoTipo', $tipos, $tipoSelecionado, 'id="campoTipo" class="form-control selectpicker" data-style="btn-default" data-live-search="true"  '); ?> 
					  
					 </div>
					 
					 <div class="form-group">
					    <label for="campoDataIni" class="control-label">Data inicial</label><br>
					  
					    <?php echo form_input($campoDataIni); ?> 
					   
					 </div>
					 
					 <div class="form-group">
					    <label for="campoDataFim" class="control-label">Data final</label><br>
					  
					    <?php echo form_input($campoDataFim); ?> 
					   
					 </div>
				 </div>
				 
				 <div class="form-group" style="padding-bottom: 10px">
					<input type="submit" class="btn btn-primary" value="Consultar" title="Consultar" />
				</div>
				
				

			</div>
			

		</form> 
		
			<?php 
			
			if($erro != ''){

				echo $erro; 
			
			}else{

			?> 
		
			<div id="grafico1" style="width:600px;height:300px; margin: 0 auto; margin-bottom: 30px;"></div>
			
			<div id="grafico2" style="width:800px;height:400px; margin: 0 auto; margin-bottom: 30px;"></div>
			
			<?php } ?> 

			
    </div>




</div><!-- fim: div view_content --> 


<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/highcharts/js/highcharts.js"></script>

<script type="text/javascript">

$(document).ready(function() {

	$.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
    $( "#campoDataIni" ).datepicker();
    $( "#campoDataFim" ).datepicker();


    Highcharts.setOptions({
        lang: {
            decimalPoint: ',',
            thousandsSep: '.'
        }
    });
    
    $('#grafico1').highcharts({

    	//colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#FFFF00', '#55BF3B', '#FF0000','#00FF00', '#8085e9', '#0000FF', '#2b908f', '#CC9900', '#CCCCCC','#7cb5ec', '#ED561B', '#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],

        chart: {
        	borderColor: '#CCC',
            borderWidth: 1,
            type: 'line'
        },
        title: {
            text: '<?php echo $grafico_1_titulo; ?>',
            style: {
            	"fontSize": "12pt" 
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:,.0f}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y:,.0f}',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Quantidade',
            data: [<?php echo $grafico_1_dados; ?>]
        }]
    });


/*

    $('#grafico2').highcharts({

    	//colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#FFFF00', '#55BF3B', '#FF0000','#00FF00', '#8085e9', '#0000FF', '#2b908f', '#CC9900', '#CCCCCC','#7cb5ec', '#ED561B', '#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
    	 chart: {
             borderColor: '#CCC',
             borderWidth: 1,
             type: 'line'
         },
        title: {
            text: '<?php echo $grafico_2_titulo; ?>',
            x: -20 //center
        },

        xAxis: {
            categories: [<?php echo $grafico_2_valores_X; ?>],
            labels:{
            	rotation: -75
            }
        },
        yAxis: {
            title: {
                text: 'Quantidade'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
       
        series: [
				<?php echo $grafico_2_valores_Y; ?>
        ]
    });
    
*/
    
} );

</script>
