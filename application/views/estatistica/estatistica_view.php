<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-select.min.css">
<style>
.form-group {
	margin-bottom: 10px;
}
</style>

<div class="areaimage">
	<center>
		<img src="{TPL_images}statistics_64.png" />
	</center>
</div>	

<div id="msg" style="display: none; padding: 13px;">

	 <h4><img src="{TPL_images}loader.gif" class="img_aling2" alt="Carregando" height="21px"/> &nbsp; Aguarde, processando informações... </h4>
	
</div>

<p class="bg-success lead text-center"><?php echo $titulo;?></p>

<div id="view_content">	

    <?php
    echo $message;
    ?>
		
	<div class="row">
		<div class="col-sm-4" >
			
			<form class="form-horizontal" role="form" id="frm1" name="frm1" action="<?php echo $form_action; ?>" method="post">
		
			<div class="panel panel-primary">
			
				<div class="panel-heading">
				
			    	<h3 class="panel-title text-center">Filtros</h3>
			  	</div>
			
				<div class="panel-body" style="padding: 10px";>
				
				 		<div class="form-group">
						  	<div class="col-sm-6">
						  	<label for="campoDataIni" class="control-label">Data inicial:</label>
						    <?php echo form_input($campoDataIni); ?> 
						 	</div>
						 	
						 	<div class="col-sm-6">
						  	<label for="campoDataFim" class="control-label">Data final:</label>
						    <?php echo form_input($campoDataFim); ?>  
						 	</div>
						 </div>
						 
						 <div class="form-group">
						    
						  	<div class="col-sm-12">
						  	<label for="campoTipo" class="control-label">Tipo de documento:</label>
						     <?php echo form_dropdown( 'campoTipo', $tipos, $tipoSelecionado, 'id="campoTipo" class="form-control selectpicker" data-style="btn-default" data-live-search="true"  '); ?> 
						  	</div>
						 </div>
						 
						 <div class="form-group">
						    
						    <div class="col-sm-12">
						    <label for="campoSetor" class="control-label">Setor:</label>
						     <?php echo form_dropdown( 'campoSetor', $setores, $setorSelecionado, 'id="campoSetor" class="form-control selectpicker" data-style="btn-default" data-live-search="true"  '); ?> 
						   </div>
						 </div>

					<div class="form-group">
						<div class="col-sm-12 text-center">
						<input type="submit" id="btn_consultar" class="btn btn-primary" value="Consultar" title="Consultar" />
						</div>
					</div>
				 </div>

			</div>

		</form> 
			
		</div>
		
		<div class="col-sm-8" >
			<?php 
			
			if($erro != ''){

				echo $erro; 
			
			}else{

				echo $grafico_1;

			}

			?> 
		</div>
	</div> <!-- fim: div row --> 
	
	<div class="row">
	
		<div class="col-sm-4" >
		
			<?php 
				
				if($erro == ''){
	
					echo $grafico_3;
				
				}
	
			?>
		
		</div>
		
		<div class="col-sm-8" >
		
			<?php 
				
				if($erro == ''){
	
					echo $grafico_2;
				
				}
	
			?>
		
		</div>
	
	</div> <!-- fim: div row --> 		

</div><!-- fim: div view_content --> 


<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/highcharts/js/highcharts.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/highcharts/js/modules/exporting.js"></script>

<script type="text/javascript">

$(document).ready(function() {

	//--- Loading ---//
	
	 $('#btn_consultar').click(function() { 
         $.blockUI({ 
        	 message: $('#msg'),
        	 overlayCSS: { backgroundColor: '#000', opacity: 0.8, cursor: 'default'},
        	 css: { 
                 top: '150px',
                 left: ($(window).width() - 300) /2 + 'px', 
                 width: '300px',
                 cursor: 'default' 
             } 
         
         }); 
         $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
     }); 

     $('#bt_cancelar').click(function() { 
         setTimeout($.unblockUI); 
     });
    
       
	//--- Fim do loading ---//

	$.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
    $( "#campoDataIni" ).datepicker();
    $( "#campoDataFim" ).datepicker();


    Highcharts.setOptions({
        lang: {
            decimalPoint: ',',
            thousandsSep: '.'
        },
        colors: ["#7cb5ec", "#f7a35c", "#90ee7e", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
		
    });
    
    $('#grafico1').highcharts({

    	//colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#FFFF00', '#55BF3B', '#FF0000','#00FF00', '#8085e9', '#0000FF', '#2b908f', '#CC9900', '#CCCCCC','#7cb5ec', '#ED561B', '#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
    	//colors: ["#7cb5ec", "#f7a35c", "#90ee7e", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
		
		//colors: ["#2b908f", "#90ee7e", "#f45b5b", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
		
        chart: {
        	borderColor: '#CCC',
            borderWidth: 1,
            type: 'line'
        },
        title: {
            text: '<?php echo $grafico_1_titulo; ?>',
            style: {
            	"fontSize": "11pt" 
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


    <?php if( $grafico_2 != '') { ?>
    $('#grafico2').highcharts({

    	 //colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#FFFF00', '#55BF3B', '#FF0000','#00FF00', '#8085e9', '#0000FF', '#2b908f', '#CC9900', '#CCCCCC','#7cb5ec', '#ED561B', '#4572A7', '#AA4643', '#89A54E', '#80699B', '#3D96AE', '#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],

    	// colors: ["#7cb5ec", "#f7a35c", "#90ee7e", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],

    	//colors: ["#2b908f", "#90ee7e", "#f45b5b", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
		
    	 
    	 chart: {
             borderColor: '#CCC',
             borderWidth: 1,
             type: 'line'
         },
        title: {
            text: '<?php echo $grafico_2_titulo; ?>',
            style: {
            	"fontSize": "11pt" 
            },
            x: -20 //center
        },

        xAxis: {
            categories: [<?php echo $grafico_2_valores_X; ?>],
            labels:{
            	rotation: -50,
            	x: 10
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
    
    <?php } ?>



    $('#grafico3').highcharts({

			colors: ['#FFD700', '#FF0000'],
			
			//colors: ["#7cb5ec", "#f7a35c", "#90ee7e", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
			//colors: ["#2b908f", "#90ee7e", "#f45b5b", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee", "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],

            chart: {
            	 borderColor: '#CCC',
                 borderWidth: 1,
                type: 'column'
            },

            title: {
                text: '<?php echo $grafico_3_titulo; ?>',
                style: {
                	"fontSize": "10pt" 
                },
            },
            subtitle: {
                text: ''
            },
            xAxis: {
				title: {
                    text: ''
                },
                type: 'category',
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
				allowDecimals: false,
                min: 0,
                title: {
                    text: 'Quantidade'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: '<b>{point.y:,.0f}</b> documentos',
            },
	
            series: [{
                name: 'Ano',
		colorByPoint: true,
                data: [<?php echo $grafico_3_dados; ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: 0,
                   // color: '#555',
                    align: 'center',
					format: '{point.y:,.0f}',
                    y: 5,
                    style: {
                        fontSize: '10pt',
                        fontFamily: 'Verdana, sans-serif',
                       // textShadow: '0 0 0px black'
                    }
                }
            }]
        });
    
} );

</script>
