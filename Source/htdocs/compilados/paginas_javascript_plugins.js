
function adiciona_inscrito_pagina(uid, idcampo_1, idcampo_2){
exibe_dialogo(idcampo_2);
executador_acao(null, 56, idcampo_1);
};

function alterar_modo_pesquisa_paginas(idcampo_1){
v_variaveis_javascript['modo_pesquisa_pagina'] = obtem_valor_campo(idcampo_1, 0);
};

function carregar_paginas_usuario(idcampo_1, idcampo_2, idcampo_3){
var array_valores = [];
array_valores[0] = idcampo_2;
array_valores[1] = parseInt(v_variaveis_javascript['modo_pesquisa_pagina']);
array_valores[2] = obtem_valor_campo(idcampo_3, 0);
executador_acao(array_valores, 116, idcampo_1);
};

function excluir_pagina_usuario(pagina, idcampo_1, idcampo_2, idcampo_3){
v_variaveis_javascript['senha_atual'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['id_pagina_excluir'] = pagina;
if(v_variaveis_javascript['senha_atual'].length == 0 || v_variaveis_javascript['id_pagina_excluir'].length == 0){
	document.getElementById(idcampo_1).focus();
	return null;
};
remove_elemento_id(idcampo_1);
remove_elemento_id(idcampo_3);
executador_acao(null, 60, idcampo_2);
};

function exibir_inscritos_pagina(pagina, idcampo_1, idcampo_2, modo){
exibe_elemento_oculto(idcampo_2, 1);
v_variaveis_javascript['id_pagina_visualizando'] = pagina;
v_variaveis_javascript['id_campo_progresso_gif_geral'] = idcampo_2;
v_variaveis_javascript['zera_contador_avanco_exibir_inscritos_pagina'] = modo;
executador_acao(null, 57, idcampo_1);
};

function pesquisar_pagina_usuario(idcampo_1, idcampo_2){
v_variaveis_javascript['termo_pesquisa_pagina'] = obtem_valor_campo(idcampo_1, 0);
executador_acao(null, 61, idcampo_2);
};

function salvar_configuracoes_pagina(idcampo_1, modo, numero_campo, pagina){
var v_valor_configuracao = obtem_valor_campo(idcampo_1, modo);
if(v_valor_configuracao == true){
	v_valor_configuracao = 1;
}else{
	v_valor_configuracao = 0;
};
v_variaveis_javascript['valor_configuracao_pagina'] = v_valor_configuracao;
v_variaveis_javascript['numero_configuracao_pagina'] = numero_campo;
v_variaveis_javascript['id_pagina_salva_configuracao'] = pagina;
executador_acao(null, 59, null);
};

function visualizar_paginas_usuario(modo, idcampo_1, idcampo_2, idcampo_3){
v_variaveis_javascript['modo_visualiza_paginas_usuario'] = modo;
if(v_variaveis_javascript['bkp_ultimo_modo_visualiza_paginas_usuario'] != modo && modo != 3){
    v_variaveis_javascript['modo_visualiza_paginas_usuario_paginar'] = modo;
	v_variaveis_javascript['bkp_ultimo_modo_visualiza_paginas_usuario'] = modo;
    v_variaveis_javascript['modo_visualiza_paginas_usuario'] = 2;	
};
v_variaveis_javascript['id_campo_progresso_gif_visualizar_paginas'] = idcampo_2;
exibe_elemento_oculto(idcampo_2, 0);
executador_acao(null, 58, idcampo_3);
};
