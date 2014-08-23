<?php
class Grid_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	function monta_tabela_list(){
		$tmpl = array (
                       'table_open'          => '<div class="table-responsive"><table id="tabela" classcellspacing="0" class="table table-striped table-bordered dataTable no-footer table-hover table-condensed">',
	
				'heading_row_start'   => '<tr>',
				'heading_row_end'     => '</tr>',
				'heading_cell_start'  => '<th>',
				'heading_cell_end'    => '</th>',
	
				'row_start'           => '<tr>',
				'row_end'             => '</tr>',
				'cell_start'          => '<td>',
				'cell_end'            => '</td>',
	
				'row_alt_start'       => '<tr>',
				'row_alt_end'         => '</tr>',
				'cell_alt_start'      => '<td>',
				'cell_alt_end'        => '</td>',
	
				'table_close'         => '</table></div>'
                );
		return $tmpl;
	}
	
	function monta_tabela($id){
		$tmpl = array (
                        'table_open'          => '<table cellpadding="0" cellspacing="0" border="0" class="display" id="'.$id.'">',

                        'heading_row_start'   => '<tr>',
                        'heading_row_end'     => '</tr>',
                        'heading_cell_start'  => '<th>',
                        'heading_cell_end'    => '</th>',

                        'row_start'           => '<tr class="gradeA">',
                        'row_end'             => '</tr>',
                        'cell_start'          => '<td>',
                        'cell_end'            => '</td>',

                        'row_alt_start'       => '<tr class="gradeA">',
                        'row_alt_end'         => '</tr>',
                        'cell_alt_start'      => '<td>',
                        'cell_alt_end'        => '</td>',

                        'table_close'         => '</table>'
                );
		return $tmpl;
	}

        function monta_tabela_view($array, $array_traducao, $barra_aux = 0, $linkPdf, $linkMail, $linkOk){
                $tmpl = '<table class="zebra">'."\n";
                if($barra_aux == 1){
                    $tmpl = $tmpl .'<tr>'."\n";
                    $tmpl = $tmpl .'<td colspan="2" align="right" style="background-color: #EDEDED;">'.$linkPdf."\n";
                    $tmpl = $tmpl .'&nbsp'.$linkMail."\n";
                    $tmpl = $tmpl .'</td>'."\n";
                    $tmpl = $tmpl .'</tr>'."\n";
                }

                foreach ($array as $chave => $valor) {

                        foreach ($array_traducao as $chave2 => $valor2) {
                                if($chave == $chave2){
                                    $chave = $valor2;
                                }
                        }

                        $tmpl = $tmpl . '<tr>'."\n";
                        $tmpl = $tmpl . '<td width="5%" class="label"><strong>'.mb_convert_case($chave, MB_CASE_TITLE, "UTF-8").':</strong></td>'."\n";
                        $tmpl = $tmpl . '<td>'.$valor.'</td>'."\n";
                        $tmpl = $tmpl . '</tr>'."\n";
                }


                $tmpl = $tmpl .'<tr>'."\n";
                $tmpl = $tmpl .'<td>&nbsp;</td>'."\n";
                $tmpl = $tmpl .'<td>'."\n";

                $tmpl = $tmpl . form_button('mybutton', 'OK', $linkOk);

                $tmpl =  $tmpl .'</td>'."\n";
                $tmpl =  $tmpl .'</tr>'."\n";

                $tmpl = $tmpl .'</table>'."\n";

		return $tmpl;
	}
	
	function monta_tabela_modal($array, $array_traducao, $barra_aux = 0, $linkPdf, $linkMail, $linkOk){
                $tmpl = '<table class="zebra">'."\n";
                if($barra_aux == 1){
                    $tmpl = $tmpl .'<tr>'."\n";
                    $tmpl = $tmpl .'<td colspan="2" align="right" style="background-color: #EDEDED;">'.$linkPdf."\n";
                    $tmpl = $tmpl .'&nbsp'.$linkMail."\n";
                    $tmpl = $tmpl .'</td>'."\n";
                    $tmpl = $tmpl .'</tr>'."\n";
                }

                foreach ($array as $chave => $valor) {

                        foreach ($array_traducao as $chave2 => $valor2) {
                                if($chave == $chave2){
                                    $chave = $valor2;
                                }
                        }

                        $tmpl = $tmpl . '<tr>'."\n";
                        $tmpl = $tmpl . '<td width="5%" class="label"><strong>'.mb_convert_case($chave, MB_CASE_TITLE, "UTF-8").':</strong></td>'."\n";
                        $tmpl = $tmpl . '<td>'.$valor.'</td>'."\n";
                        $tmpl = $tmpl . '</tr>'."\n";
                }

                $tmpl = $tmpl .'</table>'."\n";

		return $tmpl;
	}
	
        function tabela_atendimento_view($array, $array_traducao, $barra_aux = 0, $linkPendencia, $linkSolucionar, $linkConcluir, $linkPdf, $linkMail, $linkOk){
                $tmpl = '<table class="zebra">'."\n";
                if($barra_aux == 1){
                    $tmpl = $tmpl .'<tr>'."\n";
                    $tmpl = $tmpl .'<td colspan="2" align="right" style="background-color: #EDEDED;">'."\n";
                    $tmpl = $tmpl .'&nbsp '.$linkPendencia;
                    $tmpl = $tmpl .'&nbsp '.$linkSolucionar;
                    $tmpl = $tmpl .'&nbsp '.$linkConcluir;
                    $tmpl = $tmpl .'&nbsp '.$linkPdf;
                    $tmpl = $tmpl .'&nbsp '.$linkMail."\n";
                    $tmpl = $tmpl .'</td>'."\n";
                    $tmpl = $tmpl .'</tr>'."\n";
                }

                foreach ($array as $chave => $valor) {

                        foreach ($array_traducao as $chave2 => $valor2) {
                                if($chave == $chave2){
                                    $chave = $valor2;
                                }
                        }

                        $tmpl = $tmpl . '<tr>'."\n";
                        $tmpl = $tmpl . '<td width="15%" class="label"><strong>'.mb_convert_case($chave, MB_CASE_TITLE, "UTF-8").':</strong></td>'."\n";
                        $tmpl = $tmpl . '<td>'.$valor.'</td>'."\n";
                        $tmpl = $tmpl . '</tr>'."\n";
                }


                $tmpl = $tmpl .'<tr>'."\n";
                $tmpl = $tmpl .'<td>&nbsp;</td>'."\n";
                $tmpl = $tmpl .'<td>'."\n";

                $tmpl = $tmpl . form_button('mybutton', 'OK', $linkOk);

                $tmpl =  $tmpl .'</td>'."\n";
                $tmpl =  $tmpl .'</tr>'."\n";

                $tmpl = $tmpl .'</table>'."\n";

		return $tmpl;
	}
        function monta_tabela_tipo_pdf($array, $array_traducao){
		$tmpl = '<table>'."\n";

                foreach ($array as $chave => $valor) {

                        foreach ($array_traducao as $chave2 => $valor2) {
                                if($chave == $chave2){
                                    $chave = $valor2;
                                }
                        }
                    
                        $tmpl = $tmpl . '<tr>'."\n";
                        $tmpl = $tmpl . '<td width="20%" class="label"><strong>'.mb_convert_case($chave, MB_CASE_TITLE, "UTF-8").':</strong></td>'."\n";
                        $tmpl = $tmpl . '<td>'.$valor.'</td>'."\n";
                        $tmpl = $tmpl . '</tr>'."\n";
                }
                
                $tmpl = $tmpl .'</table>'."\n";
                
		return $tmpl;
	}
	
 	function tabela_pdf_servico($array, $array_traducao){
		$tmpl = '<table>'."\n";

                foreach ($array as $chave => $valor) {

                        foreach ($array_traducao as $chave2 => $valor2) {
                                if($chave == $chave2){
                                    $chave = $valor2;
                                }
                        }
                    
                        $tmpl = $tmpl . '<tr>'."\n";
                        $tmpl = $tmpl . '<td width="20%" class="label"><strong>'.mb_convert_case($chave, MB_CASE_TITLE, "UTF-8").':</strong></td>'."\n";
                        $tmpl = $tmpl . '<td>'.$valor.'</td>'."\n";
                        $tmpl = $tmpl . '</tr>'."\n";
                }
                
                $tmpl = $tmpl .'</table>'."\n";
                
		return $tmpl;
	}

}
?>