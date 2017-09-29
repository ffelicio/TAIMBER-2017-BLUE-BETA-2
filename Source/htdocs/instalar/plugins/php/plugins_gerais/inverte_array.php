<?php

// inverte um array
function inverte_array($array_conteudo){

// valida se é um array e inverte
if(is_array($array_conteudo) == true){
	
	// invertendo array...
	$array_conteudo = array_reverse($array_conteudo);
	
};

// retorno
return $array_conteudo;

};

?>