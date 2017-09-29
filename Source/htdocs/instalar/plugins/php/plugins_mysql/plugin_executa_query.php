<?php

// plugin executa query
function plugin_executa_query($query){

// valia pode executar a query
if(retorne_pode_executar_query($query) == false){
	
	// retorno nulo
	return null;
	
};

// roda a query e retorna seus dados se houverem
return plugin_roda_query($query);

};

?>