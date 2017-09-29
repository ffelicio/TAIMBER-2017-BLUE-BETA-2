<?php

// retorna o host da url
function retorna_host_valido_dados_site($url_site){

// converte para minusculo
$url_site = strtolower($url_site);

// obtendo parse
$parse = @parse_url($url_site);

// obtendo host
$host = $parse['host'];

// verifica se e o proprio servidor
if("http://".$host == URL_SERVIDOR){
	
	// nao e uma url valida
	return false;

};

// valida se é www. no começo
if(substr($url_site, 0, 4) == "www."){
	
	// e uma url valida
	return true;
	
};

// valida retorno
if($host == "www.youtube.com" or $host == null){

	// nao e uma url valida
	return false;

}else{

	// e uma url valida
	return true;

};

};

?>