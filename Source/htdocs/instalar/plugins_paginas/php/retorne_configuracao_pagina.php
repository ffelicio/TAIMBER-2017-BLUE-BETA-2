<?php

// retorna a configuracao da pagina
function retorne_configuracao_pagina($id, $modo){

// modo 0 comentarios
// modo 1 curtidas
// modo 2 inscricoes
// modo 3 somente amigos podem se inscrever

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[23] where pagina='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida o numero de linhas
if($dados_query["linhas"] == 0){
	
	// retorno
	return true;
	
};

// valida o modo
switch($modo){
	
	case 0:
	// retorno
	$retorno = $dados_query["dados"][0][HABILITAR_COMENTARIOS];
	break;
	
	case 1:
	// retorno
	$retorno = $dados_query["dados"][0][HABILITAR_CURTIDAS];
	break;
	
	case 2:
	// retorno
	$retorno = $dados_query["dados"][0][HABILITAR_INSCRICOES];
	break;
	
	case 3:
	// retorno
	$retorno = $dados_query["dados"][0][SOMENTE_AMIGOS_PODEM_SE_INSCREVER];
	
	// valida retorno
	if($retorno == 1){

		// dados da pagina
		$dados = retorne_dados_cadastro_pagina($id);

        // valida se o usuario logado e amigo do usuario dono da pagina
		if(retorne_usuario_amigo($dados[UID]) == true){
			
			// retorno verdadeiro
			$retorno = 1;
			
		}else{
			
			// retorno falso
			$retorno = 0;
			
		};

	}else{
		
		// retorno verdadeiro
		$retorno = 1;

	};

	break;

};

// valida o retorno
if($retorno == 1){
	
	// retorno
	return true;
	
}else{
	
	// retorno
	return false;

};

};

?>