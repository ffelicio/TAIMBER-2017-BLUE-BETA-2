
// salva a frase de efeito
function salvar_frase_efeito(idcampo_1, idcampo_2, idcampo_3){

// array de valores
var array_valores = [];

// atualiza valores
array_valores[0] = obtem_valor_campo(idcampo_1, 0);

// ocultando ou exibindo itens
oculta_exibe_elemento_idcampo(idcampo_2, 0);
oculta_exibe_elemento_idcampo(idcampo_3, null);

// salvando frase
executador_acao(array_valores, 66, null);

};
