<?php

// salva o comentario editado
function salvar_comentario_editado(){

// globals
global $tabela_banco;

// dados de formulario
$id = retorne_campo_formulario_request(4);
$comentario = retorne_campo_formulario_request_htmlentites(9);

// valida campos de formulario e usuario logado
if($id == null or $comentario == null or retorne_usuario_logado() == false){
	
	// retorno nulo
    return null;
	
};

// nome
$nome = retorne_nome_link_usuario(true, retorne_uid_dono_comentario($id));

// id de usuario
$idusuario = retorne_idusuario_logado();

// query
$query = "update $tabela_banco[7] set comentario='$comentario' where id='$id' and uid='$idusuario';";

// executa query
plugin_executa_query($query);

// array de retorno
$array_retorno["dados"] = $nome.converter_urls(false, $comentario);

// retorno
return json_encode($array_retorno);

};

?>