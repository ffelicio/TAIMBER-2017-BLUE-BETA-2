<?php

// retorna se o conteudo sera bloqueado
function retorna_conteudo_bloqueado($conteudo){

// globals
global $chave_improprio;

// id e usuario logado
$uid = retorne_idusuario_logado();

// palavras chave a serem bloqueadas
$palavras_chave = retorna_configuracao_privacidade(3, $uid);

// configuração de bloqueio de pornografia
$bloqueia_pornografia = retorna_configuracao_privacidade(2, $uid);

// valida se bloqueia as palavras chave
if($palavras_chave != null){
	
	// bloqueio de palavra do próprio usuário
	$bloqueio[0] = retorne_palavra_impropria($conteudo, $palavras_chave);
	
};

// valida configuracao
if($bloqueia_pornografia == true){
	
	// bloqueio de palavras chave
	$bloqueio[1] = retorne_palavra_impropria($conteudo, $chave_improprio);

};

// valida bloqueios
if($bloqueio[0] == true or $bloqueio[1] == true){
	
	// retorna que uma palavra foi bloqueada
	return true;
	
}else{
	
	// retorno padrão
	return false;
	
};

};

?>