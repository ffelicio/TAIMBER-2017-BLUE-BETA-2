
// carrega o visualizador de amigos
function carregar_visualizador_amigos(id_visualizador){

// array de valores
var array_valores = [];

// nome de pesquisa atual
v_variaveis_javascript['nome_pesquisa_amigo_local'] = obtem_valor_campo("id_campo_pesquisa_amigos_local", 0);

// atualiza o array de valores
array_valores[0] = v_variaveis_javascript['parametro_pesquisa_amigos'];

// oculta ou exibe um elemento por id
oculta_exibe_elemento_idcampo("id_campo_progresso_gif_paginar_publicacoes", 0);

// carregando lista de amigos
executador_acao(array_valores, 14, id_visualizador);

};
