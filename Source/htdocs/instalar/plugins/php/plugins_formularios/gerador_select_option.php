<?php

// gerador de select option
function gerador_select_option($array_options, $valor_atual, $nome, $idcampo, $evento_campo){

// separa os itens por virgula
$array_options = explode(",", $array_options);

// html
foreach($array_options as $valor){

	// valor original
	$valor_original = trim($valor);
	
	// removendo espacos vazios
	$valor = trim(strtolower($valor));
	$valor_atual = trim(strtolower($valor_atual));
	
	// monta option
	if($valor == $valor_atual){

		// html
		$html .= "<option value='$valor_original' selected>$valor_original</option>";

	}else{

		// html
		$html .= "<option value='$valor_original'>$valor_original</option>";

	};

};

// monta select
$html = "<select name='$nome' id='$idcampo' onchange='$evento_campo'>$html</select>";

// retorno
return $html; // retorno

};

?>