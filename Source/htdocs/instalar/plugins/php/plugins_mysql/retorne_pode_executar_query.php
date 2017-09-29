<?php

// retorna se pode executar a query
function retorne_pode_executar_query($query){

// globals
# esta variavel permite_query só existe no instalador, é necessário permitir qualquer comando de query
#para que a instalação seja bem sucedida.
global $permite_query;

// retorno
# nao mudar isto de lugar!!!
$retorno = true;

// valida configuracao
if($permite_query == true){
	
	// retorno
	return $retorno;
	
};

// converte para minusculo
$query = converte_minusculo($query);

// separando query em pedacos
$query = explode(" ", $query);

// pegando o comando principal da query
$query = trim($query[0]);

// usuario logado
$usuario_logado = retorne_usuario_logado();

// comandos principais possiveis
$array_comum[] = "insert";
$array_comum[] = "delete";
$array_comum[] = "update";

// querys proibidas
$query_proibida[] = "create";
$query_proibida[] = "drop";
$query_proibida[] = "alter";

// listando querys proibidas
foreach($array_comum as $comando_analisa){
	
	// valida query proibida
	if(retorna_palavra_chave_existe_string($query, $comando_analisa) == true and $usuario_logado == false){
		
		// retorno
		$retorno = false;
		
		// saindo de laço
		break;
		
	};

};

// listando querys proibidas
foreach($query_proibida as $comando_analisa){
	
	// valida query proibida
	if(retorna_palavra_chave_existe_string($query, $comando_analisa) == true and $usuario_logado == false){
		
		// retorno
		$retorno = false;
		
		// saindo de laço
		break;
		
	};

};

// retorno
return $retorno;

};

?>