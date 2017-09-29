<?php

// retorna se o id de um item de tabela existe
function retorne_id_existe($id, $tabela){

// query
$query = "select *from $tabela where id='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida numero de linhas
if($dados_query["linhas"] == 0){
	
	// nao existe!
	return false;
	
}else{
	
	// existe
	return true;
	
};

};

?>