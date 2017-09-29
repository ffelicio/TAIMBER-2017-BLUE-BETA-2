<?php

// retorna se pode construir o chat
function retorne_pode_construir_chat(){

// globals
global $tabela_banco;

// valida usuario logado e configuracao de modulo
if(retorne_usuario_logado() == false or HABILITAR_MODULO_CHAT == false){
	
	// nao pode exibir o chat
    return false;
	
};

// valida configuracao
if(retorna_configuracao_privacidade(9, retorne_idusuario_logado()) == true){

	// nao pode exibir o chat
    return false;

};

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_logado_sessao();

// array com dados de amigos
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];

// valida numero de amigos
if(retorne_numero_amigos($array_dados_amigos) > 0){
	
	// pode exibir o chat
	return true;
	
}else{
	
	// nao pode exibir o chat
	return false;
	
};

};

?>