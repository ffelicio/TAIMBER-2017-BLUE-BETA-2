
// exclui feed de usuario
function excluir_feed_usuario(idpublicacao, identificador_publicacao){

// seta o identificador de publicacao a ser excluida
v_variaveis_javascript['id_temp_publicacao_excluir'] = idpublicacao;

// exclui a publicacao
executador_acao(null, 110, identificador_publicacao);

// exclui publicacao visualmente
remove_elemento_id(identificador_publicacao);

};
