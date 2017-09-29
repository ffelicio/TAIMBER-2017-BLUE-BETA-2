
// carrega os aniversariantes
function carregar_aniversariantes(idcampo_1, idcampo_2, zera_contador){

// array de valores
var array_valores = [];

// exibe a barra de progresso
exibe_elemento_oculto(idcampo_2, 0);

// atualiza variaveis globais
v_variaveis_javascript['id_campo_progresso_gif_visualizador_aniversariantes'] = idcampo_2;
v_variaveis_javascript['zera_contador_aniversariantes'] = zera_contador;

// atualiza o array de valores
array_valores[0] = parseInt(zera_contador);

// carrega os aniversariantes
executador_acao(array_valores, 72, idcampo_1);

};
