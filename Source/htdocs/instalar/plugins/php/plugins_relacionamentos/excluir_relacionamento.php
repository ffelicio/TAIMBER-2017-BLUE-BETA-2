<?php

// exclui o relacionamento
function excluir_relacionamento(){

// globals
global $tabela_banco;

// uidamigo
$uidamigo = retorne_campo_formulario_request(13);

// relacao
$relacao = retorne_campo_formulario_request(53);

// valida todos os valores foram passados
if($uidamigo == null or $relacao == null){
	
	// retorno nulo
	return null;
	
};

// definindo relacaoes possiveis
$relacao_1 = $relacao;
$relacao_2 = retorne_numero_compativel_relacao($relacao);

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[39];

// query
$query[0] = "delete from $tabela where uid='$uid' and uidamigo='$uidamigo' and relacao='$relacao_1';";
$query[1] = "delete from $tabela where uid='$uidamigo' and uidamigo='$uid' and relacao='$relacao_2';";

// excluindo relacionamento
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

};

?>