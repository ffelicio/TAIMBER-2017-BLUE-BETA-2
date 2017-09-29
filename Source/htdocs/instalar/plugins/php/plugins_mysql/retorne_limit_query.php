<?php

// retorna o limit de query
function retorne_limit_query($tipo_acao, $zerar){

// retorno
if($zerar == true){
	
	// retorno com zero
    return "limit ".contador_avanco($tipo_acao, 2).", ".NUMERO_VALOR_PAGINACAO;
	
}else{
	
	// retorno normal
    return "limit ".contador_avanco($tipo_acao, 1).", ".NUMERO_VALOR_PAGINACAO;

};

};

?>