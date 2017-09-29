<?php

// exclui o comentario
function excluir_comentario(){

// globals
global $tabela_banco;

// dados de formulario
$id = retorne_campo_formulario_request(4);
$uid = retorne_idusuario_request();
$id_post = retorne_campo_formulario_request(11);
$tabela_campo = retorne_tabela_comentario(retorne_campo_formulario_request(10));

// query
$query[0] = "select *from $tabela_campo where id='$id_post';";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// id de usuario dono de publicacao
$idusuario_dono = $dados_query["dados"][0][UID];

// valida usuario logado dono de publicacao
# ISTO GARANTE QUE SOMENTE O DONO DA POSTAGEM OU DO COMENTARIO
# PODE EXCLUIR UM COMENTARIO
if($idusuario_dono != retorne_idusuario_logado() and $uid != retorne_idusuario_logado()){

    // retorno nulo	
    return null;
	
};

// query
$query[1] = "delete from $tabela_banco[7] where id='$id';";

// exclui comentario
plugin_executa_query($query[1]);

// array de retorno
$array_retorno["dados"] = null;

// remove a marcacao
remove_marcacao_usuario($id, $tabela_banco[7]);

// exclui as respostas de comentario
excluir_respostas_comentario($id);

// remove notificacao
remove_notifica($idusuario_dono, $id, $tabela_banco[7], true);

// retorno
return json_encode($array_retorno);

};

?>