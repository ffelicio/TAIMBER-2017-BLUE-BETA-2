<?php

// adiciona uma notificacao
function adicionar_notifica($id, $uidamigo, $tabela_notifica, $tabela_acao, $idcomentario){

// globals
global $tabela_banco;

// valida usuario logado
if(retorne_usuario_logado() == false or retorne_usuario_dono_perfil($uidamigo) == true){
	
	// retorno nulo
	return null;
	
};

// data atual
$data = data_atual();

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabelas
$tabela[0] = $tabela_banco[24];

// query
$query[0] = "insert into $tabela[0] values(null, '$id', '$tabela_notifica', '$tabela_acao', '$uid', '$uidamigo', '0', '$idcomentario', '$data');";
$query[1] = "select *from $tabela[0] where uidamigo='$uidamigo' and idpost='$id' and tabela_acao='$tabela_acao';";

// dados de query
$dados_query[1] = plugin_executa_query($query[1]);

// valida a tabela de acao
switch($tabela_acao){
	
	case $tabela_banco[7]: // tabela de comentarios
	$dados_query[1]["linhas"] = 0;
	break;
	
	case $tabela_banco[13]: // tabela de depoimentos
	$dados_query[1]["linhas"] = 0;
	break;
	
	case $tabela_banco[6]; // tabela de amizades
	$dados_query[1]["linhas"] = 0;
	break;

};

// verifica se a notificacao ja existe
if($dados_query[1]["linhas"] == 0){
	
	// adicionando notificacao...
	plugin_executa_query($query[0]);

}else{

	// removendo notificacao...
	remove_notifica($uidamigo, $id, $tabela_acao, false);

};

};

?>