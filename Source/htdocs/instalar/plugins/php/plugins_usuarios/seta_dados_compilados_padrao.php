<?php

// seta os dados compilados padrao
function seta_dados_compilados_padrao($array_dados_tabela){

// globals
global $tabela_banco;
global $idioma_sistema;

// dados do perfil
$dados_perfil = $array_dados_tabela[$tabela_banco[1]];

// dados de imagem
$dados_imagem = $array_dados_tabela[$tabela_banco[2]];

// imagens de servidor
$imagem_sistema[0] = retorne_imagem_sistema(5, null, true);
$imagem_sistema[1] = retorne_imagem_sistema(6, null, true);
$imagem_sistema[2] = retorne_imagem_sistema(7, null, true);
$imagem_sistema[3] = retorne_imagem_sistema(8, null, true);
$imagem_sistema[4] = retorne_imagem_sistema(39, null, true);
$imagem_sistema[5] = retorne_imagem_sistema(40, null, true);

// separa os dados de imagem
if($dados_imagem[UID] == null){
    
	// array com campos disponiveis
	$array_campos = explode(",", $idioma_sistema[388]);
	
	// define o sexo do usuario
	if($dados_perfil[SEXO] == $array_campos[1]){
	
		// setando dados...
	    $array_dados_tabela[$tabela_banco[2]][URL_HOST_GRANDE] = $imagem_sistema[0];
        $array_dados_tabela[$tabela_banco[2]][URL_HOST_MINIATURA] = $imagem_sistema[2];

	}else{
		
		// setando dados...
		$array_dados_tabela[$tabela_banco[2]][URL_HOST_GRANDE] = $imagem_sistema[1];
        $array_dados_tabela[$tabela_banco[2]][URL_HOST_MINIATURA] = $imagem_sistema[3];
    
	};
	
	// define o sexo do usuario
	if($dados_perfil[SEXO] == null){
	
		// setando dados...
	    $array_dados_tabela[$tabela_banco[2]][URL_HOST_GRANDE] = $imagem_sistema[4];
        $array_dados_tabela[$tabela_banco[2]][URL_HOST_MINIATURA] = $imagem_sistema[5];

	};
	
};

// retorno
return $array_dados_tabela;

};

?>