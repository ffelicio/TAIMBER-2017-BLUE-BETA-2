<?php

// constroe a apresentacao da pagina
function constroe_apresentacao(){

// globals
global $frase_efeito;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// valida modo mobile
if($modo_mobile == true){
	
	// retorno nulo
	return null;
	
};

// dia da semana
$dia_semana = retorne_numero_dia_semana();

// valida o numero de dia da semana
switch($dia_semana){
	
	case 1:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(81, null, false);
	break;

	case 2:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(67, null, false);
	break;

	case 3:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(69, null, false);
	break;

	case 4:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(70, null, false);
	break;

	case 5:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(71, null, false);
	break;

	case 6;
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(72, null, false);
	break;

	case 7:
		$dados[URL_HOST_GRANDE] = retorne_imagem_sistema(73, null, false);
	break;

};

// campos
$campo[0] = $dados[URL_HOST_GRANDE];

// frase do dia
$frase_dia = $frase_efeito[$dia_semana];

// campos
$campo[0] = "
<div class='classe_imagem_apresentacao'>
	$campo[0]
</div>
";

// campos
$campo[1] = "
<div class='classe_apresentacao_frase'>
	$frase_dia
</div>
";

// constroe a apresentacao da pagina
$html = "
<div class='classe_apresentacao'>
	$campo[0]
	$campo[1]
</div>
";

// retorno
return $html;

};

?>