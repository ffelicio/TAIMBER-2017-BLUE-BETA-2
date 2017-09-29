
// exibe os inscritos da pagina
function exibir_inscritos_pagina(pagina, idcampo_1, idcampo_2, modo){

// exibe a barra de progresso gif
exibe_elemento_oculto(idcampo_2, 1);

// atualiza as variaveis globais
v_variaveis_javascript['id_pagina_visualizando'] = pagina;
v_variaveis_javascript['id_campo_progresso_gif_geral'] = idcampo_2;
v_variaveis_javascript['zera_contador_avanco_exibir_inscritos_pagina'] = modo;

// executador de acoes...
executador_acao(null, 57, idcampo_1);

};
