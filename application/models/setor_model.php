<?php
class Setor_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	private $tabela = 'setor';
        private $tabela2 = 'orgao';
	
	function Setor(){
		parent::Model();
	}
	
	function list_all(){
		$this->db->order_by('nome','asc');
		return $this->db->get($this->tabela);
	}
	
	function list_funcionarios($setor){
		
		$this->db->like('setor', $setor);
		
		$this->db->or_like('setores', $setor);
		
		$this->db->or_like('setores', $setor.';');
		
		$this->db->or_like('setores', ';'.$setor.';');
		
		$this->db->order_by('nome','asc');
		
		$query = $this->db->get('usuario');
		
		//echo $this->db->last_query();
		
		return $query;
	}
	
	function get_setor_by_dono($dono){
			$this->db->where('dono', $dono);
			$this->db->order_by('nome','asc');
		return $this->db->get($this->tabela);
	}
	
	function get_nome_dono($dono){
		$this->db->where('id', $dono);
		return $this->db->get('usuario');
	}
	
	function get_all_id_and_name(){
		$this->db->order_by('nome','asc');
		$this->db->select('id, nome');
		return $this->db->get($this->tabela);
	}

        function list_all_orgaos(){
                $this->db->order_by('nome','asc');
                $queryPostos = $this->db->get($this->tabela2);
                return $queryPostos;
	}
	
	function count_all(){
		return $this->db->count_all($this->tabela);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('nome','asc');
		return $this->db->get($this->tabela, $limit, $offset);
	}

        /*
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tabela);
	}
        */
        function get_by_id($id){

   	
        	/*
        	$sql = "SELECT s1.*, s2.id, s2.nome as setorPaiNome, s2.sigla as setorPaiSigla, o.sigla as orgaoSigla
        	FROM setor as s1, setor as s2, orgao as o
        	WHERE s1.id = $id and o.id = s1.orgao and s2.id = s1.setorPai
        	GROUP BY s1.id";
        	*/
        	
        	
        	$this->db->select('s1.*, s2.id, s2.nome as setorPaiNome, s2.sigla as setorPaiSigla, o.sigla as orgaoSigla');
        	$this->db->where('s1.id', $id);
        	$this->db->where('o.id = s1.orgao');
        	$this->db->where('s2.id = s1.setorPai');
        	
        	$this->db->from('setor as s1, setor as s2, orgao as o');
        	
        	$this->db->group_by('s1.id');
        	
        	$query = $this->db->get();
        	
        //	echo $this->db->last_query();
        	

        	//return $this->db->query($sql);
        	
        	return $query;
        	
        	
	}

	function get_by_nome($nome, $orgao){
		$this->db->where('nome', $nome);
		$this->db->where('orgao', $orgao);
		return $this->db->get($this->tabela);
	}

        function get_qtd_nomes_iguais($nome){
            $sql = "SELECT * FROM ".$this->tabela." WHERE nome LIKE '$nome'";
            return $this->db->query($sql);
            //if ($query->num_rows() > 0)
        }

	function save($objeto){

		foreach ($objeto as $key => $value) {
			$objeto[$key] = trim($value);
		}

		$this->db->insert($this->tabela, $objeto);
		return $this->db->insert_id();
	}
	
	
	function funcionario_permissao($objeto){

		$this->db->where('setor', $objeto['setor']);
		$this->db->where('usuario', $objeto['usuario']);
		$this->db->delete('setor_func_per');
	
		$this->db->insert('setor_func_per', $objeto);
		//return $this->db->insert_id();
	}
	
	function get_permissao($setor, $usuario){
		
		$this->db->where('setor', $setor);
		$this->db->where('usuario', $usuario);
		return $this->db->get('setor_func_per');
		
	}
	
	function update($id, $objeto){
		
		foreach ($objeto as $key => $value) {
			$objeto[$key] = trim($value);
		}

		$this->db->where('id', $id);
		$this->db->update($this->tabela, $objeto);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tabela);
	}

	/* -- BUSCA -- */
	public function listAllSearchPag($keyword, $per_page, $offset){
				
		$keyword = $this->getDateSearch($keyword);	
			
		$this->db->select("s.*");
		$this->db->where("(LOCATE('$keyword', s.nome) > 0)");
		$this->db->or_where("(LOCATE('$keyword', s.sigla) > 0)");
		$this->db->order_by('s.nome','asc');	
		$query = $this->db->get('setor s', $per_page, $offset);

		//debug
		//echo $this->db->last_query();
			
		return $query->result();	
	}

	public function count_all_search($keyword){
			$keyword = $this->getDateSearch($keyword);	
				
			$this->db->select("s.*");
			$this->db->where("(LOCATE('$keyword', s.nome) > 0)");
			$this->db->or_where("(LOCATE('$keyword', s.sigla) > 0)");
			$this->db->order_by('s.nome','asc');			
			$query = $this->db->get('setor s');		
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