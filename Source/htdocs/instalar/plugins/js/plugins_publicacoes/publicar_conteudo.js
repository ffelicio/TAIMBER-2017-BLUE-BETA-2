
// publicar conteudo
function publicar_conteudo(idcampo_0, idcampo_1, idcampo_2, idcampo_3, pagina, idcampo_4, idcampo_5){

// array de valores
var array_valores = [];

// atualiza array de valores
array_valores[0] = obtem_valor_campo(idcampo_0, 1);
array_valores[1] = idcampo_0;

// move o foco
document.getElementById(array_valores[1]).focus();

// oculta o campo de publicacao
exibe_elemento_oculto(idcampo_2, null);

// exibe elemento oculto
exibe_elemento_oculto(idcampo_3, 0);

// posta conteudo
executador_acao(array_valores, 8, idcampo_1);

// oculta o elemento
exibe_elemento_oculto(idcampo_3, null);

// limpar os marcadores
limpar_marcadores();

// ocultando pre visualizar musicas
exibe_elemento_oculto(v_variaveis_javascript['idcampo_previsualiza_musicas'], null);
exibe_elemento_oculto(v_variaveis_javascript['idcampo_previsualiza_videos'], null);

// limpa conteudo de url
seta_valor_campo(idcampo_4, null, 1);
seta_valor_campo(idcampo_5, null, 1);

// oculta o elemento
exibe_elemento_oculto(idcampo_4, null);

// limpa valores
seta_valor_campo(idcampo_0, null, 2);

};
