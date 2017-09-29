<?php

// retorna o numero de parametros via requeste
function retorne_numero_parametros_requeste(){

// url via request
$geturl = explode('/', $_SERVER['REQUEST_URI']);

// contador
$contador = 0;

// analisando urls
foreach($geturl as $url){
	
	// valida url
	if($url != null){
		
		// atualizando contador
		$contador++;
		
	};
	
};

// retorno
return $contador;

};

?>