<?php
class Estat_model extends CI_Model {
private $tabela = 'tb_ocorrencia';
function lista_todas_por_periodo($periodo = "hoje"){
switch ($periodo) {
case "hoje":
$periodo = "DATE(d.data_criacao) = DATE(NOW())";
break;
case "mes":
$periodo = "MONTH(d.data_criacao) = MONTH(NOW())";
break;
case "ano":
$periodo = "YEAR(d.data_criacao) = YEAR(NOW())";
break;
}
$sql = "SELECT DISTINCT o.id, o.setor, d.tipo, t.nome as tipoOcoNome, o.municipio, o.danos, o.vitimas, d.data_criacao
FROM tb_ocorrencia as o, tb_tipo as t
WHERE d.tipo = t.id and $periodo
ORDER BY o.id desc";
return $this->db->query($sql);
}
function docs_por_tipo_no_periodo($dataIni, $dataFim, $tipo, $setor){
$sql = "SELECT d.setor, d.tipo, t.nome, COUNT(d.id) AS totalPorTipo
FROM documento as d, tipo as t ";
$sql .= "WHERE ";
if($tipo != 0){
$sql .= "d.tipo = '$tipo' and ";
}
if($setor != 0){
$sql .= "d.setor = '$setor' and ";
}
$sql .= "d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim'";
$sql = $sql . " GROUP BY d.tipo
ORDER BY d.data_criacao asc";
$query = $this->db->query($sql)->result_array();
//echo $this->db->last_query() . "<br>";
return $query;
}
function docs_por_tipo_no_periodo_g2($dataIni, $dataFim, $tipo, $setor){
$sql = "SELECT d.setor, d.tipo, t.nome, month(d.data_criacao) as mes, COUNT(d.id) AS totalPorTipo
FROM documento as d, tipo as t ";
$sql .= "WHERE ";
if($tipo != 0){
$sql .= "d.tipo = '$tipo' and ";
}
if($setor != 0){
$sql .= "d.setor = '$setor' and ";
}
$sql .= "d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim'";
$sql = $sql . " GROUP BY month(d.data_criacao)
ORDER BY d.data_criacao asc";
$query = $this->db->query($sql)->result_array();
//echo $this->db->last_query() . "<br>";
return $query;
}
function get_tipos_periodo($dataIni, $dataFim, $setor){
$sql = "SELECT d.setor, d.tipo, t.nome, month(d.data_criacao)
FROM documento as d, tipo as t ";
$sql .= "WHERE d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";
$sql = $sql . " GROUP BY d.tipo
ORDER BY d.data_criacao asc";
$query = $this->db->query($sql)->result_array();
// echo "<pre>";
// print_r($query);
// echo "</pre>";
//exit;
//echo $this->db->last_query() . "<br>";
return $query;
}
function get_total_tipo_datas($dataIni, $dataFim, $tipo, $setor){
$sql = "SELECT d.setor, d.tipo, t.nome, COUNT(d.id) AS totalPorTipo
FROM documento as d, tipo as t ";
//$sql .= "WHERE MONTH(d.data_criacao) = '$mes' and ";
$sql .= "WHERE d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' and ";
$sql .= "d.tipo = '$tipo' and d.tipo = t.id";
$sql = $sql . " GROUP BY d.tipo
ORDER BY d.data_criacao asc";
$query = $this->db->query($sql)->result_array();
// echo "<pre>";
// print_r($query);
// echo "</pre>";
//exit;
echo $this->db->last_query() . "<br>";
return $query;
}
function get_total_tipo_mes($dataIni, $dataFim, $mes, $tipo, $setor){
$sql = "SELECT d.tipo, MONTH(d.data_criacao) as mes, t.nome, COUNT(d.id) AS totalPorTipo
FROM documento as d, tipo as t ";
$sql .= "WHERE d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' and MONTH(d.data_criacao) = '$mes' and ";
//$sql .= "WHERE d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' and ";
$sql .= "d.tipo = '$tipo' and d.tipo = t.id";
$sql = $sql . " GROUP BY mes
ORDER BY d.data_criacao asc";
$query = $this->db->query($sql)->result_array();
// echo "<pre>";
// print_r($query);
// echo "</pre>";
//exit;
//echo $this->db->last_query() . "<br>";
return $query;
}
/*
function get_total_mes_tipo($dataIni, $dataFim, $tipo, $setor){
$sql = "SELECT d.setor, d.tipo, t.nome, COUNT(d.id) AS totalPorTipo
FROM documento as d, tipo as t ";
$sql .= "WHERE ";
$sql .= "d.tipo = '$tipo' and d.tipo = t.id and d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim'";
$sql = $sql . " GROUP BY d.tipo
ORDER BY d.data_criacao asc";
$query = $this->db->query($sql)->result_array();
echo "<pre>";
print_r($query);
echo "</pre>";
//exit;
//echo $this->db->last_query() . "<br>";
return $query;
}
*/
function get_total_ocultos($dataIni, $dataFim, $tipo, $setor){
$sql = "SELECT d.oculto, COUNT(d.id) AS total
FROM documento as d ";
$sql .= "WHERE d.data_criacao >= '$dataIni' and d.data_criacao <= '$dataFim' ";
$sql = $sql . " GROUP BY d.oculto
ORDER BY d.oculto asc";
$query = $this->db->query($sql)->result_array();
// echo "<pre>";
// print_r($query);
// echo "</pre>";
//exit;
//echo $this->db->last_query() . "<br>";
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