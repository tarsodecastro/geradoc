<?php


//$postedValue = htmlspecialchars( stripslashes( $redacao ) ) ;
//$postedValue = stripslashes( $redacao ) ;

$postedValue = htmlspecialchars($objeto->redacao);
// $postedValue =  $redacao;




$html = '

		<style type="text/css">
		<!--
		#t1 {text-align: left;}
		#t2 {text-align: center;}
		#t3 {text-align: right;}
		#t4 {text-align: justify;}

		.conteudo {vertical-align: bottom; font-family:"Times New Roman",Times,serif; font-size: 15px; text-align: justify; line-height:100%; font-weight: normal;}
		.data {text-align: right;}
		.destinatario {text-align: left; line-height:150%;}
		.redacao p{text-align: justify; line-height:150%;font-family:\'Times New Roman\',Times,serif; font-size: 15px;}
		.remetente {text-align: center; line-height:150%;}
		.cabecalho {
		font-family:\'Times New Roman\',Times,serif;
		font-size:13px;
		color:black;
		line-height: 125%;
		padding: 5px;
}
		.ceara {
		font-family:\'Times New Roman\',Times,serif;
		font-size:17px;
		color:black;
		font-weight:bold;
}

		-->
		.despacho_head{
			width: 100%;
			overflow: hidden;
			border-collapse: collapse;
			border-spacing: 0;
		}
		
		.despacho_head td{
			border: solid 1px black;
			width: 50%;
		}
		</style>

		<div class="conteudo">';
$isOrdinary = ($objeto->tipoID == 1 or $objeto->tipoID == 2) ? TRUE : FALSE;
if($isOrdinary){
			// linhas acrescentadas em fevereiro de 2013 para retirar os "<br>" do campo "para"
			$pedacos = explode("<br />", $objeto->para);
			foreach ($pedacos as $key => $value) {
				if(strlen($pedacos[$key]) < 2){
					unset($pedacos[$key]);
				}	
				$texto_para = implode("<br />", $pedacos);
			}
			$objeto->para = $texto_para;
			// fim

	$html .= $objeto->tipoNome.' Nº '.$objeto->numero.'/'.$objeto->ano.' - '.$objeto->setorSigla.'/'.$objeto->orgaoSigla.'

			<div class="data"><br> Fortaleza, '.$objeto->data.'.</div>

					<div class="destinatario">
					<p>'.$objeto->para.'</p>
							<p>
							<b>Assunto:</b> '.ucfirst($objeto->assunto);

}
else if($objeto->tipoID == 3 or $objeto->tipoID == 5){//Despacho ou Parecer
	if(isset($data_despacho))
		$date = new DateTime(str_replace('-','/',$data_despacho));
	else if(isset($objeto->data_despacho))
		$date = new DateTime(str_replace('-','/',$objeto->data_despacho));
	$tmpl = array ('table_open'  => '<table width="100%" style="border: solid 1px black; background-color: #aaa; color: black; border-collapse: collapse;">');
	$this->table->set_template($tmpl);
	$tipo_do_documento_aesp = $objeto->tipoID == 3 ? 'DESPACHO' : 'PARECER';
	$this->table->add_row("<center><b>$tipo_do_documento_aesp Nº ".$objeto->numero.'/'.$objeto->ano.'</b></center>');
	$html .= $this->table->generate();
	$html .= '<br>';
	$this->table->clear();
	$tmpl = array ('table_open'  => '<table class="despacho_head">');
	$this->table->set_template($tmpl);
	$this->table->add_row('<b>Nº. do processo: </b>'.$despacho_head['num_processo'],'<b>De: </b>'.$despacho_head['de']);
	$this->table->add_row('<b>Interessado: </b>'.$despacho_head['interessado']     ,'<b>Para: </b>'.$despacho_head['para']);
	$this->table->add_row('<b>Assunto: </b>'.$objeto->assunto     ,'<b>Data do despacho: </b>'.$date->format('d/m/Y'));
	$html .= $this->table->generate();
	$html .= '<br>';
}
if($objeto->referencia and $isOrdinary){

	$html .= ' <br><strong>Referência:</strong> '.$objeto->referencia;

}

if(!$objeto->assinatura){
	$objeto->assinatura = $objeto->remetNome . '<br>'.$objeto->remetCargoNome.' '.$objeto->remetSetorArtigo.' '.$objeto->remetSetorSigla.'';
}


if($objeto->tipoID == 3 or $objeto->tipoID == 5)
	$html .= '
		</p>
		</div>
		<div class="redacao" style="border: solid 1px black; height: 1000px;">
		<p style="margin: 10px;">'.htmlspecialchars_decode($postedValue).'</p>
				';
else
$html .= '
		</p>
		</div>
		<div class="redacao">
		<p>'.htmlspecialchars_decode($postedValue).'</p>
				<p></p>
				</div>';
if($objeto->tipoID != 4)
	$html .= '
			<div class="remetente">
			<br>'.$objeto->assinatura.'
					</div>
					</div>
					';
if($objeto->tipoID == 3 or $objeto->tipoID == 5)
	$html .= '</div>';

$header = '
		<table width="100%" style="vertical-align: bottom;">
		<tr>
		<td align="center"><img src="imagens/header.png" width="550px"/></td>
		</tr>
		</table>
		';

$footer = '
		<table width="100%" style="vertical-align: top;font-family:\'Times New Roman\',Times,serif; font-size: 11px;">
		<tr>
		<td align="center">
		<strong>ACADEMIA ESTADUAL DE SEGURANÇA PÚBLICA DO CEARÁ - AESP/CE</strong><br>
		Av. Presidente Costa e Silva, 1251, Mondubim, Cep: 60761-190<br>
		Fone/Faz: (85) 3296-0469 - Fortaleza, Ceará
		</td>
		</tr>
		<tr>
		<td align="right">{PAGENO}</td>
		</tr>
		</table>
		';

//MPDF

include("scripts/mpdf50/mpdf.php");

$mode = 'pt';
$format = 'A4';
$default_font_size = 12;
$default_font = 'times';
$margin_top = 35;
$margin_right = 20;
$margin_bottom = 30;
$margin_left = 25;
$margin_header = 8;
$margin_footer  = 10;
$orientation = '';


//$mpdf=new mPDF ($mode, $format, $default_font_size, $default_font, $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer, $orientation);

$mpdf=new mPDF ($mode, $format, $default_font_size, $default_font, $margin_left, $margin_right, $margin_top, $margin_bottom, $margin_header, $margin_footer, $orientation);

$mpdf->mirrorMargins = 0; // Use different Odd/Even headers and footers and mirror margins

$mpdf->SetHTMLHeader(utf8_encode($header));
if($objeto->tipoID != 4)
	$mpdf->SetHTMLFooter(utf8_encode($footer));

$mpdf->WriteHTML(utf8_encode($html));

// define um nome para o arquivo PDF
if($filename == null){
	$filename = $objeto->setorSigla.'_'.$objeto->tipoSigla.'_'.substr($objeto->data, -4).'_'.$objeto->numero.'.pdf';
}

//echo $postedValue;//$html;

$mpdf->Output($filename, 'I');

exit;
?>
