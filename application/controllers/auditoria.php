<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auditoria extends CI_Controller {
	
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
	
    private $area = "auditoria";
        
	public function __construct (){
		parent::__construct();	
		$this->load->library(array('restrict_page','table','form_validation','session'));
		$this->load->helper('url');
		$this->load->model('Campo_model','',TRUE);
		$this->load->model('Auditoria_model','',TRUE);
        $this->load->model('Grid_model','',TRUE);
        $this->modal = $this->load->view('about_modal', '', TRUE);
        session_start();
	}

	public function index($offset = 0){
		
		$this->js[] = 'auditoria';
		
		$data['titulo']     = 'Auditoria';
		$data['link_add']   = null;
		
		$data['link_back']  = anchor('documento/index/','Lista de Documentos',array('class'=>'back'));
		$data['form_action'] = site_url($this->area.'/search');
		
		// BUSCA
		$data['keyword_'.$this->area] = '';
		if(isset($_SESSION['keyword_'.$this->area]) == true and $_SESSION['keyword_'.$this->area] != null){
			$data['keyword_'.$this->area] = $_SESSION['keyword_'.$this->area];
			redirect($this->area.'/search/');
		}else{
			$data['keyword_'.$this->area] = 'pesquisa textual';
			$data['link_search_cancel'] = '';
		}
		// FIM DA BUSCA
		
		//Inicio da Paginacao
        $this->load->library('pagination');
        $maximo = 20;
        $uri_segment = 3;
        $inicio = (!$this->uri->segment($uri_segment, 0)) ? 0 : ($this->uri->segment($uri_segment, 0) - 1) * $maximo;
        $_SESSION['novoinicio'] = $this->uri->segment($uri_segment - 1, 'index').'/'.$this->uri->segment($uri_segment, 0);  //cria uma variavel de sessao para retornar a pagina correta apos visualizacao, delecao ou alteracao
        $config['base_url'] = site_url($this->area.'/index/');
        $config['total_rows'] = $this->Auditoria_model->count_all();
        $config['per_page'] = $maximo;

        $this->pagination->initialize($config);

        // load datas
        $objetos = $this->Auditoria_model->get_paged_list($maximo, $inicio);
        
        // carregando os dados na tabela
        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $this->table->set_heading('Item', 'Data', 'Usuário', 'URL', 'Ações');
        $this->load->model('Usuario_model','',TRUE);
        foreach ($objetos as $objeto){
            $this->table->add_row($objeto->id, $objeto->data, $this->Usuario_model->get_by_id($objeto->usuario)->row()->nome, $objeto->url,
            		
            		'<div class="btn-group">'.
            		$this->Campo_model->make_link($this->area, 'visualizar', $objeto->id).
            		'</div>'
            		
                //anchor($this->area.'/view/'.$objeto->id,'visualizar',array('class'=>'view'))
                //anchor($this->area.'/update/'.$objeto->id,'alterar',array('class'=>'update'))
              //  anchor($this->area.'/delete/'.$objeto->id,'deletar',array('class'=>'delete','onclick'=>"return confirm('Deseja REALMENTE deletar esse orgao?')"))
            );
        }

        //Monta a DataTable
        $tmpl = $this->Grid_model->monta_tabela_list();
        $this->table->set_template($tmpl);
        // Fim da DataTable

        $data['table'] = $this->table->generate();
        $data["total_rows"] = $config['total_rows'];
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view($this->area.'/'.$this->area.'_list', $data);

	}
	
	
	function view($id){
	
		$data['titulo'] = 'Detalhes do registro';
	
		$data['message'] = '';
	
		$data['link_back'] = anchor($this->area.'/index','Voltar',array('class'=>'back'));
	
		$data['objeto'] = $this->Auditoria_model->get_by_id($id)->row();
		
		$this->load->model('Usuario_model','',TRUE);
		$data['usuario_nome'] = $this->Usuario_model->get_by_id($data['objeto']->usuario)->row()->nome;
	
		$this->load->view($this->area.'/'.$this->area.'_view', $data);
	
	}
	
	public function search($page = 1) {
		$this->js[] = 'auditoria';
		$data['titulo'] = "Auditoria";
		$data['link_add']   = null;
		$data['link_search_cancel'] = $this->Campo_model->make_link($this->area, 'search_cancel');
		$data['form_action'] = site_url($this->area.'/search');
	
		$this->load->library(array('pagination', 'table'));
	
		if(isset($_SESSION['keyword_'.$this->area]) == true and $_SESSION['keyword_'.$this->area] != null and $this->input->post('search') == null){
			$keyword = $_SESSION['keyword_'.$this->area];
		}else{
			 
			$keyword = ($this->input->post('search') == null or $this->input->post('search') == "pesquisa textual") ? redirect($this->area.'/index/') : $this->input->post('search');
			$_SESSION['keyword_'.$this->area] = $keyword;
			 
		}
	
		$maximo = 10;
		$uri_segment = 3;
		$_SESSION['novoinicio'] = $this->uri->segment($uri_segment - 1, 0).'/'.$this->uri->segment($uri_segment, 0);
		$config['per_page'] = $maximo;
		$config['base_url'] = site_url($this->area.'/search');
		$config['total_rows'] = $this->Auditoria_model->count_all_search($keyword);
	
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Item', 'Data', 'Usuário', 'URL', 'Ações');
	
		$inicio = (!$this->uri->segment($uri_segment, 0)) ? 0 : ($this->uri->segment($uri_segment, 0) - 1) * $maximo;
	
		$rows = $this->Auditoria_model->listAllSearchPag($keyword, $maximo, $inicio);
	
		foreach ($rows as $o){
	
			$this->table->add_row($o->id, $o->data, $o->usuario_nome, $o->url,
					'<div class="btn-group">'.
					$this->Campo_model->make_link($this->area, 'visualizar', $o->id).
					'</div>'
					//anchor($this->area.'/view/'.$o->id,'visualizar',array('class'=>'view'))
					//anchor($this->area.'/update/'.$o->id,'alterar',array('class'=>'update'))
					//  anchor($this->area.'/delete/'.$objeto->id,'deletar',array('class'=>'delete','onclick'=>"return confirm('Deseja REALMENTE deletar esse orgao?')"))
			);
	
		}
	
		//Monta a DataTable
		$tmpl = $this->Grid_model->monta_tabela_list();
		$this->table->set_template($tmpl);
		// Fim da DataTable
	
		$data['table'] = $this->table->generate();
		$data['total_rows'] = $config['total_rows'];
		$data['keyword_'.$this->area] = $keyword;
	
		$this->load->view($this->area.'/'.$this->area.'_list', $data);
	
	}
	
	public function search_cancel() {
	
		$_SESSION['keyword_'.$this->area] = null;
	
		redirect($this->area.'/index/');
	
	}
	

	// date_validation callback
	function valid_date($str){
		if(!preg_match('^(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-([0-9]{4})$^', $str))
		{
			$this->validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
			return false;
		}
		else
		{
			return true;
		}
	}
}
?>