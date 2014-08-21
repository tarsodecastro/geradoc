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
| Popula os campos com valores inicais
|--------------------------------------------------------------------------
*/

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

		$objeto_do_form['dataIni']			= $this->datas->dateToUS($objeto_do_form['dataIni']) . ' 00:00:00';
		$objeto_do_form['dataFim'] 			= $this->datas->dateToUS($objeto_do_form['dataFim']) . ' 23:59:59';
			
/*
|--------------------------------------------------------------------------
| Monta o primeiro grafico
|--------------------------------------------------------------------------
*/
		
		$ydataG1[0] = 0;
		$ydataG1[1] = 0;
		$xdataG1[0] = 0;
		$xdataG1[1] = 0;

		$objs_g1 = $this->Estat_model->doc_por_periodo($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $data['tipoSelecionado'])->result();
		
		

		foreach ($objs_g1 as $key => $obj_g1) {

			$ydataG1[$key] = $obj_g1->totalPorData;
			$xdataG1[$key] = $this->datas->getDiaMesUS($obj_g1->data_criacao);

		}

		$Qtd = $this->Estat_model->conta_doc_por_periodo($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $data['tipoSelecionado'])->row()->total;

		if($data['tipoSelecionado'] == 0){
			$graph_1_titulo = $Qtd . " registros no período: \n";

		}else{

			$nomeDoc = $this->Estat_model->get_tipo($data['tipoSelecionado'])->row()->nome;

			$graph_1_titulo = $Qtd . " registros do tipo " . $nomeDoc . " no período: \n";

		}

		$graph_1_titulo = $graph_1_titulo . $this->datas->datetimeToBR($objeto_do_form['dataIni']) . ' à ' . $this->datas->datetimeToBR($objeto_do_form['dataFim']);

		$graph_1 = $this->jpgraph->barchart($xdataG1, $ydataG1, $graph_1_titulo);
		
		$data['grafico1'] = 'images/error.png';
		
		if($graph_1 and $ydataG1[0] > 0){

				$graph_1_name = 'grafico_oco_periodo.png';
	
				$graph_1_location = $graph_temp_directory . '/' . $graph_1_name;
	
				$graph_1->Stroke('./'.$graph_1_location);  // create the graph and write to file
	
				$data['grafico1'] = $graph_1_location;
	
				$graph_1->xaxis->SetTickLabels("teste");

		}
		
/*
|--------------------------------------------------------------------------
| Monta o segundo grafico
|--------------------------------------------------------------------------
*/
		$objs_g2 = $this->Estat_model->qtd_doc_por_periodo($objeto_do_form['dataIni'], $objeto_do_form['dataFim'])->result();
		
		//echo $this->db->last_query();
		
		// $ydata2[0] = 0;
		// $xdata2[0] = 0;
		
		$graph_temp_directory = 'temp';
		
		$data['graph'] = 'images/error.png';
		
		if($objs_g2){
			
		
			foreach ($objs_g2 as $key => $obj_2) {
			
				$xdata2[$key] = $obj_2->nome;
				$ydata2[$key] = $obj_2->totalPorData;
			}

			if($ydata2[0] > 0){
			
				$graph = $this->jpgraph->piechart($xdata2, $ydata2, 'Documentos produzidos entre '.$this->datas->get_date_US_to_BR($objeto_do_form['dataIni']).' e ' . $this->datas->get_date_US_to_BR($objeto_do_form['dataFim']));
			
				$graph_file_name = 'grafico_doc_setor.png';
			
				$graph_file_location = $graph_temp_directory . '/' . $graph_file_name;
			
				$graph->Stroke('./'.$graph_file_location);  // create the graph and write to file
				 
				$data['graph'] = $graph_file_location;
			
			}
		}
		
		
		$this->load->view($this->area.'/'.$this->area.'_view', $data);

	}


	function view($id){

		$data['titulo'] = 'Detalhes do relatorio';

		$data['message'] = '';

		$data['link_back'] = anchor($this->area.'/'.$_SESSION['novoinicio'],'<span class="glyphicon glyphicon-arrow-left"></span> Voltar',array('class'=>'btn btn-warning btn-sm'));

		$this->load->view($this->area.'/'.$this->area.'_view', $data);

	}

}
?>