<?php

// retorna o numero de compartilhamentos
function retorne_numero_compartilhamentos($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// valida id
if($id == null){

	// retorno zero
	return 0;
	
};

// query
$query = "select *from $tabela where id_compartilhado='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>