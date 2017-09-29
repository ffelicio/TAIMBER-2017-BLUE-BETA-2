<?php

// retorna o numero de publicacoes
function retorne_numero_publicacoes($uid){

// globals
global $tabela_banco;

// valida id de usuario
if($uid == null){
	
	// id de usuario via requeste
	$uid = retorne_idusuario_request();
	
};


// valida id de usuario
if($uid == null){
	
	// retorno
	return 0;
	
};

// tabela
$tabela = $tabela_banco[5];

// query
$query = "select *from $tabela where uid='$uid' and pagina='';";

// retorno
return retorne_numero_linhas_query($query);

};

?>