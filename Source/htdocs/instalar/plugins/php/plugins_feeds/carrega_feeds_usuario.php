<?php

// carrega os feeds do usuario
function carrega_feeds_usuario(){

// globals
global $tabela_banco;

// tabela de feeds
$tabela[0] = $tabela_banco[8];

// tabela de publicacoes
$tabela[1] = $tabela_banco[5];

// id de usuario logado
$uid = retorne_idusuario_logado();

// limit de query
$limit_query = retorne_limit_query_iniciar(false, null);

// query
$query = "select *from $tabela[0] where uid='$uid' order by id desc $limit_query;";

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// contador
$contador = 0;

// extraindo feeds
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados de feed
	$dados = $dados_query["dados"][$contador];
	
	// id de postagem
	$id_post = $dados[ID_POST];
	
	// query
	$query = "select *from $tabela[1] where id='$id_post';";
	
	// array de dados
	$dados_publicacao = plugin_executa_query($query);
	
	// html
	$html .= constroe_publicacao($dados_publicacao["dados"]);

};

// array com retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>