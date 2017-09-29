<?php

// constroe as imagens de album de usuário pelo modo de pagina
function constroe_imagens_album_usuario_modo_album(){

// globals
global $tabela_banco;

// modo album
$modo_album = retorne_campo_formulario_request(58);

// tabela
$tabela = $tabela_banco[4];

// id de usuário via requeste
$uid = retorne_idusuario_request();

// limit de query
$limit_query = retorne_limit_query_iniciar(false, retorne_tipo_acao_pagina());

// valida o modo de album
switch($modo_album){

	case 0:
	// query
	$query = "select *from $tabela where uid='$uid' and modo_chat='0' and chave='' and pagina='' order by id desc $limit_query;";
	break;
	
	case 1:
	// query
	$query = "select *from $tabela where uid='$uid' and modo_chat='0' and chave!='' and pagina='' order by id desc $limit_query;";
	break;

	default:
	// query
	$query = "select *from $tabela where uid='$uid' and modo_chat='0' order by id desc $limit_query;";
	
};

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// contador
$contador = 0;

// listando imagens de album
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// constroe a imagem de album por dados
	$html .= constroe_imagem_album_dados($dados, 4, null);

};

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>