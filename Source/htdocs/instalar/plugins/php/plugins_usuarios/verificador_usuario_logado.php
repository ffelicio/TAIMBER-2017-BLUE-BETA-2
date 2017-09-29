<?php

// verificador de usuario logado
function verificador_usuario_logado(){

// incremento
$incremento = TEMPO_TIMER_CONEXAO / 1000;

// modo
$modo = retorne_campo_formulario_request(6);

// valida incremento
if($incremento == 0){
	
	// valor padrao
	$incremento = 1;
	
};

// identificadores
$identificador[0] = SESSAO_DESLOGAR_AUTOMATICO;
$identificador[1] = codifica_md5(SESSAO_DESLOGAR_AUTOMATICO.retorne_idusuario_logado());

// token da pagina
$token = retorna_token_pagina_requeste();

// contador
$contador = 0;

// percorre valores iguals
foreach($_SESSION[$identificador[1]] as $valor){

	// valida o modo
	if($modo == $valor){
		
		// incrementa contador
		$contador++;

	};

};

// atualiza a sessao de modos
$_SESSION[$identificador[1]][$token] = $modo;

// valida o modo
if($contador == 0){
	
	// zera a sessao de deslogar
	$_SESSION[$identificador[0]] = 0;	
	
};

// valida atingiu o tempo limite para deslogar
if($_SESSION[$identificador[0]] >= NUMERO_SEGUNDOS_DESLOGAR_AUTOMATICO){
	
	// zera a sessao de deslogar
	$_SESSION[$identificador[0]] = 0;
	
	// valida configuracao de privacidade
	if(retorna_configuracao_privacidade(4, retorne_idusuario_logado()) == true){

		// faz logout
		logout_usuario();
		
	};

}else{
	
	// atualiza a sessao
	$_SESSION[$identificador[0]] += $incremento;
	
};

// array de retorno
$array_retorno["dados"] = retorne_usuario_logado();
$array_retorno[MODO] = $modo;

// retorno
return json_encode($array_retorno);

};

?>