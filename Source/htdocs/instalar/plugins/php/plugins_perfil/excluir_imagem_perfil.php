<?php

// exclui a imagem de perfil
function excluir_imagem_perfil(){

// globals
global $tabela_banco;

$modo = retorne_campo_formulario_request(6);

// valida chave de requeste
if($modo != 1){
	
	// array de retorno
	$array_retorno["dados"] = 0;
	
	// retorno
	return json_encode($array_retorno);

};

// id de usuario logado
$uid = retorne_idusuario_logado();

// exclui e recria pastas
excluir_pastas_subpastas(retorne_pasta_usuario($uid, 1, true), true);

// tabela
$tabela = $tabela_banco[2];

// query
$query = "delete from $tabela where uid='$uid';";

// executa query
plugin_executa_query($query);

// array de retorno
$array_retorno["dados"] = 1;

// retorno
return json_encode($array_retorno);
	
};

?>