<?php
class Comentario_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	private $tabela= 'comentario';
	
	function Comentario(){
		parent::Model();
	}
	
	function list_all(){
		$this->db->order_by('data','desc');
		return $this->db->get($this->tabela);
	}
	
	function lista_comentarios_por_documento($id_doc){
		$this->db->where('id_documento', $id_doc);
		$this->db->order_by('data','desc');
		return $this->db->get($this->tabela);
	}
	
	function count_all(){
		return $this->db->count_all($this->tabela);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
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
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tabela);
	}


}
?>