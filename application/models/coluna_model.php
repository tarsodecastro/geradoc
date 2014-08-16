<?php
class Coluna_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	function Coluna(){
		parent::Model();
	}
	
	function list_all(){
		
		$fields = $this->db->list_fields('documento');
		$fields = array_diff($fields, array('id', 'tipo', 'numero', 'setor', 'cidade', 'data', 'data_criacao', 'destinatario',
				'assunto', 'referencia', 'remetente', 'para', 'dono', 'dono_cpf',
				'cadeado', 'oculto', 'cancelado', 'carimbo'));

		return $fields;
	
	}
	
	function count_all(){
		$fields = self::list_all();
		return count($fields);
	}
	

	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tabela);
	}
        
	function get_by_nome($nome){
		
		$fields = $this->db->field_data('documento');
/*
		echo "<pre>";
		print_r($fields);
		echo "</pre>";
		exit();
		*/
		
		$campo = array();
		foreach ($fields as $field)
		{
		    if($field->name == $nome){
			   	$campo['nome'] = $field->name;
			    $campo['tipo'] = $field->type;
			    $campo['max_length']  = $field->max_length;
			}
		} 

		return $campo;
	}

        function get_qtd_nomes_iguais($nome){
            $sql = "SELECT * FROM ".$this->tabela." WHERE nome LIKE '$nome'";
            return $this->db->query($sql);
            //if ($query->num_rows() > 0)
        }

	function save($objeto){
		
		if($objeto['tamanho'] <= 200){
					$fields = array(
							$objeto['nome'] => array('type' => 'VARCHAR', 'constraint' => $objeto['tamanho'])
					);
				}else{
					$fields = array(
							$objeto['nome'] => array('type' => 'TEXT')
					);
				}
				
		$this->load->dbforge();
				
		return $this->dbforge->add_column('documento', $fields);
	}
	
	function tamanho_maximo($campo){
			
		$this->db->select_max($campo);
		$query = $this->db->get('documento')->row();
		
		return strlen($query->$campo);
	}
	
	function update($objeto){
		
		
		if($objeto['tamanho'] <= 200){
					$fields = array(
							$objeto['nome'] => array('type' => 'VARCHAR', 'constraint' => $objeto['tamanho'])
					);
				}else{
					$fields = array(
							$objeto['nome'] => array('type' => 'TEXT')
					);
				}
				
		$this->load->dbforge();
				
		return $this->dbforge->modify_column('documento', $fields);
	}
	
	function delete($campo){
		$this->load->dbforge();
		$this->dbforge->drop_column('documento', $campo);
	}

	/* -- BUSCA -- 


			public function listAllSearchPag($keyword, $per_page, $offset){
				
			$keyword = $this->getDateSearch($keyword);	
				
			$this->db->select("u.*, s.nome AS setor");
			$this->db->where("u.setor = s.id AND (LOCATE('$keyword', u.nome) > 0
        	   				OR u.matricula = '$keyword' OR u.cpf = '$keyword')");
			$this->db->order_by('u.id','desc');			
			$query = $this->db->get('tb_usuario u, tb_setor s', $per_page, $offset);
	*/

	public function listAllSearchPag($keyword){
				
		$fields = self::list_all();
		
		
		$keyword = $this->getDateSearch($keyword);	
			
		$this->db->select("c.*");
		$this->db->where("(LOCATE('$keyword', c.nome) > 0)");
		$this->db->order_by('c.nome','asc');	
		$query = $this->db->get('coluna c', $per_page, $offset);

		//debug
		//echo $this->db->last_query();
			
		return $query->result();	
	}

	public function count_all_search($keyword){
			$keyword = $this->getDateSearch($keyword);	
				
			$this->db->select("c.*");
			$this->db->where("(LOCATE('$keyword', c.nome) > 0)");
			$this->db->order_by('c.nome','asc');			
			$query = $this->db->get('coluna c');	

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