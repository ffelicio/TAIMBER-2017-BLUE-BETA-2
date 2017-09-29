<?php

// carrega a lista de amigos que enviaram mensagem
function carregar_amigos_enviaram_mensagem(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[15];

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// zerar o contador
if(retorne_campo_formulario_request(20) == 1){
	
	// limit
    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), true);

	// zerou contador
	$zerou_contador = 1;	
	
}else{
	
    // limit
    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), false);

	// zerou contador
	$zerou_contador = 0;	
	
};

// query
$query = "select DISTINCT uidamigo from $tabela where uid='$idusuario' order by id desc $limit;";

// dados de query
$dados_query = plugin_executa_query($query);

// contador
$contador = 0;

// obtendo usuarios de mensagens
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separando dados
	$uidamigo = $dados[UIDAMIGO];
	
	// valida uidamigo
	if($uidamigo != null){
		
		// query para pesquisar ultima mensagem enviada
		$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' order by id desc limit 0,1;";
		
		// mensagens
        $mensagens .= constroe_mensagem(plugin_executa_query($query), true, true);

		// seta a mensagem como visualizada
		seta_mensagem_visualizada($uidamigo);

	};
	
};

// array de retorno
$array_retorno["dados"] = $mensagens;
$array_retorno["zerou_contador"] = $zerou_contador;

// retorno
return json_encode($array_retorno);

};

?>