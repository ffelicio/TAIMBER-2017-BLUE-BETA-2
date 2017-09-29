<?php

// constroe o campo data
function campo_data($campo_elemento_nome, $data){

// globals
global $idioma_sistema;
global $meses_ano;
global $variavel_campo;
global $codigos_especiais;

// ano atual
$ano_atual = Date("Y");

// contador
$contador = NUMERO_DATA_MAXIMA_ANO;

// datas
$data = explode($codigos_especiais[10], $data);

// constroe os anos
for($contador == $contador; $contador <= $ano_atual; $contador++){
	
	// atualiza o array de anos
	$lista_anos .= $contador.",";
	
};

// contador
$contador = 1;

// constroe dias
for($contador == $contador; $contador <= NUMERO_DATA_MAXIMA_DIA; $contador++){
	
	// lista com dias
	$lista_dias .= $contador.",";
	
};

// contador
$contador = 1;

// constroe meses
for($contador == $contador; $contador <= NUMERO_DATA_MAXIMA_MES; $contador++){
	
	// lista com meses
	$lista_meses .= $contador.",";
	
	// lista com nomes de meses
	$lista_meses_nomes .= $meses_ano[$contador - 1].",";
	
};

// campos
$campo[0] = gerador_select_option_especial($lista_dias, $lista_dias, $data[0], $variavel_campo[37], null, null);
$campo[1] = gerador_select_option_especial($lista_meses_nomes, $lista_meses, $data[1], $variavel_campo[38], null, null);
$campo[2] = gerador_select_option_especial($lista_anos, $lista_anos, $data[2], $variavel_campo[39], null, null);

// html
$html = "
<input type='hidden' name='$campo_elemento_nome'>
$campo[0]
$campo[1]
$campo[2]
";

// retorno
return $html;

};

?>