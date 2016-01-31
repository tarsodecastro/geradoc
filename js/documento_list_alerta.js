$( document ).ready( function() {

    $( '#modalAlerta' ).modal({backdrop: 'static', keyboard: false});

    $.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
	$( "#campoDataAlerta" ).datepicker({
		beforeShow: function() {
	        setTimeout(function(){
	            $('.ui-datepicker').css('z-index', 99999999999999);
	        }, 0);
	    }
	});

	$('#modalAlerta').on('hidden.bs.modal', function () {
		 location.reload();
	});


	$("#campoDataAlerta").prop('disabled', true);

	$("#campoHoraAlerta").prop('disabled', true);

	$("#campoMotivoAlerta").prop('disabled', true);
	
	$("#campoConclusaoAlerta").prop('disabled', true);

	$("#btn_salvar").prop('disabled', true);

	
	$("#alerta_acao_novo").click(function() {
		$("#campoDataAlerta").prop('disabled', false);
		$("#campoHoraAlerta").prop('disabled', false);

		$("#campoConclusaoAlerta").prop('disabled', true);
		$("#alertaPainelAcaoNovo").addClass( "alert-warning" );
		$("#alertaPainelAcaoConluir").removeClass( "alert-info" );

		$("#alerta_acao_novo").prop('disabled', true);
		
		$("#alerta_acao_concluir").prop('disabled', false);

		$("#btn_salvar").prop('disabled', false);

		$("#campoMotivoAlerta").prop('disabled', false);

		$("#campoHoraAlerta").mask("99:99");

		$("#grupoConclusao").removeClass( "has-error" );

		
	});

	$("#alerta_acao_concluir").click(function() {
		$("#campoDataAlerta").prop('disabled', true);
		$("#campoHoraAlerta").prop('disabled', true);
		
		$("#campoConclusaoAlerta").prop('disabled', false);

		

		$("#campoMotivoAlerta").prop('disabled', true);

		
		$("#alertaPainelAcaoNovo").removeClass( "alert-warning" );
		$("#alertaPainelAcaoConluir").addClass( "alert-info" );

		$("#alerta_acao_novo").prop('disabled', false);

		$("#alerta_acao_concluir").prop('disabled', true);
		
		$("#btn_salvar").prop('disabled', false);


		$("#grupoData").removeClass( "has-error" );
		$("#grupoHora").removeClass( "has-error" );
		$("#grupoMotivo").removeClass( "has-error" );
		
	});


	$("#alertaForm").submit(function(){


	   if($("#alerta_acao_novo").prop('disabled') == true){

			   if( $("#campoDataAlerta").val() == ''){

				   $("#grupoData").addClass( "has-error" );
				   $("#perguntaAlerta").html( "Informe a <strong>data</strong> do novo alerta" );
	
					return false
			   }
	
			   if( $("#campoHoraAlerta").val() == ''){

				   $("#grupoHora").addClass( "has-error" );
				   $("#perguntaAlerta").html( "Informe a <strong>hora</strong> do novo alerta" );
	
					return false
			   }
	
	
			   if( $("#campoMotivoAlerta").val() == ''){

				   $("#grupoMotivo").addClass( "has-error" );
				   $("#perguntaAlerta").html( "Informe o <strong>motivo</strong> do novo alerta" );
	
					return false
			   }
	
			   var myString = $("#campoHoraAlerta").val();
			   
			   var myArray = myString.split(':');
	
			   if(myArray[0] > 23 || myArray[1] > 59){
	
					$("#grupoHora").addClass( "has-error" );
	
					$("#perguntaAlerta").text( "Hora inválida" );
					
					return false
					
				}

	   }

	   if($("#alerta_acao_concluir").prop('disabled') == true){

		   if( $("#campoConclusaoAlerta").val() == ''){

			   $("#grupoConclusao").addClass( "has-error" );
			   
			   $("#perguntaAlerta").html( '<i class="fa fa-exclamation-triangle" style="color: red;"></i> Descreva a <strong>conclusão</strong> do alerta' );

				return false
		   }

	   }

	});
	
});