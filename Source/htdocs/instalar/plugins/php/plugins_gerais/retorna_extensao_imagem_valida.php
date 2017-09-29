<?php

// retorna se uma extensao informada é uma extensao de imagem
function retorna_extensao_imagem_valida($conteudo){

// globals
global $extensao_imagem;

// valida conteudo
if($conteudo == null){
	
	// retorno
	return false;
	
};

// valida se o ponto da extensao foi informado
if($conteudo[0] != "."){
	
	// adiciona ponto de estensao
	$extensao = ".".$conteudo;
	
};

// validando extensoes
foreach($extensao_imagem as $extensao_atual){
	
	// valida extensao
	if($extensao_atual != null and $extensao != null){
		
		// converte para minusculo
		$extensao_atual = converte_minusculo($extensao_atual);
		$extensao = converte_minusculo($extensao);
		
		// valida extensao
		if($extensao_atual == $extensao){
			
			// retorno
			return true;
			
		};

	};

};

// retorno
return false;

};

?>