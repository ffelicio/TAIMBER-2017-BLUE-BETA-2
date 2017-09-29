
// pesquisa paginas de usuario
function pesquisar_pagina_usuario(idcampo_1, idcampo_2){

// atualiza variaveis globais
v_variaveis_javascript['termo_pesquisa_pagina'] = obtem_valor_campo(idcampo_1, 0);

// pesquisando por paginas...
executador_acao(null, 61, idcampo_2);

};
