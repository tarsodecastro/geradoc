$(document).ready(function(){
	$("#campoCPF").mask("999.999.999-99");
	$("#campoCPF").focus();
	
	
	//enviar formulario 
	$("#enviar").click(function(){				 
		$("#msg").show("fast");
		$("#enviar").fadeOut(); 			
				
	});  
		
});