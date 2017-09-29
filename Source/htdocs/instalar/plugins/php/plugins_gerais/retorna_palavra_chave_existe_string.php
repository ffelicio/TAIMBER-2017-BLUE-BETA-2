<?php

// retorna se a palavra chave existe na string
function retorna_palavra_chave_existe_string($conteudo, $palavra_chave){

// converte para minusculo
$conteudo = trim(converte_minusculo($conteudo));
$palavra_chave = trim(converte_minusculo($palavra_chave));

// valida conteudo e palavra chave
if($conteudo == null or $palavra_chave == null){
	
	// retorno
	return false;
	
};

// valida palavra proibida
if($conteudo == $palavra_chave){
	
    // encontrou palavra
    return true;

};

// palavras a serem comparadas
$palavra_1 = " ".$palavra_chave;
$palavra_2 = $palavra_chave." ";

// valida palavra proibida
if(strpos($conteudo, $palavra_1) !== false or strpos($conteudo, $palavra_2) !== false){

    // encontrou palavra
    return true;
	
}else{
	
	// não encontrou palavra
	return false;
	
};	

};

?>