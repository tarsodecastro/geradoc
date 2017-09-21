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
       				{"sWidth":"30px", "sClass": "text-center"},
       				{"sWidth":"100px", "sClass": "text-center"},
       				{"sWidth":"150px", "sClass": "text-left"},
       				{"sClass": "text-left"},
       				{"sClass": "text-left"},
       				{"sWidth":"400px", "sClass": "text-left"} 								 	
       			],
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
    
    
    //--- Controles do modal ---//
    
    $('a[name=modal]').click(function(e) {
		e.preventDefault();
		
		var id = $(this).attr('href');
	
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		$('#mask').fadeIn(500);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		$(id).css('top',  winH/2-$(id).height()/2.5);
		$(id).css('left', winW/2-$(id).width()/2);
	
		$(id).fadeIn(1000); 
	
	});
	
	$('.window .close').click(function (e) {
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});	
    //--- Fim ---//
			
 });	