<?php

// retorna o relacionamento do usuario
function retorne_relacionamento_usuario($relacao, $uid){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[39];

// valida uid
if($uid == null){
	
	// id de usuario logado
	$uid = retorne_idusuario_logado();

};

// query
$query = "select *from $tabela where uid='$uid' and relacao='$relacao' and aceito='1';";

// dados de query
$dados_query = retorne_dados_query($query);

// retorno
return $dados_query[UIDAMIGO];

};

?>