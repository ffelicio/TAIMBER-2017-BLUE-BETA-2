<?php

// chama a pagina de usuario
function chama_pagina_usuario($id){

// globals
global $variavel_campo;

// valida id
if($id == null){
	
	// chama a pagina inicial
	return chama_pagina_inicial();
	
};

// valida se a pagina existe
if(retorne_pagina_existe($id) == false){
	
	// chama a pagina inicial
	return chama_pagina_inicial();
	
};

// pagia inicial
$pagina_inicial = PAGINA_INICIAL."?".$variavel_campo[25]."=$id";

// redireciona
header("Location: $pagina_inicial");

};

?>