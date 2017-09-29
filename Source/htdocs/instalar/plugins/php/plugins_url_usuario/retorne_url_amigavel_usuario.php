<?php

// retorna a url amigavel de usuario
function retorne_url_amigavel_usuario($uid, $modo, $pagina){

// modo 0 usuario
// modo 1 pagina

// globals
global $tabela_banco;
global $variavel_campo;

// tabela
$tabela = $tabela_banco[28];

// valida o modo
if($modo == 0){
	
	// query
	$query = "select *from $tabela where uid='$uid' and modo='$modo';";

}else{
	
	// query
	$query = "select *from $tabela where modo='$modo' and pagina='$pagina';";
	
};

// dados de query
$dados_query = plugin_executa_query($query);

// nome amigavel
$nome_amigavel = $dados_query["dados"][0][NOME_AMIGAVEL];

// valida url amigavel
if($nome_amigavel == null){
	
	// url
	$url = PAGINA_INICIAL."?$variavel_campo[5]=$uid";

}else{
	
	// valida o modo
	if($modo == 0){
		
		// url
		$url = HOST_SERVIDOR."/$nome_amigavel";

	}else{
		
		// url
		$url = HOST_SERVIDOR."/$variavel_campo[47]/$nome_amigavel";
	
	};
};

// retorno
return $url;

};

?>