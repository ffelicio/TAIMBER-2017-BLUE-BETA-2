<?php

// define o modo mobile
function define_modo_mobile(){

// valida chave via requeste
if(retorna_chave_request() == null){
	
	// retorno nulo
	return null;
	
};

// valida modo mobile
if(retorne_modo_mobile() == true){
	
	// sessao de modo mobile
	$_SESSION[SESSAO_MODO_MOBILE] = false;
	
}else{
	
	// sessao de modo mobile
	$_SESSION[SESSAO_MODO_MOBILE] = true;	
	
};

// array de retorno
$array_retorno["dados"] = 1;

// retorno
return json_encode($array_retorno);

};

?>