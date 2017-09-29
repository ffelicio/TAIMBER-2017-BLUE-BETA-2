<?php

// retorna somente o nome amigavel de usuario por idusuario
function retorne_somente_nome_amigavel_idusuario($uid, $modo, $pagina){

// modo 0 usuario
// modo 1 pagina

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[28];

// valida modo
if($modo == 0){
	
	// query
	$query = "select *from $tabela where uid='$uid' and modo='$modo';";

}else{
	
	// query
	$query = "select *from $tabela where modo='$modo' and pagina='$pagina';";
	
};

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["dados"][0][NOME_AMIGAVEL];

};

?>