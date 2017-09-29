<?php

// retorna ou seta a chave de publicacao
function retorna_seta_chave_publicacao($modo){

#>> modo true seta a chave <<
#>> modo false retorna a chave <<

// globals
global $tabela_banco;

// retorna ou seta o valor atual da chave de publicacao
if($modo == true){

	// chave de publicacao
    $chave = codifica_md5(retorne_idusuario_request().retorne_contador_iteracao().data_atual());

	// atualiza o valor da chave na sessao
	$_SESSION[SESSAO_CHAVE_PUBLICACAO] = $chave;
	
	// retorno
    return $_SESSION[SESSAO_CHAVE_PUBLICACAO];
	
}else{
	
	// retorno
    return $_SESSION[SESSAO_CHAVE_PUBLICACAO];

};

};

?>