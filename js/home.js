$(document).ready(function() {
	$('#tabela').dataTable({					
    	"aaSorting": [[0,'desc']],
        "bJQueryUI": true,
        "bStateSave": false,		
		"bPaginate": false,
		"bFilter": false,
		"bInfo" : false,
		"bAutoWidth": false,
		"bLengthChange": false,
		"aoColumns": [
				{"sWidth":"30px", "sClass": "center"},
				{"sWidth":"140px", "sClass": "center"},
				{"sWidth":"200px", "sClass": "center"},	
				{"sClass": "justify"}, 				
				{"sWidth":"40px", "sClass": "center"},		
				{"sClass": "center"} 						

						
						
						 	
			],
		"oLanguage": {
						"sZeroRecords": "Nenhum registro no momento."
					  }
    });
	
} );
