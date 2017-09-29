<?php

// excluir mensagem de usuario
function excluir_mensagem_usuario(){

// globals
global $tabela_banco;

// id de mensagem
$id = retorne_campo_formulario_request(4);

// tabela
$tabela = $tabela_banco[15];

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// modo
$modo = retorne_campo_formulario_request(6);

// id de amigo
$uidamigo = retorne_campo_formulario_request(13);

// valida o modo
switch($modo){

    case 1: // remove todas de um amigo
	// querys
    $query[0] = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
    $query[1] = "delete from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";
    break;
	
    case 2: // remove somente uma
	// querys
    $query[0] = "select *from $tabela where id='$id' and uid='$idusuario';";
    $query[1] = "delete from $tabela where id='$id' and uid='$idusuario';";
    break;

};

// dados de query
$dados_query = plugin_executa_query($query[0]);

// valida mensagem existe
if($dados_query["linhas"] >= 1){

    // exclui a mensagem...
    plugin_executa_query($query[1]);	
	
};

// agora exclui as imagens
excluir_imagens_chat($uidamigo);

};

?>