<?php

// seta o valor no contador de avanco
function seta_valor_contador($tipo_acao, $valor){

// identificador
$identificador = retorne_identificador_md5_contador_avanco($tipo_acao);

// atualiza o calculo de paginacao atual
$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = $valor;

// retorno
return "limit $valor, ".NUMERO_VALOR_PAGINACAO;

};

?>
