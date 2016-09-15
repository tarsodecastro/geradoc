 $(document).ready(function(){
 		
	 var oTable = $('#tabela').dataTable( {
         "bJQueryUI": true,
         "bStateSave": false,
         "bPaginate": true,
         "sPaginationType": "full_numbers",
         "bSort": false,
         "bFilter": true,
         "bLengthChange": false,
         "bInfo": true,
       			"oLanguage": {
      			  "sEmptyTable": "Nenhum registro encontrado",
      			    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      			    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      			    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      			    "sInfoPostFix": "",
      			    "sInfoThousands": ".",
      			    "sLengthMenu": "_MENU_ registros por página",
      			    "sLoadingRecords": "Carregando...",
      			    "sProcessing": "Processando...",
      			    "sZeroRecords": "Nenhum registro encontrado",
      			    "sSearch": "Pesquisar ",
      			    "oPaginate": {
      			        "sNext": "Próximo",
      			        "sPrevious": "Anterior",
      			        "sFirst": "Primeiro",
      			        "sLast": "Último"
      			    }
          		}
     });
	
	$("#tabela tr").mouseover(function(){
		$(this).addClass("tableRow_mouseover");
	});
	
	$("#tabela tr").mouseout(function(){
		$(this).removeClass("tableRow_mouseover");
	});  
  	 
 	
	$('#busca').click(function() { 
        $.blockUI({ message: $('#buscaForm') }); 
 
        //setTimeout($.unblockUI, 2000); 
    }); 

    $("#search").focus(function() {
        if($("#search").val() == 'pesquisa textual'){
            $("#search").attr('value','');
            $("#search").removeClass('search_text');
        }
    }).blur(function() {
        if($("#search").val() == ''){
            $("#search").attr('value','pesquisa textual');
            $("#search").addClass('search_text');
        }
    });

			
 });	