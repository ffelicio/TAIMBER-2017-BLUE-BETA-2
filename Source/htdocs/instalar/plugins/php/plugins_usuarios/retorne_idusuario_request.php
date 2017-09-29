<?php

// retorna o id de usuario de request
function retorne_idusuario_request(){

// globals
global $variavel_campo;

// id de usuario via requeste
$idusuario = remove_html($_REQUEST[$variavel_campo[5]]);

// id de pagina
$pagina = retorne_idpagina_request();

// valida idusuario
if($idusuario == null){
	
	// retorna o id de usuario amigavel via requeste
	$idusuario = retorne_idusuario_amigavel_requeste(0);
	
};

// valida idusuario
if($idusuario == null){
    
	// id de usuario logado
	$idusuario = retorne_idusuario_logado();

};

// valida o modo pagina
if(retorne_modo_pagina() == true and $idusuario == null){
	
	// id de usuario
	$idusuario = retorne_idusuario_dono_pagina($pagina);

};

// retorno
return $idusuario;

};

?>