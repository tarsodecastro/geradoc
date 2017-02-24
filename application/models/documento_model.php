<?php
class Documento_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	private $tabela     = 'documento';
	private $tabela2    = 'tipo';
	private $tabela3    = 'contato';
	private $tabela4    = 'setor';

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tabela);
	}
	
	function lista($dono_cpf,$setor=NULL){
		if($setor)
			$sql = "SELECT id, tipo, oculto, cadeado, numero, dono_cpf, assunto, cancelado 
					FROM documento 
					WHERE setor = $setor AND (oculto = 'N' or dono_cpf = '".$dono_cpf."')
					ORDER BY id desc";
		else
			$sql = "SELECT id, tipo, oculto, cadeado, numero, dono_cpf, assunto, cancelado 
					FROM documento 
					WHERE oculto = 'N' or dono_cpf = '".$dono_cpf."'
					ORDER BY id desc";
		return $this->db->query($sql);
	}

	function lista_busca($dono_cpf, $txt_busca){
		$txt_busca = htmlentities($txt_busca);
		$sql = "SELECT id, data_criacao, tipo, oculto, cadeado, numero, dono_cpf, assunto, cancelado 
				FROM documento 
				WHERE para 
				LIKE '%".$txt_busca."%' or redacao LIKE '%".$txt_busca."%' and (oculto = 'N' or dono_cpf = '".$dono_cpf."') 
				ORDER BY id desc";
		// echo $sql;
		return $this->db->query($sql);
	}

	function lista_autocomplete($txt_busca){
		$this->db->distinct();
		
		$this->db->like('para', $txt_busca);
		$this->db->order_by('para', 'desc');
		$this->db->group_by("para");
		$this->db->limit(7);
		return $this->db->get($this->tabela);
	}

	function list_all_tipos(){
		$this->db->order_by('id','asc');
		$resultQuery = $this->db->get($this->tabela2);
		return $resultQuery;
	}

	
	// ANTES DA TABELA TIPO_ANO
	function get_tipo($id){
		$sql = "SELECT t.* FROM tipo as t WHERE t.id = $id";
		return $this->db->query($sql);
	}
	
	
	//--- PESQUISA NA TABELA TIPO_ANO ---//
	function get_inicio_contagem($tipo, $ano){
		$this->db->where('tipo', $tipo);
		$this->db->where('ano', $ano);

		//return $this->db->get('tipo_ano')->row()->inicio;
		
		$query = $this->db->get('tipo_ano');
		
		if($query->num_rows > 0){
			return $query->row()->inicio;
		}else{
			return 1;
		}
		
	}
	//--- FIM ---//

	function get_setor($id){
		$sql = "SELECT c.*, s1.id as setorId, s1.sigla, s2.id, s2.sigla as setorPaiSigla FROM contato as c, setor as s1, setor as s2 WHERE c.id = $id and s1.id = c.setor and s2.id = s1.setorPai";
		return $this->db->query($sql);
	}

	function list_all_contatos(){
		$sql =      "SELECT ";
		$sql = $sql."c.id, c.nome, c.setor, s1.sigla as setorSigla, s2.sigla as setorPai, o.sigla as orgaoSigla ";
		$sql = $sql."FROM ";
		$sql = $sql."contato as c, setor as s1, setor as s2, orgao as o ";
		$sql = $sql."WHERE ";
		$sql = $sql."s1.id = c.setor and s2.id = s1.setorPai and o.id = s1.orgao ";
		$sql = $sql."ORDER BY ";
		$sql = $sql."c.nome ";

		return $this->db->query($sql);
	}

	function list_all_setores(){
		$sql = "SELECT s1.*, o.sigla as orgaoSigla FROM setor as s1, orgao as o WHERE o.id = s1.orgao ORDER BY s1.nome";
		return $this->db->query($sql);
	}

	/*
	function get_ano(){
		$sql = "SELECT YEAR(MAX(data_criacao)) as ultimoAno FROM documento";
		return $this->db->query($sql)->row();
	}
	*/
	
	function get_ano($id_tipo){
		$sql = "SELECT YEAR(MAX(data)) as ultimoAno FROM documento WHERE tipo = $id_tipo ";
		return $this->db->query($sql)->row();
	}
	
	function get_by_tipo_e_ano($tipo, $ano){
		$this->db->where('tipo', $tipo);
		$this->db->where('YEAR(data)', $ano);
		return $this->db->get($this->tabela);
	}

	function proximo_numero($setor, $tipo, $ano){
		//$sql = "SELECT COALESCE(MAX(numero),0)+1 as proximoNumero FROM documento as d WHERE d.setor = $setor and d.tipo = $tipo and YEAR(data_criacao) = $ano";
		$sql = "SELECT COALESCE(MAX(numero),0)+1 as proximoNumero FROM documento as d WHERE d.setor = $setor and d.tipo = $tipo and YEAR(data) = $ano";
		return $this->db->query($sql);
	}

	function list_all_orgaos(){
		$this->db->order_by('id','asc');
		$resultQuery = $this->db->get($this->tabela4);
		return $resultQuery;
	}

	function count_all(){
		return $this->db->count_all($this->tabela);
	}

	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','desc');
		return $this->db->get($this->tabela, $limit, $offset);
	}

	function lista_todos_documentos($inicio = 0, $maximo = 10, $cpf){

		$this->db->order_by('id','desc');
		$this->db->where('oculto =', 'N');
		$this->db->or_where('dono_cpf =', $cpf); 

		return $this->db->get('documento', $maximo, $inicio)->result();
		
	}

	function conta_todos_documentos($cpf){

		$this->db->where('oculto =', 'N');
		$this->db->or_where('dono_cpf =', $cpf); 

		return $this->db->get('documento')->num_rows;
	}

	function lista_documentos_por_setor($inicio = 0, $maximo = 10, $setor, $cpf){
		
		
		$this->db->where('oculto =', 'N');
		$this->db->where('setor =', $setor);
		//$this->db->or_where('dono_cpf =', $cpf);
		$this->db->or_where("(oculto = 'S' AND setor = $setor AND dono_cpf = $cpf)", null, false);
		//$this->db->or_where("(oculto = 'N' AND setor = $setor)", null, false);
		
		$this->db->order_by('id','desc');
		
		return $this->db->get($this->tabela, $maximo, $inicio)->result();

	}

	function conta_documentos_por_setor($setor, $cpf){

		$this->db->where('oculto =', 'N');
		$this->db->where('setor =', $setor);
		//$this->db->or_where('dono_cpf =', $cpf);
		$this->db->or_where("(oculto = 'S' AND setor = $setor AND dono_cpf = $cpf)", null, false);
		//$this->db->or_where("(oculto = 'N' AND setor = $setor)", null, false);
		
		return $this->db->get('documento')->num_rows();

	}

	function get_by_id($id){

		$sql =      "SELECT ";
		$sql = $sql."d.*, t.id as tipoID, t.nome as tipoNome, t.abreviacao as tipoSigla, t.layout as layout, s.nome as setorNome, s.sigla as setorSigla, s.artigo as setorArtigo, o.nome as orgaoNome, o.sigla as orgaoSigla, remet.nome as remetNome, remetCargo.nome as remetCargoNome, remet.assinatura, remetSetor.artigo as remetSetorArtigo, remetSetor.sigla as remetSetorSigla, remetSetor.setorPai as remetSetorPai ";
		$sql = $sql."FROM ";
		$sql = $sql."documento as d, tipo as t, setor as s, orgao as o, contato as remet, cargo as remetCargo, setor as remetSetor ";
		$sql = $sql."WHERE ";
		$sql = $sql."d.id = $id and t.id = d.tipo and s.id = d.setor and o.id = s.orgao and remet.id = d.remetente and remetCargo.id = remet.cargo and remetSetor.id = remet.setor";

		return $this->db->query($sql);
	}
	
	function get_despacho_head($despacho_id){
		$this->db->where('despacho_id',$despacho_id);
		$this->db->limit(1);
		$query = $this->db->get('despacho_head');
		if($query->num_rows() == 1){
			return $query->result_array();
		}
		return NULL;
	}

	function get_by_numero($numero,$tipo,$setor, $ano){
		//$sql = "SELECT id FROM ".$this->tabela." WHERE numero = $numero and tipo = $tipo and setor = $setor";
		$sql = "SELECT id FROM ".$this->tabela." WHERE numero = $numero and tipo = $tipo and setor = $setor and YEAR(data) = $ano";
		return $this->db->query($sql);
	}

	function checa_existencia($stringA, $stringB, $stringC){
		$sql = "SELECT COUNT(*) FROM ".$this->tabela." WHERE numero = $stringA and setor = $stringB and tipo = $stringC";
		return $this->db->query($sql);
	}

	function save($objeto){
		if($objeto['tipo'] == 3 or $objeto['tipo'] == 5){
			$despacho['num_processo']	= $this->input->post('desp_num_processo');
			$despacho['interessado']	= $this->input->post('desp_interessado');
			//$despacho['de']				= $this->input->post('desp_de');
			//$despacho['para']			= $this->input->post('desp_para');
			$despacho['de']				= $this->input->post('campoSetor');
			$despacho['para']			= $this->input->post('campoPara');
		}
		$this->db->trans_start();
		$this->db->insert($this->tabela, $objeto);
		$id = $this->db->insert_id();
		if($objeto['tipo'] == 3 or $objeto['tipo'] == 5){
			$despacho['despacho_id'] = $id;
			$this->db->insert('despacho_head',$despacho);
		}
		$this->db->trans_complete();
		return $id;
	}

	function update($id, $objeto){

		if(isset($objeto['numero']))
			unset($objeto['numero']);

		if(array_key_exists('tipo', $objeto)){ //Tarso: pequena POG para testar se a chave "tipo" está presente no array objeto, acho que o Bruno queria utilizar tipoID lá do get_by_id
			if($objeto['tipo'] == 3 or $objeto['tipo'] == 5){
				$despacho['num_processo']	= $this->input->post('desp_num_processo');
				$despacho['interessado']	= $this->input->post('desp_interessado');
				//$despacho['de']				= $this->input->post('desp_de');
				//$despacho['para']			= $this->input->post('desp_para');
				$despacho['de']				= $this->input->post('campoSetor');
				$despacho['para']			= $this->input->post('campoPara');
			}
		}

		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update($this->tabela, $objeto);
		if(array_key_exists('tipo', $objeto)){
		if($objeto['tipo'] == 3 or $objeto['tipo'] == 5){
			$this->db->where('despacho_id', $id);
			$this->db->update('despacho_head',$despacho);
		}
		}
		$this->db->trans_complete();
		
		//$this->history_save($id, $objeto);
	}
	
	function history_save($id, $texto){
		
		$objeto['id_documento'] = $id;
		$objeto['data'] = date("Y-m-d H:i:s");
		$objeto['texto'] = $texto;
		
		
		$this->db->trans_start();
		
			$qtd = $this->conta_historico($id);
			
			if($qtd > 3){ // mantem 4 versoes
					
				$antigo = $this->get_historico_antigo($id);
	
				$this->delete_historico($antigo->id_historico);
					
			}
			
			$this->db->insert('historico', $objeto);
			$id = $this->db->insert_id();
		
		$this->db->trans_complete();
		
		return $id;
	}
	
	function conta_historico($id_documento){
	
		$this->db->where('id_documento =', $id_documento);
	
		return $this->db->get('historico')->num_rows;
	}
	
	function get_historico($id_documento){
		
		$this->db->where('id_documento =', $id_documento);
		$this->db->order_by('id_historico','desc');
		return $this->db->get('historico');
		
	}
	
	function get_historico_antigo($id_documento){
	
		$this->db->select('id_historico, id_documento');
		$this->db->where('id_documento =', $id_documento);
		
		$this->db->order_by('id_historico','asc');
	
		return $this->db->get('historico')->row();
	}
	
	function delete_historico($id_historico){
		$this->db->where('id_historico', $id_historico);
		$this->db->delete('historico');
	}
	

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tabela);
	}
	
	function check_workflow($id_setor_destino){
	
		$this->db->where('id_setor_destino', $id_setor_destino);
		$this->db->where('data_recebimento', null);
		$this->db->order_by('id_workflow','desc');
		return $this->db->get('workflow');
	
	}


	/* -- BUSCA -- */
	public function listAllSearchPag($keyword, $maximo, $inicio, $cpf, $setor = 0){
				
		$keyword = $this->getDateSearch($keyword);	
			
		$jogodavelha = stripos($keyword, "#");
		
		if ($jogodavelha === false) {
			$this->db->select("d.*");
			if($setor > 0){
				$this->db->where('setor', $setor);
			}
			$this->db->where("(LOCATE ('$keyword', d.redacao) > 0
			OR LOCATE ('$keyword', d.para) > 0
			OR LOCATE ('$keyword', d.numero) > 0
			OR LOCATE ('$keyword', d.assunto) > 0
			OR d.data = '$keyword'
			OR LOCATE ('$keyword', d.dono) > 0)
			AND d.oculto = 'N'");
			$this->db->or_where("(LOCATE ('$keyword', d.redacao) > 0
			OR LOCATE ('$keyword', d.para) > 0
			OR LOCATE ('$keyword', d.numero) > 0
			OR LOCATE ('$keyword', d.assunto) > 0
			OR d.data = '$keyword'
			OR LOCATE ('$keyword', d.dono) > 0)
			AND d.dono_cpf = '$cpf'");
			
		}else{
			
			$keyword = str_replace("#", "", $keyword);
			$this->db->select("d.*");
			$this->db->where("d.numero = $keyword AND d.oculto = 'N'");
		}
		
		//$this->db->where("(LOCATE('$keyword', d.redacao) > 0)");
		$this->db->order_by('d.id','desc');	
		$query = $this->db->get('documento d', $maximo, $inicio);
			
		return $query->result();	
	}

	public function count_all_search($keyword, $cpf, $setor = 0){
		
		$keyword = $this->getDateSearch($keyword);	
					
		$jogodavelha = stripos($keyword, "#");
		
		if ($jogodavelha === false) {
			$this->db->select("d.*");
			if($setor > 0){
				$this->db->where('setor', $setor);
			}
			$this->db->where("(LOCATE ('$keyword', d.redacao) > 0
			OR LOCATE ('$keyword', d.para) > 0
			OR LOCATE ('$keyword', d.numero) > 0
			OR LOCATE ('$keyword', d.assunto) > 0
			OR d.data = '$keyword'
			OR LOCATE ('$keyword', d.dono) > 0)
			AND d.oculto = 'N'");
			$this->db->or_where("(LOCATE ('$keyword', d.redacao) > 0
			OR LOCATE ('$keyword', d.para) > 0
			OR LOCATE ('$keyword', d.numero) > 0
			OR LOCATE ('$keyword', d.assunto) > 0
			OR d.data = '$keyword'
			OR LOCATE ('$keyword', d.dono) > 0)
			AND d.dono_cpf = '$cpf'");
			
		}else{
			
			$keyword = str_replace("#", "", $keyword);
			$this->db->select("d.*");
			$this->db->where("d.numero = $keyword AND d.oculto = 'N'");
		}
			
			$query = $this->db->get('documento d');	

			return $query->num_rows();					
	}  

	private function getDateSearch($keyword){
		/*
		 * Verifica se a keyword é uma data e converte para o formato US
		 */			
		$keyword = trim($keyword);			
		
		$pos =	strpos($keyword,"/");
	
		if ($pos > 1 && strlen($keyword) == 10){			
			$dt = explode("/", $keyword); 
			$d = $dt[0];
			$m = $dt[1];
			$y = $dt[2];			
			$res = checkdate($m,$d,$y);									
			$res = ($res == 1) ? TRUE : FALSE;				
			if ($res == 1){
				$a = explode('/', $keyword);
				$keyword = $a[2].'-'.$a[1].'-'.$a[0];
				return $keyword;
			} 
		} else {
			return $keyword;
		}		
			
	}
	/* -- FIM DA BUSCA -- */


}
?>
