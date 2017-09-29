<?php

// retorna dados por chave
function retorne_dados_chave($chave, $tabela){

// valida chave e tabela
if($chave == null or $tabela == null){
	
	// retorno nulo
	return null;
	
};

// query
$query = "select *from $tabela where chave='$chave';";

// dados
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0];

};

?>