<?php

// retorna o titulo da pagina
function retorne_titulo_pagina(){

// globals
global $idioma_sistema;

// numero de parametros via requeste
$numero_parametros_requeste = retorne_numero_parametros_requeste();

// usuario logado
$usuario_logado = retorne_usuario_logado();

// valida numero de parametros de requeste e se o usuário está logado
if($numero_parametros_requeste == 0 and $usuario_logado == false){
	
	// retorno
	return $idioma_sistema[534];
	
};

// valida o modo de pagina
if(retorne_modo_pagina() == false){
	
	// valida usuario logado
	if($usuario_logado == true){
		
		// nome do usuario
		$nome_usuario = retorne_nome_usuario(true, retorne_idusuario_request());

	}else{
		
		// nome nulo
		$nome_usuario = null;
		
	};
	
}else{
	
	// dados da pagina
	$dados = retorne_dados_perfil_pagina(retorne_idpagina_request());
	
	// nome da pagina
	$nome_usuario = $dados[TITULO_DA_PAGINA];
	
};

// valida nome de usuario
if($nome_usuario != null){
	
    // titulo da pagina
    $titulo = $nome_usuario;
	
}else{
	
	// titulo da pagina
    $titulo = NOME_SISTEMA;	
	
};

// retorno
return $titulo;

};

?>