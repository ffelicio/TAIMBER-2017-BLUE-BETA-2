<?php

// retorna o sexo do usuario
function retorne_sexo_texto_usuario($dados_perfil){

// globals
global $idioma_sistema;

// valida dados de perfil
if($dados_perfil[SEXO] == null){
	
	// retorno nulo
	return null;
	
};

// array com campos disponiveis
$array_campos_sexo = explode(",", $idioma_sistema[36]);

// valida sexo de usuario
if(retorne_sexo_usuario($dados_perfil) == true){
	
	// retorno
	return $array_campos_sexo[1];
	
}else{
	
	// retorno
	return $array_campos_sexo[2];
	
};

};

?>