
// carrega as paginas do usuário
function carregar_paginas_usuario(idcampo_1, idcampo_2, idcampo_3){

// array de valores
var array_valores = [];

// atualiza o array de valores
array_valores[0] = idcampo_2;
array_valores[1] = parseInt(v_variaveis_javascript['modo_pesquisa_pagina']);
array_valores[2] = obtem_valor_campo(idcampo_3, 0);

// carregando paginas
executador_acao(array_valores, 116, idcampo_1);

};
