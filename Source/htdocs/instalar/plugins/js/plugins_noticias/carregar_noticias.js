
// carrega as noticias
function carregar_noticias(idcampo_1, idcampo_2, modo){

// exibe a barra de progresso
exibe_elemento_oculto(idcampo_1, 0);

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = idcampo_1;
array_valores[1] = modo;

// carregando...
executador_acao(array_valores, 108, idcampo_2);

};
