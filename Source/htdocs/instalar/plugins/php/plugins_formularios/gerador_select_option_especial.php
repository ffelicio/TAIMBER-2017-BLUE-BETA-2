<?php

// gerador de select option especial
function gerador_select_option_especial($array_options, $array_valores, $valor_atual, $nome, $idcampo, $evento_campo){

// separa os itens por virgula
$array_options = explode(",", $array_options);
$array_valores = explode(",", $array_valores);

// contador
$contador = 0;

// remove espacos em branco
$valor_atual = trim(strtolower($valor_atual));

// html
foreach($array_options as $valor){

	// valor original
	$valor_original = trim($valor);
	
	// valor especial
	$valor_especial = trim(strtolower($array_valores[$contador]));
	
	// remove espacos em branco
	$valor = trim(strtolower($valor));
	
	// monta option
	if($valor == $valor_atual or $valor_especial == $valor_atual){

		// html
		$html .= "<option value='$valor_especial' selected>$valor_original</option>";

	}else{

		// html
		$html .= "<option value='$valor_especial'>$valor_original</option>";

	};

	// atualiza o contador
	$contador++;

};

// monta select
$html = "<select name='$nome' id='$idcampo' onchange='$evento_campo'>$html</select>";

// retorno
return $html; // retorno

};

?>