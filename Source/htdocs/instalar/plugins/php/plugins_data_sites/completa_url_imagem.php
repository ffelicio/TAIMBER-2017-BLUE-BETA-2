<?php

// completa a url de imagem
function completa_url_imagem($url_imagem, $url_site){

// dados de imagem
$dados_imagem = @parse_url($url_imagem);

// valida protocolo
if($dados_imagem["scheme"] == null){
	
	// dados de site
	$dados_site = @parse_url($url_site);

	// host
	$host = $dados_site['host'];
	
	// url completa
	$url_imagem = "http://$host/".$url_imagem;
	
};

// retorno
return $url_imagem;

};

?>