 $(document).ready(function(){
 	
	 $('#about').click(function() { 
         $.blockUI({ 
        	 message: $('#modalDialog'),
        	 overlayCSS: { backgroundColor: '#000' },
        	 css: { 
                 top: '150px',
                 left: ($(window).width() - 500) /2 + 'px', 
                 width: '500px',
             } 
         
         }); 
         $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
     }); 

     $('#bt_cancelar').click(function() { 
         setTimeout($.unblockUI); 
     });
	
 });	
	
	