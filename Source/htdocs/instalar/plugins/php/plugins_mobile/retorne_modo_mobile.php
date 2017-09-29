<?php

// retorna se esta no modo mobile
function retorne_modo_mobile(){

// valida simula modo mobile
if(SIMULA_MODO_MOBILE == true or $_SESSION[SESSAO_MODO_MOBILE] == true){
	
	// retorno
	return true;
	
};

// retorno
return $_SESSION[SESSAO_RESOLUCAO_RETORNA];

};

?>