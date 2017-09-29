<?php

// retorna um array com ultimas ids de publicacoes de usuario
// util para os feeds
function retorne_array_ids_ultimas_publicacoes_usuario($uid, $modo){

// modo true usa limit
// modo false nao usa limit

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// valida o modo
if($modo == true){
	
	// limit
	$limit_query = "limit ".NUMERO_LIMITE_ULTIMAS_PUBLICACOES_USUARIO;

};

// query
$query = "select *from $tabela where uid='$uid' order by id asc $limit_query;";

// dados de query
$dados_query = plugin_executa_query($query);

// contador
$contador = 0;

// construindo array de retorno
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
	$pagina = $dados[PAGINA];

	// valida id de publicacao
	if($id != null and $pagina == null){
		
		// atualiza o array de retorno
		$array_retorno[] = $id;
		
	};

};

// retorno
return $array_retorno;

};

?>