<?php

// retorna o id do compartilhamento via id de post
function retorne_idcompartilhamento_id_post($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// query
$query = "select *from $tabela where id='$id' limit 1;";

// dados de query
$dados_query = plugin_executa_query($query);

// id de compartilhamento
$id_compartilhado = $dados_query["dados"][0][ID_COMPARTILHADO];

// valida id compartilhado
if($id_compartilhado == null){
	
	// retorna o id
	return $id;
	
}else{
	
	// retorna o id compartilhado
	return $id_compartilhado;
	
};

};

?>