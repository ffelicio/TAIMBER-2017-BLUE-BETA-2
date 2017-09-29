<?php

// retorna dados por id
function retorne_dados_id($id, $tabela){

// valida id e tabela
if($id == null or $tabela == null){
	
	// retorno nulo
	return null;
	
};

// query
$query = "select *from $tabela where id='$id';";

// dados
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0];

};

?>