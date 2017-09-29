
// atualiza a descricao de imagem de album
function atualizar_descricao_imagem_album(idcampo_1, id, chave){

// array com valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = obtem_valor_campo(idcampo_1, 1);
array_valores[1] = id;
array_valores[2] = chave;

// atualizando descricao
executador_acao(array_valores, 98, null);

};
