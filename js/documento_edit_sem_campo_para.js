
$().ready(function() {

   $("textarea#campoRedacao").tinymce({
	      script_url : '<?php echo base_url(); ?>js/tinymce/tinymce.min.js',
	      language : 'pt_BR',
	  	  menubar : false,
	  	  browser_spellcheck : true,
	  	  content_css : '../../css/style_editor.css',
	  	  width : 750,
	  	  relative_urls: false,
	  	  setup : function(ed){
	  		ed.on('init', function() {
	  			   this.getDoc().body.style.fontSize = '10.5pt';
	  			});
	  	},

	  	plugins: "preview image jbimages spellchecker textcolor table lists",
	  	
	  	toolbar: "undo redo | fontsizeselect bold italic underline strikethrough | subscript superscript removeformat | alignleft aligncenter alignright alignjustify | forecolor backcolor | bullist numlist outdent indent | table | preview code | jbimages ",
	  	statusbar : false,
	  	relative_urls: false
	  	
	   });

});

        $("#form").submit(function() {

            var campoRedacao = $('#campoRedacao').val();

            var testeRedacao = false;
        
            if (campoRedacao == '') {
               // alert(campoRedacao);
                $("#redacao_error").html("<img class='img_align' src='{TPL_images}error.png' alt='!' /> * requerido").show();
                testeRedacao = false;
            }else{
                // alert(campoRedacao);
                $("#redacao_error").hide();
                testeRedacao = true;
            }

            if(testeRedacao == true){
                return true;
            }else{
                return false;
            }

        });

        //--- Fim da tela de Aguarde... (Loading) ---/
       	$.unblockUI({ });
        //--- Fim ---//
        