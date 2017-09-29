<?php

// retorna a imagem de perfil de pagina
function retorne_imagem_perfil_pagina($id, $modo){

// modo true imagem miniatura
// modo false imagem tamanho normal

// globals
global $tabela_banco;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// dados
$dados = retorne_dados_perfil_pagina($id);

// tabela
$tabela = $tabela_banco[20];

// query
$query = "select *from $tabela where id='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// separa os dados
$dados_query = $dados_query["dados"][0];

// separa os dados
$url_host_grande = $dados_query[URL_HOST_GRANDE];
$url_host_miniatura = $dados_query[URL_HOST_MINIATURA];
$url_host_mobile = $dados_query[URL_HOST_MOBILE];

// valida urls validas
if($url_host_grande == null or $url_host_miniatura == null){
	
	// define as imagens padrao
    $url_host_grande = retorne_imagem_sistema(22, false, true);
    $url_host_miniatura = retorne_imagem_sistema(21, false, true);

};

// titulo de comunidade
$titulo_comunidade = $dados[TITULO_DA_PAGINA];

// valida o modo
if($modo == true){
	
	// imagem de perfil
	$imagem_perfil = "
	<img src='$url_host_grande' title='$titulo_comunidade' alt='$titulo_comunidade'>
	";
	
}else{
	
	// imagem de perfil
	$imagem_perfil = "
	<img src='$url_host_miniatura' title='$titulo_comunidade' alt='$titulo_comunidade'>
	";
	
};

// html
$html = retorne_link_pagina($id, $titulo_comunidade, $imagem_perfil);

// retorno
return $html;

};

?>