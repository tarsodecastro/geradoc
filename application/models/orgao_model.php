<?php
class Orgao_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	private $sistemaId    = 4; // Id do sistema de Boletins na tabela sso.tb_sistema
	
	private $tabela= 'orgao';
	
	function Orgao(){
		parent::Model();
	}
	
	function list_all(){
		$this->db->order_by('nome','asc');
		return $this->db->get($tabela);
	}
	
	function count_all(){
		return $this->db->count_all($this->tabela);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('nome','asc');
		return $this->db->get($this->tabela, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tabela);
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
			
		$this->db->select("o.* ");
		$this->db->where("(LOCATE('$keyword', o.nome) > 0)");
		$this->db->or_where("(LOCATE('$keyword', o.sigla) > 0)");
		$this->db->or_where("(LOCATE('$keyword', o.endereco) > 0)");
		$this->db->order_by('o.nome','asc');	
		$query = $this->db->get('orgao o', $per_page, $offset);

		//debug
		//echo $this->db->last_query();
			
		return $query->result();	
	}

	public function count_all_search($keyword){
			$keyword = $this->getDateSearch($keyword);	
				
			$this->db->select("o.*");
			$this->db->where("(LOCATE('$keyword', o.nome) > 0)");
			$this->db->order_by('o.nome','asc');			
			$query = $this->db->get('orgao o');	

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