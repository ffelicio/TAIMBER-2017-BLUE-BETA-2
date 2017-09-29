<?php

// opcoes de pesquisa de amigos
function constroe_opcoes_parametros_pesquisa_amigos($funcao_parametro, $idcampo_1){

// globals
global $idioma_sistema;

// array com opcoes
$array_opcoes = explode(",", $idioma_sistema[566]);

// contador
$contador = 0;

// analisando opcoes disponiveis
foreach($array_opcoes as $valor){
	
	// valida valor
	if($valor != null){
		
		// funcoes
		$funcao[0] = "altera_parametro_pesquisa_amigos(\"$contador\", \"$idcampo_1\")";
		$funcao[1] = $funcao_parametro[0];

		// eventos
		$evento[0] = "onclick='$funcao[0], $funcao[1];'";
		
		// construindo opcoes
		$campos[0] .= "
		<div class='classe_div_opcao_menu_suspense' $evento[0]>
		<span class='span_link'>$valor</span>
		</div>
		";
	
		// atualizando o contador
		$contador++;
		
	};
	
};

// adiciona titulo
$campos[0] = "
<div class='classe_opcoes_parametros_pesquisa_amigos_titulo'>
$idioma_sistema[567]
</div>

$campos[0]
";

// campos
$campo[1] = constroe_menu_suspense(false, null, false, null, null, $campos[0]);

// html
$html = "
<div class='classe_opcoes_parametros_pesquisa_amigos'>
$campo[1]
</div>
";

// retorno
return $html;

};

?>