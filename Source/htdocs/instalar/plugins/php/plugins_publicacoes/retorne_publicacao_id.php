<?php

// retorna a publicacao por id
function retorne_publicacao_id($id){

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[5] where id='$id' or id_compartilhado='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida o numero de linhas
if($dados_query["linhas"] == 0){
	
	// retorno
	return mensagem_conteudo_indisponivel();
	
};

// retorno
return constroe_publicacao($dados_query["dados"]);

};

?>