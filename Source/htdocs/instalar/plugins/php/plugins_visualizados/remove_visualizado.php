<?php

// remove o visualizado
function remove_visualizado($id, $tabela_campo){

// globals
global $tabela_banco;

// valida id e tabela de banco de dados
if($id == null or $tabela_banco == null){
	
	// retorno nulo
	return null;
	
};

// tabela
$tabela = $tabela_banco[40];

// query
$query = "delete from $tabela where id_post='$id' and tabela_campo='$tabela_campo';";

// excluindo
plugin_executa_query($query);

};

?>