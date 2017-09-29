
// compartilhar
function compartilhar(idcampo_1, id, idcampo_2, idcampo_3, idcampo_4){

// atualiza variaveis globais
v_variaveis_javascript['id_post_compartilha'] = id;

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = idcampo_2;
array_valores[1] = idcampo_3;

// compartilhar
executador_acao(array_valores, 73, idcampo_1);

};
