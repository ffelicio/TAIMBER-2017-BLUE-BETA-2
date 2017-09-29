<?php

// retorna se o usuario esta online
function retorne_usuario_online($uid){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[17];

// valida uid
if($uid == null){
	
    // id de usuario
    $uid = retorne_idusuario_logado();

};

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida data de conexao existe
if($dados_query["dados"][0][DATA_CONEXAO] == null){

    // esta offline
    return false;

};

// calcula o tempo de diferenca
$tempo_diferenca = diferenca_data_conexao($dados_query["dados"][0][DATA_CONEXAO]);

// retorno
if($tempo_diferenca <= TEMPO_FICAR_OFFLINE){

    // online
    return true;

}else{

    // offline
    return false;

};

};

?>