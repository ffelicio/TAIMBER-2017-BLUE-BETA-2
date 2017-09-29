<?php

// retorna o id da pagina via request
function retorne_idpagina_request(){

// id de pagina amigavel
$idpagina = retorne_idusuario_amigavel_requeste(1);

// valida id de pagina
if($idpagina == null){
	
	// id de pagina
	$idpagina = retorne_campo_formulario_request(25);

};

// retorno
return $idpagina;

};

?>