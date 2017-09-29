<?php

// retorna o numero de mensagens
function retorne_numero_mensagens($modo, $uidamigo){

// modo 1 todas as mensagens
// modo 2 novas mensagens
// modo 3 mensagens lidas
// modo 4 retorna todas as mensagens de um amigo
// modo 5 retorna todas as mensagens nao lidas do usuario logado

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[15];

// id de usuario
$idusuario = retorne_idusuario_logado();

// valida o modo
switch($modo){
	
	case 1:
	$query = "select DISTINCT uidamigo from $tabela where uid='$idusuario';";
	break;

	case 2:
	$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' and visualizado='0';";
	break;
	
	case 3:
	$query = "select DISTINCT uidamigo from $tabela where uid='$idusuario' and visualizado='1';";
	break;

	case 4:
	$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
	break;
	
	case 5:
	$query = "select *from $tabela where uid='$idusuario' and visualizado='0';";
	break;
	
};

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>