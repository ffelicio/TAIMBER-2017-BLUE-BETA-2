
// funcao para alterar o relacionamento
function alterar_relacionamento(modo, idcampo_1, idcampo_2){

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = obtem_valor_campo(idcampo_1, 0);
array_valores[1] = parseInt(modo);

// alterando relacionamento
executador_acao(array_valores, 117, idcampo_2);

};
