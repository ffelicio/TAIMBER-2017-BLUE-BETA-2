
// pagina as recomendacoes de usuarios
function paginar_recomendacoes_usuario(modo, idcampo_1, idcampo_2){

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = modo;
array_valores[1] = idcampo_2;

// exibe o elemento oculto
exibe_elemento_oculto(idcampo_2, 0);

// carregando recomendacoes
executador_acao(array_valores, 121, idcampo_1);

};
