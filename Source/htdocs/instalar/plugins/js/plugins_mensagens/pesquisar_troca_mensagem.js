
// pesquisa por troca de mensagens
function pesquisar_troca_mensagem(idcampo_1, idcampo_2){

// atualiza variaveis globais
v_variaveis_javascript['termo_pesquisa_mensagem'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['zera_contador_mensagens'] = 1;
v_variaveis_javascript['modo_mensagens'] = 1;
v_variaveis_javascript['uidamigo_mensagem_abrir'] = -1;

// pesquisa...
executador_acao(null, 42, idcampo_2);

};