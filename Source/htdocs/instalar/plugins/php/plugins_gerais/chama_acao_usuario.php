<?php

// chama uma acao de usuario
function chama_acao_usuario($tipo_acao){

// globals
global $variavel_campo;

// valida tipo de acao
if($tipo_acao == null){
	
	// tipo de acao
	$tipo_acao = retorne_tipo_acao_pagina();

};

// valida tipo de acao
if($tipo_acao == null){

	// chama a pagina inicial
	return chama_pagina_inicial();
	
};

// pagia inicial
$pagina_inicial = PAGINA_INICIAL."?".$variavel_campo[2]."=$tipo_acao";

// redireciona
header("Location: $pagina_inicial");

};

?>