
// exibe o info link
function exibe_info_link(modo, uid, idcampo_1, idcampo_2, ponto){

// abre o menu de suspense
exibe_menu_acao(idcampo_1, ponto);

// array com valores
var array_valores = [];

// atualizando array com valores
array_valores[0] = modo;
array_valores[1] = uid;

// obtendo informacoes
executador_acao(array_valores, 93, idcampo_2);

};
