 $(document).ready(function(){
 		
	 var oTable = $('#tabela').dataTable( {
         "bJQueryUI": true,
         "bStateSave": false,
         "bPaginate": false,
         "sPaginationType": "full_numbers",
         "bSort": false,
         "bFilter": false,
         "bLengthChange": false,
         "bInfo": false,
         "aoColumns": [
       				{"sWidth":"220px", "sClass": "justify"},
       				{"sClass": "justify"}, 
       				{"sClass": "justify"},
       				{"sWidth":"80px", "sClass": "justify"},	
       				{"sWidth":"435px", "sClass": "center"} 								 	
       			],
     });
	
	 $("#tabela tr:contains('CANCELADO')").css("background-color", "#FFDAB9");
     $("#tabela tr:contains('CANCELADO')").mouseover(function() {
             $(this).css('background-color', '#FFF0BE');
     }).mouseout(function() {
             $(this).css('background-color', '#FFDAB9');
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
	
	