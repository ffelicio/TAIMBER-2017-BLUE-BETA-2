<?php

// carrega as notificacoes
function carrega_notificacoes($tabela_notifica, $tabela_acao, $modo){

// modo 0 nao visualizados
// modo 1 visualizados

// globals
global $tabela_banco;
global $idioma_sistema;

// tipo de acao
$tipo_acao = retorne_campo_formulario_request(2);

// tabela
$tabela[0] = $tabela_banco[24];

// limit de query
$limit = contador_avanco($tipo_acao, 1) - NUMERO_VALOR_PAGINACAO;
$limit = "limit $limit, ".NUMERO_VALOR_PAGINACAO;

// id de usuario logado
$uid = retorne_idusuario_logado();

// valida tabela de notificacao
if($tabela_notifica != null and $tabela_acao == null){

	// query
	$query[0] = "select *from $tabela[0] where tabela_notifica='-1' and uidamigo='$uid' order by id desc $limit;";
	$query[1] = "update $tabela[0] set visualizado='1' where tabela_notifica='-1' and uidamigo='$uid';";

}else{

	// valida tipo de tabela de acao
	switch($tabela_acao){
		
		case $tabela_banco[14]: // marcacoes
		// query
		$query[0] = "select *from $tabela[0] where tabela_notifica='$tabela_acao' and uidamigo='$uid' order by id desc $limit;";
		$query[1] = "update $tabela[0] set visualizado='1' where tabela_notifica='$tabela_acao' and uidamigo='$uid';";
		break;
		
		default: // padrao
		// query
		$query[0] = "select *from $tabela[0] where tabela_acao='$tabela_acao' and uidamigo='$uid' order by id desc $limit;";
		$query[1] = "update $tabela[0] set visualizado='1' where tabela_acao='$tabela_acao' and uidamigo='$uid';";

	};	
	
};

// contador
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query[0]);

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// listando notificacoes
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];

	// constroe a notificacao
	$html .= constroe_notificacao_usuario($dados);

};

// limpa as notificacoes
plugin_executa_query($query[1]);

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>