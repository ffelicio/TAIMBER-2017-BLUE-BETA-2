<?php

// retorna a extensao da imagem usando mime
function retorne_extensao_imagem_mime($imagem){

// dados da imagem
$dados_imagem = getimagesize($imagem);

// valida o tipo de imagem
$dados = explode("/", $dados_imagem["mime"]);

// valida se é uma imagem
if($dados[0] != "image"){
	
	// retorno nulo
	return null;
	
}else{
	
	// retorno
	return ".".$dados[1];
	
};

};

?>