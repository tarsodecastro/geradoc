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
	
	function lista_todas_por_todos($dataIni, $dataFim){

		$sql = "SELECT DISTINCT o.setor, COUNT(DISTINCT o.id) AS totalPorSetor, d.data_criacao
				FROM tb_ocorrencia as o, tb_tipo as t
				WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim'
				GROUP BY o.setor 
				ORDER BY totalPorSetor desc";
		
		//echo "<br>lista_todas_por_todos<br> " . $sql;
		
		return $this->db->query($sql);
		
	}
	
	function lista_todas_por_municipio($dataIni, $dataFim, $municipio){

		$sql = "SELECT DISTINCT o.setor, COUNT(DISTINCT o.id) AS totalPorSetor, d.data_criacao
				FROM tb_ocorrencia as o, tb_tipo as t
				WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' and o.municipio = '$municipio'
				GROUP BY o.setor 
				ORDER BY totalPorSetor desc";
		
		//echo "<br>lista_todas_por_municipio<br> " . $sql;
		
		return $this->db->query($sql);
		
	}
	
	function lista_oco_por_todos($dataIni, $dataFim, $tipo){

		$sql = "SELECT DISTINCT o.setor, COUNT(DISTINCT o.id) AS totalPorSetor, d.data_criacao
				FROM tb_ocorrencia as o, tb_tipo as t
				WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim'  and d.tipo = '$tipo'
				GROUP BY o.setor 
				ORDER BY totalPorSetor desc";
		
		//echo "<br>lista_oco_por_todos<br> " . $sql;
		
		return $this->db->query($sql);
		
	}
	
	function lista_oco_por_municipio($dataIni, $dataFim, $municipio, $tipo){

		$sql = "SELECT DISTINCT o.setor, COUNT(DISTINCT o.id) AS totalPorSetor, d.data_criacao
				FROM tb_ocorrencia as o, tb_tipo as t
				WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim'  and d.tipo = '$tipo' and o.municipio = '$municipio'
				GROUP BY o.setor 
				ORDER BY totalPorSetor desc";
		
		//echo "<br>lista_oco_por_municipio<br> " . $sql;
		
		return $this->db->query($sql);
		
	}
	
	function lista_por_periodo($dataIni, $dataFim){

		$sql = "SELECT DISTINCT o.id, o.setor, d.tipo, t.nome as tipoOcoNome, o.municipio, o.danos, o.vitimas, d.data_criacao
				FROM tb_ocorrencia as o, tb_tipo as t
				WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim'
				ORDER BY o.id desc";
		
		//echo "<br>lista_por_periodo<br> " . $sql;
		
		return $this->db->query($sql);
		
	}
	
	
	function doc_por_periodo($dataIni, $dataFim, $tipoDoc = 0){
		

		$sql = "SELECT DISTINCT d.setor, d.tipo, d.data_criacao, COUNT(DISTINCT d.id) AS totalPorData
				FROM documento as d, tipo as t ";

		if($tipoDoc == 0){

			$sql = $sql . " WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";

		}else{

			$sql = $sql . " WHERE d.tipo = '$tipoDoc' and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";
			
		}

	//	echo $this->data_to_number($dataFim) . "<br>";
		//echo $this->data_to_number($dataFim) . "<br>";
		
		if($this->data_to_number($dataFim) - $this->data_to_number($dataIni) <= 60){
			$sql = $sql . " GROUP BY d.tipo, DAY(d.data_criacao)
							ORDER BY d.data_criacao asc";
		}else{
			$sql = $sql . " GROUP BY d.tipo, DAY(d.data_criacao)
							ORDER BY d.data_criacao asc";
			
		}

		//echo "<br>doc_por_periodo<br> " . $sql;
		
		$query = $this->db->query($sql);
		
		echo $this->db->last_query() . "<br>";
		
		return $this->db->query($sql);
		
	}
	
	function dias_com_registro ($dataIni, $dataFim, $tipoDoc = 0){
	
	
		$sql = "SELECT DISTINCT  d.tipo, d.data_criacao, COUNT(DISTINCT d.id) AS total
				FROM documento as d, tipo as t ";
	
		if($tipoDoc == 0){
	
			$sql = $sql . " WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";
	
		}else{
	
			$sql = $sql . " WHERE d.tipo = '$tipoDoc' and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";
				
		}
	
		$sql = $sql . " GROUP BY d.tipo
						ORDER BY d.data_criacao asc";
	
		//echo "<br>doc_por_periodo<br> " . $sql;
		
		$query = $this->db->query($sql);
		
		//echo $this->db->last_query() . "<br>";
		
		//print_r($query->result_array());
	
		return $query;
	
	}
	
	
	function qtd_doc_por_periodo($dataIni, $dataFim){
	
	
		$sql = "SELECT DISTINCT d.setor, d.tipo, t.nome, d.data_criacao, COUNT(DISTINCT d.id) AS totalPorData
				FROM documento as d, tipo as t ";
	
		$sql = $sql . " WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";
	
	
		$sql = $sql . " GROUP BY d.tipo
						ORDER BY d.data_criacao asc";
	
	
		$query = $this->db->query($sql);
		
		//echo $this->db->last_query() . "<br>";
		
	
		return $query;
	
	}
	

	function conta_doc_por_periodo($dataIni, $dataFim, $tipoDoc = 0){

		$sql = "SELECT COUNT(DISTINCT d.id) AS total
					FROM documento as d, tipo as t ";

		if($tipoDoc == 0){

			$sql = $sql . " WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";

		}else{

			$sql = $sql . " WHERE d.tipo = '$tipoDoc' and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";
			
		}


		$sql = $sql . " ORDER BY d.data_criacao asc";

		//echo "<br>doc_por_periodo<br> " . $sql;
		
		return $this->db->query($sql);
		
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