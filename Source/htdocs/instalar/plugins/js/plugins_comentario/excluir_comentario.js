
// exclui o comentario de usuario
function excluir_comentario(id, uid, id_comentario_usuario, id_dialogo_excluir, tabela_comentario, id_post){

// define o id de comentario
v_variaveis_javascript['comentario_usuario_excluir_id'] = id;

// define o id de usuario dono do comentario
v_variaveis_javascript['comentario_usuario_excluir_idusuario'] = uid;

// tabela de campo de comentario
v_variaveis_javascript['tabela_campo'] = tabela_comentario;

// define o id de post
v_variaveis_javascript['id_post'] = id_post;

// exclui o comentario
executador_acao(null, 21, id_comentario_usuario);

// oculta o dialogo de excluir comentario
exibe_dialogo(id_dialogo_excluir);

};
