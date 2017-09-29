<?php

// retorna o id de usuario amigavel
function retorne_idusuario_amigavel($nome_amigavel, $modo, $pagina){

// modo 0 usuario
// modo 1 pagina

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[28];

// valida modo
if($modo == 0){
	
	// query
	$query = "select *from $tabela where nome_amigavel='$nome_amigavel' and modo='$modo';";

}else{
	
	// query
	$query = "select *from $tabela where nome_amigavel='$nome_amigavel' and modo='$modo' and pagina='$pagina';";

};

// dados de query
$dados_query = plugin_executa_query($query);

// valida o modo
if($modo == 0){
	
	// retorno
	return $dados_query["dados"][0][UID];

}else{

	// retorno
	return $dados_query["dados"][0][PAGINA];
	
};

};

?>