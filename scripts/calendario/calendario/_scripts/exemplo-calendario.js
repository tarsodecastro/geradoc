$(document).ready(function(){
	

	/* ACORDDION 
		$('h2.accordion').click(function(){
			$(this).next().slideToggle("slow");
			$('.calendario').remove();
		});
	*/
	
	
	$('#data_1').focus(function(){
		$(this).calendario({ 
			target:'#data_1'
		});
	});
	
	
	$('#data_2').focus(function(){
		$(this).calendario({ 
			target:'#data_2',
			top:0,
			left:130
		});
	});
	
	
	$('#data_3').focus(function(){
		$(this).calendario({ 
			target:'#data_3',
			closeClick:false
		});
	});
	
	$('#data_4').focus(function(){
		$(this).calendario({ 
			target :'#data_4',
			dateDefault:$(this).val()
		});
	});
	
	
	$('#data_5_dia, #data_5_mes, #data_5_ano').focus(function(){
		$(this).calendario({ 
			targetDay :'#data_5_dia',
			targetMonth :'#data_5_mes',
			targetYear :'#data_5_ano',
			dateDefault: $('#data_5_dia').val()+"/"+$('#data_5_mes').val()+"/"+$('#data_5_ano').val(),
			referencePosition : '#data_5_dia'
		});
	});	
	
	$('#data_6').focus(function(){
		$(this).calendario({ 
			target :'#data_6',
			dateDefault:$(this).val(),
			minDate:'10/11/2008',
			maxDate:'25/01/2009'
		});
	});
});

