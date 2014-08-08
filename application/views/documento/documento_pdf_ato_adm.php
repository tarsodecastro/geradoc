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
		.titulo {text-align: center; line-height:100%;font-family:\'Times New Roman\',Times,serif; font-size: 18px;font-weight: bold;text-transform:uppercase;}
		.redacao p{text-align: justify; line-height:150%;font-family:\'Times New Roman\',Times,serif; font-size: 15px;}
		.remetente, .remetente p {text-align: center; line-height:150%;}
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
		
		.redacao table{
			border-width: 1px;
			border-spacing: 0px !important;
			border-collapse:collapse;
			border-style: solid;
			border-color: #000;
		}
		
		.redacao table td,.redacao table th {
			margin: 0;
			padding: 4px;
			border-width: 1px;
			border-style: solid;
			border-color: #000;
		}
		</style>

		<div class="conteudo">';


$header = '
		<table width="100%" style="vertical-align: bottom;">
		<tr>
		<td align="center"><img src="./images/header_'.$_SESSION['orgao_documento'].'.png"/></td>
		</tr>
		</table>
		';
if($objeto->carimbo == 'S'){
	$header .= '<div style="text-align: right; margin-top:-105px; margin-right:-73px; font-size: 10pt; color: #555; line-height:200%;">
						<img src="./images/carimbo_aesp.png" width="80px"/>
				</div>';
}


	$html .= '
		</p>
		</div>
		<div class="titulo">
			'.$objeto->tipoNome.' Nº '.$objeto->numero.'/'.$objeto->ano.' - '.$caminho_remetente.'
		</div>
		<div class="redacao">
			<p>'.htmlspecialchars_decode($postedValue).'</p>
		</div>';
	
	if(!$objeto->assinatura){
		$objeto->assinatura = $objeto->remetNome . '<br>'.$objeto->remetCargoNome.' '.$objeto->remetSetorArtigo.' '.$objeto->remetSetorSigla.'';
	}
	
	if($objeto->tipoID != 4){
		$html .= '
			ACADEMIA ESTADUAL DE SEGURANÇA PÚBLICA DO CEARÁ – AESP/CE, em Fortaleza, '.$objeto->data.'.
			<div class="remetente">
				<p><br><br>'.$objeto->assinatura.'</p>
			</div>';
	}

$footer = '
		<table width="100%" style="vertical-align: top;font-family:\'Times New Roman\',Times,serif; font-size: 11px;">
		<tr>
		<td align="center">
		'.$_SESSION['rodape_documento'].'
		</td>
		</tr>
		<tr>
		<td align="right">{PAGENO}</td>
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

$mpdf->mirrorMargins = 0; // Use different Odd/Even headers and footers and mirror margins

$mpdf->SetHTMLHeader(utf8_encode($header));
if($objeto->tipoID != 4)
	$mpdf->SetHTMLFooter($footer);

$mpdf->debug = true;
$mpdf->WriteHTML($html);

// define um nome para o arquivo PDF
if($filename == null){
	$filename = $objeto->setorSigla.'_'.$objeto->tipoSigla.'_'.substr($objeto->data, -4).'_'.$objeto->numero.'.pdf';
}

//echo $postedValue;//$html;

$mpdf->Output($filename, 'I');

exit;
?>
