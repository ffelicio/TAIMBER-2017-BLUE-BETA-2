
// exibe os amigos online
function exibir_amigos_online(idcampo_1, idcampo_2, zerar_contador){

// atualiza as variaveis globais
v_variaveis_javascript['zera_contador_amigos_online'] = parseInt(zerar_contador);

// oculta a barra de progresso gif
oculta_exibe_elemento_idcampo(idcampo_2, 0);

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = idcampo_2;

// exibindo amigos online...
executador_acao(array_valores, 88, idcampo_1);

};
