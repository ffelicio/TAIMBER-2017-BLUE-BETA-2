
// carrega as solicitacoes de amizade
function carrega_solicitacoes_amizade(id){

// altera a variavel que ira carregar o conteudo
v_variaveis_javascript['campo_carrega_conteudo'] = id;

// exibe a barra de progresso gif
exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);

// carrega solicitacoes de amizade...
executador_acao(null, 25, id);

};