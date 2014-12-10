<?php
class Workflow_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	private $tabela     = 'documento';
		
	function get_workflows($id_setor_destino){
	
		$this->db->where('id_setor_destino =', $id_setor_destino);
		$this->db->order_by('id_workflow','desc');
		return $this->db->get('workflow');
	
	}
	
	function get_workflows_paged_list($id_setor_destino, $limit = 10, $offset = 0){
	
		$this->db->where('id_setor_destino =', $id_setor_destino);
		$this->db->order_by('id_workflow','desc');
		return $this->db->get('workflow', 10, $offset)->result();
	
	}

	function set_workflow($obj){
	
		$this->db->trans_start();

			$this->db->insert('workflow', $obj);
			$id = $this->db->insert_id();
		
		$this->db->trans_complete();
		
		return $id;
	}
	
	function list_workflow($id_documento){
		$this->db->where('id_documento', $id_documento);
		$this->db->order_by('id_workflow','desc');
		return $this->db->get('workflow');
	}

	public function listAllSearchPag($keyword, $per_page, $offset, $id_setor){
	
		$keyword = $this->getDateSearch($keyword);
			
		$this->db->select("w.*");
		
		$this->db->where('w.id_documento = d.id');
		
		$this->db->where('w.id_setor_destino =', $id_setor);

		$this->db->where("(LOCATE ('$keyword', d.redacao) > 0
			OR LOCATE ('$keyword', d.para) > 0
			OR LOCATE ('$keyword', d.numero) > 0
			OR LOCATE ('$keyword', d.assunto) > 0
			OR LOCATE ('$keyword', w.data_envio) > 0
			OR LOCATE ('$keyword', d.dono) > 0)
			AND d.oculto = 'N'");
		
		$this->db->order_by('w.id_workflow','desc');
		
		$query = $this->db->get('workflow w, documento d', $per_page, $offset);
		
		//echo $this->db->last_query();

		return $query->result();
	}
	
	
	public function count_all_search($keyword, $id_setor){
		
		$keyword = $this->getDateSearch($keyword);
	
		$this->db->select("w.*");
		
		$this->db->where('w.id_documento = d.id');
		
		$this->db->where('w.id_setor_destino =', $id_setor);
		
		$this->db->where("(LOCATE ('$keyword', d.redacao) > 0
			OR LOCATE ('$keyword', d.para) > 0
			OR LOCATE ('$keyword', d.numero) > 0
			OR LOCATE ('$keyword', d.assunto) > 0
			OR LOCATE ('$keyword', w.data_envio) > 0
			OR LOCATE ('$keyword', d.dono) > 0)
			AND d.oculto = 'N'");

		$this->db->order_by('w.id_workflow','desc');
		
		$query = $this->db->get('workflow w, documento d');
	
		return $query->num_rows();
	}
	
	function workflow_update($id, $objeto){

		$this->db->where('id_workflow =', $id);
		$this->db->update('workflow', $objeto);

	}
	
	function workflow_delete($id){
		$this->db->where('id_workflow', $id);
		$this->db->delete('workflow');
	}
	
	function check_workflow($id_setor_destino){
	
		$this->db->where('id_setor_destino', $id_setor_destino);
		$this->db->where('data_recebimento', null);
		$this->db->order_by('id_workflow','desc');
		return $this->db->get('workflow');
	
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
	
	
	function save($obj){
	
		$this->db->trans_start();
	
		$this->db->insert('workflow', $obj);
		$id = $this->db->insert_id();
	
		$this->db->trans_complete();
	
		return $id;
	}

	function update($id, $objeto){
	
		$this->db->where('id_workflow =', $id);
		$this->db->update('workflow', $objeto);
	
	}
	
	function delete($id){
		$this->db->where('id_workflow', $id);
		$this->db->delete('workflow');
	}
	
	

}
?>
