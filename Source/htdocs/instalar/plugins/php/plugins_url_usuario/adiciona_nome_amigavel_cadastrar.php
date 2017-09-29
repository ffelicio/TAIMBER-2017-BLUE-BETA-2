<?php

// adiciona nome amigavel ao se cadastrar
function adiciona_nome_amigavel_cadastrar($nome, $sobrenome){

// globals
global $tabela_banco;

// adiciona sobrenome em nome
$nome .= "_".$sobrenome;

// tabela
$tabela = $tabela_banco[28];

// uid
$uid = retorne_idusuario_logado();

// nome amigavel
$nome = retorne_nome_amigavel($nome)."_".$uid;

// valida nome disponivel
if(retorne_nome_url_amigavel_existe($nome, 0) == true){
	
	// retorno nulo
	return null;
	
};

// query
$query = "insert into $tabela values(null, '$uid', '$nome', '0', null);";

// executa query
plugin_executa_query($query);

};

?>