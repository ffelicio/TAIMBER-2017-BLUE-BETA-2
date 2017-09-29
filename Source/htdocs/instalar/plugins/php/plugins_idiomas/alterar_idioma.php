<?php

// altera o idioma
function alterar_idioma(){

// globals
global $tabela_banco;

// usuario logado
$usuario_logado = retorne_usuario_logado();

// valida se a chave foi passada
if(retorna_chave_request() == null and $usuario_logado == true){
	
	// retorno nulo
	return null;
	
};

// tabela
$tabela = $tabela_banco[34];

// modo
$modo = retorne_campo_formulario_request(6);

// valida modo
if($modo == null){
	
	// retorno nulo
	return null;
	
};

// valida usuario logado
if($usuario_logado == true){
	
	// id de usuario logado
	$uid = retorne_idusuario_logado();

	// atualiza as configuracoes do usuario
	$query[0] = "select *from $tabela where uid='$uid';";
	$query[1] = "insert into $tabela values(null, '$uid', '$modo');";
	$query[2] = "update $tabela set modo='$modo' where uid='$uid';";
	
	// dados de query
	$dados_query = plugin_executa_query($query[0]);
	
	// valida numero de linhas
	if($dados_query["linhas"] == 0){
		
		// adicionando...
		plugin_executa_query($query[1]);
		
	}else{
		
		// atualizando...
		plugin_executa_query($query[2]);
		
	};

};

// atualiza a sessao
$_SESSION[SESSAO_IDIOMA] = $modo;

};

?>