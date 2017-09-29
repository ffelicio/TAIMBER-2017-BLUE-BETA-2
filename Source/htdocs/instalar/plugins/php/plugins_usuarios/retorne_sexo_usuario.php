<?php

// retorna o sexo do usuario
function retorne_sexo_usuario($dados_perfil){

// 1 e homem
// 0 e mulher

// globals
global $idioma_sistema;

// valida id de usuario
if($dados_perfil[UID] == null){
	
	// retorno
	return 1;
	
};

// array com campos disponiveis
$array_campos_sexo = explode(",", $idioma_sistema[388]);

// valida sexo de usuario
if($dados_perfil[SEXO] == null){
	
	// retorno padrao
	return 1;
	
};

// valida dados e retorna
return $dados_perfil[SEXO] == $array_campos_sexo[1];

};

?>