<?php

// bloqueia o usuario
function bloquear_usuario(){

// globals
global $tabela_banco;

// tabelas
$tabela[0] = $tabela_banco[10];
$tabela[1] = $tabela_banco[37];

// data atual
$data = data_atual();

// id de amigo
$uidamigo = retorne_idusuario_request();

// valida pode bloquear amigo
if(retorne_pode_bloquear($uidamigo) == false){

	// retorno nulo
	return null;
	
};

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query[0] = "select *from $tabela[0] where uid='$idusuario' and uidamigo='$uidamigo';";
$query[1] = "insert into $tabela[0] values(null, '$idusuario', '$uidamigo', '$idusuario', '$data');";
$query[2] = "insert into $tabela[0] values(null, '$uidamigo', '$idusuario', '$idusuario', '$data');";
$query[3] = "delete from $tabela[1] where uid='$idusuario' and uidamigo='$uidamigo';";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// exclui dados de amizade
excluir_dados_amizade($uidamigo, false);

// valida numero de linhas
if($dados_query["linhas"] == 0){
	
	// query
    plugin_executa_query($query[1]);
    plugin_executa_query($query[2]);
	plugin_executa_query($query[3]);
	
};

// limpa a sessao de usuarios abertos de chat
limpa_sessao_usuarios_abertos_chat($uidamigo);

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

// remove as recomendacoes de usuario
remover_recomendacoes_usuario();

// erradica as recomendacoes
erradicar_recomendacoes();

// array de retorno
$array_retorno["dados"] = null;

// retorno
return json_encode($array_retorno);

};

?>