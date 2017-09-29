<?php

// cadastra noticia em tabela
function cadastra_noticia($titulo, $link, $conteudo, $data){

// globals
global $tabela_banco;

// valida titulo e conteudo
if($link == null){
	
	// retorno nulo
	return null;
	
};

// transforma em codigo html
$titulo = htmlentities($titulo);
$link = htmlentities($link);
$conteudo = htmlentities($conteudo);
$data_noticia = htmlentities($data);

// transforma em codigo html
$titulo = remove_html($titulo);
$link = remove_html($link);
$conteudo = remove_html($conteudo);
$data_noticia = remove_html($data);

// tabelas
$tabela = $tabela_banco[35];

// id de usuario logado
$uid = retorne_idusuario_logado();

// data atual
$data = data_atual();

// query
$query = "insert into $tabela values(null, '$uid', '$titulo', '$link', '$conteudo', '$data_noticia', '$data');";

// cadastrando
plugin_executa_query($query);

};

?>