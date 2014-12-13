<?php
class Estat_model extends CI_Model {

	private $tabela     = 'tb_ocorrencia';

	function lista_todas_por_periodo($periodo = "hoje"){
		
		switch ($periodo) {
			
		    case "hoje":
		        $periodo =  "DATE(d.data_criacao) = DATE(NOW())";
		        break;
		    case "mes":
		        $periodo =  "MONTH(d.data_criacao) = MONTH(NOW())";
		        break;
		    case "ano":
		        $periodo =  "YEAR(d.data_criacao) = YEAR(NOW())";
		        break;
		}
		
		$sql = "SELECT DISTINCT o.id, o.setor, d.tipo, t.nome as tipoOcoNome, o.municipio, o.danos, o.vitimas, d.data_criacao
				FROM tb_ocorrencia as o, tb_tipo as t
				WHERE d.tipo = t.id and $periodo
				ORDER BY o.id desc";
		
		return $this->db->query($sql);
		
	}
	

	
	
	function docs_por_tipo_no_periodo($dataIni, $dataFim){
	
		$sql = "SELECT d.setor, d.tipo, t.nome, d.data_criacao, COUNT(d.id) AS totalPorTipo
				FROM documento as d, tipo as t ";
	
		$sql = $sql . " WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";
	
		$sql = $sql . " GROUP BY d.tipo
						ORDER BY d.data_criacao asc";
		
		$query = $this->db->query($sql)->result_array();
		
		echo $this->db->last_query() . "<br>";
		
		return $query;
	
	}
	


	
 	function get_setor($id){

                $sql = "SELECT s1.*, s2.id, s2.nome as setorPaiNome, s2.sigla as setorPaiSigla 
						FROM tb_setor as s1, tb_setor as s2
						WHERE s1.id = $id and s2.id = s1.setorPai";
                return $this->db->query($sql);
	}

	function get_tipo($id){

                $sql = "SELECT nome
						FROM tipo
						WHERE id = $id";
                return $this->db->query($sql);
	}
	
	public function data_to_number($data){
		
		$pre_array = explode(' ', $data);
	
		$array_data = explode('-', $pre_array[0]);
			
		$numero = $array_data[0].$array_data[1].$array_data[2];
	
		return $numero;
	
	}

}
?>