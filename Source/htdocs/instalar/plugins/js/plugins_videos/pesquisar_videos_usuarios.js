
// pesquisa as videos dos usuarios
function pesquisar_videos_usuarios(idcampo_1, idcampo_2, idcampo_3, idcampo_4){

// array de valores
var array_valores = [];

// atualiza as variaveis globais
v_variaveis_javascript['video_pesquisa'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['id_campo_progresso_pesquisa_videos'] = idcampo_2;
v_variaveis_javascript['id_campo_pesquisa_videos_informacoes'] = idcampo_4;

// exibe a barra de progresso gif
exibe_elemento_oculto(idcampo_2, 0)

// atualiza o array de valores
array_valores[0] = v_variaveis_javascript['chave'];

// carregando videos...
executador_acao(array_valores, 82, idcampo_3);

};
