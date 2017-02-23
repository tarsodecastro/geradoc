<?php
	class Usuario_model extends CI_Model{

		public function __construct(){        
			parent::__construct(); 
			
		}
		
		private $sistemaId = 4; // Id do sistema de Boletins na tabela sso.tb_sistema
		
		private $tabela= 'usuario';
		
		function list_all(){
			$this->db->order_by('nome','asc');
			return $this->db->get($this->tabela);
		}
		
		function count_all(){
			return $this->db->count_all($this->tabela);
		}
		
		function get_paged_list($limit = 10, $offset = 0){
			$this->db->order_by('nome','asc');
			return $this->db->get($this->tabela, $limit, $offset);
		}
		
		/* -- BUSCA -- */
		public function listAllSearchPag($keyword, $per_page, $offset){
		
			$keyword = $this->getDateSearch($keyword);
				
			$this->db->select("u.*");
			$this->db->where("(LOCATE('$keyword', u.nome) > 0)");
			$this->db->order_by('u.nome','asc');
			$query = $this->db->get('usuario u', $per_page, $offset);
		
			//debug
			//echo $this->db->last_query();
				
			return $query->result();
		}
		
		public function count_all_search($keyword){
			$keyword = $this->getDateSearch($keyword);
		
			$this->db->select("u.*");
			$this->db->where("(LOCATE('$keyword', u.nome) > 0)");
			$this->db->order_by('u.nome','asc');
			$query = $this->db->get('usuario u');
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
		
		function checa_senha($string){
			$this->db->where('senha', $string);
			return $this->db->get($this->tabela);
		}
		
		function updateSenha($id_usuario, $senha){
			$sql = "UPDATE usuario SET senha = '$senha' WHERE usuario.id = $id_usuario";
			return $this->db->query($sql);
		}
		
		function get_by_id($id){
			$this->db->where('id', $id);
			return $this->db->get($this->tabela);
		}
		
		function get_by_cpf($cpf){
			$this->db->where('cpf', $cpf);
			return $this->db->get($this->tabela);
		}
		
		function save($objeto){
			$this->db->insert($this->tabela, $objeto);
			return $this->db->insert_id();
		}
		
		function update($id, $objeto){
			$this->db->where('id', $id);
			$this->db->update($this->tabela, $objeto);
		}
		
		function get_setor($id){
			//$sql = "SELECT s1.*, s2.id, s2.sigla as setorPaiSigla, c.id, c.setor FROM setor as s1, setor as s2, contato as c WHERE s1.id = c.setor and s2.id = s1.setorPai and c.id = $id";
			$sql = "SELECT u.*, s1.id as setorId, s1.sigla, s2.id, s2.sigla as setorPaiSigla FROM usuario as u, setor as s1, setor as s2 WHERE u.id = $id and s1.id = u.setor and s2.id = s1.setorPai";
			//$this->db->order_by('id','asc');
			//$resultQuery = $this->db->get($this->tabela4);
			return $this->db->query($sql);
		}
		
		
		function get_funcionarios_do_setor($setor){
			$this->db->where('setor', $setor);
			return $this->db->get($this->tabela);
		}
		
		
		
		
		
			
	}

?>
