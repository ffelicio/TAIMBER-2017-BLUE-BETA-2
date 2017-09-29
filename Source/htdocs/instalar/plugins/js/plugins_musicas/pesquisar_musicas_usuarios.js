
// pesquisa as musicas dos usuarios
function pesquisar_musicas_usuarios(idcampo_1, idcampo_2, idcampo_3, idcampo_4){

// array de valores
var array_valores = [];

// atualiza as variaveis globais
v_variaveis_javascript['musica_pesquisa'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['id_campo_progresso_pesquisa_musicas'] = idcampo_2;
v_variaveis_javascript['id_campo_pesquisa_musicas_informacoes'] = idcampo_4;

// atualiza o array de valores
array_valores[0] = idcampo_2;
array_valores[1] = v_variaveis_javascript['chave'];

// exibe a barra de progresso gif
exibe_elemento_oculto(idcampo_2, 0)

// carregando musicas...
executador_acao(array_valores, 78, idcampo_3);

};
