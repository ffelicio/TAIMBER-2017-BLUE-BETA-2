
// modo alterar opcoes de solicitacao
function alterar_modo_opcoes_solicitacao(idcampo, id_campo_conteudo){

// seta o modo de solicitacao de amizade
v_variaveis_javascript['modo_opcoes_solicitacao_amizade'] = document.getElementById(idcampo).value;

// altera a variavel que ira carregar o conteudo
v_variaveis_javascript['campo_carrega_conteudo'] = id_campo_conteudo;

// limpa contador antigo
executador_acao(null, 26, id_campo_conteudo);

};
