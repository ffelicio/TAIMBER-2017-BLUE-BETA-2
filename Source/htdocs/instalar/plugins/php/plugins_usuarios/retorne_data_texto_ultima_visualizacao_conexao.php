<?php

// retorna a data modo texto da ultima visualizacao de perfil do usuario
function retorne_data_texto_ultima_visualizacao_conexao($uid, $modo_json){

// globals
global $tabela_banco;

// valida uid
if($uid == null){
	
    // id de usuario
    $uid = retorne_idusuario_logado();

};

// tabela
$tabela = $tabela_banco[17];

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// data
$data = $dados_query["dados"][0][DATA_CONEXAO];

// valida data
if($data == null){
	
	// retorno nulo
	return null;
	
};

// data completa
$data = converte_data_amigavel(true, $data);

// retorno
return $data;

};

?>