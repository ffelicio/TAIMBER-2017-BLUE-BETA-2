<?php

// retorna o limit de query
function retorne_limit_query_iniciar($modo_limpar, $tipo_acao){

// valida o tipo de acao
if($tipo_acao == null and is_numeric($tipo_acao) == false){
	
	// tipo de acao
	$tipo_acao = retorne_campo_formulario_request(2);
	
};

// retorna o valor atual do contador
$contador = contador_avanco($tipo_acao, 3);

// valida o modo limpar
if($modo_limpar == true){
	
	// agora zera o contador
	contador_avanco($tipo_acao, 2);

	// retorna o valor atual do contador
	$contador = contador_avanco($tipo_acao, 3);

}else{
	
	// agora atualiza o contador
	contador_avanco($tipo_acao, 1);
	
};

// retorno
return "limit $contador, ".NUMERO_VALOR_PAGINACAO;

};

?>