<?php

// retorna se e o modo pagina
function retorne_modo_pagina(){

// valida id de pagina
if(retorne_idpagina_request() != null){
	
	// modo pagina
	return true;
	
}else{
	
	// nao e uma pagina
	return false;
	
};

};

?>