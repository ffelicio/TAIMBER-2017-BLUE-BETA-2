<?php

// carrega os links de medias, video, musica etc
function carrega_links_medias(){

// globals
global $tabela_banco;

// tabela
$tabela[0] = $tabela_banco[26];

// id de usuasrio logado
$uid = retorne_idusuario_logado();

// tipo de acao de pagina
$tipo_acao = retorne_tipo_acao_pagina();

// valida se deve limpar os dados antigos
if(contador_avanco($tipo_acao, 3) == 0){

	// limit de query
	$limit = "limit ".contador_avanco($tipo_acao, 1).", ".NUMERO_VALOR_PAGINACAO;
	
}else{
	
	// limit de query
	$limit = retorne_limit_query($tipo_acao, false);

};

// lista de query
$lista_query = retorne_completa_recomendar_musicas();

// query
$query = "select *from $tabela[0] where ($lista_query) and uid!='$uid' order by id desc $limit;";

// dados de query
$dados_query = plugin_executa_query($query);

//html
$html = constroe_link_media($dados_query, false, true);

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>