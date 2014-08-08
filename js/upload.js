$(document).ready(function() {
		
	$('#form_upload').submit(function() {			
		$(this).hide(500, function() {
			$('#info').hide(500);
			$('#upload_msg').hide(500);
			$('#loader_img').show(500);
		});	
		

	});
	
	$("#cancelar").click(function(){
		var novaURL =  CI_ROOT + '/boletim/';
		$(window.document.location).attr('href',novaURL);
	});
		
	
		
	
});