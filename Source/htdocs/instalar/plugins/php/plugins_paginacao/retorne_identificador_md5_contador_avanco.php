<?php

// retorna o identificador md5 de contador de avanco
function retorne_identificador_md5_contador_avanco($tipo_acao){

// texto a ser codificado
$texto_codificar = $tipo_acao.retorne_idusuario_request().retorne_campo_formulario_request(23).SESSAO_CONTADOR_AVANCO.retorna_token_pagina_requeste();

// retorno
return codifica_md5($texto_codificar.retorna_token_pagina_requeste());

};

?>
