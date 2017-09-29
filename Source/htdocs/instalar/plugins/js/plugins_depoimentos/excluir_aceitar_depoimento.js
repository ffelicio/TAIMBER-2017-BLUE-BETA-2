
// exclui ou aceita um depoimento
function excluir_aceitar_depoimento(id, idcampo_1, idcampo_2, modo){

// seta valores em variaveis globais
v_variaveis_javascript['id_depoimento_excluir'] = id;
v_variaveis_javascript['modo_aceita_exclui_depoimento'] = modo;
v_variaveis_javascript['idcampo_depoimento_usuario'] = idcampo_2;

// exclui ou aceita baseado em modo
executador_acao(null, 36, idcampo_1);

};
