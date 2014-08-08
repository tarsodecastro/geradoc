

//Initializes all textareas with the tinymce class
$().ready(function() {

	 $("#campoBusca").focus(function() {
	        if($("#campoBusca").val() == 'pesquisa textual'){
	        	$("#campoBusca").addClass('campo_busca_hover');
	            $("#campoBusca").attr('value','');
	        }
	        
	    }).blur(function() {
	        if($("#campoBusca").val() == ''){
	        	 $("#campoBusca").addClass('campo_busca');
	            $("#campoBusca").attr('value','pesquisa textual');
	        }
	       
	    });

   $("textarea#campoRedacao").tinymce({
	      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
	      language : 'pt_BR',
	  	  menubar : false,
	  	  browser_spellcheck : true,
	  	
	  	  relative_urls: false,
	  	  setup : function(ed){
	  		ed.on('init', function() {
	  			   this.getDoc().body.style.fontSize = '10.5pt';
	  			});
	  	},
	
	  	plugins: "preview image jbimages spellchecker textcolor table lists",
	  	
	  	toolbar: "undo redo | fontsizeselect bold italic underline strikethrough | subscript superscript removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | table | preview code | jbimages ",
	  	statusbar : false,
	  	relative_urls: false
	  	
	   });
	
	 $("textarea#campoPara").tinymce({
	      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
	  		language : 'pt_BR',
	  		menubar : false,
	  		browser_spellcheck : true,
	  		forced_root_block : false,
	  		setup : function(ed){
	  		ed.on('init', function() {
	  			   this.getDoc().body.style.fontSize = '10.5pt';
	  			});
	  	},
	  	toolbar: "undo redo | bold italic underline superscript ",
	  	statusbar : false,
	   });

});

	function log( message ) {
		$("#campoPara").val(message);
	}

    $('#campoBusca').autocomplete({
		minLength: 3,
		source: function(req, add){
			$.ajax({
			    url: '<?php echo base_url(); ?>index.php/documento/loadDestinatario/',
			    dataType: 'json',
			    type: 'POST',
			    data: req,
			    success: function(data){
			        if(data.response =='true'){
			           add(data.message);
			        }else{
			            $('#campoBusca').removeClass( "ui-autocomplete-loading" );
			        }
			    },
			});
    	},

	select: function( event, ui ) {

		log( ui.item ? ui.item.label : "Nothing selected, input was " + this.value);
		this.value = "";
		return false;
	},
            
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a>" + item.label + "</a>" )
            .appendTo( ul );
    };

        $("#form").submit(function() {

            var campoPara = $('#campoPara').val();
            var campoRedacao = $('#campoRedacao').val();

            var teste1 = false;
            var teste2 = false;
          
            if (campoPara == '') {
                //alert(campoPara);
                $("#para_error").html("<img class='img_align' src='{TPL_images}error.png' alt='!' /> * requerido").show();
                teste1 = false;
            }else{
                //alert(campoPara);
                $("#para_error").hide();
                teste1 = true;
            }

            if (campoRedacao == '') {
               // alert(campoRedacao);
                $("#redacao_error").html("<img class='img_align' src='{TPL_images}error.png' alt='!' /> * requerido").show();
                teste2 = false;
            }else{
                // alert(campoRedacao);
                $("#redacao_error").hide();
                teste2 = true;
            }

            if(teste1 == true && teste2 == true){
                return true;
            }else{
                return false;
            }

        });
 
        
        
