<?php

// retorna o nome do usuario
function retorne_nome_usuario($modo, $uid){

// modo true exibe o sobrenonme
// modo false nao exibe o sobrenome

// globals
global $tabela_banco;
global $idioma_sistema;

// dados compilados do usuario
$dados_compilados_usuario = retorne_dados_compilados_usuario($uid);

// separa dados por tabela
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];

// valida o modo
if($modo == true){
	
	// nome de usuario
	$nome = $dados_perfil[NOME]." ".$dados_perfil[SOBRENOME];

}else{
	
	// nome de usuario
	$nome = $dados_perfil[NOME];
	
};

// valida nome
if($dados_perfil[NOME] == null){
	
	// nome
	$nome = $idioma_sistema[415];
	
};

// retorno
return $nome;

};

?>