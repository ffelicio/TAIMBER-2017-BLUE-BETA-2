<?php

// retorna se constroe a pagina
function retorna_constroe_pagina(){

// valida id de pagina
if(retorne_idpagina_request() == null){
	
	// nao constroe pagina
	return false;
	
}else{
	
	// constroe a pagina
	return true;
	
};

};

?>