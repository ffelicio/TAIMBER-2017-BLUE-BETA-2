<?php

// aceita o relacionamento
function aceita_relacionamento(){

// globals
global $tabela_banco;

// uidamigo
$uidamigo = retorne_campo_formulario_request(13);

// relacao
$relacao = retorne_campo_formulario_request(53);

// definindo relacaoes possiveis
$relacao_1 = $relacao;
$relacao_2 = retorne_numero_compativel_relacao($relacao);

// valida todos os valores foram passados
if(retorne_usuario_amigo($uidamigo) == false or $uidamigo == null or $relacao == null){
	
	// retorno nulo
	return null;
	
};

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[39];

// querys
$query[] = "update $tabela set aceito='1' where uid='$uid' and uidamigo='$uidamigo' and relacao='$relacao_2';";
$query[] = "update $tabela set aceito='1' where uid='$uidamigo' and uidamigo='$uid' and relacao='$relacao_2';";

// uidamigos
$uidamigo_2 = retorne_idusuario_relacionamento($uidamigo, $relacao_1);

// aceitando relacionamento, e excluindo solicitações antigas
plugin_executa_varias_query($query);

// valida a relacao
switch($relacao_1){
	
	case 0:
	
	// remove relacionamentos de usuário e amigo
	$query[] = "delete from $tabela where uid='$uid' and aceito='0' and relacao='$relacao_1';";
	$query[] = "delete from $tabela where uidamigo='$uidamigo' and aceito='0' and relacao='$relacao_1';";

	// remove relacionamentos de ex
	$query[] = "delete from $tabela where uid='$uidamigo_2' and aceito='1' and relacao='$relacao_1';";
	$query[] = "delete from $tabela where uidamigo='$uidamigo_2' and aceito='1' and relacao='$relacao_1';";

	break;
	
};

// aceitando relacionamento, e excluindo solicitações antigas
plugin_executa_varias_query($query);

};

?>