<?php

// remove a notificacao
function remove_notifica($uidamigo, $idpost, $tabela_acao, $modo){

// modo false remove apenas o informado
// modo true remove todas as notificacoes de uma tabela e um id

// globals
global $tabela_banco;

// tabelas
$tabela[0] = $tabela_banco[24];

// valida tipo de tabela de acao
switch($tabela_acao){
	
	case $tabela_banco[7]:
	// valida o id de amigo
	if($uidamigo != null){
		// query
		$query = "delete from $tabela[0] where uidamigo='$uidamigo' and idcomentario='$idpost' and tabela_acao='$tabela_acao';";
	}else{
		// query
		$query = "delete from $tabela[0] where idcomentario='$idpost' and tabela_acao='$tabela_acao';";		
	};
	
	break;
	
	case $tabela_banco[6]:
	// query
	$query = "delete from $tabela[0] where uidamigo='$uidamigo';";
	// removendo notificacao
	plugin_executa_query($query);
	// retorno nulo
	return null;
	break;
	
	default:
	// valida o uidamigo
	if($uidamigo == null){
		// query
		$query = "delete from $tabela[0] where idpost='$idpost' and tabela_acao='$tabela_acao';";
	}else{
		// query
		$query = "delete from $tabela[0] where uidamigo='$uidamigo' and idpost='$idpost' and tabela_acao='$tabela_acao';";
	};
	
};

// removendo notificacao
plugin_executa_query($query);

// remove todas as notificacoes de uma publicacao, ou imagem de album
if($modo == true and ($tabela_acao == $tabela_banco[4] or $tabela_acao == $tabela_banco[5])){
	
	// query
	$query = null;
	$query[0] = "delete from $tabela[0] where idpost='$idpost' and tabela_acao='$tabela_banco[7]';";
	$query[1] = "delete from $tabela[0] where idpost='$idpost' and tabela_acao='$tabela_banco[9]';";
	
	// removendo notificacao
	plugin_executa_query($query[0]);
	plugin_executa_query($query[1]);
	
};

};

?>