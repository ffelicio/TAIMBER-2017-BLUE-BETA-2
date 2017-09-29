
// exclui publicacao de usuario
function excluir_publicacao_usuario(idpublicacao, identificador_publicacao){

// seta o identificador de publicacao a ser excluida
v_variaveis_javascript['id_temp_publicacao_excluir'] = idpublicacao;

// exclui a publicacao
executador_acao(null, 12, identificador_publicacao);

// exclui publicacao visualmente
remove_elemento_id(identificador_publicacao);

};
