<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
	class Datas {		
		private $date; 
		private $dia; 
		private $mes;
		private $ano;
		private $semana; 
		
		public function __construct(){
			$this->date =  date('d/m/Y'); 
			$this->mes = date('m');
			$this->ano = date('Y');
			$this->semana = date('w');
		}
		
		// retorna a data de hoje no formato ex: Sexta-feira, 10 de maio de 2001
		public function getFullDateExtenso(){
			$mes = $this->getMesExtenso();
			$semana = $this->getSemanaExtenso();
			return $semana.', '.$this->dia.' de '.$mes.' de '.$this->ano;  			
			
		} 
		
		//retorna a data no formato ex: 10/05/2001, Sexta-feira
		public function getMinDateExtenso(){
			$mes = $this->getMesExtenso();
			$semana = $this->getSemanaExtenso();
			return $this->date.', '.$semana; 
		}
		
		public function getMesExtenso(){
			switch ($this->mes){
				case 1: $mes = "Janeiro"; break;
				case 2: $mes = "Fevereiro"; break;
				case 3: $mes = "Março"; break;
				case 4: $mes = "Abril"; break;
				case 5: $mes = "Maio"; break;
				case 6: $mes = "Junho"; break;
				case 7: $mes = "Julho"; break;
				case 8: $mes = "Agosto"; break;
				case 9: $mes = "Setembro"; break;
				case 10: $mes = "Outubro"; break;
				case 11: $mes = "Novembro"; break;
				case 12: $mes = "Dezembro"; break;
			}
			return $mes;
		}
		
		public function getSemanaExtenso(){
			switch ($this->semana) {
				case 0: $semana = "domingo"; break;
				case 1: $semana = "segunda-feira"; break;
				case 2: $semana = "terça-feira"; break;
				case 3: $semana = "quarta-feira"; break;
				case 4: $semana = "quinta-feira"; break;
				case 5: $semana = "sexta-feira"; break;
				case 6: $semana = "sábado"; break;
			}
			return $semana;			
		}
		
		public function datetimeToBR($datetimeUS){
			return implode("/", array_reverse(explode("-", substr($datetimeUS, 0, 10)))).substr($datetimeUS, 10);
		} 
		
		public function dateToBr ($dateUS){			
			$a = explode('-', $dateUS);
			$dataBR = $a[2].'/'.$a[1].'/'.$a[0];
			return $dataBR;
		}

		public function dateToUS ($dateBR){			
			$a = explode('/', $dateBR);
			$dataUS = $a[2].'-'.$a[1].'-'.$a[0];
			return $dataUS;
		}
		
		public function get_year_US ($dateUS){
			$a = explode('-', $dateUS);
			$year = $a[0];
			return $year;
		}
		
		public function get_date_US_to_BR ($dateUS){
			$a = explode(' ', $dateUS);
			$date = explode('-', $a[0]);
			$year = $date[0];
			$month = $date[1];
			$day = $date[2];
			return $day.'/'.$month.'/'.$year;
		}
		
		public function checkDataValida($data){
			$dt = explode("/", $data); 
			$d = $dt[0];
			$m = $dt[1];
			$y = $dt[2];			
			$res = checkdate($m,$d,$y);
						
			return ($res == 1) ? TRUE : FALSE;			
		}
		
		public function getAnoUS ($dateUS){			
			$a = explode('-', $dateUS);
			$ano = $a[0];
			return $ano;
		}	
		
		public function getAnoBR ($dateBR){			
			$a = explode('/', $dateBR);
			$ano = $a[2];
			return $ano;
		}
		
		public function getDiaMesUS($dateUS){
			$a = explode('-', $dateUS);
			$b = explode(' ', $a[2]);
			$dataBR = $b[0].'/'.$a[1];
			return $dataBR;
		}		

		public function getMesAnoUS($dateUS){
			
			$a = explode('-', $dateUS);
			$b = explode(' ', $a[2]);
			$dataBR = $a[1].'/'.$a[0];
			return $dataBR;
		}

	}
?>