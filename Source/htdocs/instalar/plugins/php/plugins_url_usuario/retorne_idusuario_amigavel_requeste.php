<?php

// retorna o id de usuario amigavel via requeste
function retorne_idusuario_amigavel_requeste($modo){

// url via request
$geturl = explode('/', $_SERVER['REQUEST_URI']);

// obtendo nome de usuario
$nome_usuario = $geturl[1];

// obtendo nome de pagina
$nome_pagina = $geturl[2];

// valida modo
if($modo == 0){
	
	// retorno
	return retorne_idusuario_amigavel($nome_usuario, $modo, null);
	
}else{
	
	// retorno
	return retorne_idpagina_amigavel_nome($nome_pagina);
	
};

};

?>