
// função para reposicionar a capa
function reposicionar_capa(modo, idcampo_1){

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = modo;
array_valores[1] = idcampo_1;
array_valores[2] = $("#" + idcampo_1).height();;

// reposicionando a capa
executador_acao(array_valores, 128, idcampo_1);

};
