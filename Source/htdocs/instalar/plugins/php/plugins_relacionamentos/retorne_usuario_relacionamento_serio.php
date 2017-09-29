<?php

// retorna o id de usuario de relacionamento
function retorne_usuario_relacionamento_serio($uid, $relacao){

// globals
global $tabela_banco;

// valida id de usuario
if($uid == null){

	// id de usuario logado
	$uid = retorne_idusuario_logado();
	
};

// valida relacao
switch($relacao){
	
	case 0:
	$permite_varios = false;
	break;
	
	default:
	$permite_varios = true;
	
};

// tabela
$tabela = $tabela_banco[39];

// query
$query = "select *from $tabela where uid='$uid' and relacao='$relacao' and aceito='1';";

// numero de linhas
$linhas = retorne_numero_linhas_query($query);

// valida o numero de linhas
if($linhas == 0){
	
	// retorno falso
	return false;
	
};

// valida numero de linhas e permite varios relacionamentos
if($linhas > 0 and $permite_varios == true){
	
	// retorno falso
	return false;
	
};

// valida numero de linhas e permite varios relacionamentos
if($linhas > 0 and $permite_varios == false){
	
	// retorno verdadeiro
	return true;
	
};

};

?>