<?php

// retorna se uma palavra é imprópria
function retorne_palavra_impropria($conteudo, $chave_parametro){

// globals
global $chave_improprio;

// valida se a chave foi repassada por parâmetro
if($chave_parametro == null){

	// setando palavras chave padrão
	$chave_parametro = $chave_improprio;
	
};

// separa as palavras impróprias da lista
$palavras = explode(",", $chave_parametro);
$conteudo_array = explode(" ", $conteudo);

// vasculha o array em busca de palavras impróprias
foreach($palavras as $palavra_chave){

	// valida palavra
	if($palavra_chave != null){

		// retorna se a palavra chave existe na string
		if(retorna_palavra_chave_existe_string($conteudo, $palavra_chave) == true){
			
			// retorna que a palavra a ser proíbida existe
			return true;
			
		};

	};

};

// retorno padrão
return false;

};

?>