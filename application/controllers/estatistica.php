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
| Popula os campos do formulario com valores inicais
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

		$data['erro'] = '';
		if($this->data_to_number($objeto_do_form['dataIni']) > $this->data_to_number($objeto_do_form['dataFim'])){
				
			$data['erro'] =  '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-2x"></i> <br> A data inicial informada é maior que a data final!</div>';
				
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
		
		//echo $this->db->last_query();

		$data['grafico_2_dados'] = "	{
									            name: 'Tokyo',
									            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
									        },
					
									        {
									            name: 'New York',
									            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
									        },
					
									        {
									            name: 'Berlin',
									            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
									        },
					
									        {
									            name: 'London',
									            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
									        }";

		$data['grafico_2_valores_eixo_x'] = '';
		
		$data['grafico_2_valores_eixo_y'] = '';
		
		$dias_com_registro = $this->Estat_model->dias_com_registro($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $data['tipoSelecionado'])->result();
		
		
// 		echo "<pre>";
// 		print_r($dias_com_registro);
// 		echo "/<pre>";
		
		foreach ($dias_com_registro as $dia){
			
			$data['grafico_2_valores_eixo_y'] .= "{
										            name: '".$this->get_nome_tipo_doc($dia->tipo)."',
										             data: [";
			
					foreach ($objs_g1 as $key => $obj_g1) {

							$data['grafico_2_valores_eixo_x'] .= "'".$this->datas->getDiaMesUS($obj_g1->data_criacao) . "',";							
							
							if($obj_g1->tipo == $dia->tipo){
								
								$data['grafico_2_valores_eixo_y'] .= $obj_g1->totalPorData.",";
							}
				
					}
			
			$data['grafico_2_valores_eixo_y'] .= "]},";
			
		}
		
		$Qtd = $this->Estat_model->conta_doc_por_periodo($objeto_do_form['dataIni'], $objeto_do_form['dataFim'], $data['tipoSelecionado'])->row()->total;

		if($data['tipoSelecionado'] == 0){
			
			$Qtd = $nombre_format_francais = number_format($Qtd, 0, '', '.');
			
			$graph_1_titulo = $Qtd . " registros entre: <br>";
			

		}else{

			$nomeDoc = $this->Estat_model->get_tipo($data['tipoSelecionado'])->row()->nome;

			$graph_1_titulo = $Qtd . " registros do tipo " . $nomeDoc . " entre: <br>";

		}

		$graph_1_titulo = $graph_1_titulo . $this->datas->datetimeToBR($objeto_do_form['dataIni']) . ' e ' . $this->datas->datetimeToBR($objeto_do_form['dataFim']);

		$data['grafico_2_titulo'] = $graph_1_titulo;


/*
|--------------------------------------------------------------------------
| Monta o segundo grafico
|--------------------------------------------------------------------------
*/
		$objs_g2 = $this->Estat_model->qtd_doc_por_periodo($objeto_do_form['dataIni'], $objeto_do_form['dataFim'])->result();

		$data['grafico_1_dados'] = "";
		
		$data['grafico_1_titulo'] = 'Documentos produzidos entre '.$this->datas->get_date_US_to_BR($objeto_do_form['dataIni']).' e ' . $this->datas->get_date_US_to_BR($objeto_do_form['dataFim']);
			
		if($objs_g2){
			
			$data['grafico_1_dados'] = '';
			
			foreach ($objs_g2 as $key => $obj_2) {
			
				$xdata2[$key] = $obj_2->nome;
				$ydata2[$key] = $obj_2->totalPorData;
	
				$data['grafico_1_dados'] .= "['". $obj_2->nome ."',". $obj_2->totalPorData . "],";

			}

		}
		
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