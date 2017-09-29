<?php

// atualiza ou retorna os dados da sessao do usuario
function atualiza_retorna_dados_usuario_sessao($modo, $limpa_direto){

#>> para acessar os dados <<
#>> array_retorno[nome_tabela][campo_tabela]

// isto é necessário em caso de uploads, publicações novas etc...
if($limpa_direto == true){
	
	// limpa os dados diretamente da sessao
	retorne_pode_retornar_dados_usuario_nova_consulta(1, retorne_idusuario_request(), null);
	retorne_pode_retornar_dados_usuario_nova_consulta(1, retorne_idusuario_logado(), null);
	
};

// salvando os dados na memoria
if($modo == true){
	
	// salvando os dados
    $_SESSION[SESSAO_DADOS_USUARIO][retorne_idusuario_request()] = retorne_dados_compilados_usuario(retorne_idusuario_request());
	$_SESSION[SESSAO_DADOS_USUARIO_LOGADO] = retorne_dados_compilados_usuario(retorne_idusuario_logado());

}else{
	
	// retorno
	return $_SESSION[SESSAO_DADOS_USUARIO][retorne_idusuario_request()];
	
};

};

?>