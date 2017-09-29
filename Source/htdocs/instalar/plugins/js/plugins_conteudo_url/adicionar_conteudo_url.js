
// adiciona conteudo de url
function adicionar_conteudo_url(idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5){

// array de valores
var array_valores = [];

// obtendo url de campo de entrada
var v_url = obtem_valor_campo(idcampo_1, 0);

// atualiza o array de valores
array_valores[0] = v_url;
array_valores[1] = idcampo_3;
array_valores[2] = idcampo_4;
array_valores[3] = idcampo_5;

// exibe a barra de progresso
exibe_elemento_oculto(idcampo_4, 0);

// executando acao e obtendo informacoes de site
executador_acao(array_valores, 94, idcampo_2);

};
