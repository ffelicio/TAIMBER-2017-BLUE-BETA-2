
// carrega a lista de usuarios bloqueados
function carrega_usuarios_bloqueados(id_campo_conteudo){
	
// altera a variavel que ira carregar o conteudo
v_variaveis_javascript['campo_carrega_conteudo'] = id_campo_conteudo;

// exibe a barra de progresso gif
exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);

// carrega os usuarios bloqueados
executador_acao(null, v_variaveis_javascript['tipo_acao_pagina'], id_campo_conteudo);

};
