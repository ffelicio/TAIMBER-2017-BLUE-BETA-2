
// atualiza as notificacoes via timer
function atualiza_notifica_timer(idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5, idcampo_6, idcampo_7, idcampo_8, idcampo_9){

// array de valores
var array_valores = [];

// atualiza as variaveis globais
v_variaveis_javascript['id_notifica_num_geral'] = idcampo_1;
v_variaveis_javascript['id_notifica_num_comentario'] = idcampo_2;
v_variaveis_javascript['id_notifica_num_curtida'] = idcampo_3;
v_variaveis_javascript['id_notifica_num_mensagens'] = idcampo_4;
v_variaveis_javascript['id_notifica_num_depoimentos'] = idcampo_5;
v_variaveis_javascript['id_notifica_num_amizades_add'] = idcampo_6;
v_variaveis_javascript['id_notifica_num_marcacoes'] = idcampo_7;
v_variaveis_javascript['id_notifica_num_amizdeaceitos_acc'] = idcampo_8;

// atualiza o array de valores
array_valores[0] = idcampo_9;

// atualiza as notificacoes
executador_acao(array_valores, 64, null);

};
