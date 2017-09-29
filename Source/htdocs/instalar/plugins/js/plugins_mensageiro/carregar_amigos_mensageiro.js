
// carrega os amigos de mensageiro
function carregar_amigos_mensageiro(idcampo_1, idcampo_2){

// array de valores
var array_valores = [];

// atualiza array de valores
array_valores[0] = obtem_valor_campo(idcampo_2, 0);

// carregando amigos de mensageiro
executador_acao(array_valores, 111, idcampo_1);

};
