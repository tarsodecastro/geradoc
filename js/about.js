 $(document).ready(function(){
 	
	 $('#about').click(function() { 
         $.blockUI({ 
        	 message: $('#modalDialog'),
        	 overlayCSS: { backgroundColor: '#000', opacity: 0.8, cursor: 'default'},
        	 css: { 
                 top: '150px',
                 left: ($(window).width() - 500) /2 + 'px', 
                 width: '500px',
                 cursor: 'default' 
             } 
         
         }); 
         $('.blockOverlay').attr('title','Click to unblock').click($.unblockUI); 
     }); 

     $('#bt_cancelar').click(function() { 
         setTimeout($.unblockUI); 
     });
	
 });	
	
	