$(document).ready(function() {
	
	var oTable = $('#tabela').dataTable( {
		"aaSorting": [[1,'desc']],
        "bJQueryUI": true,
        "bStateSave": false,
        "bPaginate": false,
    	"bFilter": false,
    	"bInfo" : false,
    	"bAutoWidth": false,
    	"bLengthChange": false,

        "aoColumns": [
	                      null, 	//setor
	                      {"sWidth":"100px", "sClass": "center"},	//quantidade
                     ],					
        "oLanguage": {
						"sEmptyTable": "Nenhum registro no momento.",
						"sZeroRecords": "Nenhum registro no momento.",
					},
					
					
    });
	
	
        var oTable = $('#tabela_oco').dataTable( {
            "aaSorting": [[0,'desc']],
            "bJQueryUI": true,
            "bStateSave": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 15,
            "aLengthMenu": [[15, 25, 50], [15, 25, 50]],
            "aoColumns": [{"sWidth":"50px", "sClass": "center"}, 	//id
                          {"sWidth":"150px",},						//data
                          {"sWidth":"150px", "sClass": "center"},	//municipio
                          {"sWidth":"200px"}, 						//unidade
                          {"sWidth":"300px"}, 						//ocorrencia
                          {"sClass": "center"}],					//vitima
            "oLanguage": {
				"oPaginate": {
					"sFirst"   : "Primeira",
					"sLast"    : " Última",
					"sNext"    : "Próxima",
					"sPrevious" : "Anterior"				
				},
				
				"sEmptyTable": "Nenhum registro no momento.",
				"sZeroRecords": "Nenhum registro no momento.",
				"sInfo": "Mostrando _START_ a _END_, de _TOTAL_ registros.",
				"sInfoEmpty": "Nenhum registro para exibir.",
				"sInfoFiltered": " Filtrados de _MAX_ registros.",			
				"sLengthMenu": 'Mostrar <select>'+				
											'<option value="15">15</option>'+													
											'<option value="25">25</option>'+													
											'<option value="50">50</option>'+				
											'<option value="-1">Todos</option>'+				
										'</select> registros',
				"sSearch": "Procurar:"
								
			}	
        });
        
        $.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
        $( "#campoDataIni" ).datepicker();
        $( "#campoDataFim" ).datepicker();
        
    } );