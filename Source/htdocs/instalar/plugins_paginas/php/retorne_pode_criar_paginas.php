<?php

// retorna se pode criar paginas
function retorne_pode_criar_paginas(){

// valida numero de paginas por usuario
if(retorne_numero_paginas_usuario(retorne_idusuario_logado()) >= NUMERO_MAXIMO_PAGINAS_USUARIO){

    // nao pode criar paginas
    return false;

}else{
	
	// pode criar paginas
	return true;

};

};

?>