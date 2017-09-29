<?php

// retorna os dados da imagem do usuario
function retorne_dados_imagem_usuario($modo, $uid){

// modo 0 imagem de perfil
// modo 1 imagem de capa
// modo 2 imagem de perfil de pagina
// modo 3 imagem de capa de pagina

// globals
global $tabela_banco;

// valida o modo
switch($modo){
	
	case 0:
	// tabela
	$tabela = $tabela_banco[2];
	// query
	$query = "select *from $tabela where uid='$uid';";
	break;
	
	case 1:
	// tabela
	$tabela = $tabela_banco[20];
	// query
	$query = "select *from $tabela where id='$uid';";
	break;
	
};

// dados query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0];

};

?>