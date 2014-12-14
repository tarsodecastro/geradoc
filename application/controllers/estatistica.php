<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estatistica extends CI_Controller {

	/*
	 * Atributos opcionais para as views
	* public $layout;  define o layout default
	* public $title; define o titulo default da view
	* public $css = array('css1','css2'); define os arquivos css default
	* public $js = array('js1','js2'); define os arquivos javascript default
	* public $images = 'dir_images'; define a diretório default das imagens
	*
	*/

	public $layout = 'default';
	public $css = array('style','demo_page','demo_table_jui','jquery-ui-1.8.11.custom');
	public $js = array('jquery-1.7.1.min','jquery.dataTables.min','jquery.blockUI','about');
	public $js_custom;

	private $area            = "estatistica";
	private $tituloIndex     = "s";
	private $tituloAdd       = "Novo ";
	private $tituloView      = "Detalhes do ";
	private $tituloUpdate    = "Edita ";

	public function __construct (){
		parent::__construct();
		$this->load->library(array('restrict_page','table','form_validation','session', 'jpgraph','datas'));
		$this->load->helper('url');
		$this->load->model('Grid_model','',TRUE);
		$this->load->model('Estat_model', '', TRUE);
		$this->modal = $this->load->view('about_modal', '', TRUE);
		session_start();
	}

	public function index() {

		$this->js[] = 'datepicker/js/jquery-ui-1.8.16.custom.min';
		$this->js[] = 'datepicker/js/jquery.ui.datepicker-pt-BR';
		$this->js[] = 'estatistica';
			
		$data['titulo']         = "Estatísticas";
		$data['message']        = '';
		$data['form_action']	= site_url($this->area);
		$graph_temp_directory = 'temp';
			
/*
|--------------------------------------------------------------------------
| Definicao dos campos
|--------------------------------------------------------------------------
*/
		$this->load->model('Campo_model','',TRUE);
		$data['campoDataIni']            	= $this->Campo_model->estatisticas('campoDataIni');
		$data['campoDataFim']            	= $this->Campo_model->estatisticas('campoDataFim');
		$data['campoDataFim']['value']   	= date("d/m/Y");


/*
|--------------------------------------------------------------------------
| Lista os tipos de documentos
|--------------------------------------------------------------------------
*/

		$this->load->model('Tipo_model','',TRUE);
		$objTipos = $this->Tipo_model->list_all()->result();

		$arrayTipos[0] = "TODOS";
		foreach ($objTipos as $tipo) {

			$arrayTipos[$tipo->id] = $tipo->nome;

		}

		$data['tipos'] = $arrayTipos;
		$data['tipoSelecionado'] = $this->input->post('campoTipo') ? $this->input->post('campoTipo') : 0;
		
		
/*
|--------------------------------------------------------------------------
| Lista os setores
|--------------------------------------------------------------------------
*/
		$this->load->model('Setor_model','',TRUE);
		$objSetores = $this->Setor_model->list_all()->result();

		$arraySetores[0] = "TODOS";
		
		foreach ($objSetores as $item) {
			
			$setor =  $this->Setor_model->get_by_id($item->id)->row();
		
			if($setor->setorPaiSigla and $setor->setorPaiSigla != "NENHUM" and $setor->setorPaiSigla != $setor->orgaoSigla and $setor->sigla != $setor->setorPaiSigla){
    		
				$arraySetores[$item->id] = $item->nome . " - " . $item->sigla . "/" . $setor->setorPaiSigla;
				
			}else{
				
				$arraySetores[$item->id] = $item->nome . " - " . $item->sigla;
			}
		
		}
		
		$data['setores'] = $arraySetores;
		$data['setorSelecionado'] = $this->input->post('campoSetor') ? $this->input->post('campoSetor') : 0;

/*
|--------------------------------------------------------------------------
| Popula os campos do formulario com valores inicais
|--------------------------------------------------------------------------
*/
		$objeto_do_form['tipo'] = $data['tipoSelecionado'] ;
		
		$objeto_do_form['setor'] = $data['setorSelecionado'] ;

		if($this->input->post('campoDataIni')){
			$objeto_do_form['dataIni']		= $this->input->post('campoDataIni');
			$data['campoDataIni']['value']	= $this->input->post('campoDataIni');
		}else{
			$data['campoDataIni']['value'] 	= date('d/m/Y', mktime (0, 0, 0, date("m")  , date("d")-30, date("Y"))) ;
			$objeto_do_form['dataIni'] 		= $data['campoDataIni']['value'];
		}

		if($this->input->post('campoDataFim')){
			$objeto_do_form['dataFim'] 		= $this->input->post('campoDataFim');
			$data['campoDataFim']['value']	= $this->input->post('campoDataFim');
		}else{
			$data['campoDataFim']['value'] 	= date ('d/m/Y');
			$objeto_do_form['dataFim'] 		= $data['campoDataFim']['value'];
		}

		$data['erro'] = '';
		if($this->data_to_number($objeto_do_form['dataIni']) > $this->data_to_number($objeto_do_form['dataFim'])){
				
			$data['erro'] =  '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-2x"></i> <br> A data inicial informada é maior que a data final!</div>';
				
		}
		
		$dataIniForm = $objeto_do_form['dataIni'];
		$dataFimForm = $objeto_do_form['dataFim'];
		
		$objeto_do_form['dataIni']			= $this->datas->dateToUS($objeto_do_form['dataIni']) . ' 00:00:00';
		$objeto_do_form['dataFim'] 			= $this->datas->dateToUS($objeto_do_form['dataFim']) . ' 23:59:59';
		

/*
|--------------------------------------------------------------------------
| Monta o primeiro grafico (de pizza)
|--------------------------------------------------------------------------
*/
		$linhas = $this->Estat_model->docs_por_tipo_no_periodo($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $objeto_do_form['tipo'], $objeto_do_form['setor']);
		
		$data['grafico_1'] = '';
		$data['grafico_1_titulo'] = "Sem registros";
		$data['grafico_1_dados'] = "";
			
		if(count($linhas) > 0){

			$data['grafico_1_dados'] = '';
			
			$total = 0;
				
			foreach ($linhas as $key => $item) {

				$data['grafico_1_dados'] .= "['". $item['nome'] ."',". $item['totalPorTipo'] . "],";
				
				$total += $item['totalPorTipo'];
		
			}
	
			if($objeto_do_form['tipo'] == 0){
				$data['grafico_1_titulo'] = number_format($total, 0, ',', '.') . ' documentos produzidos entre <br>'.$this->datas->get_date_US_to_BR($objeto_do_form['dataIni']).' e ' . $this->datas->get_date_US_to_BR($objeto_do_form['dataFim']);
			}else{
				$data['grafico_1_titulo'] = number_format($total, 0, ',', '.') . ' documentos do tipo <strong>'.$this->get_nome_tipo_doc($objeto_do_form['tipo']).'</strong> produzidos entre <br>'.$this->datas->get_date_US_to_BR($objeto_do_form['dataIni']).' e ' . $this->datas->get_date_US_to_BR($objeto_do_form['dataFim']);
			}		
		}
		
	
		$data['grafico_1'] = '<div id="grafico1" style="width:600px;height:300px; margin: 0 auto; margin-bottom: 30px;"></div>';
	

/*
|--------------------------------------------------------------------------
| Fim do primeiro grafico
|--------------------------------------------------------------------------
*/
				
/*
|--------------------------------------------------------------------------
| Grafico 2
|--------------------------------------------------------------------------
*/

		$linhas2 = $this->Estat_model->docs_por_tipo_no_periodo_g2($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $objeto_do_form['tipo'], $objeto_do_form['setor']);
		
		$data['grafico_2'] = '';
		$data['grafico_2_titulo'] = "Sem registros";
		$data['grafico_2_dados'] = "";
			
		if(count($linhas2) > 0){
		
			$data['grafico_2_valores_X'] = '';
			
			$data['grafico_2_valores_Y'] = '';
				
			$total = 0;
			
// 			echo "<pre>";
// 			print_r($linhas2);
// 			echo "</pre>";
			
// 			exit;
			
			$meses = array();
			foreach ($linhas2 as $key => $item) {
		
				$data['grafico_2_valores_X'] .= "'". $item['mes'] ."',";
				
				$meses[$key] = $item['mes'];
				
				/*
				$data['grafico_2_valores_Y'] .= "{
										            name: '". $item['nome'] ."',
										            data: [";
				
				 
				
				$total_por_tipo = $this->Estat_model->get_total_mes_tipo($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $item['tipo'] , 0);
				
				
				if(!empty($total_por_tipo)){
					
					$data['grafico_2_valores_Y'] .= $total_por_tipo['0']['totalPorTipo'] .",";
					
				}else{
					
					$data['grafico_2_valores_Y'] .= "0,";
				}
				
				$data['grafico_2_valores_Y'] .= "]},";
				*/
		
				$total += $item['totalPorTipo'];
		
			}
			
			
			$linhas3 = $this->Estat_model->get_tipos_periodo($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $objeto_do_form['setor']);
			
			
			foreach ($linhas3 as $key => $item) {
			

				 $data['grafico_2_valores_Y'] .= "{
				name: '". $item['nome'] ."',
				data: [";

				foreach ($meses as $mes){
					
						//$total_por_tipo = $this->Estat_model->get_total_tipo_datas($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $item['tipo'] , 0);

						$total_por_tipo = $this->Estat_model->get_total_tipo_mes($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $mes, $item['tipo'] , 0);
						
					
						if(!empty($total_por_tipo)){
							
							$data['grafico_2_valores_Y'] .= $total_por_tipo['0']['totalPorTipo'] .",";
							
						}else{
							
							$data['grafico_2_valores_Y'] .= "0,";
						}
				}
			
				$data['grafico_2_valores_Y'] .= "]},";
			
			
				//$total += $total_por_tipo['0']['totalPorTipo'];
			
			}

			
			//$data['grafico_2_valores_Y'] .= ']';
			
			//$data['grafico_2_valores_X'] .= "]";
		
			if($objeto_do_form['tipo'] == 0){
				$data['grafico_2_titulo'] = number_format($total, 0, ',', '.') . ' documentos produzidos entre <br>'.$this->datas->get_date_US_to_BR($objeto_do_form['dataIni']).' e ' . $this->datas->get_date_US_to_BR($objeto_do_form['dataFim']);
			}else{
				$data['grafico_2_titulo'] = number_format($total, 0, ',', '.') . ' documentos do tipo <strong>'.$this->get_nome_tipo_doc($objeto_do_form['tipo']).'</strong> produzidos entre <br>'.$this->datas->get_date_US_to_BR($objeto_do_form['dataIni']).' e ' . $this->datas->get_date_US_to_BR($objeto_do_form['dataFim']);
			}
		}
		
		$data['grafico_2'] = '<div id="grafico2" style="width:800px;height:400px; margin: 0 auto; margin-bottom: 30px;"></div>';

/*
|--------------------------------------------------------------------------
| Fim do grafico 2
|--------------------------------------------------------------------------
*/
		$this->load->view($this->area.'/'.$this->area.'_view', $data);
		
	}


	public function data_to_number($data_brasil){
		
		$array_data = explode('/', $data_brasil);
			
		$numero = $array_data[2].$array_data[1].$array_data[0];
		
		return $numero;
		
	}
	
	public function get_nome_tipo_doc($id_tipo_doc){
	
		$this->load->model('Tipo_model', '', TRUE);
		
		$nome = $this->Tipo_model->get_by_id($id_tipo_doc)->row();
	
		return $nome->nome;
	
	}

}
?>