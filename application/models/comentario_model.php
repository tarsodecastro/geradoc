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
	
	
	function checa_comentario_visto($id_comentario, $id_usuario){
		$this->db->where('id_comentario', $id_comentario);
		$this->db->where('id_usuario', $id_usuario);
		
		return $this->db->get('rel_comentario_usuario');
	}
	
	
	function save_comentario_visto($objeto){
		
		$checa = self::checa_comentario_visto($objeto['id_comentario'], $objeto['id_usuario'])->result();

 		if(count($checa) == 0){
			$this->db->insert('rel_comentario_usuario', $objeto);
 		}

	}


}
?>