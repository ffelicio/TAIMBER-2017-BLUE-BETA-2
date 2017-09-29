<?php

// retorna a imagem do sexo do usuario
function retorne_imagem_sexo_usuario($modo, $dados_perfil, $uid){

// modo true retorna a url da imagem
// modo false retorna a imagem

// globals
global $tabela_banco;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// valida dados do perfil
if($dados_perfil == null){
	
	// dados do perfil
	$dados_perfil = retorne_dados_compilados_usuario($uid);

	// separa os dados do perfil
	$dados_perfil = $dados_perfil[$tabela_banco[1]];

};

// define o sexo do usuario
if($dados_perfil[SEXO] == null){

	// valida modo mobile
	if($modo_mobile == true){
		
		// retorno
		return retorne_imagem_sistema(93, false, $modo);		
		
	}else{
		
		// retorno
		return retorne_imagem_sistema(39, false, $modo);

	};

};
	
// valida o sexo do usuario
if(retorne_sexo_usuario($dados_perfil) == true){
	
	// valida modo mobile
	if($modo_mobile == true){
		
		// retorno
		return retorne_imagem_sistema(91, false, $modo);
		
	}else{
		
		// retorno
		return retorne_imagem_sistema(11, false, $modo);	
		
	};
	
}else{
	
	// valida modo mobile
	if($modo_mobile == true){

		// retorno
		return retorne_imagem_sistema(92, false, $modo);		
	
	}else{
		
		// retorno
		return retorne_imagem_sistema(24, false, $modo);
		
	};
	
};

};

?>