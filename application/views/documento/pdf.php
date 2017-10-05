<?php

$header = '<table width="100%" style="vertical-align: bottom;">
			<tr>
			<td align="center">'.$cabecalho.'</td>
			</tr>
			</table>';

if($objeto->carimbo == 'S'){
	$header .= '<div style="text-align: right; margin-top:-105px; margin-right:-73px;">
						<img src="./images/carimbo_folha.png" width="80px"/>
				</div>';
}

if($objeto->carimbo_via == 'S'){
	$header .= '<div style="text-align: right; margin-top:50px; margin-right:-45px;">
						<img src="./images/carimbo_via_2.png" width="35px"/>
					</div>';
}else{
	$header .= '<div style="text-align: right; margin-top:10px; margin-right: -45px;">
						<img src="./images/carimbo_em_branco.png" width="35px"/>
					</div>';
}

if($objeto->carimbo_confidencial == 'S'){
	$header .= '<div style="text-align: right; margin-top:10px; margin-right: -49px;">
						<img src="./images/carimbo_confidencial_2.png" width="40px"/>
					</div>';
}else{
	$header .= '<div style="text-align: right; margin-top:20px; margin-right: -49px;">
						<img src="./images/carimbo_em_branco.png" width="40px"/>
					</div>';
}

if($objeto->carimbo_urgente == 'S'){
	$header .= '<div style="text-align: right; margin-top:10px; margin-right: -51px;">
						<img src="./images/carimbo_urgente_2.png" width="45px"/>
					</div>';
}else{
	$header .= '<div style="text-align: right; margin-top:10px; margin-right: -51x;">
						<img src="./images/carimbo_em_branco.png" width="45px"/>
					</div>';
}

$content = '<div class="conteudo">
				'.htmlspecialchars_decode($objeto->layout).'
			</div>';

$footer = '
		<table width="100%" style="vertical-align: top;font-family:\'Times New Roman\',Times,serif; font-size: 11px;">
			<tr>
				<td align="center" colspan="2">
					'.$rodape.'
				</td>
			</tr>
			<tr>
				<td style="font-size: 9px">'.$documento_identificacao.'
				</td>	
				<td align="right">página {PAGENO} de {nbpg}</td>
			</tr>
		</table>
		';

//MPDF

include("scripts/mpdf57/mpdf.php");

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

$stylesheet = file_get_contents(base_url().'css/pdf.css'); // external css

$mpdf->mirrorMargins = 0; // Use different Odd/Even headers and footers and mirror margins

// $mpdf->SetHTMLHeader(utf8_encode($header));
$mpdf->SetHTMLHeader($header);
//if($objeto->tipoID != 4)
	$mpdf->SetHTMLFooter($footer);

$mpdf->debug = true;
//$mpdf->keep_table_proportions = false;

$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($content);

if($filename == null){
	$filename = $objeto->setorSigla.'_'.$objeto->tipoSigla.'_'.substr($objeto->data, -4).'_'.$objeto->numero.'.pdf';
}

//echo htmlspecialchars_decode($content);

$mpdf->Output($filename, 'I');

exit;
?>