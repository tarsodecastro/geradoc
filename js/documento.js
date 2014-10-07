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
    
    
    $('#setorSelect').click(function() { 
        $.blockUI({ 
       	 message: $('#dialogSetor'),
       	 overlayCSS: { backgroundColor: '#000', opacity: 0.8, cursor: 'default'},
       	 css: { 
                top: '150px',
                left: ($(window).width() - 800) /2 + 'px', 
                width: '800px',
                cursor: 'default' 
            } 
        
        }); 
        $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
    }); 

    $('#setor_bt_cancelar').click(function() { 
        setTimeout($.unblockUI); 
    });
    
    $('#setores').change(function() { 
    	$.blockUI({ message: '<h1>Aguarde...</h1>' });
    });

			
 });	
	
	