<?php

// escrever depoimento
function escrever_depoimento(){

// globals
global $idioma_sistema;
global $tabela_banco;

// id de amigo que recebe depoimento
$uidamigo = retorne_idusuario_request();

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// depoimento
$depoimento = retorne_campo_formulario_request_htmlentites(19);

// valida dados de formulario
if($uidamigo == null or $idusuario == null or $depoimento == null){
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[190]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// valida desabilitou depoimentos
if(retorna_configuracao_privacidade(8, $uidamigo) == true){
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[187]);
	
	// retorno
	return json_encode($array_retorno);

};

// tabela
$tabela = $tabela_banco[13];

// data atual
$data = data_atual();

// query
$query[0] = "insert into $tabela values(null, '$uidamigo', '$idusuario', '$depoimento', '0', '$data');";
$query[1] = "select *from $tabela where uidamigo='$idusuario' and uid='$uidamigo' order by id desc limit 1;";

// executa query
plugin_executa_query($query[0]);

// nome de usuario
$nome_usuario = retorne_nome_usuario_logado();

// nome de amigo
$nome_amigo = retorne_nome_usuario(true, $uidamigo);

// dados de query
$dados_query = plugin_executa_query($query[1]);

// array com retorno
$array_retorno["dados"] = mensagem_sucesso($nome_usuario.$idioma_sistema[188].$nome_amigo.$idioma_sistema[189]);

// adiciona notificacao
adicionar_notifica($dados_query["dados"][0]["id"], $uidamigo, $tabela_banco[13], $tabela_banco[13], null);

// retorno
return json_encode($array_retorno);

};

?>