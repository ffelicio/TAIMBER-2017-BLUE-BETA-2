<?php

// atualiza a conexao do usuario
function atualizar_conexao_usuario(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[17];

// id de usuario logado
$uid = retorne_idusuario_logado();

// data da conexao atual
$data_conexao = retorne_data_atual_conexao();

// query
$query[0] = "select *from $tabela where uid='$uid';";
$query[1] = "update $tabela set data_conexao='$data_conexao' where uid='$uid';";
$query[2] = "insert into $tabela values(null, '$uid', '$data_conexao');";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// valida numero de linhas
if($dados_query["linhas"] == 0){
	
	// insere dados
	plugin_executa_query($query[2]);
	
}else{
	
	// atualiza os dados
	plugin_executa_query($query[1]);
	
};

};

?>