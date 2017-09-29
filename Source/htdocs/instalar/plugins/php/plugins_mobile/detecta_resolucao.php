<?php

// deteca a resolucao
function detecta_resolucao(){

// largura
$largura = retorne_campo_formulario_request(49);

// id de campo
$idcampo[0] = codifica_md5($largura.SESSAO_RESOLUCAO_DETECTA);

// atualiza sessao
if($_SESSION[SESSAO_RESOLUCAO_DETECTA][$idcampo[0]] != $idcampo[0]){
	
	// atualiza a sessao
	$_SESSION[SESSAO_RESOLUCAO_DETECTA][$idcampo[0]] = $idcampo[0];
	
	// valor de retorno
	$retorno = 1;
	
}else{
	
	// valor de retorno
	$retorno = null;
	
};


if($largura >= TAMANHO_MINIMO_RESOLUCAO_MOBILE){

	// valor de retorno
	$retorno = null;

	// atualiza a sessao
	$_SESSION[SESSAO_RESOLUCAO_RETORNA] = false;

}else{

	// atualiza a sessao
	$_SESSION[SESSAO_RESOLUCAO_RETORNA] = true;
	
	// informa que o modo mobile foi ativo
	$_SESSION[SESSAO_MODO_MOBILE_ATIVOU] = true;
	
};

// array de retorno
$array_retorno["dados"] = $retorno;

// retorno
return json_encode($array_retorno);

};

?>