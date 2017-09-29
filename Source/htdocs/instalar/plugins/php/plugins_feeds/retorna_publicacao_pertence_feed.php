<?php

// retorna se a publicacao pertence aos feeds
function retorna_publicacao_pertence_feed($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[8];

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "select *from $tabela where uid='$uid' and id_post='$id';";

// valida numero de linhas
if(retorne_numero_linhas_query($query) == 0){
	
	// retorna falso
	return false;
	
}else{

	// retorno verdadeiro
	return true;
	
};

};

?>