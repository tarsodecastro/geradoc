<?php
class Contato_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
			
	}
	
	private $tabela     = 'contato';
    private $tabela2    = 'cargo';
    private $tabela3    = 'setor';
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tabela);
	}
	
	function list_all_actives($setor = 0){
		if($setor > 0){
			$this->db->where('setor', $setor);
		}
		$this->db->where('status', 'A');
		$this->db->order_by('nome','asc');
		return $this->db->get($this->tabela);
	}

        function list_all_cargos(){
                $this->db->order_by('id','asc');
                $resultQuery = $this->db->get($this->tabela2);
                return $resultQuery;
	}

        function list_all_setores(){
                $this->db->order_by('id','asc');
                $resultQuery = $this->db->get($this->tabela3);
                return $resultQuery;
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

                $sql = "SELECT c.*, ca.nome as cargoNome, s.nome as setorNome, o.nome as orgaoNome FROM contato as c, cargo as ca, setor as s, orgao as o WHERE c.id = $id and ca.id = c.cargo and s.id = c.setor and o.id = s.orgao";
                
                return $this->db->query($sql);
	}

	function get_by_nome($nome){
		$this->db->where('nome', $nome);
		return $this->db->get($this->tabela);
	}

        function get_qtd_nomes_iguais($nome){
            $sql = "SELECT * FROM ".$this->tabela." WHERE nome LIKE '$nome'";
            return $this->db->query($sql);
            //if ($query->num_rows() > 0)
        }

	function save($objeto){
		$this->db->insert($this->tabela, $objeto);
		return $this->db->insert_id();
	}
	
	function update($id, $objeto){
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
			
		$this->db->select("c.*");
		$this->db->where("(LOCATE('$keyword', c.nome) > 0)");
		$this->db->order_by('c.nome','asc');	
		$query = $this->db->get('contato c', $per_page, $offset);

		//debug
		//echo $this->db->last_query();
			
		return $query->result();	
	}

	public function count_all_search($keyword){
			$keyword = $this->getDateSearch($keyword);	
				
			$this->db->select("c.*");
			$this->db->where("(LOCATE('$keyword', c.nome) > 0)");
			$this->db->order_by('c.nome','asc');			
			$query = $this->db->get('contato c');	

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