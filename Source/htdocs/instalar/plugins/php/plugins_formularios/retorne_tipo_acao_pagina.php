<?php

// retorna o tipo de acao de pagina
function retorne_tipo_acao_pagina(){

// tipo de acao
$tipo_acao = retorne_campo_formulario_request(2);

// valida id de pagina
if(retorne_idpagina_request() != null){

	// valida o tipo de acao
	switch(retorne_campo_formulario_request(2)){
		
		case 7:
		// tipo de acaoes imagens de albuns
		$tipo_acao = 7;
		break;
		
		default:
		// tipo de acoes publicacoes 
		$tipo_acao = 9;	

	};

};

// valida usuario dono do perfil e o tipo de acao padrao
# O USUARIO NAO E O DONO DO PERFIL, E NENHUM TIPO DE ACAO FOI DEFINIDA
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false and $tipo_acao == null){

    // tipo de acoes publicacoes
    $tipo_acao = 9;
	
};

// valida usuario dono do perfil e o tipo de acao padrao
# O USUARIO E O DONO DO PERFIL, MAS NENHUM TIPO DE ACAO FOI DEFINIDO
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == true and $tipo_acao == null){
	
	// tipo de acao feeds
    $tipo_acao = 22;
	
};

// valida usuario dono do perfil e o tipo de acao padrao
# O USUARIO QUE NAO E DONO DO PERFIL TENTA ACESSAR OS FEEDS DO USUARIO EM VISUALIZACAO
# ISTO IMPEDE A MODIFICACAO DIRETA PELO USUARIO TENTANDO MODIFICAR OS ENDERECOS URLS
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false and $tipo_acao == 22){

    // tipo de acoes publicacoes
    $tipo_acao = 9;
	
};

// tipo de acoes voltadas para as configuracoes de pagina
// tipo de acao e igual a 25 mas compartilham modos diferentes
if($tipo_acao == 25){
	
	// verifica o modo de acao 25
	switch(retorne_campo_formulario_request(6)){
		
		case 1: // formulario alterar a senha, nao faça nada
		$tipo_acao = -1;
		break;
		
		case 3: // carrega os usuarios bloqueados
		$tipo_acao = 27;
		break;
		
		case 4: // carrega as visitas do perfil
		$tipo_acao = 29;
		break;

	};
	
};

// retorno
return $tipo_acao;

};

?>