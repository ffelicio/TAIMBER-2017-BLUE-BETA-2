<?php

// aplica o odioma do usuario
function aplica_idioma_usuario(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[34];

// dados do perfil do usuario logado
$dados_perfil_logado = retorne_dados_sessao_usuario_logado();

// separando dados
$dados_perfil_logado = $dados_perfil_logado[$tabela];

// separa dados
$modo = $dados_perfil_logado[MODO];

// valida modo
if($modo == null){
	
	// seta padrao
	$modo = 0;
	
};

// atualiza a sessao
$_SESSION[SESSAO_IDIOMA] = $modo;

};

?>