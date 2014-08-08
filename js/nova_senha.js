$(document).ready(function(){
	$("#txtCPF").mask("999.999.999-99");
	$("#txtCPF").focus();
	
	
	//enviar formulario 
	$("#enviar").click(function(){				 
		$("#msg").show("fast");
		$("#enviar").fadeOut(); 			
				
	});  
		
});