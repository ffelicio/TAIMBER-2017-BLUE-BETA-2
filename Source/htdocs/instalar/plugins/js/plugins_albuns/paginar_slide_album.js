
// paginar slide album
function paginar_slide_album(id, modo, idcampo_1, uid){

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = id;
array_valores[1] = modo;
array_valores[2] = idcampo_1;
array_valores[3] = uid;

// atualiza as variaveis globais
v_array_ids_imagens_albuns[idcampo_1] = idcampo_1;

// paginando slide de imagem...
executador_acao(array_valores, 125, idcampo_1);

};
