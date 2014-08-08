<?php
// Padrao do CI para não acessar a Classe direto pelo Browser
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * Layout Class
 *
 * @package hooks
 * @description Implementa as views do tipo layout no framework.
 */
 
class Layout { 
	public $base_url; 
	/**
	* Metodo que executa as implementacoes.
	* Este metodo e chamado atraves do arquivo hooks.php
	* na pasta config.
	*
	* @return
	*/
	
	public function __construct(){
		
	}
	
	/*
	 * Se definido no controlador pega o valor do controlador ( o link de css,js,images)
	 * Se não retorna o valor default
	 */
	
	public function init(){		
		// Instancia do CI.
		$CI =& get_instance();
		 
		// Definindo o base_url.
		$this->base_url = $CI->config->slash_item('base_url');
		 
		// Pegando a saida que o CI gera normalmente.
		$output = $CI->output->get_output();
                
        // Pegando o valor de chat, se definido no controller.
		$chat = (isset($CI->chat)) ? $CI->chat : '';
		
		// Pegando o valor de chat, se definido no controller.
		$modal = (isset($CI->modal)) ? $CI->modal : '';
		 
		// Pegando o valor de title, se definido no controller.
		$title = (isset($CI->title)) ? $CI->title : '';
		 
		// Links CSS definidos no controlador.
		$css = (isset($CI->css)) ? $this->createCSSLinks($CI->css) : '';
		 
		// Links JS definidos no controlador.
		$js = (isset($CI->js)) ? $this->createJSLinks($CI->js) : '';
		
		// Links JS_CUSTOM definidos no controlador.
		//permite gerar javscript a partir do php no head htlm (ex: echo "alert('oi');")
		$js_custom = (isset($CI->js_custom)) ? $this->createJS_CUSTOMLinks($CI->js_custom) : '';
		
		// Links IMAGES definidos no controlador.
		//Se não definido retorna o path padrão das imagens		
		$images = (isset($CI->images)) ? $this->createIMAGELinks($CI->images) : $this->base_url . IMAGESPATH;
 
 
		// Se layout estiver definido e a regexp nao bater.
		if (isset($CI->layout) && !preg_match('/(.+).php$/', $CI->layout)){		
			$CI->layout .= '.php';
		} else {
			$CI->layout = 'default.php';
		}
 
		// Definindo caminho completo do layout.
		$layout = LAYOUTPATH . $CI->layout;
 
		// Se o layout for diferente do default, e o arquivo nao existir.
		if ($CI->layout !== 'default.php' && !file_exists($layout)){
					
			// Exibe a mensagem, se o layout for diferente de '.php'.
			if ($CI->layout != '.php') show_error("You have specified a invalid layout: " . $CI->layout);
		}
 
		// Se o arquivo layout existir.
		if (file_exists($layout)){
			// Carrega o conteudo do arquivo.
			$layout = $CI->load->file($layout, true);
		 
			// Substitui o texto {content_for_layout} pelo valor de output em layout.
			$view = str_replace('{TPL_content}', $output, $layout);
                        
            // Substitui o texto {title_for_layout} pelo valor de title em view.
			$view = str_replace('{TPL_chat}', $chat, $view);
			
			// Substitui o texto {title_for_layout} pelo valor de title em view.
			$view = str_replace('{TPL_modal}', $modal, $view);
			 
			// Substitui o texto {title_for_layout} pelo valor de title em view.
			$view = str_replace('{TPL_title}', $title, $view);
			 
			// Links CSS.
			$view = str_replace('{TPL_css}', $css, $view);
		 
			// Links JS.
			$view = str_replace('{TPL_js}', $js, $view);
			
			// Links IMAGE.
			$view = str_replace('{TPL_images}', $images, $view);
			
			// Links JS_CUSTOM.
			$view = str_replace('{TPL_js_custom}', $js_custom, $view);
			
		} else {
			$view = $output;
		}
		 
		echo $view;
	}
 
	/**
	* Gera os links CSS utilizados no layout.
	*
	* @return void
	*/
	private function createCSSLinks($links){
		$html = ""; 
		for ($i = 0; $i < count($links); $i++) {
			$html .= "<link rel='stylesheet' type='text/css' href='" . $this->base_url . CSSPATH . $links[$i] . ".css' />\r\n";
		} 
		return $html; 
	}
 
	/**
	* Gera os links JS utilizados no layout.
	*
	* @return void
	*/
	private function createJSLinks($links){
		$html = ""; 
		for ($i = 0; $i < count($links); $i++){
			$html .= "<script type='text/javascript' src='" . $this->base_url . JSPATH . $links[$i] . ".js'></script>\r\n";
		} 
		return $html;
	}
	
	/**
	* Gera os links IMAGES utilizados no layout.
	*
	* @return void
	*/	
	private function createIMAGELinks($links){	
		return $this->base_url . IMAGESPATH .$links; 
	
	}
	
	/**
	* Gera os links JS_CUSTOM utilizados no layout.
	*
	* @return void
	*/	
	private function createJS_CUSTOMLinks($links){				
		$html = '<script type="text/javascript">'. $links.'</script>';		 
		return $html;	
	}
 
}
?>
