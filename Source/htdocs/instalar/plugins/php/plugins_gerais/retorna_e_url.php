<?php

// retorna se uma string e uma url
function retorna_e_url($conteudo){

// converte para minusculo
$conteudo = converte_minusculo($conteudo);

// sub conteudo
$sub_conteudo = substr($conteudo, 0, 7);

// valida sub conteudo
switch($sub_conteudo){
	
	case "http://": // protocolo http
	return true;
	break;

};

};

?>