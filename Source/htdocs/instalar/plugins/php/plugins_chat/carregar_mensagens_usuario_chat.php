<?php

// carrega as mensagens do chat do usuario
function carregar_mensagens_usuario_chat(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[15];

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// id de amigo
$uidamigo = retorne_idusuario_request();

// contador de avanco
$contador_avanco = contador_avanco(retorne_tipo_acao_pagina(), 3);

// numero de mensagens
$numero_mensagens = retorne_numero_mensagens(4, $uidamigo);

// id de campos
$idcampo[0] = md5("NUMERO_MENSAGENS_".$uidamigo.retorna_token_pagina_requeste());
$idcampo[1] = md5("NUMERO_NOVAS_MENSAGENS_".$uidamigo.retorna_token_pagina_requeste());

// valida existe novas mensagens
if($_SESSION[$idcampo[0]] != $numero_mensagens){
	
	// numero com novas mensagens
	$numero_novas_mensagens = $numero_mensagens - $_SESSION[$idcampo[0]];
	
	// atualiza sessao
    $_SESSION[$idcampo[0]] = $numero_mensagens;

}else{
	
	// valida o contador de avanco
	if($contador_avanco > 0){
		
		// array de retorno
		$array_retorno["dados"] = null;
		
		// retorno nulo
		return json_encode($array_retorno);
	
	};
	
};

// valida contador de avanco
if($contador_avanco == 0){
	
	// valida numero de mensagens
	// isto permite que as primeiras mensagens sejam carregadas
	if($numero_mensagens >= NUMERO_VALOR_PAGINACAO){
		
		// numero de mensagens de limit
		$numero_mensagens -= NUMERO_VALOR_PAGINACAO;
		
	}else{
		
		// numero de mensagens de limit
		$numero_mensagens = 0;
	
	};

	// limit
	$limit = "limit $numero_mensagens, ".NUMERO_VALOR_PAGINACAO;

	// query
	$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' order by id asc $limit;";

	
}else{
	
	// numero de mensagens de limit
	$numero_mensagens -= $numero_novas_mensagens;

	// limit
	$limit = "limit $numero_mensagens, ".NUMERO_VALOR_PAGINACAO;

	// query
	$query = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo' order by id asc $limit;";

};

// atualiza o contador de avanco
contador_avanco(retorne_tipo_acao_pagina(), 1);

// seta a mensagem como visualizada
seta_mensagem_visualizada($uidamigo);

// array de retorno
$array_retorno["dados"] = constroe_mensagem_chat(plugin_executa_query($query), false);

// retorno
return json_encode($array_retorno);

};

?>